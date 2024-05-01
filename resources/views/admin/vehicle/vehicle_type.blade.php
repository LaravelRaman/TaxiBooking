@extends('admin.layouts.app')

@section('content')
    <div class="page-body">
        <div class="container-fluid">
            <div class="page-header">
                <div class="row">
                    <div class="col-sm-6">
                        <h3>Vehicle</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item">Vehicle</li>
                            <li class="breadcrumb-item"><a href="{{ url('admin/vehicle-type') }}">Vehicle Type</a></li>
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
                            <h5> Add Vehicle Type </h5>
                        </div>
                        @if ($message = Session::get('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong class>{{ $message }}</strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif
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
                            <div class="mb-5">
                                <form class="theme-form" action="{{ url('/admin/add-vehicle-type') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-12 mb-3">
                                            <label class="col-form-label pt-0" for="exampleInputEmail1">Title</label><span style="color: red; margin:4px;">*</span>
                                            <input class="form-control" id="" type="text" name="title" value="{{ old('title') }}" aria-describedby="emailHelp" placeholder="Enter Title">
                                            @error('title')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6 mb-3">
                                            <label class="col-form-label pt-0" for="exampleInputEmail1">Meta Keyword</label><span style="color: black; margin:4px;">(Optional)</span>
                                            <input class="form-control" id="" type="text" name="meta_keyword" value="{{ old('meta_keyword') }}" aria-describedby="emailHelp" placeholder="Enter Meta Keyword">
                                            @error('meta_keyword')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-6 mb-3">
                                            <label class="col-form-label pt-0" for="exampleInputEmail1">Meta Description</label><span style="color: black; margin:4px;">(Optional)</span>
                                            <input class="form-control" id="" type="text" name="meta_description" value="{{ old('meta_description') }}" aria-describedby="emailHelp" placeholder="Enter Service Name">
                                            @error('meta_description')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6 mb-3">
                                            <label class="col-form-label pt-0" for="exampleInputEmail1">Vehicle Type</label>
                                            <span style="color: red; margin:4px;">*</span>
                                            <input class="form-control" id="vehicle_type" type="text" name="vehicle_type"
                                                value="{{ old('vehicle_type') }}" aria-describedby="emailHelp"
                                                placeholder="Enter Vehicle Type">
                                            @error('vehicle_type')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <?php
                                        $random_val = Str::random(8);
                                        ?>
                                        <div class="col-6 mb-3">
                                            <label class="col-form-label pt-0" for="exampleInputEmail1">Vehicle Type
                                                Slug</label><span style="color: red; margin:4px;">*</span>
                                            <input class="form-control" id="vehicle_type_slug" type="text"
                                                name="slug" value="{{ $random_val }}"
                                                aria-describedby="emailHelp" placeholder="Enter Vehicle Type Slug">
                                            @error('vehicle_type_slug')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6 mb-3">
                                            <label class="col-form-label pt-0" for="exampleInputEmail1">Vehicle Type Image</label><span style="color: red; margin:4px;">*</span>
                                            <input class="form-control" id="type_image" type="file" name="vehicle_type_image" value="{{ old('no_of_child') }}" placeholder="Enter Vehicle Company">
                                            @error('vehicle_company')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-6 mb-3">
                                            <label class="col-form-label pt-0" for="exampleInputEmail1">Vehicle Type Status</label><span style="color: red; margin:4px;">*</span>
                                            <select class="form-select digits" id="exampleFormControlSelect9" name="status">
                                                <option value="ACTIVE">ACTIVE</option>
                                                <option value="INACTIVE" selected>INACTIVE</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-4 mb-3">
                                            <label class="col-form-label pt-0" for="exampleInputEmail1">Number of children</label><span style="color: red; margin:4px;">*</span>
                                            <input class="form-control" id="vehicle_company" type="text" name="no_of_child" value="{{ old('no_of_child') }}" aria-describedby="emailHelp" placeholder="Enter Number Of Children">
                                            @error('no_of_child')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-4 mb-3">
                                            <label class="col-form-label pt-0" for="exampleInputEmail1">Number of passengers</label><span style="color: red; margin:4px;">*</span>
                                            <input class="form-control" id="no_of_passenger" type="text" name="no_of_passengers" value="{{ old('no_of_passengers') }}" aria-describedby="emailHelp" placeholder="Enter Vehicle Passenger Capacity">
                                            @error('no_of_passengers')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-4 mb-3">
                                            <label class="col-form-label pt-0" for="exampleInputEmail1">Number of suitcases</label><span style="color: red; margin:4px;">*</span>
                                            <input class="form-control" id="no_of_suitcases" type="text" name="no_of_suitcases" value="{{ old('no_of_suitcases') }}" aria-describedby="emailHelp" placeholder="Enter Vehicle Suitcase Capacity">
                                            @error('no_of_suitcases')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
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
                                                <input class="form-control" type="text" name="base_price" value="{{ old('base_price') }}" placeholder="Enter Base Price">
                                                @error('base_price')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                            </div>
                                        </div>
                                        <div class="col-3 mb-3">
                                            <label class="col-form-label pt-0" for="exampleInputEmail1">Price Per Minute</label><span style="color: red; margin:4px;">*</span>
                                            <div class="input-group"><span class="input-group-text">$</span>
                                                <input class="form-control" type="text" name="price_per_min" value="{{ old('price_per_min') }}" placeholder="Enter Price Per Minute">
                                                @error('price_per_min')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                            </div>
                                        </div>
                                        <div class="col-3 mb-3">
                                            <label class="col-form-label pt-0" for="exampleInputEmail1">Price Per Hour</label><span style="color: red; margin:4px;">*</span>
                                            <div class="input-group"><span class="input-group-text">$</span>
                                                <input class="form-control" type="text" name="price_per_hour" value="{{ old('price_per_hour') }}" placeholder="Enter Price Per Hour">
                                                @error('price_per_hour')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                            </div>
                                        </div>
                                        <div class="col-3 mb-3">
                                            <label class="col-form-label pt-0" for="exampleInputEmail1">Price Per KM</label><span style="color: red; margin:4px;">*</span>
                                            <div class="input-group"><span class="input-group-text">$</span>
                                                <input class="form-control" type="text" name="price_per_km" value="{{ old('price_per_km') }}" placeholder="Enter Price Per Kilometer">
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
                                            <input class="form-control" type="text" name="extra_waiting_time" value="{{ old('extra_waiting_time') }}" placeholder="Enter Extra Waiting Time">
                                            @error('extra_waiting_time')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        </div>
                                        <div class="col-3 mb-3">
                                            <label class="col-form-label pt-0" for="exampleInputEmail1">Minimum Charge</label><span style="color: red; margin:4px;">*</span>
                                            <div class="input-group"><span class="input-group-text">$</span>
                                            <input class="form-control" type="text" name="minimum_charge" value="{{ old('minimum_charge') }}" placeholder="Enter Minimum Vehicle Charge">
                                            @error('minimum_charge')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        </div>
                                        <div class="col-3 mb-3">
                                            <label class="col-form-label pt-0" for="exampleInputEmail1">Minimum Hour</label><span style="color: red; margin:4px;">*</span>
                                            <div class="input-group"><span class="input-group-text">$</span>
                                            <input class="form-control" type="text" name="minimum_hour" value="{{ old('minimum_hour') }}" placeholder="Enter Minimum Vehicle Hour">
                                            @error('minimum_hour')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        </div>
                                        <div class="col-3 mb-3">
                                            <label class="col-form-label pt-0" for="exampleInputEmail1">International Airport Pickup Charge</label><span style="color: red; margin:4px;">*</span>
                                            <div class="input-group"><span class="input-group-text">$</span>
                                            <input class="form-control" type="text" name="international_airport_pickup_charges" value="{{ old('international_airport_pickup_charges') }}" placeholder="Enter Minimum Vehicle Hour">
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
                                            <input class="form-control" type="text" name="domestic_airport_pickup_charges" value="{{ old('domestic_airport_pickup_charges') }}" placeholder="Enter Extra Waiting Time">
                                            @error('domestic_airport_pickup_charges')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        </div>
                                        <div class="col-3 mb-3">
                                            <label class="col-form-label pt-0" for="exampleInputEmail1">Child Seat Charge</label><span style="color: red; margin:4px;">*</span>
                                            <div class="input-group"><span class="input-group-text">$</span>
                                            <input class="form-control" type="text" name="child_seat_charges" value="{{ old('child_seat_charges') }}" placeholder="Enter Minimum Vehicle Charge">
                                            @error('child_seat_charges')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="col-form-label pt-0" for="exampleInputEmail1">Description</label><span style="color: red; margin:4px;">*</span>
                                        <textarea class="form-control" id="vehicle_type_description" type="text" name="vehicle_type_description"
                                            value="{{ old('vehicle_type_description') }}" aria-describedby="emailHelp"></textarea>
                                        @error('vehicle_type_description')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <button class="btn btn-primary" type="submit">Submit</button>
                                    <button class="btn btn-secondary" type="reset">Cancel</button>
                                </form>
                            </div>
                            <div class="table-responsive">
                                <table class="stripe" id="example-style-8">
                                    <thead>
                                        <tr>
                                            <th>Thumbnail</th>
                                            <th>Vehicle Type</th>
                                            <th>Slug</th>
                                            <th>Description</th>
                                            <th>Number of passengers and suitcases</th>
                                            <th>Net Prices</th>
                            
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($types as $type)
                                            <tr>
                                                <td><img src="{{asset('uploads/vehicle_type/'.$type->vehicle_type_image) }}" alt="" srcset="" style="height: 188px; 270px;"></td>
                                                <td>{{ !empty($type->vehicle_type)?$type->vehicle_type:'NA' }}</td>
                                                <td>{{ !empty($type->vehicle_type_slug)?$type->vehicle_type_slug:'NA' }}</td>
                                                <td>{{ !empty($type->vehicle_type_description)?$type->vehicle_type_description:'NA' }}</td>
                                                <td>
                                                    No. of Passengers: {{ !empty($type->price->no_of_child)?$type->price->no_of_child:'NA' }}<br/>
                                                    No. of Children: {{ !empty($type->price->no_of_passengers)?$type->price->no_of_passengers:'NA' }}<br/>
                                                    No. of Suitcases: {{ !empty($type->price->no_of_suitcases)?$type->price->no_of_suitcases:'NA' }}
                                                </td>
                                                <td>
                                                    Base Price: ${{ !empty($type->price->base_price)?$type->price->base_price:'NA' }}<br/>
                                                    Price Per Minute: ${{ !empty($type->price->price_per_min)?$type->price->price_per_min:'NA' }}<br/>
                                                    Price Per Hour: ${{ !empty($type->price->price_per_hour)?$type->price->price_per_hour:'NA' }}<br/>
                                                    Price Per KM: ${{ !empty($type->price->price_per_km)?$type->price->price_per_km:'NA' }}<br/>
                                                    Extra Waiting Time(Price Per min): ${{ !empty($type->price->extra_waiting_time)?$type->price->extra_waiting_time:'NA' }}<br/>
                                                    Minimum Vehicle Charge: ${{ !empty($type->price->minimum_charge)?$type->price->minimum_charge:'NA' }}<br/>
                                                    Minimum Vehicle Hour Booking: ${{ !empty($type->price->minimum_hour)?$type->price->minimum_hour:'NA' }}<br/>
                                                </td>
                                                
                                                <td>
                                                    <a href="{{ url('admin/edit-vehicle-type', $type->id) }}"><button
                                                            class="btn btn-warning"><i class="fa fa-pencil"></i></button>
                                                    </a>
                                                    <a href="{{ url('admin/delete-vehicle-type', $type->id) }}"><button
                                                            class="btn btn-danger"><i class="fa fa-trash"></i></button></a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Thumbnail</th>
                                            <th>Vehicle Type</th>
                                            <th>Slug</th>
                                            <th>Description</th>
                                            <th>Number of passengers and suitcases</th>
                                            <th>Net Prices</th>
                                            <th>Action</th>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
