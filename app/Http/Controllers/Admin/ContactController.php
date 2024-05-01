<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contact;
use Illuminate\Support\Facades\Auth;

class ContactController extends Controller
{
    public function Contact()
    { 
        try {
            if (Auth::user()) {
                $contacts = Contact::orderBy('id','ASC')->paginate(10);
                return view('admin.contact.contact',compact('contacts'));
            } else {
                return redirect(url('admin/login'));
            }
            
        } catch (\Exception $e) {
          
            return $e->getMessage();
        }
    }
    public function ViewContact($id)
    {
        try {
            if (Auth::user()) {
                $contact = Contact::where('id',$id)->first();
                return view('admin.contact.view_contact',compact('contact'));
            } else {
                return redirect(url('admin/login'));
            }
            
        } catch (\Exception $e) {
          
            return $e->getMessage();
        }
    }
    public function DeleteContact($id)
    {
        try {
            if (Auth::user()) {
                Contact::where('id',$id)->delete();
                return redirect(route('admin.contacts'));
            } else {
                return redirect(url('admin/login'));
            }
            
        } catch (\Exception $e) {
          
            return $e->getMessage();
        }
    }
}
