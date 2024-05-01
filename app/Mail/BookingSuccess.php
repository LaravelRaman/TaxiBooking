<?php

namespace App\Mail;

use App\Models\Booking;
use App\Models\Event;
use App\Models\User;
use App\Models\VehicleType;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Str;
use Barryvdh\DomPDF\Facade\Pdf as PDF;

class BookingSuccess extends Mailable
{
    use Queueable, SerializesModels;
    public $data;
    public $slug;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
        $this->slug = $data['booking_slug'];
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $booking = Booking::where('booking_slug',$this->slug)->first();
        $vehicle_type_id = VehicleType::where('id',$booking->vehicle_type)->first();
        
        $vehicle_type = $vehicle_type_id->vehicle_type;
        $international_detail = json_decode($booking['international_airport_pickup_detail']);
        $domestic_detail = json_decode($booking['domestic_airport_pickup_detail']);
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
        //dd($v['international_airport_pickup_charges']);
        $pdf = PDF::loadView('mail.bookinginvoice',array('order'=>$booking,
                                                            'user'=>$user,
                                                            'invoice_date' => $invoice_date,
                                                            'invoice_time' => $invoice_time,
                                                            'vehicle_type' => $vehicle_type,
                                                            'v'=>$v,
                                                            'vehicle_estimated_price' =>$vehicle_estimated_price,
                                                            'image_logo' => $image_logo,
                                                            'international_detail' => $international_detail,
                                                            'domestic_detail' => $domestic_detail,
                                                        ));
                            
        $invoice_date = date('jS F Y', strtotime($booking->invoice_date)); 

        $pdf->setPaper('A4', 'portrait');

        $pdf->setOption([
            'isPhpEnabled' => true,
            'isHtml5ParserEnabled' => true,
            'isRemoteEnabled' => true
        ]);

        $pdf_content = $pdf->output();
        return $this->from('admin@prodrive.com')->subject('Booking Successful')->view('mail.bookingmail')->with('data', $this->data)->attachData($pdf_content, 'Booking.pdf', ['mime' => 'application/pdf']);
    }
}
