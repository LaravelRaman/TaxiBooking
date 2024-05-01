<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Event;
use App\Models\Payment;
use App\Models\VehicleType;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Square\SquareClient;
use Square\LocationsApi;
use Square\Exceptions\ApiException;
use Square\Http\ApiResponse;
use Square\Models\ListLocationsResponse;
use Square\Models\Money;
use Square\Models\CreatePaymentRequest;
use Square\Models\createPayment;
use Square\Environment;
use Illuminate\Support\Facades\Http;

class SquarePaymentController extends Controller
{
    public function initiatePayment(Request $request)
    {
        
        $square_client = new SquareClient([
            'accessToken' => 'EAAAELjDK2vg2D0zNTxfbUMNVyfblXVs6EvyoGfTvDO5efbYwZZIXr6dbwNJJOPq',
            'environment' => 'sandbox',
        ]);

        $locationId = 'LYQ8QF8RS568Z';

        $payments_api = $square_client->getPaymentsApi();

        $booking_slug = $request->input('slug');

        $booking_details = Booking::where('booking_slug', $booking_slug)->first();
        $booking_details=$booking_details->toArray();

        if($booking_details!=null && strtolower($booking_details['payment_status'])!='paid')
        {
            
            $total_distance = 0;
            $total_duration = 0;
            $event_multiplier = 1;
            if ($booking_details != null) {
                $total_distance = $booking_details['distance'] + 0;
                $total_duration = ($booking_details['duration'] / 60 + 0);

                if ($booking_details['service_type'] == "Special Event") {
                    $event = Event::where('id', $booking_details['booking_event'])->first();
                    $event_multiplier = $event->price_multiplier;
                }
            }

            //$vhls = Vehicle::where('id', $booking_details['vehicle_type'])->first();
            $vhls = VehicleType::where('vehicle_types.id', $booking_details['vehicle_type'])->join('vehicle_price', 'vehicle_types.id', '=', 'vehicle_price.vehicle_type_id')->first();


            $v = $vhls->toArray();
            $v= $this->vehicleCalc($v,$booking_details);

            $vhls = $v;

            $vehicle_estimated_price = $v['travel_cost'];
            if ($booking_details['international_airport_pickup_nos'] > 0)
                $vehicle_estimated_price = $vehicle_estimated_price + $v['international_airport_pickup_charges'] * $booking_details['international_airport_pickup_nos'];

            if ($booking_details['domestic_airport_pickup_nos'] > 0)
                $vehicle_estimated_price = $vehicle_estimated_price + $v['domestic_airport_pickup_charges'] * $booking_details['domestic_airport_pickup_nos'];

            if ($booking_details['child_seat_nos'] > 0)
                $vehicle_estimated_price = $vehicle_estimated_price + $v['child_seat_charges'] * $booking_details['child_seat_nos'];

            $money = new Money();
            $money->setAmount($booking_details['total_price']);
            $money->setCurrency("USD");

            $data = $request->input('token');

            $orderId = rand(9000, 1000);
            $create_payment_request = new CreatePaymentRequest($data, $orderId);
            $create_payment_request->setAmountMoney($money);
            $response = $payments_api->createPayment($create_payment_request);

            if ($response->isSuccess()) {
                $pay_response = json_encode($response->getResult());
                $data = array(
                    'booking_slug' =>  $booking_details['booking_slug'],
                    'booking_from' =>  $booking_details['booking_from'],
                    'booking_to' => $booking_details['booking_to'],
                    'base_price' => $vhls['minimum_charge'],
                    'international_airport_pickup_nos' => $booking_details['international_airport_pickup_nos'],
                    'international_airport_pickup_charges' =>  $vhls["international_airport_pickup_charges"],
                    'domestic_airport_pickup_nos' =>   $booking_details['domestic_airport_pickup_nos'],
                    'domestic_airport_pickup_charges' =>   $vhls["domestic_airport_pickup_charges"],
                    'child_seat_nos' => $booking_details["child_seat_nos"],
                    'child_seat_charges' => $vhls["child_seat_charges"],
                    'vehicle_type' => $vhls["vehicle_type"],
                    'vehicle_type_description' => $vhls["vehicle_type_description"],
                    'vehicle_type_image' => $vhls["vehicle_type_image"],
                    'total_cost' => $vhls['travel_cost'],
                    'vehicle_estimated_price' => $vehicle_estimated_price,
                    'status' =>  $booking_details['status'],
                    'payment_status' =>  $booking_details['payment_status'],
                    'international_airport_pickup_detail' => $booking_details['international_airport_pickup_detail'],
                    'domestic_airport_pickup_detail' => $booking_details['domestic_airport_pickup_detail'],
                    'payment_method' => "",
                );
                
                $payment = Payment::create([
                    'booking_id' => $booking_details['id'],
                    'transaction_id' => $pay_response['id'],
                    'payment_method' => "Square",
                    'payment_status' =>$pay_response['status'],
                    'payment_details' => json_encode($pay_response),
                    'created_at' => Carbon::now(),
                ]);
                
            } else {
            echo json_encode($response->getErrors());
            }
        }
        else if($booking_details!=null){
            $err=true;
            $resp_msg="Booking already marked as paid. Please contact admin with your payment ID: ".($request->orderID?$request->orderID:'');
        }
        
        if($err==false)
        return redirect()->route('payment', [$booking_details['booking_slug']])->with('success_msg', $resp_msg);
        else
        return redirect()->route('payment', [$booking_details['booking_slug']])->with('error_msg', $resp_msg);

        
    }
    public function vehicleCalc($v,$booking_details)
    {
        $total_distance = 0;
        $total_duration = 0;
        $event_multiplier = 1;

        $round_trip=0;
        $hourly_rate=0;

        if ($booking_details != null) {
            $total_distance = $booking_details['distance'] + 0;
            $total_duration = ($booking_details['duration'] / 60 + 0);

            if ($booking_details['service_type'] == "Special Event") {
                $event = Event::where('id', $booking_details['booking_event'])->first();
                $event_multiplier = $event->price_multiplier;
            }
            
            if(!empty($booking_details['booking_transfer_type'] ))
            {
                if($booking_details['booking_transfer_type']=='Round Trip')
                    $round_trip=1;
            }
            if(!empty($booking_details['booking_booking_type'] ))
            {
                if($booking_details['booking_booking_type']=='Hourly Rate')
                    $hourly_rate=1;
            }
            
            
            
        }
        if($hourly_rate==1){
            if(ceil($total_duration/60)<$v['minimum_hour'])
            {
                $total_duration=$v['minimum_hour']*60;
                
            }
            
            $total_duration=$v['minimum_hour']*60;

            $v['travel_cost'] = ($v['price_per_hour'] * ceil($total_duration/60));
        }
        else{
            $v['travel_cost'] = ($v['base_price'] + ($total_distance * $v['price_per_km']) + ($total_duration * $v['price_per_min']));

            if ($v['travel_cost'] < $v['minimum_charge'])
            $v['travel_cost'] = $v['minimum_charge'];
        }
        

            
        $v['travel_cost'] = round($v['travel_cost'] * $event_multiplier, 0);
        $discount=0;
        $v['round_trip_multiplier'] =2*0.9;
        if(!empty($booking_details['booking_discount']))
        {
            $discount=$booking_details['booking_discount'];
            $v['travel_cost'] = round($v['travel_cost'] * (1-$discount/100), 0);
        }
        else if(Auth::user() && Auth::user()->discount>0){
            $discount=Auth::user()->discount;
            if($discount>100)
            $discount=0;
            

            $v['travel_cost'] = round($v['travel_cost'] * (1-$discount/100), 0);

        }
        if($round_trip==1)
        {
            $v['travel_cost'] = round($v['travel_cost'] *  $v['round_trip_multiplier'], 0);
        }
        $v['discount'] =$discount;

        return $v;
    }
}
