<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Booking;
use App\Models\Event;
use App\Models\Invoice;
use App\Models\User;
use App\Models\VehicleType;
use Illuminate\Support\Str;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Illuminate\Support\Facades\DB;

class BookingController extends Controller
{
    public function Bookings()
    {
        try {
            if (Auth::user()) {
                $bookings = DB::table('bookings')
                            ->join('users','bookings.booking_by','=','users.id')
                            ->select('bookings.*','users.name')
                            ->orderBy('created_at','desc')->get();
                return view('admin.booking.booking',compact('bookings'));
            } else {
                return redirect(url('admin/login'));
            }
        } catch (\Exception $e) {
          
            return $e->getMessage();
        }
    }
    public function ViewBookings($id)
    {
        try {
            if (Auth::user()) {
            $booking = Booking::where('id',$id)->first();
            $user = User::where('id',$booking->booking_by)->first();
            //dd($user);
            $vehicle_type_id = VehicleType::where('id',$booking->vehicle_type)->first();
            
            $vehicle_type = $vehicle_type_id->vehicle_type;
            //dd($vehicle_type);
            $random_val = Str::random(8);

            $total_distance = 0;
            $total_duration = 0;
            $event_multiplier = 1;
            if ($booking != null) {
                $total_distance = $booking->distance + 0;
                $total_duration = ($booking->duration / 60 + 0);

                if (($booking->service_type == "Special Event")) {
                    $event = Event::where('id', $booking->booking_event)->first();
                    $event_multiplier = $event->price_multiplier;
                }
            }
            //$vhls = Vehicle::where('id', $booking['vehicle_type'])->first();
            $vhls = VehicleType::where('vehicle_types.id', $booking->vehicle_type)->join('vehicle_price', 'vehicle_types.id', '=', 'vehicle_price.vehicle_type_id')->first();

            $total_distance = 0;
            $total_duration = 0;
            $event_multiplier = 1;
            if ($booking != null) {
                $total_distance = $booking->distance + 0;
                $total_duration = ($booking->duration / 60 + 0);

                if (($booking->service_type == "Special Event")) {
                    $event = Event::where('id', $booking['booking_event'])->first();
                    $event_multiplier = $event->price_multiplier;
                }
            }

            $v = $vhls->toArray();
            $v['travel_cost'] = ($v['base_price'] + ($total_distance * $v['price_per_km']) + ($total_duration * $v['price_per_min']));
            if ($v['travel_cost'] < $v['minimum_charge'])
                $v['travel_cost'] = $v['minimum_charge'];



            $v['travel_cost'] = round($v['travel_cost'] * $event_multiplier, 0);

            if ($booking['international_airport_pickup_nos'] > 0)
                $v['travel_cost'] = $v['travel_cost'] + $v['international_airport_pickup_charges'] * $booking['international_airport_pickup_nos'];

            if ($booking['domestic_airport_pickup_nos'] > 0)
                $v['travel_cost'] = $v['travel_cost'] + $v['domestic_airport_pickup_charges'] * $booking['domestic_airport_pickup_nos'];

            if ($booking['child_seat_nos'] > 0)
                $v['travel_cost'] = $v['travel_cost'] + $v['child_seat_charges'] * $booking['child_seat_nos'];
            
            $booking_details = Booking::where('id', $booking->id)->first()->toArray();
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
            $v['travel_cost'] = ($v['base_price'] + ($total_distance * $v['price_per_km']) + ($total_duration * $v['price_per_min']));
            if ($v['travel_cost'] < $v['minimum_charge'])
                $v['travel_cost'] = $v['minimum_charge'];

            $v['travel_cost'] = round($v['travel_cost'] * $event_multiplier, 0);

            $vhls = $v;

            $vehicle_estimated_price = $v['travel_cost'];
            if ($booking_details['international_airport_pickup_nos'] > 0)
                $vehicle_estimated_price = $vehicle_estimated_price + $v['international_airport_pickup_charges'] * $booking_details['international_airport_pickup_nos'];

            if ($booking_details['domestic_airport_pickup_nos'] > 0)
                $vehicle_estimated_price = $vehicle_estimated_price + $v['domestic_airport_pickup_charges'] * $booking_details['domestic_airport_pickup_nos'];

            if ($booking_details['child_seat_nos'] > 0)
                $vehicle_estimated_price = $vehicle_estimated_price + $v['child_seat_charges'] * $booking_details['child_seat_nos'];
            
            $booking_by = User::where('id',$booking->booking_by)->first();
            $user = $booking_by->name;
            $invoice_generate = Invoice::where('booking_id', $booking->id)->first();

            $invoices = Invoice::latest('id')->first();
            $invoice_no_from_admin = $invoices->invoice_no;
            
            return view('admin.booking.booking-detail',compact('booking','vehicle_type','v','vehicle_estimated_price','user','booking_by','invoice_generate','invoice_no_from_admin'));
                    
            } else {
                return redirect(url('admin/login'));
            }
        } catch (\Exception $e) {
          
            return $e->getMessage();
        }
    }
    public function DeleteBooking($id)
    {
        try {
            if (Auth::user()) {
                Booking::where('id',$id)->delete();
                return back()->with('success','Booking deleted successfully!');
            } else {
                return redirect(url('admin/login'));
            }
        } catch (\Exception $e) {
          
            return $e->getMessage();
        }
    }
    public function generatePDF($id)
    {
        $booking = Booking::where('id',$id)->first();
        $vehicle_type_id = VehicleType::where('id',$booking->vehicle_type)->first();
        
        $vehicle_type = $vehicle_type_id->vehicle_type;
        //dd($vehicle_type);
        $random_val = Str::random(8);

        $total_distance = 0;
        $total_duration = 0;
        $event_multiplier = 1;
        if ($booking != null) {
            $total_distance = $booking->distance + 0;
            $total_duration = ($booking->duration / 60 + 0);

            if (($booking->service_type == "Special Event")) {
                $event = Event::where('id', $booking->booking_event)->first();
                $event_multiplier = $event->price_multiplier;
            }
        }
        //$vhls = Vehicle::where('id', $booking['vehicle_type'])->first();
        $vhls = VehicleType::where('vehicle_types.id', $booking->vehicle_type)->join('vehicle_price', 'vehicle_types.id', '=', 'vehicle_price.vehicle_type_id')->first();

        $total_distance = 0;
        $total_duration = 0;
        $event_multiplier = 1;
        if ($booking != null) {
            $total_distance = $booking->distance + 0;
            $total_duration = ($booking->duration / 60 + 0);

            if (($booking->service_type == "Special Event")) {
                $event = Event::where('id', $booking['booking_event'])->first();
                $event_multiplier = $event->price_multiplier;
            }
        }

        $v = $vhls->toArray();
        $v['travel_cost'] = ($v['base_price'] + ($total_distance * $v['price_per_km']) + ($total_duration * $v['price_per_min']));
        if ($v['travel_cost'] < $v['minimum_charge'])
            $v['travel_cost'] = $v['minimum_charge'];



        $v['travel_cost'] = round($v['travel_cost'] * $event_multiplier, 0);

        if ($booking['international_airport_pickup_nos'] > 0)
            $v['travel_cost'] = $v['travel_cost'] + $v['international_airport_pickup_charges'] * $booking['international_airport_pickup_nos'];

        if ($booking['domestic_airport_pickup_nos'] > 0)
            $v['travel_cost'] = $v['travel_cost'] + $v['domestic_airport_pickup_charges'] * $booking['domestic_airport_pickup_nos'];

        if ($booking['child_seat_nos'] > 0)
            $v['travel_cost'] = $v['travel_cost'] + $v['child_seat_charges'] * $booking['child_seat_nos'];
        
        $booking_details = Booking::where('id', $booking->id)->first()->toArray();
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
        $v['travel_cost'] = ($v['base_price'] + ($total_distance * $v['price_per_km']) + ($total_duration * $v['price_per_min']));
        if ($v['travel_cost'] < $v['minimum_charge'])
            $v['travel_cost'] = $v['minimum_charge'];

        $v['travel_cost'] = round($v['travel_cost'] * $event_multiplier, 0);

        $vhls = $v;

        $vehicle_estimated_price = $v['travel_cost'];
        if ($booking_details['international_airport_pickup_nos'] > 0)
            $vehicle_estimated_price = $vehicle_estimated_price + $v['international_airport_pickup_charges'] * $booking_details['international_airport_pickup_nos'];

        if ($booking_details['domestic_airport_pickup_nos'] > 0)
            $vehicle_estimated_price = $vehicle_estimated_price + $v['domestic_airport_pickup_charges'] * $booking_details['domestic_airport_pickup_nos'];

        if ($booking_details['child_seat_nos'] > 0)
            $vehicle_estimated_price = $vehicle_estimated_price + $v['child_seat_charges'] * $booking_details['child_seat_nos'];
        
        $booking_by = User::where('id',$booking->booking_by)->first();
        $user = $booking_by->name;
        $invoice_date = date('M j, Y', strtotime($booking->booking_date));
        $invoice_time = date('h:i A', strtotime($booking->booking_time));
        $image_logo = public_path('frontend/images/logo.png');
        $pdf = PDF::loadView('admin.booking.invoice',array('order'=>$booking,
                                                            'user'=>$user,
                                                            'invoice_date' =>$invoice_date,
                                                            'invoice_time' =>$invoice_time,
                                                            'vehicle_type' =>$vehicle_type,
                                                            'v'=>$v,
                                                            'vehicle_estimated_price' =>$vehicle_estimated_price,
                                                            'image_logo' =>$image_logo
                                                        ));

        $invoice_date = date('jS F Y', strtotime($booking->invoice_date)); 

        $pdf->setPaper('A4', 'portrait');

        $pdf->setOption([
            'isPhpEnabled' => true,
            'isHtml5ParserEnabled' => true,
            'isRemoteEnabled' => true
        ]);

        return $pdf->download('Invoice_'.'MrDrivers'.'_Order_No # '.$id.' Date_'.$invoice_date.'.pdf');
    }
    public function ChangeBookingStatus(Request $request,$slug)
    {
        try {
            if (Auth::user()) {
                Booking::where('booking_slug',$slug)->update([
                    'status' => $request->status,
                ]);
                return back();
            } else {
                return redirect(url('admin/login'));
            }
        } catch (\Exception $e) {
          
            return $e->getMessage();
        }
    }
    public function GenerateInvoice(Request $request)
    {
        if (Auth::user()) {
            $validatedData = $request->validate([
                'invoice_number' => 'required',
                'bill_to_name' => 'required',
                'invoice_date' => 'required',
            ], [
                'invoice_number' => 'Invoice Number field is required.',
                'bill_to_name' => 'Bill To Name field is required.',
                'invoice_date' => 'Invoice Date field is required.',
            ]);

            $flight = Invoice::create([
                'user_id' => $request->user_id,
                'booking_id' => $request->booking_id,
                'invoice_no' => $request->invoice_number,
                'invoice_date' => $request->invoice_date,
                'bill_to_name' => empty($request->bill_to_name)?'':$request->bill_to_name,
                'billing_addr' => empty($request->billing_addr)?'':$request->billing_addr,
                'abn_number' => empty($request->abn_number)?'':$request->abn_number,
                'international_airport_pickup_detail' => $request->international_airport_pickup_detail,
                'domestic_airport_pickup_detail' => $request->domestic_airport_pickup_detail,
                'total_amount' => $request->total_amount,
                'gst' => $request->gst,
                'discount' => $request->discount,
                'net_amount' => $request->net_amount,
            ]);
            return back()->with('success','Invoice generated successfully! Please check your invoice masters');
        } else {
            return redirect(url('/admin/login'));
        }
    }
}
