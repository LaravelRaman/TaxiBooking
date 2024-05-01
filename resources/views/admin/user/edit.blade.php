@extends('admin.layouts.app')

@section('content')
    <div class="page-body">
        <div class="container-fluid">
            <div class="page-header">
                <div class="row">
                    <div class="col-sm-6">
                        <h3>Customer Edit</h3>
                        <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                        <li class="breadcrumb-item">Customer Edit</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                    <h5> Customer Edit </h5>
                    </div>
                    @if ($message = Session::get('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong class>{{ $message }}</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif 
                    <div class="card-body">
                       <form action="{{ route('admin.update-user',['slug' => $user->id]) }}" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-6 mb-3">
                                    <label class="col-form-label pt-0" for="exampleInputEmail1">Email</label><span style="color: red; margin:4px;">*</span>
                                    <input class="form-control" id="" type="text" name="email" value="{{ $user->email }}" aria-describedby="emailHelp" placeholder="Enter Email">
                                    @error('email')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-6 mb-3">
                                    <label class="col-form-label pt-0" for="exampleInputEmail1">Password</label>
                                    <input class="form-control" id="" type="text" value="" name="password" aria-describedby="emailHelp" placeholder="********">
                                    @error('password')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6 mb-3">
                                    <label class="col-form-label pt-0" for="exampleInputEmail1">Name</label><span style="color: red; margin:4px;">*</span>
                                    <input class="form-control" id="" type="text" name="name" value="{{ $user->name }}" aria-describedby="emailHelp" placeholder="Enter Name">
                                    @error('name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-6 mb-3">
                                    <label class="col-form-label pt-0" for="exampleInputEmail1">Phone</label><span style="color: red; margin:4px;">*</span>
                                    <input class="form-control" id="" type="text" value="{{ !empty($user->phone)?$user->phone:'' }}" name="phone" aria-describedby="emailHelp" placeholder="Enter Phone Number">
                                    @error('phone')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6 mb-3">
                                    <label class="col-form-label pt-0" for="exampleInputEmail1">Discount</label><span style="color: red; margin:4px;">*</span>
                                    <input class="form-control" id="" type="text" value="{{ !empty($user->discount)?$user->discount:'' }}" name="discount" aria-describedby="emailHelp" placeholder="Please enter user discount">
                                    @error('discount')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-6 mb-3">
                                    <label class="col-form-label pt-0" for="exampleInputEmail1">ABN Number</label>
                                    <input class="form-control" id="" type="text" value="{{ !empty($user->abn_number)?$user->abn_number:'' }}" name="abn_number" aria-describedby="emailHelp" placeholder="Please enter ABN number">
                                    @error('abn_number')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6 mb-3">
                                    <label class="col-form-label pt-0" for="exampleInputEmail1">Bill To Name</label><span style="color: red; margin:4px;">*</span>
                                    <input class="form-control" id="" type="text" value="{{ !empty($user->bill_to_name)?$user->bill_to_name:'' }}" name="bill_to_name" aria-describedby="emailHelp" placeholder="Please enter user bill to name">
                                    @error('bill_to_name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-6 mb-3">
                                    <label class="col-form-label pt-0" for="exampleInputEmail1">Billing Address</label><span style="color: red; margin:4px;">*</span>
                                    <input class="form-control" id="" type="text" value="{{ !empty($user->billing_addr)?$user->billing_addr:'' }}" name="billing_addr" aria-describedby="emailHelp" placeholder="Please enter user billing address">
                                    @error('billing_addr')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <button class="btn btn-primary" type="submit">Update</button>
                            <a href="{{ route('admin.user') }}"><button class="btn btn-secondary" type="button">Cancel</button></a>
                       </form>
                    </div>
                </div>
                </div>
            </div>
        </div> 
    </div> 
@endsection
