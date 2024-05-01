<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function Index(Request $request)
    {
        if (Auth::user()) {
            $users = User::orderBy('id','DESC')->paginate(10);
            return view('admin.user.index',compact('users'));
        } else {
            return redirect(url('admin/login'));
        }
    }
    public function Edit($slug)
    {
        try {
            if (Auth::user()){
                $user = User::where('id',$slug)->first();
                return view('admin.user.edit',compact('user'));
            }
            else {
                return redirect(url('admin/login'));
            }
          } catch (\Exception $e) {
          
              return $e->getMessage();
          }
    }
    public function Update(Request $request,$slug)
    {
        if (Auth::user()){
            $request->validate([
                'name' => 'required',
                'email' => 'required',
                'phone' => 'required',
                'discount' => 'required',
            ],
            [
                'name.required' => 'Name field is required.',
                'email.required' => 'Email field is required.',
                'phone.required' => 'Phone field is required.',
                'discount.required' => 'Discount field is required.',
            ]);
            if($request->password){
                $user = User::where('id',$slug)->update([
                    'name' => $request->name,
                    'email' => $request->email,
                    'phone' => $request->phone,
                    'discount' => $request->discount,
                    'bill_to_name' => empty($request->bill_to_name)?'':$request->bill_to_name,
                    'billing_addr' => empty($request->billing_addr)?'':$request->billing_addr,
                    'abn_number' => empty($request->abn_number)?'':$request->abn_number,
                    'is_admin' => 1,
                    'password' => Hash::make($request->password),
                ]);
            }else{
                $user = User::where('id',$slug)->update([
                    'name' => $request->name,
                    'email' => $request->email,
                    'phone' => $request->phone,
                    'discount' => $request->discount,
                    'bill_to_name' => empty($request->bill_to_name)?'':$request->bill_to_name,
                    'billing_addr' => empty($request->billing_addr)?'':$request->billing_addr,
                    'abn_number' => empty($request->abn_number)?'':$request->abn_number,
                    'is_admin' => 1,
                ]);
            }
            return redirect()->route('admin.user')->with('success','User updated successfully!');
        }
        else {
            return redirect(url('admin/login'));
        }
    }
    public function Delete($slug)
    {
        try {
            if (Auth::user()){
                User::where('id',$slug)->delete();
                return back()->with('success','User deleted successfully!');
            }
            else {
                return redirect(url('admin/login'));
            }
          
          } catch (\Exception $e) {
          
              return $e->getMessage();
          } 
    }
    public function AdminIndex()
    {
        try {
            if (Auth::user()){
                $admins = User::where('is_admin',1)->orderby('id','ASC')->paginate(100);
                return view('admin.user.admin_index',compact('admins'));
            }
            else {
                return redirect(url('admin/login'));
            }
          
          } catch (\Exception $e) {
          
              return $e->getMessage();
          } 
    }
    public function AddAdminUser(Request $request)
    {
        if (Auth::user()){
            $request->validate([
                'name' => 'required',
                'email' => 'required',
                'phone' => 'required',
                'role' => 'required',
                'password' => 'required',
            ],
            [
                'name.required' => 'Name field is required.',
                'email.required' => 'Email field is required.',
                'phone.required' => 'Phone field is required.',
                'role.required' => 'Role field is required.',
                'password.required' => 'Password field is required.',
            ]);
            $user = user::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'is_admin' => $request->role,
                'password' => Hash::make($request->password),
            ]);
            return back()->with('success','Admin user created successfully!');
        }
        else {
            return redirect(url('admin/login'));
        }
    }
    public function EditAdminUser($slug)
    {
        try {
            if (Auth::user()){
                $admin = User::where('id',$slug)->first();
                return view('admin.user.admin-edit',compact('admin'));
            }
            else {
                return redirect(url('admin/login'));
            }
          
          } catch (\Exception $e) {
          
              return $e->getMessage();
          } 
    }
    public function UpdateAdminUser(Request $request,$slug)
    {
        if (Auth::user()){
            $request->validate([
                'name' => 'required',
                'email' => 'required',
                'phone' => 'required',
                'role' => 'required'
            ],
            [
                'name.required' => 'Name field is required.',
                'email.required' => 'Email field is required.',
                'phone.required' => 'Phone field is required.',
                'role.required' => 'Role field is required.',
            ]);
            if($request->password){
                $user = User::where('id',$slug)->update([
                    'name' => $request->name,
                    'email' => $request->email,
                    'phone' => $request->phone,
                    'is_admin' => $request->role,
                    'password' => Hash::make($request->password),
                ]);
            }else{
                $user = User::where('id',$slug)->update([
                    'name' => $request->name,
                    'email' => $request->email,
                    'phone' => $request->phone,
                    'is_admin' => $request->role,
                ]);
            }
            return redirect()->route('admin.admin-user')->with('success','Admin user updated successfully!');
        }
        else {
            return redirect(url('admin/login'));
        }
    }
    public function DeleteAdminUser($slug)
    {
        try {
            if (Auth::user()){
                User::where('id',$slug)->delete();
                return back()->with('success','Admin user deleted successfully!');
            }
            else {
                return redirect(url('admin/login'));
            }
          
          } catch (\Exception $e) {
          
              return $e->getMessage();
          } 
    }
}
