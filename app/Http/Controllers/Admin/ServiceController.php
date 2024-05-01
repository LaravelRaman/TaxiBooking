<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\Event;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ServiceController extends Controller
{
    // public function Services()
    // {
    //     $this->fixServiceSNo();
    //     $services = Service::orderBy('sno','ASC')->paginate(100);
    //     return view('admin.services.services',compact('services'));
    // }
    // public function AddService(Request $request)
    // {
    //     if (Auth::user()) {
    //         $request['service_slug'] = Str::slug($request->service_name).'-'.$request->slug;
    //         $validatedData = $request->validate([
    //             'type' => 'required',
    //             'title' => 'required',
    //             'service_name' => 'required',
    //             'slug' => 'required',
    //             'service_slug' => 'unique:services,service_slug',
    //             'description_text' => 'required',
    //             'status' => 'required',
    //             'description' => 'required',
    //             'long_description' => 'required',
    //             'price_multiplier' => 'required',
    //         ], [
    //             'type.required' => 'Type field is required.',
    //             'title.required' => 'Title field is required.',
    //             'service_name.required' => 'Service name field is required.',
    //             'slug.required' => 'Service slug field is required.',
    //             'service_slug.required' => 'Service slug field is required.',
    //             'description_text.required' => 'Service description field is required.',
    //             'status.required' => 'Service status field is required.',
    //             'description.required' => 'Service description field is required.',
    //             'long_description.required' => 'Service long description field is required.',
    //             'price_multiplier.required' => 'Event price multiplier field is required.',
    //         ]);

    //         $fileName_thumbnail = null;
    //         $fileName_banner = null;
    //         $imageurl= null;

    //         $service = Event::create([
    //             'type' => $request->type,
    //             'title' => $request->title,
    //             'meta_keyword' => $request->meta_keyword,
    //             'meta_description' => $request->meta_description,
    //             'event_name' => $request->service_name,
    //             'slug' => $request->slug,
    //             'event_slug' => Str::slug($request->service_name).'-'.$request->slug,
    //             'event_text' => $request->description_text,
    //             'status' => $request->status,
    //             'price_multiplier' => $request->price_multiplier,
    //             'description' => $request->description,
    //             'long_description' => $request->long_description,
    //             'tags' => $request->tags,
    //             'sno' => Event::where('type','service')->count()+1,
    //         ]);
           
    //         if (request()->hasFile('thumbnail')) {
    //             $file = request()->file('thumbnail');
    //             $fileName_thumbnail =time() . "." . $file->getClientOriginalExtension();
    //             $imageurl =url('/uploads/service_thumbnail/'.time() . "." . $file->getClientOriginalExtension());
    //             $file->move('./uploads/service_thumbnail/', $fileName_thumbnail);
    //             $service->thumbnail=$fileName_thumbnail;
    //             $service->save();
    //         }
    //         if (request()->hasFile('banner_image')) {
    //             $file = request()->file('banner_image');
    //             $fileName_banner =time() . "." . $file->getClientOriginalExtension();
    //             $imageurl =url('/uploads/service_banner/'.time() . "." . $file->getClientOriginalExtension());
    //             $file->move('./uploads/service_banner/', $fileName_banner);
    //             $service->banner_image= $fileName_banner;
    //             $service->save();
    //         }
    //         return back()->with('success','Service created successfully!');
    //     } else {
    //         return redirect(url('/admin/login'));
    //     }
    // }
    // public function EditService($slug)
    // {
    //     try {
    //         if (Auth::user()) {
    //             $service = Service::where('service_slug',$slug)->first();
    //             return view('admin.services.edit_service',compact('service'));
    //         } else {
    //             return redirect(url('/admin/login'));
    //         }
    //     } catch (\Exception $e) {
          
    //         return $e->getMessage();
    //     }
    // }
    // public function UpdateService(Request $request,$slug)
    // {
    //     if (Auth::user()) {
    //         $slug_data = Service::where('service_slug',$slug)->select('service_slug')->first();
    //         $service_slug = $slug_data->service_slug;
    //         $request_slug = Str::slug($request->service_name).'-'.$request->slug;
    //         $request['service_slug'] = $request_slug;
    //             $request_data = [
    //                 'title' => 'required',
    //                 'service_name' => 'required',
    //                 'slug' => 'required',
    //                 'service_slug' => 'required',
    //                 'description_text' => 'required',
    //                 'status' => 'required',
    //                 'description' => 'required',
    //                 'long_description' => 'required',
    //                 'tags' => 'required',
    //                 'price_multiplier.required' => 'required',
    //             ];
    //             $validate_msg = [
    //                 'title.required' => 'Title field is required.',
    //                 'service_name.required' => 'Service name field is required.',
    //                 'slug.required' => 'Service slug field is required.',
    //                 'service_slug.required' => 'Service slug field is required.',
    //                 'description_text.required' => 'Service description field is required.',
    //                 'status.required' => 'Service status field is required.',
    //                 'description.required' => 'Service description field is required.',
    //                 'long_description.required' => 'Service long description field is required.',
    //                 'tags.required' => 'Service tags field is required.',
    //                 'price_multiplier.required' => 'Event price multiplier field is required.',
    //             ];
                


    //         if($service_slug != $request_slug){
    //             $request_data['service_slug'] = "required|unique:services,service_slug";
    //             $validate_msg['service_slug.unique'] = "This slug exists. Please add a distinct slug";
                
    //         }
    //         $validatedData = $request->validate($request_data, $validate_msg);
            

    //         $service = Event::where('event_slug',$service_slug)->update([
    //             'type' => $request->type,
    //             'title' => $request->title,
    //             'meta_keyword' => $request->meta_keyword,
    //             'meta_description' => $request->meta_description,
    //             'event_name' => $request->service_name,
    //             'slug' => $request->slug,
    //             'event_slug' => Str::slug($request->service_name).'-'.$request->slug,
    //             'event_text' => $request->description_text,
    //             'status' => $request->status,
    //             'price_multiplier' => $request->price_multiplier,
    //             'description' => $request->description,
    //             'long_description' => $request->long_description,
    //             'tags' => $request->tags,
    //             'sno' => Event::where('type','service')->count()+1,
    //         ]);
    //         $service = Event::where('event_slug',$request_slug)->first();


    //         $fileName_thumbnail = null;
    //         $fileName_banner = null;
    //         $imageurl= null;
            
    //         if (request()->hasFile('thumbnail')) {
    //             $file = request()->file('thumbnail');
    //             $fileName_thumbnail =time() . "." . $file->getClientOriginalExtension();
    //             $imageurl =url('/uploads/service_thumbnail/'.time() . "." . $file->getClientOriginalExtension());
    //             $file->move('./uploads/service_thumbnail/', $fileName_thumbnail);
    //             $service->thumbnail=$fileName_thumbnail;
    //             $service->save();
    //         }
    //         if (request()->hasFile('banner_image')) {
    //             $file = request()->file('banner_image');
    //             $fileName_banner =time() . "." . $file->getClientOriginalExtension();
    //             $imageurl =url('/uploads/service_banner/'.time() . "." . $file->getClientOriginalExtension());
    //             $file->move('./uploads/service_banner/', $fileName_banner);
    //             $service->banner_image= $fileName_banner;
    //             $service->save();
    //         }
    //         return redirect(route('admin.service-master'))->with('success','Service updated successfully!');
    //     } else {
    //         return redirect(url('/admin/login'));
    //     }
    // }
    // public function DeleteService($slug)    
    // {
    //     try {
    //         if (Auth::user()) {
    //             Service::where('service_slug',$slug)->delete();
    //             return back()->with('success','Service deleted successfully!');  
    //         } else {
    //             return redirect(url('/admin/login'));
    //         }
    //     } catch (\Exception $e) {
          
    //         return $e->getMessage();
    //     }
    // }

    //Events Related Funnctions
    public function Events()
    {
        try {
            if (Auth::user()) {
                $events = Event::orderBy('id','DESC')->paginate(100);
                return view('admin.event.index',compact('events'));
            } else {
                return redirect(url('/admin/login'));
            }
        } catch (\Exception $e) {
          
            return $e->getMessage();
        }
    }
    public function AddEvents(Request $request)
    {
        //dd($request->all());
        if (Auth::user()) {
            $request['event_slug'] = Str::slug($request->event_name).'-'.$request->slug;
            if(!empty($request->type) && $request->type=='service')
            {
                $validatedData = $request->validate([
                    'type' =>'required',
                    'title' =>'required',
                    'event_name' => 'required',
                    'slug' => 'required',
                    'event_slug' => 'unique:events,event_slug',
                    'event_text' => 'required',
                    'thumbnail' => 'required',
                    'banner_image' => 'required',
                    'status' => 'required',
                    'description' => 'required',
                    
                ], [
                    'title.required' => 'Service type field is required.',
                    'title.required' => 'Service title field is required.',
                    'event_name.required' => 'Service name field is required.',
                    'slug.required' => 'Service slug field is required.',
                    'event_slug.required' => 'Service slug field is required.',
                    'event_text.required' => 'Service text field is required.',
                    'thumbnail.required' => 'Service thumbnail is required.',
                    'banner_image.required' => 'Service Banner is required.',
                    'status.required' => 'Service description field is required.',
                    'description.required' => 'Service description field is required.',
                ]);
            }
            else{

            
                $validatedData = $request->validate([
                    'type' =>'required',
                    'title' =>'required',
                    'event_name' => 'required',
                    'slug' => 'required',
                    'event_slug' => 'unique:events,event_slug',
                    'event_text' => 'required',
                    'thumbnail' => 'required',
                    'banner_image' => 'required',
                    'status' => 'required',
                    'from_date' => 'required',
                    'to_date' => 'required',
                    'location' => 'required',
                    'description' => 'required'
                ], [
                    'type.required' => 'Event type field is required.',
                    'title.required' => 'Event title field is required.',
                    'event_name.required' => 'Event name field is required.',
                    'slug.required' => 'Event slug field is required.',
                    'event_slug.required' => 'Event slug field is required.',
                    'event_text.required' => 'Event text field is required.',
                    'thumbnail.required' => 'Event thumbnail is required.',
                    'banner_image.required' => 'Event Banner is required.',
                    'status.required' => 'Event description field is required.',
                    'from_date.required' => 'Event from date field is required.',
                    'to_date.required' => 'Event to date field is required.',
                    'location.required' => 'Event location field is required.',
                    'description.required' => 'Event description field is required.',
                ]);
            }
            $service = Event::create([
                'title' => $request->title,
                'type' => $request->type, 
                'meta_keyword' => $request->meta_keyword,
                'meta_description' => $request->meta_description,
                'event_name' => $request->event_name,
                'slug' => $request->slug,
                'event_slug' => Str::slug($request->event_name).'-'.$request->slug,
                'event_text' => $request->event_text,
                'status' => $request->status,
                'from_date' =>$request->from_date,
                'to_date' =>$request->to_date,
                'price_multiplier' => $request->price_multiplier,
                'location' =>$request->location,
                'description' => $request->description,
                'long_description' => $request->long_description,
                'tags' => $request->tags,
            ]);
            if ($request->type == "service") {
                $service->sno = Event::where('type','service')->count()+1;
            }
            $fileName_thumbnail = null;
            $fileName_banner = null;
            $imageurl= null;
            if (request()->hasFile('thumbnail')) {
                $file = request()->file('thumbnail');
                $fileName_thumbnail =time() . "." . $file->getClientOriginalExtension();
                $imageurl =url('/uploads/event_thumbnail/'.time() . "." . $file->getClientOriginalExtension());
                $file->move('./uploads/event_thumbnail/', $fileName_thumbnail);
                $service->thumbnail=$fileName_thumbnail;
                $service->save();
            }
            if (request()->hasFile('banner_image')) {
                $file = request()->file('banner_image');
                $fileName_banner =time() . "." . $file->getClientOriginalExtension();
                $imageurl =url('/uploads/event_banner/'.time() . "." . $file->getClientOriginalExtension());
                $file->move('./uploads/event_banner/', $fileName_banner);
                $service->banner_image= $fileName_banner;
                $service->save();
            }
            return redirect(route('admin.event-master'))->with('success','Event created successfully!');
        } else {
            return redirect(url('/admin/login'));
        }
    }
    public function EditEvent($slug)
    {
        try {
            if (Auth::user()) {
                $event = Event::where('event_slug',$slug)->first();
                //dd($event->from_date);
                return view('admin.event.edit',compact('event'));
            } else {
                return redirect(url('/admin/login'));
            }
        } catch (\Exception $e) {
          
            return $e->getMessage();
        }
    }
    public function UpdateEvent(Request $request,$slug)
    {
        if (Auth::user()) {

            $slug_data = Event::where('event_slug',$slug)->select('event_slug')->first();
            $event_slug = $slug_data->event_slug;
            $request_slug = Str::slug($request->event_name).'-'.$request->slug;
            $request['event_slug'] = $request_slug;
            //dd($request->service_slug);
            if(!empty($request->type) && $request->type=='service')
            {
                    $request_data = [
                    'event_name' => 'required',
                    'slug' => 'required',
                    'event_slug' => 'required',
                    'event_text' => 'required',
                    'status' => 'required',
                    'description' => 'required',
                    
                ];
                $validate_msg = [
                    'event_name.required' => 'Service name field is required.',
                    'slug.required' => 'Service slug field is required.',
                    'event_slug.required' => 'Service slug field is required.',
                    'event_text.required' => 'Service text field is required.',
                    'status.required' => 'Service description field is required.',
                    'description.required' => 'Service description field is required.',
                ];
            }
            else{
                $request_data = [
                    'event_name' => 'required',
                    'slug' => 'required',
                    'event_slug' => 'required',
                    'event_text' => 'required',
                    'status' => 'required',
                    'from_date' => 'required',
                    'to_date' => 'required',
                    'location' => 'required',
                    'price_multiplier' => 'required',
                    'description' => 'required'
                ];
                $validate_msg = [
                    'event_name.required' => 'Event name field is required.',
                    'slug.required' => 'Event slug field is required.',
                    'event_slug.required' => 'Event slug field is required.',
                    'event_text.required' => 'Event text field is required.',
                    'status.required' => 'Event description field is required.',
                    'from_date.required' => 'Event from date field is required.',
                    'to_date.required' => 'Event to date field is required.',
                    'location.required' => 'Event location field is required.',
                    'price_multiplier.required' => 'Event price multiplier field is required.',
                    'description.required' => 'Event description field is required.',
                ];
            }
                


            if($event_slug != $request_slug){
                $request_data['event_slug'] = "required|unique:events,event_slug";
                $validate_msg['event_slug.unique'] = "This slug exists. Please add a distinct slug";
                
            }
            $validatedData = $request->validate($request_data, $validate_msg);

            $service = Event::where('event_slug',$event_slug)->update([
                'title' => $request->title,
                'type' => $request->type,
                'meta_keyword' => $request->meta_keyword,
                'meta_description' => $request->meta_description,
                'event_name' => $request->event_name,
                'slug' => $request->slug,
                'event_slug' => Str::slug($request->event_name).'-'.$request->slug,
                'event_text' => $request->event_text,
                'status' => $request->status,
                'from_date' =>$request->from_date,
                'to_date' =>$request->to_date,
                'price_multiplier' => $request->price_multiplier,
                'location' =>$request->location,
                'description' => $request->description,
                'long_description' => $request->long_description?$request->long_description:'',
                'tags' => $request->tags,
            ]);

            $service = Event::where('event_slug',Str::slug($request->event_name).'-'.$request->slug)->first();

            $fileName_thumbnail = null;
            $fileName_banner = null;
            $imageurl= null;
            if (request()->hasFile('thumbnail')) {
                $file = request()->file('thumbnail');
                $fileName_thumbnail =time() . "." . $file->getClientOriginalExtension();
                $imageurl =url('/uploads/event_thumbnail/'.time() . "." . $file->getClientOriginalExtension());
                $file->move('./uploads/event_thumbnail/', $fileName_thumbnail);
                $service->thumbnail=$fileName_thumbnail;
                $service->save();
            }
            if (request()->hasFile('banner_image')) {
                $file = request()->file('banner_image');
                $fileName_banner =time() . "." . $file->getClientOriginalExtension();
                $imageurl =url('/uploads/event_banner/'.time() . "." . $file->getClientOriginalExtension());
                $file->move('./uploads/event_banner/', $fileName_banner);
                $service->banner_image= $fileName_banner;
                $service->save();
            }
            return redirect(route('admin.event-master'))->with('success','Event updated successfully!');
        } else {
            return redirect(url('/admin/login'));
        }
    }
    public function DeleteEvent($slug)
    {
        try {
            if (Auth::user()) {
                Event::where('event_slug',$slug)->delete();
                return back()->with('success','Event deleted successfully!');
            } else {
                return redirect(url('/admin/login'));
            }
        } catch (\Exception $e) {
          
            return $e->getMessage();
        }
    }
    public function ChangeServiceSNo($slug,$sno)
    {
        $this->fixServiceSNo();
        $service=Service::where('slug',$slug)->first();
        if($service!=null && $sno>0)        
        {
            if($sno>Service::count())
            $sno=Service::count();
            
            $oldsno=$service->sno;

            DB::table('services')->where('sno','>', $oldsno)
            ->lazyById()->each(function ($service) {
                DB::table('services')
                    ->where('id', $service->id)
                    ->update(['sno' => $service->sno-1]);
            });

            DB::table('services')->where('sno','>=', $sno)
            ->lazyById()->each(function ($service) {
                DB::table('services')
                    ->where('id', $service->id)
                    ->update(['sno' => $service->sno+1]);
            });
           
           $service->sno=$sno;
           $service->save();
        }
        return redirect(route('admin.service-master'));
    }
    public function fixServiceSNo()
    {
        foreach(Service::where('sno',0)->orderBy('id','ASC')->get() as $service)
        {
            $max=Service::max('sno')+1;
            $service->sno=$max;
            $service->save();
        }
    }
}
