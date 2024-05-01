<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Slider;
use Illuminate\Support\Facades\Auth;

class SettingController extends Controller
{
    public function SliderMaster()
    {
        try {
            if (Auth::user()) {
                $sliders = Slider::orderBy('id','DESC')->paginate(10);
                return view('admin.settings.slider',compact('sliders'));
            } else {
                return redirect(url('/admin/login'));
            }
        } catch (\Exception $e) {
          
            return $e->getMessage();
        }
    }
    public function AddSliderMaster(Request $request)
    {
        if (Auth::user()) {
            $validatedData = $request->validate([
                'slider_tag' => 'required',
                'slider_title' => 'required',
                'slider_description' => 'required',
                'slider_btn_link' => 'required',
                'slider_image' => 'required',
            ], [
                'slider_tag.required' => 'Slider tag field is required.',
                'slider_title.required' => 'Slider title field is required.',
                'slider_description.required' => 'Slider description field is required.',
                'slider_btn_link.required' => 'Slider button link field is required.',
                'slider_image.required' => 'Slider image field is required.'
            ]);

            $slider = Slider::create([
                'slider_tag' => $request->slider_tag,
                'slider_title' => $request->slider_title,
                'slider_description' => $request->slider_description,
                'slider_btn_link' => $request->slider_btn_link,
            ]);
            $fileName = null;
            $imageurl= null;
            if (request()->hasFile('slider_image')) {
                $file = request()->file('slider_image');
                $fileName =time() . "." . $file->getClientOriginalExtension();
                $imageurl =url('/uploads/sliders/'.time() . "." . $file->getClientOriginalExtension());
                $file->move('./uploads/sliders/', $fileName);
                $slider->slider_image = $fileName;
                $slider->save();
            }
            return back()->with('success','Slider created successfully!');
        } else {
            return redirect(url('/admin/login'));
        }
    }
    public function EditSliderMaster($id)
    {
        try {
            if (Auth::user()) {
                $slider = Slider::where('id',$id)->first();
                return view('admin.settings.edit_slider',compact('slider'));
            } else {
                return redirect(url('/admin/login'));
            }
            
        } catch (\Exception $e) {
          
            return $e->getMessage();
        }
    }
    public function UpdateSliderMaster(Request $request,$id)
    {
        if (Auth::user()) {
            $validatedData = $request->validate([
                'slider_tag' => 'required',
                'slider_title' => 'required',
                'slider_description' => 'required',
                'slider_btn_link' => 'required',
            ], [
                'slider_tag.required' => 'Slider tag field is required.',
                'slider_title.required' => 'Slider title field is required.',
                'slider_description.required' => 'Slider description field is required.',
                'slider_btn_link.required' => 'Slider button link field is required.',
            ]);

            $slider = Slider::where('id',$id)->update([
                'slider_tag' => $request->slider_tag,
                'slider_title' => $request->slider_title,
                'slider_description' => $request->slider_description,
                'slider_btn_link' => $request->slider_btn_link,
            ]);
            $slider = Slider::where('id',$id)->first();
            $fileName = null;
            $imageurl= null;
            if (request()->hasFile('slider_image')) {
                $file = request()->file('slider_image');
                $fileName =time() . "." . $file->getClientOriginalExtension();
                $imageurl =url('/uploads/sliders/'.time() . "." . $file->getClientOriginalExtension());
                $file->move('./uploads/sliders/', $fileName);
                $slider->slider_image = $fileName;
                $slider->save();
            }
            return redirect(url('/admin/slider-master'))->with('success','Slider updated successfully!');
        } else {
            return redirect(url('/admin/login'));
        }
    }
    public function DeleteSliderMaster($id)
    {
        try {
            if (Auth::user()) {
                Slider::where('id',$id)->delete();
                return back()->with('success','Slider deleted successfully!');
            } else {
                return redirect(url('/admin/login'));
            }
            
        } catch (\Exception $e) {
          
            return $e->getMessage();
        }
    }
}
