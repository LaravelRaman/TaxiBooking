<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\VehicleType;
use App\Models\VehicleAttribute;
use App\Models\VehicleAttr;
use App\Models\Vehicle;
use App\Models\VehiclePrice;
use App\Models\VehicleImage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use DB;
class VehicleController extends Controller
{
    //------------------------------------------------------------
    // Vehicle type functions starts
    //------------------------------------------------------------
    public function VehicleType(Request $request)
    {
        try {
            if (Auth::user()) {
                $types = VehicleType::orderBy('id','DESC')->paginate('10');
                return view('admin.vehicle.vehicle_type',compact('types'));
            } else {
                return redirect(url('/admin/login'));
            } 
          } catch (\Exception $e) {
          
              return $e->getMessage();
          } 
    }
    public function AddVehicleType(Request $request)
    {
        //dd($request->all());
        if (Auth::user()) {
            $request['vehicle_type_slug'] = Str::slug($request->vehicle_type).'-'.$request->slug;
            $validatedData = $request->validate([
                'title' =>'required',
                'vehicle_type' => 'required',
                'slug' => 'required',
                'vehicle_type_slug' => 'unique:vehicle_types,vehicle_type_slug',
                'status' => 'required',
                'vehicle_type_image' => 'required',
                'no_of_child' => 'required',
                'no_of_passengers' => 'required',
                'no_of_suitcases' => 'required',
                'base_price' => 'required',
                'price_per_min' => 'required',
                'price_per_hour' => 'required',
                'price_per_km' => 'required',
                'extra_waiting_time' => 'required',
                'minimum_charge' => 'required',
                'minimum_hour' => 'required',
                'international_airport_pickup_charges' => 'required',
                'domestic_airport_pickup_charges' => 'required',
                'child_seat_charges' => 'required',
                'vehicle_type_description' => 'required'
            ], [
                'title.required' => 'Vehicle title field is required.',
                'vehicle_type.required' => 'Vehicle type field is required.',
                'slug.required' => 'Vehicle slug field is required.',
                'status.required' => 'Vehicle status field is required.',
                'vehicle_type_image.required' => 'Vehicle type image field is required.',
                'vehicle_type_slug.required' => 'Vehicle type slug field is required.',
                'no_of_child.required' => 'Vehicle No. of child field is required.',
                'no_of_passengers.required' => 'Vehicle No. of passenger field is required.',
                'no_of_suitcases.required' => 'Vehicle No. of suitcase field is required.',
                'base_price.required' => 'Vehicle base price field is required.',
                'price_per_min.required' => 'Vehicle per min price field is required.',
                'price_per_hour.required' => 'Vehicle price per hour field is required.',
                'price_per_km.required' => 'Vehicle price per km field is required.',
                'extra_waiting_time.required' => 'Vehicle waiting time price field is required.',
                'minimum_charge.required' => 'Vehicle minimum charge field is required.',
                'minimum_hour.required' => 'Vehicle minimum hour field is required.',
                'international_airport_pickup_charges.required' => 'Vehicle international pickup charge field is required.',
                'domestic_airport_pickup_charges.required' => 'Vehicle domestic pickup charge field is required.',
                'child_seat_charges.required' => 'Vehicle child seat charge field is required.',
                'vehicle_type_description.required' => 'Vehicle type description field is required.',
            ]);

            $vht = VehicleType::create([
                'title' => $request->title,
                'meta_keyword' => $request->meta_keyword,
                'meta_description' => $request->meta_description,
                'vehicle_type' => $request->vehicle_type,
                'vehicle_slug' => $request->slug,
                'vehicle_type_slug' => Str::slug($request->vehicle_type).'-'.$request->slug,
                'vehicle_type_description' => $request->vehicle_type_description,
                'status' => $request->status,
                'vehicle_type_image' => ""
            ]);
            $vhtp = VehiclePrice::create([
                'vehicle_type_id' => $vht->id,
                'no_of_child' => $request->no_of_child,
                'no_of_passengers' => $request->no_of_passengers,
                'no_of_suitcases' => $request->no_of_suitcases,
                'base_price' => $request->base_price,
                'price_per_min' => $request->price_per_min,
                'price_per_hour' => $request->price_per_hour,
                'price_per_km' => $request->price_per_km,
                'extra_waiting_time' => $request->extra_waiting_time,
                'minimum_charge' => $request->minimum_charge,
                'minimum_hour' => $request->minimum_hour,
                'international_airport_pickup_charges' => $request->international_airport_pickup_charges,
                'domestic_airport_pickup_charges' => $request->domestic_airport_pickup_charges,
                'child_seat_charges' => $request->child_seat_charges,
                
            ]);
            

            if (request()->hasFile('vehicle_type_image')) {
                $file = request()->file('vehicle_type_image');
                $fileName =time() . "." . $file->getClientOriginalExtension();
                $imageurl =url('/uploads/vehicle_type/'.time() . "." . $file->getClientOriginalExtension());
                $file->move('./uploads/vehicle_type/', $fileName);
                $vht->vehicle_type_image = $fileName;
                $vht->save();
            }

            return back()->with('success','Vehicle type created successfully!');
        } else {
            return redirect(url('/admin/login'));
        }
    }
    public function EditVehicleType($id)
    {
        try {
            if (Auth::user()) {
                $type = VehicleType::where('id',$id)->first();
                return view('admin.vehicle.edit_vehicle_type',compact('type'));
            } else {
                return redirect(url('/admin/login'));
            }  
        } catch (\Exception $e) {
          
            return $e->getMessage();
        }
    }
    public function UpdateVehicleType(Request $request,$id)
    {
        // try {
            if (Auth::user()) {
                $slug = VehicleType::where('id',$id)->select('vehicle_type_slug')->first();
                $vehicle_type_slug = $slug->vehicle_type_slug;
                $request_slug = Str::slug($request->vehicle_type).'-'.$request->slug;
                $request['vehicle_type_slug'] = $request_slug;
                $request_data = [
                    'title' => 'required',
                    'vehicle_type' => 'required',
                    'slug' => 'required',
                    'vehicle_type_slug' => 'required',
                    'status' => 'required',
                    'no_of_child' => 'required',
                    'no_of_passengers' => 'required',
                    'no_of_suitcases' => 'required',
                    'base_price' => 'required',
                    'price_per_min' => 'required',
                    'price_per_hour' => 'required',
                    'price_per_km' => 'required',
                    'extra_waiting_time' => 'required',
                    'minimum_charge' => 'required',
                    'minimum_hour' => 'required',
                    'international_airport_pickup_charges' => 'required',
                    'domestic_airport_pickup_charges' => 'required',
                    'child_seat_charges' => 'required',
                    'vehicle_type_description' => 'required'
                ];
                //dd($request_data['vehicle_type_slug']);
                $validate_msg = [
                    'title.required' => 'Vehicle type title field is required.',
                    'vehicle_type.required' => 'Vehicle type field is required.',
                    'vehicle_type_slug.required' => 'Vehicle type slug field is required.',
                    'slug.required' => 'Vehicle Type Slug field is required.',
                    'status.required' => 'Vehicle type status field is required.',
                    'no_of_child.required' => 'Vehicle No. of child field is required.',
                    'no_of_passengers.required' => 'Vehicle No. of passenger field is required.',
                    'no_of_suitcases.required' => 'Vehicle No. of suitcase field is required.',
                    'base_price.required' => 'Vehicle base price field is required.',
                    'price_per_min.required' => 'Vehicle per min price field is required.',
                    'price_per_hour.required' => 'Vehicle price per hour field is required.',
                    'price_per_km.required' => 'Vehicle price per km field is required.',
                    'extra_waiting_time.required' => 'Vehicle waiting time price field is required.',
                    'minimum_charge.required' => 'Vehicle minimum charge field is required.',
                    'minimum_hour.required' => 'Vehicle minimum hour field is required.',
                    'international_airport_pickup_charges.required' => 'Vehicle international pickup charge field is required.',
                    'domestic_airport_pickup_charges.required' => 'Vehicle domestic pickup charge field is required.',
                    'child_seat_charges.required' => 'Vehicle child seat charge field is required.',
                    'vehicle_type_description.required' => 'Vehicle type description field is required.',
                ];
                if($vehicle_type_slug != $request_slug){
                    $request_data['vehicle_type_slug'] = "unique:vehicle_types,vehicle_type_slug";
                    $validate_msg['vehicle_type_slug.unique'] = "This slug exists. Please add a distinct slug";
                    
                }

                $validatedData = $request->validate($request_data, $validate_msg);
                //dd($request->all());
                $flight = VehicleType::where('id',$id)->update([
                    'title' => $request->title,
                    'meta_keyword' => $request->meta_keyword,
                    'meta_description' => $request->meta_description,
                    'status' => $request->status,
                    'vehicle_type' => $request->vehicle_type,
                    'vehicle_slug' => $request->slug,
                    'vehicle_type_slug' => Str::slug($request->vehicle_type).'-'.$request->slug,
                    'vehicle_type_description' => $request->vehicle_type_description,
                ]);
                if(VehiclePrice::where('vehicle_type_id',$id)->first()!=null)
                $vhtp = VehiclePrice::where('vehicle_type_id',$id)->update([
                    'no_of_child' => $request->no_of_child,
                    'no_of_passengers' => $request->no_of_passengers,
                    'no_of_suitcases' => $request->no_of_suitcases,
                    'base_price' => $request->base_price,
                    'price_per_min' => $request->price_per_min,
                    'price_per_hour' => $request->price_per_hour,
                    'price_per_km' => $request->price_per_km,
                    'extra_waiting_time' => $request->extra_waiting_time,
                    'minimum_charge' => $request->minimum_charge,
                    'minimum_hour' => $request->minimum_hour,
                    'international_airport_pickup_charges' => $request->international_airport_pickup_charges,
                    'domestic_airport_pickup_charges' => $request->domestic_airport_pickup_charges,
                    'child_seat_charges' => $request->child_seat_charges,
                    
                ]);
                else
                $vhtp = VehiclePrice::create([
                    'vehicle_type_id' => $id,
                    'status' => $request->status,
                    'no_of_child' => $request->no_of_child,
                    'no_of_passengers' => $request->no_of_passengers,
                    'no_of_suitcases' => $request->no_of_suitcases,
                    'base_price' => $request->base_price,
                    'price_per_min' => $request->price_per_min,
                    'price_per_hour' => $request->price_per_hour,
                    'price_per_km' => $request->price_per_km,
                    'extra_waiting_time' => $request->extra_waiting_time,
                    'minimum_charge' => $request->minimum_charge,
                    'minimum_hour' => $request->minimum_hour,
                    'international_airport_pickup_charges' => $request->international_airport_pickup_charges,
                    'domestic_airport_pickup_charges' => $request->domestic_airport_pickup_charges,
                    'child_seat_charges' => $request->child_seat_charges,
                ]);
                
                if (request()->hasFile('vehicle_type_image')) {
                    $file = request()->file('vehicle_type_image');
                    $fileName =time() . "." . $file->getClientOriginalExtension();
                    $imageurl =url('/uploads/vehicle_type/'.time() . "." . $file->getClientOriginalExtension());
                    $file->move('./uploads/vehicle_type/', $fileName);
                    //$flight->vehicle_type_image = $fileName;
                    $flight = VehicleType::where('id',$id)->update([
                        'vehicle_type_image' => $fileName
                    ]);
                }
    
                return redirect(url('/admin/vehicle-type'))->with('success','Vehicle type updated successfully!');
            } else {
                return redirect(url('/admin/login'));
            }    
        // } catch (\Exception $e) {
          
        //     return $e->getMessage();
        // }
    }
    public function DeleteVehicleType($id)
    {
        try {
            if (Auth::user()) {
                VehicleType::where('id',$id)->delete();
                return back()->with('success','Vehicle type deleted successfully!');
            } else {
                return redirect(url('/admin/login'));
            }  
        } catch (\Exception $e) {
          
            return $e->getMessage();
        }
    }
    //----------------------------------------------------------------
    // Vehicle Attribute Functions starts
    //----------------------------------------------------------------
    public function VehicleAttribute(Request $request)
    {
        try {
            if (Auth::user()) {
                $attributes = VehicleAttribute::orderBy('id','DESC')->paginate(10);
                return view('admin.vehicle.vehicle_attribute',compact('attributes'));
            } else {
                return redirect(url('/admin/login'));
            }
            
        } catch (\Exception $e) {
          
            return $e->getMessage();
        }
    }
    public function AddVehicleAttribute(Request $request)
    {
        if (Auth::user()) {
            $request['vehicle_attribute_slug'] = Str::slug($request->vehicle_attribute).'-'.$request->slug;
            $validatedData = $request->validate([
                'vehicle_attribute' => 'required',
                'slug' => 'required',
                'vehicle_attribute_slug' => 'unique:vehicle_attributes_master,vehicle_attribute_slug',
            ], [
                'vehicle_attribute.required' => 'Vehicle Attribute field is required.',
                'slug.required' => 'Vehicle Slug field is required.',
                'vehicle_attribute_slug.unique' => 'Slug already exists, please add a distinct slug.'
            ]);

            $flight = VehicleAttribute::create([
                'vehicle_attribute' => $request->vehicle_attribute,
                'vehicle_slug' => $request->slug,
                'vehicle_attribute_slug' => Str::slug($request->vehicle_attribute).'-'.$request->slug,
            ]);
            return back()->with('success','Vehicle attribute created successfully!');
        } else {
            return redirect(url('/admin/login'));
        }
    } 
    public function EditVehicleAttribute($id)
    {
        try {
            if (Auth::user()) {
                $attribute = VehicleAttribute::where('id',$id)->first();
                return view('admin.vehicle.edit_vehicle_attribute',compact('attribute'));
            } else {
                return redirect(url('/admin/login'));
            }
        } catch (\Exception $e) {
          
            return $e->getMessage();
        }
    }
    public function UpdateVehicleAttribute(Request $request,$id)
    {
        if (Auth::user()) {
                $slug = VehicleAttribute::where('id',$id)->select('vehicle_attribute_slug')->first();
                $vehicle_attribute_slug = $slug->vehicle_attribute_slug;
                $request_slug = Str::slug($request->vehicle_attribute).'-'.$request->slug;
                $request['vehicle_attribute_slug'] = $request_slug;
                $request_data = [
                    'vehicle_attribute' => 'required',
                    'vehicle_attribute_slug' => 'required',
                    'slug' => 'required'
                ];
                $validate_msg = [
                    'vehicle_attribute.required' => 'Vehicle Attribute field is required.',
                    'slug.required' => 'Vehicle Slug field is required.',
                    'vehicle_attribute_slug.required' => 'Vehicle Attribute field is required.',
                ];
                //dd($request->all());
                if($vehicle_attribute_slug != $request_slug){
                    $request_data['vehicle_attribute_slug'] = "required|unique:vehicle_attributes_master,vehicle_attribute_slug";
                    $validate_msg['vehicle_type_slug.unique'] = "This slug exists. Please add a distinct slug";
                }

                $validatedData = $request->validate($request_data, $validate_msg);

                $flight = VehicleAttribute::where('id',$id)->update([
                    'vehicle_attribute' => $request->vehicle_attribute,
                    'vehicle_slug' => $request->slug,
                    'vehicle_attribute_slug' => Str::slug($request->vehicle_attribute).'-'.$request->slug,
                ]);

            return redirect(url('/admin/vehicle-attribute'))->with('success','Vehicle attribute updated successfully!');
        } else {
            return redirect(url('/admin/login'));
        }    
    }
    public function DeleteVehicleAttribute($id)
    {
        try {
            if (Auth::user()) {
                VehicleAttribute::where('id',$id)->delete();
                return back()->with('success','Vehicle attribute deleted successfully!');
            } else {
                return redirect(url('/admin/login'));
            }  
        } catch (\Exception $e) {
          
            return $e->getMessage();
        }
    }
    //--------------------------------------------------------------
    // Vehicle functions starts
    //--------------------------------------------------------------
    public function Vehicle(Request $request)
    {
        try {
            if (Auth::user()) {
                $vehicles = Vehicle::orderBy('id','DESC')->paginate(100);
                return view('admin.vehicle.vehicle',compact('vehicles'));
            } else {
                return redirect(url('/admin/login'));
            }
            
        } catch (\Exception $e) {
          
            return $e->getMessage();
        }
    }
    public function AddVehicle(Request $request)
    {
        try {
            if (Auth::user()) {
                $attributes = VehicleAttribute::orderBy('id','DESC')->get();
                $types = VehicleType::orderBy('id','DESC')->get();
                return view('admin.vehicle.add_vehicle',compact('attributes','types'));
            } else {
                return redirect(url('/admin/login'));
            }
        } catch (\Exception $e) {
          
            return $e->getMessage();
        }
        
    }
    public function AddVehicleStore(Request $request)
    {
        if (Auth::user()) {
            //dd($request->vehicle_images);
            $request['vehicle_slug'] = Str::slug($request->vehicle_name).'-'.$request->slug;
            $validatedData = $request->validate([
                'title' =>'required',
                'vehicle_type' => 'required',
                'vehicle_name' => 'required',
                'slug' => 'required',
                'status' => 'required',
                'vehicle_slug' => 'unique:vehicles,vehicle_slug',
                'vehicle_base_location' => 'required',
                'vehicle_make' => 'required',
                'vehicle_model' => 'required',
                'vehicle_company' => 'required',
                'vehicle_description' => 'required',
                'vehicle_thumbnail' => 'required',
                'vehicle_images' => 'required',
            ], [
                'title.required' => 'Vehicle title field is required.',
                'vehicle_type.required' => 'Vehicle type field is required.',
                'vehicle_name.required' => 'Vehicle name field is required.',
                'slug.required' => 'Vehicle slug field is required.',
                'status.required' => 'Vehicle status field is required.',
                'vehicle_slug.unique' => 'Vehicle slug must be unique, please a distinct slug.',
                'vehicle_base_location.required' => 'Vehicle base location field is required.',
                'vehicle_make.required' => 'Vehicle make field is required.',
                'vehicle_model.required' => 'Vehicle model field is required.',
                'vehicle_company.required' => 'Vehicle company field is required.',
                'vehicle_description.required' => 'Vehicle description field is required.',
                'vehicle_thumbnail.required' => 'Vehicle thumbnail is required.',
                'vehicle_images.required' => 'Vehicle multiple images field is required.',
            ]);

            $vehicle = Vehicle::create([
                'title' => $request->title,
                'meta_keyword' => $request->meta_keyword,
                'meta_description' => $request->meta_description,
                'vehicle_type_id' => $request->vehicle_type,
                'vehicle_name' => $request->vehicle_name,
                'vehicle_slug' => Str::slug($request->vehicle_name).'-'.$request->slug,
                'status' => $request->status,
                'vehicle_radom_slug' => $request->slug,
                'vehicle_base_location' => $request->vehicle_base_location,
                'vehicle_make' => $request->vehicle_make,
                'vehicle_model' => $request->vehicle_model,
                'vehicle_company' =>$request->vehicle_company,
                'vehicle_description' => $request->vehicle_description,
            ]);
            $fileName = null;
            $imageurl= null;
            if (request()->hasFile('vehicle_thumbnail')) {
                $file = request()->file('vehicle_thumbnail');
                $fileName =time() . "." . $file->getClientOriginalExtension();
                $imageurl =url('/uploads/vehicle/'.time() . "." . $file->getClientOriginalExtension());
                $file->move('./uploads/vehicle/', $fileName);
                $vehicle->vehicle_thumbnail = $fileName;
                $vehicle->save();
            }
            if (request()->hasFile('vehicle_images')) {
                foreach ($request->vehicle_images as $key => $image) {
                    $name = $image->getClientOriginalName();
                    $fileName =rand(1000,9999).'_'.time() . "." . $image->getClientOriginalExtension();
                    $image->move('./uploads/vehicle/', $fileName);
                    VehicleImage::create([
                        'vehicle_id' => $vehicle->id,
                        'image_name' => $name,
                        'image' => $fileName
                    ]);
                }
            }
            //dd($request->all());
            VehicleAttr::where('vehicle_id',$vehicle->id)->delete();

            if($vehicle->save()){
                $attributes = $request->attribute_id;
                $values = $request->vehicle_attr_val;
                if($attributes)
                for ($i=0; $i < count($attributes); $i++) { 
                    if(!empty($values[$i]))
                    VehicleAttr::create([
                        'vehicle_id' => $vehicle->id,
                        'attribute_id' => $attributes[$i],
                        'value' => $values[$i]
                    ]);  
                }
            }
            return redirect(url('/admin/vehicle'))->with('success','Vehicle created successfully!');
        } else {
            return redirect(url('/admin/login'));
        }
    }
    public function EditVehicle(Request $request,$slug)
    {
        try {
            if (Auth::user()) {
                $vehicle = Vehicle::where('vehicle_slug',$slug)->first();
                $vehicle_id = $vehicle->id;
                $vehicle_images = VehicleImage::where('vehicle_id',$vehicle_id)->get();
                $attr_data = VehicleAttribute::leftJoin('vehicle_attributes', function($join)use($vehicle)
                {
                    $join->on('vehicle_attributes_master.id','=','vehicle_attributes.attribute_id');
                    $join->on('vehicle_attributes.vehicle_id','=',DB::raw($vehicle->id));

                })->select('vehicle_attributes_master.id as attribute_id','vehicle_attributes_master.vehicle_attribute','vehicle_attributes.value')->get();

                $attribute_masters = VehicleAttribute::orderBy('id','DESC')->get();
                $types = VehicleType::orderBy('id','DESC')->get();
                return view('admin.vehicle.edit_vehicle',compact('attribute_masters','types','vehicle','vehicle_images','attr_data'));
            } else {
                return redirect(url('/admin/login'));
            }
            
        } catch (\Exception $e) {
          
            return $e->getMessage();
        }
    }
    public function DeleteVehicleImage($id,$vehicle_id)
    {
        try {
            if (Auth::user()) {
                //dd($vehicle_id);
                VehicleImage::where('id',$id)->where('vehicle_id',$vehicle_id)->delete();
                return back();
            } else {
                return redirect(url('/admin/login'));
            }
            
        } catch (\Exception $e) {
          
            return $e->getMessage();
        }
    }
    public function UpdateVehicle(Request $request,$slug)
    {
        if (Auth::user()) {
            $slug_data = Vehicle::where('vehicle_slug',$slug)->select('vehicle_slug','id')->first();
            $vehicle_slug = $slug_data->vehicle_slug;
            $request_slug = Str::slug($request->vehicle_name).'-'.$request->slug;
            $request['vehicle_slug'] = Str::slug($request->vehicle_name).'-'.$request->slug;
            $request_data = [
                'vehicle_name' => 'required',
                'slug' => 'required',
                'status' => 'required',
                'vehicle_slug' => 'required',
                'vehicle_base_location' => 'required',
                'vehicle_make' => 'required',
                'vehicle_model' => 'required',
                'vehicle_company' => 'required',
                'vehicle_description' => 'required',
            ];
            $validate_msg = [
                'vehicle_name.required' => 'Vehicle name field is required.',
                'slug.required' => 'Slug field is required.',
                'status.required' => 'Vehicle status field is required.',
                'vehicle_slug.required' => 'Vehicle slug field is required.',
                'vehicle_base_location.required' => 'Vehicle base location field is required.',
                'vehicle_make.required' => 'Vehicle make field is required.',
                'vehicle_model.required' => 'Vehicle model field is required.',
                'vehicle_company.required' => 'Vehicle company field is required.',
                'vehicle_description.required' => 'Vehicle description field is required.',
            ];
            if($vehicle_slug != $request_slug){
                $request_data['vehicle_slug'] = "required|unique:vehicles,vehicle_slug";
                $validate_msg['vehicle_slug.unique'] = "This slug exists. Please add a distinct slug.";
                
            }

            $validatedData = $request->validate($request_data, $validate_msg);
            //dd($slug);

            $flight = Vehicle::where('vehicle_slug',$slug)->update([
                'vehicle_type_id' => $request->vehicle_type,
                'vehicle_name' => $request->vehicle_name,
                'vehicle_slug' => Str::slug($request->vehicle_name).'-'.$request->slug,
                'vehicle_radom_slug' => $request->slug,
                'status' => $request->status,
                'vehicle_base_location' => $request->vehicle_base_location,
                'vehicle_make' => $request->vehicle_make,
                'vehicle_model' => $request->vehicle_model,
                'vehicle_company' =>$request->vehicle_company,
                'vehicle_description' => $request->vehicle_description,
            ]);
            $flight = Vehicle::where('vehicle_radom_slug',$request->vehicle_slug)->first();
            $fileName = null;
            $imageurl= null;
            if (request()->hasFile('vehicle_thumbnail')) {
                $file = request()->file('vehicle_thumbnail');
                $fileName =time() . "." . $file->getClientOriginalExtension();
                $imageurl =url('/uploads/vehicle/'.time() . "." . $file->getClientOriginalExtension());
                $file->move('./uploads/vehicle/', $fileName);
                // $flight->vehicle_thumbnail = $fileName;
                Vehicle::where('vehicle_slug',$slug)->update([
                    'vehicle_thumbnail' => $fileName,
                ]);
            }
            if (request()->hasFile('vehicle_images')) {
                //dd($request->vehicle_images);
                foreach ($request->vehicle_images as $key => $image) {
                    $name = $image->getClientOriginalName();
                    $fileNameVehicle =rand(1000,9999).'_'.time() . "." . $image->getClientOriginalExtension();
                    $image->move('./uploads/vehicle/', $fileNameVehicle);
                    VehicleImage::create([
                        'vehicle_id' => $slug_data->id,
                        'image_name' => $name,
                        'image' => $fileNameVehicle
                    ]);
                }
            }
            //dd($flight);
            if($request->attribute_id){ 
                VehicleAttr::where('vehicle_id',$slug_data->id)->delete();
                $vehicle = Vehicle::where('vehicle_slug',$slug)->first();
                $vehicle_id = $vehicle->id;
                $attributes = $request->attribute_id;
                $values = $request->vehicle_attr_val;
                if($attributes)
                for ($i=0; $i < count($attributes); $i++) { 
                    if(!empty($values[$i]))
                    VehicleAttr::create([
                        'vehicle_id' => $vehicle_id,
                        'attribute_id' => $attributes[$i],
                        'value' => $values[$i]
                    ]);  
                }
            }
            return redirect(url('/admin/vehicle'))->with('success','Vehicle updated successfully!');
        } else {
            return redirect(url('/admin/login'));
        }
    }
    public function DeleteVehicle(Request $request,$slug)
    {
        try {
            if (Auth::user()) {
                Vehicle::where('vehicle_slug',$slug)->delete();
                return back()->with('success','Vehicle deleted successfully!');
            } else {
                return redirect(url('/admin/login'));
            }
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
