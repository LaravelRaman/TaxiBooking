<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\FAQ;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class FAQController extends Controller
{
    public function Faqs()
    {
        $this->fixFaqSNo();
        $faqs = FAQ::orderBy('sno','ASC')->paginate(100);
        return view('admin.faq.home',compact('faqs'));
    }
    public function Faq()
    {
        try {
            if (Auth::user()) {
                $faqs = FAQ::orderBy('id','ASC')->get();
                return view('admin.faq.home',compact('faqs'));
            } else {
                return redirect(url('/admin/login'));
            }
        } catch (\Exception $e) {
          
            return $e->getMessage();
        }
    }
    public function AddFaq()
    {
        try {
            if (Auth::user()) {
                return view('admin.faq.add');
            } else {
                return redirect(url('/admin/login'));
            }
        } catch (\Exception $e) {
          
            return $e->getMessage();
        }
    }
    public function AddFaqSave(Request $request)
    {
        if (Auth::user()) {
            $validatedData = $request->validate([
                'question' => 'required',
                'answer' => 'required',
                'slug' => 'unique:f_a_q_s,slug'
            ], [
                'question.required' => 'Question field is required.',
                'answer.required' => 'Answer field is required.',
                'slug.unique' => 'Slug already exists, please add distinct slug.'
            ]);

            $flight = FAQ::create([
                'question' => $request->question,
                'answer' => $request->answer,
                'slug' => $request->slug,
                'sno' => FAQ::count()+1
            ]);
            return redirect(route('admin.faq'))->with('success','FAQ created successfully!');
        } else {
            return redirect(url('/admin/login'));
        }
    }
    public function EditFaq($slug)
    {
        try {
            if (Auth::user()) {
                $faq = FAQ::where('slug',$slug)->first();
                return view('admin.faq.edit',compact('faq'));
            } else {
                return redirect(url('/admin/login'));
            }
        } catch (\Exception $e) {
          
            return $e->getMessage();
        }
    }
    public function UpdateFaq($slug,Request $request)
    {
        if (Auth::user()) {
                $slug = Faq::where('slug',$slug)->select('slug')->first();
                $faq_slug = $slug->slug;
                $request_data = [
                    'question' => 'required',
                    'answer' => 'required',
                    'slug' => 'unique:f_a_q_s,slug'
                ];
                $validate_msg = [
                    'question.required' => 'Question field is required.',
                    'answer.required' => 'Answer field is required.',
                    'slug.unique' => 'Slug already exists, please add distinct slug.'
                ];
                //dd($request->all());
                if($faq_slug != $request->slug){
                    $request_data['slug'] = "required|unique:f_a_q_s,slug";
                    $validate_msg['slug.unique'] = "Slug already exists, please add distinct slug.";
                }

                $validatedData = $request->validate($request_data, $validate_msg);

                $flight = FAQ::where('slug',$slug)->update([
                    'question' => $request->question,
                    'answer' => $request->answer,
                    'slug' => $request->slug
                ]);
                
                return redirect(route('admin.faq'))->with('success','FAQ updated successfully!');
        } else {
            return redirect(url('/admin/login'));
        }
    }
    public function DeleteFaq($slug)
    {
        try {
            if (Auth::user()) {
                FAQ::where('slug',$slug)->delete();
                return back()->with('success','FAQ deleted successfully!');
            } else {
                return redirect(url('/admin/login'));
            }
        } catch (\Exception $e) {
          
            return $e->getMessage();
        }
    }
    public function ChangefaqSNo($slug,$sno)
    {
        $this->fixFaqSNo();
        $faq=FAQ::where('slug',$slug)->first();
        if($faq!=null && $sno>0)        
        {
            if($sno>FAQ::count())
            $sno=FAQ::count();
            
            $oldsno=$faq->sno;

            DB::table('f_a_q_s')->where('sno','>', $oldsno)
            ->lazyById()->each(function ($faq) {
                DB::table('f_a_q_s')
                    ->where('id', $faq->id)
                    ->update(['sno' => $faq->sno-1]);
            });

            DB::table('f_a_q_s')->where('sno','>=', $sno)
            ->lazyById()->each(function ($faq) {
                DB::table('f_a_q_s')
                    ->where('id', $faq->id)
                    ->update(['sno' => $faq->sno+1]);
            });
           
           $faq->sno=$sno;
           $faq->save();
        }
        return redirect(route('admin.faq'));
    }
    public function fixFaqSNo()
    {
        foreach(FAQ::where('sno',0)->orderBy('id','ASC')->get() as $faq)
        {
            $max=FAQ::max('sno')+1;
            $faq->sno=$max;
            $faq->save();
        }
    }
}
