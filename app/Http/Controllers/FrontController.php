<?php

namespace App\Http\Controllers;

use App\Mail\BookingFail;
use App\Mail\BookingSuccess;
use App\Mail\SendMail;
use App\Models\Booking;
use App\Models\BookingVehicle;
use App\Models\Contact;
use App\Models\Event;
use App\Models\FAQ;
use App\Models\Payment;
use App\Models\Service;
use App\Models\Slider;
use App\Models\User;
use App\Models\Vehicle;
use App\Models\VehicleType;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str; 

class FrontController extends Controller
{
    public function index()
    {
        $sliders = Slider::orderBy('id','desc')->get();
        $types = VehicleType::with('vehicles')->get();
        $vehicles = Vehicle::all();
        $services = Event::where('type','service')->where('status','ACTIVE')->orderBy('id','asc')->get();
        return view('welcome',compact('sliders','types','vehicles','services'));
    }
    public function BookingNew(Request $request)
    {
        if (empty($step))
            $step = 1;
        if($step<=1)
        Session::put('booking_details',null);
        $service_type="General Transfer";
        $booking_event="";
        $booking_details = Session::get('booking_details');
        $booking_service=$request->service;
        if($booking_details!=null)
        {
            $booking_service=null;
            $service_type=$booking_details['service_type'];
            $booking_event=$booking_details['booking_event'];
        }
        else{
            $booking_service = Event::where('status', 'ACTIVE')->where('event_slug',$booking_service)->orderBy('sno', 'ASC')->first();
            if($booking_service!=null && $booking_service->price_multiplier>1)
            {   
                $service_type="Special Event";
                $booking_event=$booking_service->id;
            }
            
        }

        $events = Event::where('status', 'ACTIVE')->where('type','service')->where('price_multiplier','>','1')->orderBy('sno', 'ASC')->get();
        $events_quote = Event::where('status', 'ACTIVE')->where('type','event')->orderBy('sno', 'ASC')->get();
        $types = VehicleType::orderBy('id', 'DESC')->get();
        return view('pages.booking', compact('booking_details', 'events', 'types', 'step','service_type','booking_event','events_quote'));
    }
    public function ChooseVehicle(Request $request)
    {
        $booking_details = Session::get('booking_details');

        if ($booking_details != null) {
            $types = VehicleType::orderBy('id', 'DESC')->get();
            return view('booking.booking_step2', compact('booking_details', 'types'));
        }

        return redirect()->route('book-now');
    }
    public function ContactDetail()
    {
        $booking_details = Session::get('booking_details');
        //dd($booking_details);
        if ($booking_details != null) {
            $booking_details = Session::get('booking_details');
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
            
            

            $vhls = $this->vehicleCalc($v,$booking_details);


            return view('booking.booking_step3', compact('booking_details', 'vhls'));
        }

        return redirect()->route('book-now');
    }
    //Ajax Calls
    public function getVehicles(Request $request)
    {
        $booking_details = Session::get('booking_details');
        if($request->has('booking_transfer_type'))
        {
            $booking_details['booking_transfer_type']=$request->booking_transfer_type;
            $booking_details['booking_booking_type']='Distance Wise Rate';
            if($booking_details['booking_transfer_type']=='Hourly Rate')
            $booking_details['booking_booking_type']='Hourly Rate';

        }
        
        /*
        var total_price = value.base_price + (total_distance*value.price_per_km) + 60*(value.price_per_min);
                       console.log(total_price);
                       */

        // Fetch all records
        $vehicles = array();
        $vhls = VehicleType::join('vehicle_price', 'vehicle_types.id', '=', 'vehicle_price.vehicle_type_id')->select('vehicle_types.id as vehicle_type_id','vehicle_types.*','vehicle_price.*')->orderBy('base_price', 'ASC');

        if ($request->number_of_passenger > 0)
            $vhls->where('no_of_passengers', '>=', $request->number_of_passenger);
        if ($request->number_of_suitcase > 0)
            $vhls->where('no_of_suitcases', '>=', $request->number_of_suitcase);
        if ($request->vehicle_type > 0)
            $vhls->where('vehicle_type_id', $request->vehicle_type);

        foreach ($vhls->get() as $vehicle) {
            $v = $vehicle->toArray();
            

            $vehicles[] = $this->vehicleCalc($v,$booking_details);
        }
        $response['data'] = $vehicles;
        $response['csrf_token']=csrf_token();

        return response()->json($response);
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
    public function getVehicles1(Request $request)
    {


        $booking_details = Session::get('booking_details');
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

        /*
        var total_price = value.base_price + (total_distance*value.price_per_km) + 60*(value.price_per_min);
                       console.log(total_price);
                       */

        // Fetch all records
        $vehicles = array();
        $vhls = Vehicle::orderBy('base_price', 'ASC');

        if ($request->number_of_passenger > 0)
            $vhls->where('no_of_passengers', '>=', $request->number_of_passenger);
        if ($request->number_of_suitcase > 0)
            $vhls->where('no_of_suitcases', '>=', $request->number_of_suitcase);
        if ($request->vehicle_type > 0)
            $vhls->where('vehicle_type_id', $request->vehicle_type);

        foreach ($vhls->get() as $vehicle) {
            $v = $vehicle->toArray();
            $v['travel_cost'] = ($v['base_price'] + ($total_distance * $v['price_per_km']) + ($total_duration * $v['price_per_min']));

            if ($v['travel_cost'] < $v['minimum_charge'])
                $v['travel_cost'] = $v['minimum_charge'];

            $v['travel_cost'] = round($v['travel_cost'] * $event_multiplier, 0);
            $discount=0;
            
            if(Auth::user() && Auth::user()->discount>0){
                $discount=Auth::user()->discount;
                if($discount>100)
                $discount=0;

                $v['travel_cost'] = round($v['travel_cost'] * (1-$discount/100), 0);

            }
            

            $v['discount'] =$discount;

            $vehicles[] = $v;
        }
        $response['data'] = $vehicles;

        return response()->json($response);
    }
    

    public function booking(Request $request)
    {
        $err = true;
        $err_msg = "Error in processing booking";
        if ($request->submit_type == 'choose_location') {
            $err = false;
            $booking_date = null;
            if ($request->booking_date != null) {
                $d = explode('/', $request->booking_date);

                $booking_date = "$d[2]-$d[0]-$d[1]";
            }
            if (($request->service_type == "Special Event") && $request->booking_event == "") {
                $err = true;
                $err_msg = "Please choose event.";
            } else if (($request->service_type == "Special Event")) {
                $event = Event::where('id', $request->booking_event)->first();
                if ($event != null) {
                    if ($event->status != 'ACTIVE') {
                        $err = true;
                        $err_msg = "Selected event is not valid.";
                    }
                    /*else if(strtotime($event->from_date)>strtotime("+1 day",strtotime($booking_date)) || strtotime($event->to_date)<strtotime("-1 day",strtotime($booking_date)))
                    {
                        $err=true;
                        $err_msg=$event->from_date."Booking date note fall in event from-to date duration.".$booking_date;
                    }*/
                } else {
                    $err = true;
                    $err_msg = "Selected event is not valid.";
                }
            }

            if ($err == false) {
                $booking_details = array(
                    "service_type" => $request->service_type,
                    "booking_event" => $request->booking_event,
                    //"booking_date" => $request->booking_date,
                    //"booking_time" => $request->booking_time,
                    "booking_from_location" => $request->booking_from_location,
                    "booking_to_location" => $request->booking_to_location,
                    "origin" => $request->origin,
                    "destination" => $request->destination,
                    //"booking_transfer_type" => $request->booking_transfer_type,
                    //"booking_extra_hours" => $request->booking_extra_hours,
                    "distance" => $request->distance,
                    "duration" => $request->duration,
                    "s_latitude" => $request->s_latitude,
                    "s_longitude" => $request->s_longitude,
                    "d_latitude" => $request->d_latitude,
                    "d_longitude" => $request->d_longitude,
                    //"s_place_id" => $request->s_place_id,
                    //"d_place_id" => $request->d_place_id,

                    "total_waypoints" => $request->total_waypoints,
                
                    "booking_waypoint_1" => $request->booking_waypoint_1,
                    "waypoint_1" => $request->waypoint_1,
                    
                    "w_latitude_1" => $request->w_latitude_1,
                    "w_longitude_1" => $request->w_longitude_1,

                    "booking_waypoint_2" => $request->booking_waypoint_2,
                    "waypoint_2" => $request->waypoint_2,
                    
                    "w_latitude_2" => $request->w_latitude_2,
                    "w_longitude_2" => $request->w_longitude_2,
                    "booking_waypoint_3" => $request->booking_waypoint_3,
                    "waypoint_3" => $request->waypoint_3,
                    
                    "w_latitude_3" => $request->w_latitude_3,
                    "w_longitude_3" => $request->w_longitude_3,
                    
                );

                Session::put('booking_details', $booking_details);
                
                return response()->json(
                    [
                        "success" => true,
                        "csrf_token"=>csrf_token(),
                        "response_message" => "Booking location data captured",
                    ]
                );
            }
        } else if ($request->submit_type == 'choose_vehicle') {
            $err = false;
            $booking_details = Session::get('booking_details');

            if ($booking_details == null) {
                $err = true;
                $err_msg = "Please choose ride details first.";
            } else if ($request->vehicle_type == "") {
                $err = true;
                $err_msg = "Please choose vehicle.";
            } else {
                $vhls = Vehicle::where('id', $request->vehicle_type)->first();
                if ($vhls != null) {
                    if ($vhls->status != 'ACTIVE') {
                        $err = true;
                        $err_msg = "Selected vehicle is not valid.";
                    }
                } else {
                    $err = true;
                    $err_msg = "Selected vehicle is not valid.";
                }
            }

            if ($err == false) {
                $booking_details["vehicle_type"] = $request->vehicle_type;
                $booking_details["is_international_airport_pickup_charges"] = $request->is_international_airport_pickup_charges;
                $booking_details["international_airport_pickup_nos"] = $request->is_international_airport_pickup_charges != 1 ? 0 : $request->international_airport_pickup_nos;
                $booking_details["is_domestic_airport_pickup_charges"] = $request->is_domestic_airport_pickup_charges;
                $booking_details["domestic_airport_pickup_nos"] = $request->is_domestic_airport_pickup_charges != 1 ? 0 : $request->domestic_airport_pickup_nos;
                $booking_details["is_child_seat_charges"] = $request->is_child_seat_charges;
                $booking_details["child_seat_nos"] = $request->is_child_seat_charges != 1 ? 0 : $request->child_seat_nos;

                Session::put('booking_details', $booking_details);

                return response()->json(
                    [
                        "success" => true,
                        "csrf_token"=>csrf_token(),
                        "response_message" => "Booking vehicle data captured",
                    ]
                );
            }
        }
        return response()->json(
            [
                "success" => false,
                "csrf_token"=>csrf_token(),
                "response_message" => $err_msg,
            ]
        );
    }
    public function saveBooking(Request $request)
    {

        $err = true;
        $err_msg = "Error in processing booking";

        //$booking_details=Session::get('booking_details');

        $booking_details = array(
            "service_type" => $request->service_type,
            "booking_event" => $request->booking_event,
            "booking_date" => $request->booking_date,
            "booking_time" => $request->booking_time,
            "return_date" => $request->return_date,
            "return_time" => $request->return_time,
            "booking_from_location" => $request->booking_from_location,
            "booking_to_location" => $request->booking_to_location,
            "origin" => $request->origin,
            "destination" => $request->destination,
            "booking_transfer_type" => $request->booking_transfer_type,
            "booking_booking_type" => $request->booking_transfer_type=='Hourly Rate'?$request->booking_transfer_type:'Distance Wise Rate',
            "booking_extra_hours" => $request->booking_extra_hours,
            "distance" => $request->distance,
            "duration" => $request->duration,
            "s_latitude" => $request->s_latitude,
            "s_longitude" => $request->s_longitude,
            "d_latitude" => $request->d_latitude,
            "d_longitude" => $request->d_longitude,
            "s_place_id" => $request->s_place_id,
            "d_place_id" => $request->d_place_id,
            "total_waypoints" => $request->total_waypoints,
                
            "booking_waypoint_1" => $request->booking_waypoint_1,
            "waypoint_1" => $request->waypoint_1,
            
            "w_latitude_1" => $request->w_latitude_1,
            "w_longitude_1" => $request->w_longitude_1,

            "booking_waypoint_2" => $request->booking_waypoint_2,
            "waypoint_2" => $request->waypoint_2,
            
            "w_latitude_2" => $request->w_latitude_2,
            "w_longitude_2" => $request->w_longitude_2,
            "booking_waypoint_3" => $request->booking_waypoint_3,
            "waypoint_3" => $request->waypoint_3,
            
            "w_latitude_3" => $request->w_latitude_3,
            "w_longitude_3" => $request->w_longitude_3,
        
        );

        $booking_details["vehicle_type"] = $request->vehicle_type;
        $booking_details["is_international_airport_pickup_charges"] = $request->is_international_airport_pickup_charges;
        $booking_details["international_airport_pickup_nos"] = $request->is_international_airport_pickup_charges != 1 ? 0 : $request->international_airport_pickup_nos;
        $booking_details["is_domestic_airport_pickup_charges"] = $request->is_domestic_airport_pickup_charges;
        $booking_details["domestic_airport_pickup_nos"] = $request->is_domestic_airport_pickup_charges != 1 ? 0 : $request->domestic_airport_pickup_nos;
        $booking_details["is_child_seat_charges"] = $request->is_child_seat_charges;
        $booking_details["child_seat_nos"] = $request->is_child_seat_charges != 1 ? 0 : $request->child_seat_nos;




        $international_flight_detail = [];
        $domestic_flight_detail = [];
        $i_flight_count = 0;
        $d_flight_count = 0;

        if (isset($request->i_flight['number']) && !empty($request->i_flight['number'])) {
            $i_flight_number = array();
            $i_flight_title = array();
            $i_flight_board_name = array();
            $i_flight_time = array();

            parse_str($request->i_flight['number'], $i_flight_number);
            parse_str($request->i_flight['title'], $i_flight_title);
            parse_str($request->i_flight['board_name'], $i_flight_board_name);
            parse_str($request->i_flight['time'], $i_flight_time);
            //dd($request->all());

            $i_flight_count = count($i_flight_number['i_flight']['number']);

            if ($i_flight_count > 0) {

                for ($i = 0; $i < $i_flight_count; $i++) {
                    $international_flight_detail[$i] = array(
                        "flight_no" => !empty($i_flight_number['i_flight']) ? $i_flight_number['i_flight']['number'][$i] : "",
                        "title" => !empty($i_flight_title['i_flight']) ? $i_flight_title['i_flight']['title'][$i] : "",
                        "board_name" => !empty($i_flight_board_name['i_flight']) ? $i_flight_board_name['i_flight']['board_name'][$i] : "",
                        "time" => !empty($i_flight_time['i_flight']) ? $i_flight_time['i_flight']['time'][$i] : "",
                    );
                }
            }
        }

        if (isset($request->d_flight['number']) && !empty($request->d_flight['number'])) {
            $d_flight_number = array();
            $d_flight_title = array();
            $d_flight_board_name = array();
            $d_flight_time = array();

            parse_str($request->d_flight['number'], $d_flight_number);
            parse_str($request->d_flight['title'], $d_flight_title);
            parse_str($request->d_flight['board_name'], $d_flight_board_name);
            parse_str($request->d_flight['time'], $d_flight_time);
            $d_flight_count = count($d_flight_number['d_flight']['number']);

            if ($d_flight_count > 0) {

                for ($i = 0; $i < $d_flight_count; $i++) {
                    $domestic_flight_detail[$i] = array(
                        "flight_no" => !empty($d_flight_number['d_flight']) ? $d_flight_number['d_flight']['number'][$i] : "",
                        "title" => !empty($d_flight_title['d_flight']) ? $d_flight_title['d_flight']['title'][$i] : "",
                        "board_name" => !empty($d_flight_board_name['d_flight']) ? $d_flight_board_name['d_flight']['board_name'][$i] : "",
                        "time" => !empty($d_flight_time['d_flight']) ? $d_flight_time['d_flight']['time'][$i] : "",
                    );
                }
            }
        }

        $international_flight_detail = json_encode($international_flight_detail, JSON_PRETTY_PRINT);

        $domestic_flight_detail = json_encode($domestic_flight_detail, JSON_PRETTY_PRINT);
        // dd($domestic_flight_detail);

        $service_type = "";

        $booking_event = "";

        if ($booking_details != null) {
            $random_val = Str::random(8);

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

            $v = $vhls->toArray();
            $v = $this->vehicleCalc($v,$booking_details);

            if ($booking_details['international_airport_pickup_nos'] > 0)
                $v['travel_cost'] = $v['travel_cost'] + $v['international_airport_pickup_charges'] * $booking_details['international_airport_pickup_nos'];

            if ($booking_details['domestic_airport_pickup_nos'] > 0)
                $v['travel_cost'] = $v['travel_cost'] + $v['domestic_airport_pickup_charges'] * $booking_details['domestic_airport_pickup_nos'];

            if ($booking_details['child_seat_nos'] > 0)
                $v['travel_cost'] = $v['travel_cost'] + $v['child_seat_charges'] * $booking_details['child_seat_nos'];



            $service = Booking::create([
                'service_type' => $booking_details['service_type'],
                'booking_event' => $booking_details['booking_event'],
                'booking_date' => date('Y-m-d', strtotime($booking_details['booking_date'])),
                'booking_time' => date('H:i:s', strtotime($booking_details['booking_time'])),
                'return_date' => date('Y-m-d', strtotime($booking_details['return_date'])),
                'return_time' => date('H:i:s', strtotime($booking_details['return_time'])),
                'booking_from' => $booking_details['booking_from_location'],
                'booking_to' => $booking_details['booking_to_location'],
                'booking_transfer_type' => $booking_details['booking_transfer_type'],
                'booking_booking_type' => $booking_details['booking_booking_type'],
                'booking_extra_hours' => $booking_details['booking_extra_hours'],
                'distance' => $booking_details['distance'],
                'duration' => $booking_details['duration'],
                's_latitude' => $booking_details['s_latitude'],
                's_longitude' => $booking_details['s_longitude'],
                'd_latitude' => $booking_details['d_latitude'],
                'd_longitude' => $booking_details['d_longitude'],
                'waypoint' => json_encode(array(
                    'total_waypoints'=>$booking_details['total_waypoints'],
                    'booking_waypoint_1' => $booking_details['booking_waypoint_1'],
                    'waypoint_1' => $booking_details['waypoint_1'],
                    
                    'w_latitude_1' => $booking_details['w_latitude_1'],
                    'w_longitude_1' => $booking_details['w_longitude_1'],

                    'booking_waypoint_2' => $booking_details['booking_waypoint_2'],
                    'waypoint_2' => $booking_details['waypoint_2'],
                    
                    'w_latitude_2' => $booking_details['w_latitude_2'],
                    'w_longitude_2' => $booking_details['w_longitude_2'],
                    'booking_waypoint_3' => $booking_details['booking_waypoint_3'],
                    'waypoint_3' => $booking_details['waypoint_3'],
                    
                    'w_latitude_3' => $booking_details['w_latitude_3'],
                    'w_longitude_3' => $booking_details['w_longitude_3'],
                )),
                
                
            
                'vehicle_type' => $booking_details['vehicle_type'],
                'is_international_airport_pickup_charges' => $booking_details['is_international_airport_pickup_charges'],
                'international_airport_pickup_nos' => $booking_details['international_airport_pickup_nos'],
                'international_airport_pickup_detail' => $international_flight_detail,
                'domestic_airport_pickup_detail' => $domestic_flight_detail,
                'is_domestic_airport_pickup_charges' => $booking_details['is_domestic_airport_pickup_charges'],
                'domestic_airport_pickup_nos' => $booking_details['domestic_airport_pickup_nos'],
                'is_child_seat_charges' => $booking_details['is_child_seat_charges'],
                'child_seat_nos' => $booking_details['child_seat_nos'],
                'booking_slug' => $random_val,
                'booking_for' => $request->booking_for,
                'company_person' => $request->company_person,
                'other_phone_number' => $request->other_phone_number,
                'other_email' => $request->other_email,
                'booking_by' => Auth::user()->id,
                'email' => Auth::user()->email,
                'phone' => Auth::user()->phone,
                'booking_discount' => Auth::user()->discount,
                "bill_to_name" => empty($request->bill_to_name)?'':$request->bill_to_name,
                "billing_addr" => empty($request->billing_addr)?'':$request->billing_addr,
                "abn_number" => empty($request->abn_number)?'':$request->abn_number,
                'total_price' => $v['travel_cost'],
                'payment_status' => 'pending',
            ]);

        //dd($vhls);
            if ($service->save()) {
                BookingVehicle::create([
                    'booking_id' => $service->id,
                    'vehicle_type_id' => $booking_details['vehicle_type'],
                    'vehicle_type' => $vhls->vehicle_type,
                    'no_of_child' => $vhls->no_of_child,
                    'no_of_passengers' => $vhls->no_of_passengers,
                    'no_of_suitcases' => $vhls->no_of_suitcases,
                    'vehicle_type_description' => $vhls->vehicle_type_description,
                    'vehicle_type_image' => $vhls->vehicle_type_image	,
                    'base_price' => $vhls->base_price,
                    'price_per_min' => $vhls->price_per_min,
                    'price_per_hour' => $vhls->price_per_hour,
                    'price_per_km' => $vhls->price_per_km,
                    'extra_waiting_time' => $vhls->extra_waiting_time,
                    'minimum_charge' => $vhls->minimum_charge,
                    'minimum_hour' => $vhls->minimum_hour,
                    'international_airport_pickup_charges' => $vhls->international_airport_pickup_charges,
                    'domestic_airport_pickup_charges' => $vhls->domestic_airport_pickup_charges,
                    'child_seat_charges' => $vhls->child_seat_charges,
                    'status' => $vhls->status,
                ]);

                $booking_details = Booking::where('id', $service->id)->first()->toArray();
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
                

                $vhls = $this->vehicleCalc($v,$booking_details);
            }
            Session::put('booking_details_extra', null);
            Session::put('booking_details', null);
            return response()->json(
                [
                    "success" => true,
                    "csrf_token"=>csrf_token(),
                    "response_message" => "Booking data captured",
                    "redirect_url" => route('payment', ['slug' => $service->booking_slug])
                ]
            );
        }

        return response()->json(
            [
                "success" => false,
                "csrf_token"=>csrf_token(),
                "response_message" => $err_msg,
            ]
        );
    }
    public function Payment(Request $request, $bookig_slug)
    {
       

        $booking_details = Booking::where('booking_slug', $bookig_slug)->first();
        if ($booking_details != null) {
            $booking_details_extra = array(

                "international_flight_detail" => json_decode($booking_details->international_airport_pickup_detail, TRUE),
                "domestic_flight_detail" => json_decode($booking_details->domestic_airport_pickup_detail, TRUE),
                'company_person' => $booking_details->company_person,
                'other_phone_number' => $booking_details->other_phone_number,
                'other_email' => $booking_details->other_email,
                'booking_for' => $booking_details->booking_for,
            );
            $booking=$booking_details;
            $booking_details = $booking_details->toArray();

            $total_distance = 0;
            $total_duration = 0;
            $event_multiplier = 1;

            $total_distance = $booking_details['distance'] + 0;
            $total_duration = ($booking_details['duration'] / 60 + 0);

            if ($booking_details['service_type'] == "Special Event") {
                $event = Event::where('id', $booking_details['booking_event'])->first();
                $event_multiplier = $event->price_multiplier;
            }

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
            

            $vhls = $this->vehicleCalc($v,$booking_details);
            $booking_by = User::where('id',$booking_details['booking_by'])->first();
            $booking_details['user']=$booking_by->toArray();
            $user = User::where('id',$booking_details['booking_by'])->first();
            $user_name = $user->name;
            $user_abn = $user->abn_number;

            return view('payment', compact('booking','booking_details', 'vhls', 'booking_details_extra','user_name','vehicle_estimated_price','user_abn'));
        }

        return redirect()->route('book-now');
    }

    public function MakePayment($slug)
    {
        $booking_details = Booking::where('booking_slug', $slug)->first();
        //dd($slug);
        if ($booking_details != null) {
            return view('booking_attempt', compact('booking_details'));
        }

        return redirect()->route('book-now');
    }
    public function checkout($slug)
    {
        $booking_details = Booking::where('booking_slug', $slug)->first();
        if ($booking_details != null) {
            $booking_details_extra = array(

                "international_flight_detail" => json_decode($booking_details->international_airport_pickup_detail, TRUE),
                "domestic_flight_detail" => json_decode($booking_details->domestic_airport_pickup_detail, TRUE),
                'company_person' => $booking_details->company_person,
                'other_phone_number' => $booking_details->other_phone_number,
                'other_email' => $booking_details->other_email,
                'booking_for' => $booking_details->booking_for,
            );
            $booking=$booking_details;
            $booking_details = $booking_details->toArray();

            $total_distance = 0;
            $total_duration = 0;
            $event_multiplier = 1;

            $total_distance = $booking_details['distance'] + 0;
            $total_duration = ($booking_details['duration'] / 60 + 0);

            if ($booking_details['service_type'] == "Special Event") {
                $event = Event::where('id', $booking_details['booking_event'])->first();
                $event_multiplier = $event->price_multiplier;
            }

            $vhls = BookingVehicle::where('booking_id', $booking_details['id'])->first();

            $v = $vhls->toArray();
            

            $vhls = $this->vehicleCalc($v,$booking_details);
            $booking_by = User::where('id',$booking_details['booking_by'])->first();
            $booking_details['user']=$booking_by->toArray();
            return view('checkout', compact('booking','booking_details', 'vhls', 'booking_details_extra'));
        }

        return redirect()->route('book-now');
    }
    public function PaypalPaymentComplete(Request $request, $booking_slug)
    {
       // $request->orderID="6DR63956924303843";

        $err=false;
        $resp_msg="Error in processing payment. Please contact admin with your payment ID: ".($request->orderID?$request->orderID:'');
        $booking_details = Booking::where('booking_slug', $booking_slug)->first();
        $booking_details=$booking_details->toArray();
        if($booking_details!=null && strtolower($booking_details['payment_status'])!='paid')
        {

            $curl="https://api.".(env('PAYPAL_MODE')=='sandbox'?'sandbox.':'')."paypal.com/v1/oauth2/token/";

            $header = array(
                //'Authorization'   => 'Bearer ' . env('PAYPAL_CLIENT_ID'),
                'Content-Type'    => 'application/json',
                'grant_type'=>'client_credentials'
            );
        
            $curl.="?CLIENT_ID=".env('PAYPAL_CLIENT_ID')."&CLIENT_SECRET=".env('PAYPAL_CLIENT_SECRET')."&grant_type=client_credentials";
            
            $ch = curl_init($curl);

            // Set HTTP Header for POST request 
            curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
            curl_setopt($ch, CURLOPT_USERPWD,env('PAYPAL_CLIENT_ID').':'.env('PAYPAL_CLIENT_SECRET'));
            curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
            curl_setopt($ch, CURLOPT_POST, true);
            //curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode(array('CLIENT_ID'=>env('PAYPAL_CLIENT_ID'),'CLIENT_SECRET'=>env('PAYPAL_CLIENT_SECRET'),'gant_type'=>'client_credentials')));
            $execResult = curl_exec($ch);
            
            
            $obj = json_decode($execResult, true);
            if($obj && !empty($obj['access_token']))
            {
                $curl="https://api-m.".(env('PAYPAL_MODE')=='sandbox'?'sandbox.':'')."paypal.com/v2/checkout/orders/".$request->orderID;
                $header = array(
                    'Authorization'   => 'Bearer ' . $obj['access_token'],
                    'Content-Type'    => 'application/json',
                    
                );
            
                
                $ch = curl_init($curl);
        
                // Set HTTP Header for POST request 
                curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
                curl_setopt($ch, CURLOPT_USERPWD,env('PAYPAL_CLIENT_ID').':'.env('PAYPAL_CLIENT_SECRET'));
                curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
                curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
                //curl_setopt($ch, CURLOPT_POST, true);
                //curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode(array('CLIENT_ID'=>env('PAYPAL_CLIENT_ID'),'CLIENT_SECRET'=>env('PAYPAL_CLIENT_SECRET'),'gant_type'=>'client_credentials')));
                $execResult = curl_exec($ch);
                
                /*
                {"id":"6DR63956924303843","intent":"CAPTURE","status":"COMPLETED","payment_source":{"paypal":{"email_address":"shravan.darc@gmail.com","account_id":"6AEZNGU2USC2Q","name":{"given_name":"Shravan","surname":"Verma"},"address":{"country_code":"AU"}}},"purchase_units":[{"reference_id":"k1GiMBZO","amount":{"currency_code":"USD","value":"97.00"},"payee":{"email_address":"sb-ockmm3761787@business.example.com","merchant_id":"7FW6UCB7HXGZ8"},"description":"k1GiMBZO","custom_id":"CUST-1","soft_descriptor":"PAYPAL *JOHNDOESTES SH","shipping":{"name":{"full_name":"Shravan Verma"},"address":{"address_line_1":"tets","address_line_2":"test","admin_area_2":"etse","admin_area_1":"SA","postal_code":"2009","country_code":"AU"}},"payments":{"captures":[{"id":"1NS79663TT023401C","status":"COMPLETED","amount":{"currency_code":"USD","value":"97.00"},"final_capture":true,"seller_protection":{"status":"NOT_ELIGIBLE"},"seller_receivable_breakdown":{"gross_amount":{"currency_code":"USD","value":"97.00"},"paypal_fee":{"currency_code":"USD","value":"2.63"},"net_amount":{"currency_code":"USD","value":"94.37"}},"custom_id":"CUST-1","links":[{"href":"https://api.sandbox.paypal.com/v2/payments/captures/1NS79663TT023401C","rel":"self","method":"GET"},{"href":"https://api.sandbox.paypal.com/v2/payments/captures/1NS79663TT023401C/refund","rel":"refund","method":"POST"},{"href":"https://api.sandbox.paypal.com/v2/checkout/orders/6DR63956924303843","rel":"up","method":"GET"}],"create_time":"2023-03-19T05:52:01Z","update_time":"2023-03-19T05:52:01Z"}]}}],"payer":{"name":{"given_name":"Shravan","surname":"Verma"},"email_address":"shravan.darc@gmail.com","payer_id":"6AEZNGU2USC2Q","address":{"country_code":"AU"}},"create_time":"2023-03-19T05:51:05Z","update_time":"2023-03-19T05:52:01Z","links":[{"href":"https://api.sandbox.paypal.com/v2/checkout/orders/6DR63956924303843","rel":"self","method":"GET"}]}*/
                $obj = json_decode($execResult, true);
                if($obj)
                {
                    if($obj['id']==$request->orderID && $obj['purchase_units'][0]['reference_id']==$booking_details['booking_slug'])
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

                        $data = array(
                            'booking_slug'      =>  $booking_details['booking_slug'],
                            'booking_from'   =>   $booking_details['booking_from'],
                            'booking_to'   =>   $booking_details['booking_to'],
                            'base_price'   =>   $vhls['minimum_charge'],
                            'international_airport_pickup_nos'   =>   $booking_details['international_airport_pickup_nos'],
                            'international_airport_pickup_charges'   =>   $vhls["international_airport_pickup_charges"],
                            'domestic_airport_pickup_nos'   =>   $booking_details['domestic_airport_pickup_nos'],
                            'domestic_airport_pickup_charges'   =>   $vhls["domestic_airport_pickup_charges"],
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
                            'transaction_id' => $obj['id'],
                            'payment_method' => "Paypal",
                            'payment_status' =>$obj['status'],
                            'payment_details' => json_encode($obj),
                            'created_at' => Carbon::now(),
                        ]);

                        if (!empty($obj['status']) && $obj['status'] == 'COMPLETED') {

                            if($obj['purchase_units'][0]['amount']['value']>=$booking_details['total_price'])
                            Booking::where('booking_slug', $booking_slug)->update([
                                'payment_status' => 'paid',
                                'payment_id' => $payment->id
                            ]);
                            else
                            Booking::where('booking_slug', $booking_slug)->update([
                                'payment_status' => 'partially paid',
                                'payment_id' => $payment->id
                            ]);
                            
                            $data['payment_method'] = "Paypal";
                            $booking_by = User::where('id',$booking_details['booking_by'])->first();
                            $user = $booking_by->name;
                            $data['user'] = $user;
                            Mail::to($booking_details['email'])->send(new BookingSuccess($data));

                            $resp_msg="Payment Status: ".$obj['status'].", Payment ID: ".($request->orderID?$request->orderID:'');
                            
                        } else {
                            $data['stats'] = $obj['status'];
                            Mail::to($booking_details['email'])->send(new BookingFail($data));
                            $err=true;
                            $resp_msg="Payment Status: ".$obj['status'].", Payment ID: ".($request->orderID?$request->orderID:'');

                        }
                    }
                    else{
                        $err=true;
                        $resp_msg="Invalid booking reference. Please contact admin with your payment ID: ".($request->orderID?$request->orderID:'');
                    }
                    
                }
                else{
                    $err=true;
                }
            }    
            else{
                $err=true;
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
        /*return $request->json(
            array(
                "status"=>200,
                "success"=>$err?false:true,
                "message"=>$resp_msg,
            )
        );*/
    }
    public function MakePaymentProcess(Request $request, $slug)
    {
        $booking_data = Booking::where('booking_slug', $slug)->first();
        //dd($booking_details);
        if ($booking_data != null) {
            $validator = Validator::make($request->all(), [
                'card_no' => 'required',
                'ccExpiryMonth' => 'required',
                'ccExpiryYear' => 'required',
                'cvvNumber' => 'required',
                // 'amount' => 'required',
            ]);

            $input = $request->except('_token');

            if ($validator->passes()) {
                if (Auth::user()) {
                    // $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));

                    try {

                        $booking_vehicle = BookingVehicle::where('booking_id', $booking_data->id)->first();

                        $booking_details = $booking_data->toArray();

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


                        $data = array(
                            'booking_slug'      =>  $booking_details['booking_slug'],
                            'booking_from'   =>   $booking_details['booking_from'],
                            'booking_to'   =>   $booking_details['booking_to'],
                            'base_price'   =>   $vhls['minimum_charge'],
                            'international_airport_pickup_nos'   =>   $booking_details['international_airport_pickup_nos'],
                            'international_airport_pickup_charges'   =>   $vhls["international_airport_pickup_charges"],
                            'domestic_airport_pickup_nos'   =>   $booking_details['domestic_airport_pickup_nos'],
                            'domestic_airport_pickup_charges'   =>   $vhls["domestic_airport_pickup_charges"],
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
                        //dd($data);

                        
                        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
                        $charge = Stripe\Charge::create ([
                                "amount" => 100 * 100,
                                "currency" => "usd",
                                "source" => $request->stripeToken,
                                "description" => "Test payment from tutsmake.com."
                        ]);
                        $payment_details = json_encode($charge);
                        $payment = Payment::create([
                                    'booking_id' => $booking_details['id'],
                                    'transaction_id' => $charge->id,
                                    'payment_method' => empty($charge->payment_method) ? null : $charge->payment_method,
                                    'payment_status' => $charge->status,
                                    'payment_details' => $payment_details,
                                    'created_at' => Carbon::now(),
                                ]);

                        if (!empty($charge['status']) && $charge['status'] == 'succeeded') {

                            Booking::where('booking_slug', $slug)->update([
                                'payment_status' => $charge->status,
                                'payment_id' => $payment->id
                            ]);
    
                            $data['payment_method'] = $charge->payment_method;
                            $booking_by = User::where('id',$booking_details['booking_by'])->first();
                            $user = $booking_by->name;
                            $data['user'] = $user;
                            Mail::to($booking_details['email'])->send(new BookingSuccess($data));
                            return view('pages.thankyou');
                        } else {
                            $data['stats'] = $charge->status;
                            Mail::to($booking_details['email'])->send(new BookingFail($data));

                        }
                    } catch (Exception $e) {
                        return redirect()->route('payment', [$booking_details['booking_slug']])->with('error', $e->getMessage());
                    } catch (\Cartalyst\Stripe\Exception\CardErrorException $e) {
                        return redirect()->route('payment', [$booking_details['booking_slug']])->with('error', $e->getMessage());
                    } catch (\Cartalyst\Stripe\Exception\MissingParameterException $e) {
                        return redirect()->route('payment', [$booking_details['booking_slug']])->with('error', $e->getMessage());
                    }
                }
            }
        }

        return redirect()->route('book-now');
    }

    public function PaymentStatus($bookig_slug)
    {

        $booking_details = Booking::where('booking_slug', $bookig_slug)->first();

        $booking_payment_details = Payment::where('booking_id', $booking_details->id)->first();

        if ($booking_details != null) {
            $booking_details_extra = array(

                "international_flight_detail" => json_decode($booking_details->international_airport_pickup_detail, TRUE),
                "domestic_flight_detail" => json_decode($booking_details->domestic_airport_pickup_detail, TRUE),
                'company_person' => $booking_details->company_person,
                'other_phone_number' => $booking_details->other_phone_number,
                'other_email' => $booking_details->other_email,
                'booking_for' => $booking_details->booking_for,
            );
            //print_r(            $booking_details_extra);exit;
            $booking_details = $booking_details->toArray();

            $total_distance = 0;
            $total_duration = 0;
            $event_multiplier = 1;

            $total_distance = $booking_details['distance'] + 0;
            $total_duration = ($booking_details['duration'] / 60 + 0);

            if ($booking_details['service_type'] == "Special Event") {
                $event = Event::where('id', $booking_details['booking_event'])->first();
                $event_multiplier = $event->price_multiplier;
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

            return view('payment_status', compact('booking_details', 'vhls', 'booking_details_extra', 'booking_payment_details', 'vehicle_estimated_price'));
        }

        return redirect()->route('book-now');
    }
    public function AjaxLogin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'login_email' => 'required|email',
            'login_password' => 'required'
        ]);
  
        if ($validator->fails()){
            return response()->json([
                    "status" => false,
                    "errors" => $validator->errors()
                ]);
        } else {
            if (Auth::attempt(array('email'=>$request->login_email, "password"=>$request->login_password))) {
                return response()->json([
                    "status" => true, 
                    "login" => "ok",
                    "redirect" => route("booking-detail"),
                    "auth_user" => ['name'=>Auth::user()->name, 'email'=>Auth::user()->email,'phone'=>Auth::user()->phone,'discount'=>Auth::user()->discount,'csrf_token'=>csrf_token()],
                ]);
            } else {
                return response()->json([
                    "status" => false,
                    "errors" => ["Invalid credentials"]
                ]);
            }
        }
    }
    public function create(array $data)
    {
      return User::create([
        'name' => $data['name'],
        'email' => $data['email'],
        'phone' => $data['phone'],
        'password' => Hash::make($data['password'])
      ]);
    }
    public function AjaxRegister(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'phone' => 'required',
            'password' => 'required|min:6',
            /*'bill_to_name'=> 'required',
            'abn_number'=> 'required',
            'billing_addr'=> 'required',*/
        ]);
    
        if ($validator->fails()){
            return response()->json([
                    "status" => false,
                    "errors" => $validator->errors()
                ]);
        }
        //dd($request->all());
        $data = $request->all();
        $user = User::create([
                'email'=>$request->email,
                'password'=>Hash::make($data['password']),
                'name'=>$request->name,
                'phone'=>$request->phone,
                'bill_to_name'=>empty($request->bill_to_name)?'':$request->bill_to_name,
                'abn_number'=>empty($request->abn_number)?'':$request->abn_number,
                'billing_addr'=>empty($request->billing_addr)?'':$request->billing_addr,
        ]);
    
        Auth::login($user);
    
        return response()->json([
            "status" => true, 
            "redirect" => route("booking-detail"),
            "auth_user" => ['name'=>Auth::user()->name, 'email'=>Auth::user()->email,'phone'=>Auth::user()->phone,'bill_to_name'=>Auth::user()->bill_to_name,'abn_number'=>Auth::user()->abn_number,'billing_addr'=>Auth::user()->billing_addr],
        ]);
    }
    public function signOut() {
        Session::flush();
        Auth::logout();
        return redirect('/');
    } 
    public function about()
    {
        return view('pages.about');
    }
    public function service()
    {
        $services = Event::where('type','service')->where('status','ACTIVE')->orderBy('id','asc')->get();
        //dd($services);
        return view('pages.service',compact('services'));
    }
    public function serviceHome($slug)
    {
        if (empty($step))
            $step = 1;

        $booking_details = Session::get('booking_details');
        $events = Event::where('status', 'ACTIVE')->where('type','event')->orderBy('from_date', 'ASC')->get();
        $types = VehicleType::orderBy('id', 'DESC')->get();
        $services = Event::where('type','service')->where('status','ACTIVE')->orderBy('sno','ASC')->get();
        $service = Event::where('type','service')->where('event_slug',$slug)->first();

        $image = Event::where('type','service')->where('event_slug',$slug)->select('banner_image')->first();

        return view('pages.service_home',compact('service','services','step','events','types','booking_details','image'));
    }
    public function fleet()
    {
        return view('pages.fleets');
    }
    public function fleetDetail($slug)
    {
        $detail = Vehicle::where('vehicle_slug',$slug)->first();
        return view('fleet.details',compact('detail'));
    }
    public function event()
    {
        $events = Event::where('status', 'ACTIVE')->where('event_name','!=','Other')->where('type','event')->orderBy('id','ASC')->get();
        //dd($events);
        return view('pages.event',compact('events'));
    }
    public function faq()
    {
        $faqs = FAQ::orderBy('id','ASC')->get();
        return view('pages.faq',compact('faqs'));
    }
    public function contact()
    {
        return view('pages.contact');
    }
    public function AddContact(Request $request)
    {
        //dd($request->all());
        $contact = Contact::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'subject' => $request->subject,
            'message' => $request->message,
        ]);
        if($contact->save()){
            $data = array(
                    'name'      =>  $request->name,
                    'message'   =>   $request->subject
                );
        
            // Mail::to($request->email)->send(new SendMail($data));
            return view('pages.thankyou');
        }
        else {
            return back();
        } 
    }
    public function ThankYou()
    {
        return view('pages.thankyou');
    }
}
