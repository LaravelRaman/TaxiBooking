@extends('admin.layouts.app')

@section('content')
    <div class="page-body">
        <div class="container-fluid">
            <div class="page-header">
                <div class="row">
                    <div class="col-sm-6">
                        <h3>Vehicle Type</h3>
                        <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item">Vehicle</li>
                        <li class="breadcrumb-item"><a href="{{ url('admin/vehicle-type') }}">Vehicle Type</a></li>
                        <li class="breadcrumb-item"><a href="{{ url('admin/edit-vehicle-type') }}">Edit Vehicle Type</a></li>
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
                    <h5> Edit Vehicle Type </h5>
                    </div>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="card-body">
                        <form class="theme-form" action="{{ url('/admin/update-vehicle-type',$type->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-12 mb-3">
                                    <label class="col-form-label pt-0" for="exampleInputEmail1">Title</label><span style="color: red; margin:4px;">*</span>
                                    <input class="form-control" id="" type="text" name="title" value="{{ $type->title }}" aria-describedby="emailHelp" placeholder="Enter Title">
                                    @error('title')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6 mb-3">
                                    <label class="col-form-label pt-0" for="exampleInputEmail1">Meta Keyword</label><span style="color: black; margin:4px;">(Optional)</span>
                                    <input class="form-control" id="" type="text" name="meta_keyword" value="{{ $type->meta_keyword }}" aria-describedby="emailHelp" placeholder="Enter Meta Keyword">
                                    @error('meta_keyword')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-6 mb-3">
                                    <label class="col-form-label pt-0" for="exampleInputEmail1">Meta Description</label><span style="color: black; margin:4px;">(Optional)</span>
                                    <input class="form-control" id="" type="text" name="meta_description" value="{{ $type->meta_description }}" aria-describedby="emailHelp" placeholder="Enter Service Name">
                                    @error('meta_description')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6 mb-3">
                                    <label class="col-form-label pt-0" for="exampleInputEmail1">Vehicle Type</label><span style="color: red; margin:4px;">*</span>
                                    <input class="form-control" id="vehicle_type" type="text" name="vehicle_type" value="{{ !empty($type->vehicle_type)?$type->vehicle_type:'' }}" aria-describedby="emailHelp" placeholder="Enter Vehicle Type">
                                    @error('vehicle_type')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-6 mb-3">
                                    <label class="col-form-label pt-0" for="exampleInputEmail1">Vehicle Type Slug</label><span style="color: red; margin:4px;">*</span>
                                    <input class="form-control" id="vehicle_type_slug" type="text" name="slug" value="{{ !empty($type->vehicle_slug)?$type->vehicle_slug:'' }}" aria-describedby="emailHelp" placeholder="Enter Vehicle Type Slug">
                                    <input type="hidden" name="vehicle_type_slug" value="{{ $type->vehicle_type_slug }}">
                                    @error('vehicle_type_slug')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-4 mb-3">
                                    <label class="col-form-label pt-0" for="exampleInputEmail1">Number of children</label><span style="color: red; margin:4px;">*</span>
                                    <input class="form-control" id="no_of_child" type="text" name="no_of_child" value="{{ !empty($type->price->no_of_child)?$type->price->no_of_child:'' }}" aria-describedby="emailHelp" placeholder="Enter Number Of Children">
                                    @error('no_of_child')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-4 mb-3">
                                    <label class="col-form-label pt-0" for="exampleInputEmail1">Number of passengers</label><span style="color: red; margin:4px;">*</span>
                                    <input class="form-control" id="no_of_passenger" type="text" name="no_of_passengers" value="{{ !empty($type->price->no_of_passengers)?$type->price->no_of_passengers:'' }}" aria-describedby="emailHelp" placeholder="Enter Vehicle Passenger Capacity">
                                    @error('no_of_passengers')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-4 mb-3">
                                    <label class="col-form-label pt-0" for="exampleInputEmail1">Number of suitcases</label><span style="color: red; margin:4px;">*</span>
                                    <input class="form-control" id="no_of_suitcases" type="text" name="no_of_suitcases" value="{{ !empty($type->price->no_of_suitcases)?$type->price->no_of_suitcases:'' }}" aria-describedby="emailHelp" placeholder="Enter Vehicle Suitcase Capacity">
                                    @error('no_of_suitcases')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6 mb-3">
                                    <label class="col-form-label pt-0" for="exampleInputEmail1">Vehicle Type Image</label><span style="color: red; margin:4px;">*</span>
                                    <input class="form-control" id="type_image" type="file" name="vehicle_type_image" value="" aria-describedby="emailHelp" placeholder="Enter Vehicle Company">
                                    @error('vehicle_type_image')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-6 mb-3">
                                    <label class="col-form-label pt-0" for="exampleInputEmail1">Vehicle Type Status</label><span style="color: red; margin:4px;">*</span>
                                    <select class="form-select digits" id="exampleFormControlSelect9" name="status">
                                        <option value="ACTIVE" {{ $type->status == "ACTIVE"?'selected':'' }}>ACTIVE</option>
                                        <option value="INACTIVE" {{ $type->status == "INACTIVE"?'selected':'' }}>INACTIVE</option>
                                    </select>
                                </div>
                            </div>
                            
                            <hr>
                                    <div class="mb-3">
                                        <span style="font-size: 138%;font-weight: 600;">Add Vehicle Price</span>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-3 mb-3">
                                            <label class="col-form-label pt-0" for="exampleInputEmail1">Base Price</label><span style="color: red; margin:4px;">*</span>
                                            <div class="input-group"><span class="input-group-text">$</span>
                                                <input class="form-control" type="text" name="base_price" value="{{ !empty($type->price->base_price)?$type->price->base_price:'' }}" placeholder="Enter Base Price">
                                                @error('base_price')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                            </div>
                                        </div>
                                        <div class="col-3 mb-3">
                                            <label class="col-form-label pt-0" for="exampleInputEmail1">Price Per Minute</label><span style="color: red; margin:4px;">*</span>
                                            <div class="input-group"><span class="input-group-text">$</span>
                                                <input class="form-control" type="text" name="price_per_min" value="{{ !empty($type->price->price_per_min)?$type->price->price_per_min:'' }}" placeholder="Enter Price Per Minute">
                                                @error('price_per_min')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                            </div>
                                        </div>
                                        <div class="col-3 mb-3">
                                            <label class="col-form-label pt-0" for="exampleInputEmail1">Price Per Hour</label><span style="color: red; margin:4px;">*</span>
                                            <div class="input-group"><span class="input-group-text">$</span>
                                                <input class="form-control" type="text" name="price_per_hour" value="{{ !empty($type->price->price_per_hour)?$type->price->price_per_hour:'' }}" placeholder="Enter Price Per Hour">
                                                @error('price_per_hour')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                            </div>
                                        </div>
                                        <div class="col-3 mb-3">
                                            <label class="col-form-label pt-0" for="exampleInputEmail1">Price Per KM</label><span style="color: red; margin:4px;">*</span>
                                            <div class="input-group"><span class="input-group-text">$</span>
                                                <input class="form-control" type="text" name="price_per_km" value="{{ !empty($type->price->price_per_km)?$type->price->price_per_km:'' }}" placeholder="Enter Price Per Kilometer">
                                                @error('price_per_km')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-3 mb-3">
                                            <label class="col-form-label pt-0" for="exampleInputEmail1">Extra Waiting Time(Per min)</label><span style="color: red; margin:4px;">*</span>
                                            <div class="input-group"><span class="input-group-text">$</span>
                                            <input class="form-control" type="text" name="extra_waiting_time" value="{{ !empty($type->price->extra_waiting_time)?$type->price->extra_waiting_time:'' }}" placeholder="Enter Extra Waiting Time">
                                            @error('extra_waiting_time')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        </div>
                                        <div class="col-3 mb-3">
                                            <label class="col-form-label pt-0" for="exampleInputEmail1">Minimum Charge</label><span style="color: red; margin:4px;">*</span>
                                            <div class="input-group"><span class="input-group-text">$</span>
                                            <input class="form-control" type="text" name="minimum_charge" value="{{ !empty($type->price->minimum_charge)?$type->price->minimum_charge:'' }}" placeholder="Enter Minimum Vehicle Charge">
                                            @error('minimum_charge')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        </div>
                                        <div class="col-3 mb-3">
                                            <label class="col-form-label pt-0" for="exampleInputEmail1">Minimum Hour</label><span style="color: red; margin:4px;">*</span>
                                            <div class="input-group"><span class="input-group-text">$</span>
                                            <input class="form-control" type="text" name="minimum_hour" value="{{ !empty($type->price->minimum_hour)?$type->price->minimum_hour:'' }}" placeholder="Enter Minimum Vehicle Hour">
                                            @error('minimum_hour')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        </div>
                                        <div class="col-3 mb-3">
                                            <label class="col-form-label pt-0" for="exampleInputEmail1">International Airport Pickup Charge</label><span style="color: red; margin:4px;">*</span>
                                            <div class="input-group"><span class="input-group-text">$</span>
                                            <input class="form-control" type="text" name="international_airport_pickup_charges" value="{{ !empty($type->price->international_airport_pickup_charges)?$type->price->international_airport_pickup_charges:'' }}" placeholder="Enter Minimum Vehicle Hour">
                                            @error('international_airport_pickup_charges')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-3 mb-3">
                                            <label class="col-form-label pt-0" for="exampleInputEmail1">Domestic Airport Pickup Charge</label><span style="color: red; margin:4px;">*</span>
                                            <div class="input-group"><span class="input-group-text">$</span>
                                            <input class="form-control" type="text" name="domestic_airport_pickup_charges" value="{{ !empty($type->price->domestic_airport_pickup_charges)?$type->price->domestic_airport_pickup_charges:'' }}" placeholder="Enter Extra Waiting Time">
                                            @error('domestic_airport_pickup_charges')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        </div>
                                        <div class="col-3 mb-3">
                                            <label class="col-form-label pt-0" for="exampleInputEmail1">Child Seat Charge</label><span style="color: red; margin:4px;">*</span>
                                            <div class="input-group"><span class="input-group-text">$</span>
                                            <input class="form-control" type="text" name="child_seat_charges" value="{{ !empty($type->price->child_seat_charges)?$type->price->child_seat_charges:'' }}" placeholder="Enter Minimum Vehicle Charge">
                                            @error('child_seat_charges')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        </div>
                                    </div>
                            <div class="mb-3">
                                <label class="col-form-label pt-0" for="exampleInputEmail1">Description</label><span style="color: red; margin:4px;">*</span>
                                <textarea class="form-control" id="vehicle_type_description" type="text" name="vehicle_type_description" aria-describedby="emailHelp">{{ !empty($type->vehicle_type_description)?$type->vehicle_type_description:'' }}</textarea>
                                    @error('vehicle_type_description')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                            </div>
                            <button class="btn btn-primary" type="submit">Update</button>
                            <a href="{{ route('admin.vehicle_type') }}"><button class="btn btn-secondary" type="button">Back</button></a>
                        </form>
                    </div>
                </div>
                </div>
            </div>
        </div> 
    </div> 
@endsection