<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\QuoteApproved;
use App\Mail\QuoteCanceled;
use App\Models\EventQuote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;

class QuoteController extends Controller
{
    public function Quote()
    {
        try {
            if (Auth::user()) {
                $quotes = EventQuote::get();
                return view('admin.quotes.home',compact('quotes'));
            }else {
                return redirect(url('/admin/login'));
            }
        } catch (\Exception $e) {
          
            return $e->getMessage();
        }
    }
    public function EditQuote($slug)
    {
        try {
            if (Auth::user()) {
                $quote = EventQuote::where('event_name',$slug)->first();
                return view('admin.quotes.edit',compact('quote'));
            }else {
                return redirect(url('/admin/login'));
            }
        } catch (\Exception $e) {
          
            return $e->getMessage();
        }
    }
    public function UpdateQuote(Request $request,$slug)
    {
        //dd($request->all());
        $quote = EventQuote::where('event_name',$slug)->first();
        if(isset($request->status) && $request->status == "approved"){
            $validatedData = $request->validate([
                'status' => 'required',
                'quote_price' => 'required',
                'customer_remarks' => 'required',
            ], [
                'status.required' => 'Status field is required.',
                'quote_price.required' => 'Quote price field is required.',
                'customer_remarks.required' => 'Quote remark field is required.',
            ]);

            $quotes = EventQuote::where('event_name',$slug)->update([
                'status' => 'approved',
                'quote_price' => $request->quote_price,
                'customer_remarks' => $request->customer_remark
            ]);
            $data = array(
                'event_name' => $quote->event_name,
                'name' =>  $quote->name,
                'email' =>   $quote->email,
                'phone' => $quote->phone,
                'date' => $quote->date,
                'starting_point' => $quote->starting_point,
                'vehicle_type' => $quote->vehicle_type,
                'service_type' => $quote->service_type,
                'destination' => $quote->destination,
                'message' => $quote->message,
                'quote_price' => $request->quote_price,
                'customer_remarks' => $request->customer_remark
            );
            Mail::to($request->email)->send(new QuoteApproved($data));
            return view('pages.thankyou');
        }
        if(isset($request->status) && $request->status == "canceled"){
            $validatedData = $request->validate([
                'status' => 'required',
                'customer_remarks' => 'required',
            ], [
                'status.required' => 'Status field is required.',
                'customer_remarks.required' => 'Quote remark field is required.',
            ]);

            $quotes = EventQuote::where('event_name',$slug)->update([
                'status' => 'canceled',
                'customer_remarks' => $request->customer_remark,
            ]);
            $data = array(
                'event_name' => $quote->event_name,
                'name' =>  $quote->name,
                'email' =>   $quote->email,
                'phone' => $quote->phone,
                'date' => $quote->date,
                'starting_point' => $quote->starting_point,
                'vehicle_type' => $quote->vehicle_type,
                'service_type' => $quote->service_type,
                'destination' => $quote->destination,
                'message' => $quote->message,
                'customer_remarks' => $request->customer_remark
            );
            Mail::to($request->email)->send(new QuoteCanceled($data));
            return view('pages.thankyou');
        }
        if(isset($request->status) && $request->status == "pending"){
            $validatedData = $request->validate([
                'status' => 'required',
                'customer_remarks' => 'required',
            ], [
                'status.required' => 'Status field is required.',
                'customer_remarks.required' => 'Quote remark field is required.',
            ]);

            $quotes = EventQuote::where('event_name',$slug)->update([
                'status' => 'pending',
                'customer_remarks' => $request->customer_remarks,
            ]);
        }
        return redirect(route('admin.quotes'))->with('message',"The Quote Status Has Been Changed");
    }
    public function DeleteQuote()
    {
        $quotes = EventQuote::get();
        return view('admin.quotes.home',compact('quotes'));
    }

}
