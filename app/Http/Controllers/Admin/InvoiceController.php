<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Event;
use App\Models\Invoice;
use App\Models\User;
use App\Models\VehicleType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Barryvdh\DomPDF\Facade\Pdf as PDF;  

class InvoiceController extends Controller
{
    public function Index()
    {
        try {
            if (Auth::user()) {
                // $invoices = Invoice::oredrBy('id','DESC')->get();
                $invoices = DB::table('invoices')
                            ->join('users','invoices.user_id','=','users.id')
                            ->leftjoin('bookings','invoices.booking_id','=','bookings.id')
                            ->get();
                return view('admin.invoice.index',compact('invoices'));
            } else {
                return redirect(url('admin/login'));
            }
        } catch (\Exception $e) {
          
            return $e->getMessage();
        }
    }
    public function Detail($id)
    {
        try {
            if (Auth::user()) {
            $booking_id = $id;
            $invoices = Invoice::where('booking_id',$id)->first();
            return view('admin.invoice.detail',compact('booking_id'));
            } else {
                return redirect(url('admin/login'));
            }
        } catch (\Exception $e) {
          
            return $e->getMessage();
        }
    }
    public function Delete($id)
    {
        try {
            if (Auth::user()) {
                Invoice::where('booking_id', '=',$id)->delete();
                return back()->with('success','Invoice deleted successfully!');;
            } else {
                return redirect(url('admin/login'));
            }
        } catch (\Exception $e) {
          
            return $e->getMessage();
        }
    }
    public function ViewPdf($id)
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

            if (($booking_details['service_type'] == "Special Event")) {
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

        $pdf_content = $pdf->output();
        return response($pdf_content)->header('Content-Type', 'application/pdf');
    }
}
