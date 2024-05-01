@extends('admin.layouts.app')

@section('content')
    <div class="page-body">
        <div class="container-fluid">
            <div class="page-header">
                <div class="row">
                    <div class="col-sm-6">
                        <h3>Add Vehicle</h3>
                        <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item">Vehicle</li>
                        <li class="breadcrumb-item"><a href="{{ url('admin/vehicle') }}">Vehicles</a></li>
                        <li class="breadcrumb-item"><a href="{{ url('admin/vehicle-type') }}">Add Vehicle</a></li>
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
                            <div class="row">
                                <div class="col-6">
                                    <h5> Add Vehicle </h5>
                                </div>
                                <div class="col-6">
                                    <a href="{{ url('admin/vehicle') }}"><button class="btn btn-danger" style="float:right;">Back</button></a>
                                </div>
                            </div>
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
                            <form class="theme-form" action="{{ url('/admin/add-vehicle') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-6 mb-3">
                                        <label class="col-form-label pt-0" for="exampleInputEmail1">Vehicle Type</label><span style="color: red; margin:4px;">*</span>
                                        <select class="form-control" id="vehicle_type" type="text" name="vehicle_type" aria-describedby="emailHelp" placeholder="Enter Vehicle Name">
                                            <option value="">-- no type selected --</option>
                                            @foreach($types as $type)
                                                <option value="{{ $type->id }}">{{ $type->vehicle_type }}</option>
                                            @endforeach
                                        </select>
                                        @error('vehicle_type')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-6 mb-3">
                                        <label class="col-form-label pt-0" for="exampleInputEmail1">Vehicle Name</label><span style="color: red; margin:4px;">*</span>
                                        <input class="form-control" id="vehicle_name" type="text" name="vehicle_name" value="{{ old('vehicle_name') }}" aria-describedby="emailHelp" placeholder="Enter Vehicle Name">
                                        @error('vehicle_name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <?php 
                                        $random_val = Str::random(8);
                                    ?>
                                <div class="row">
                                    <div class="col-6 mb-3">
                                        <label class="col-form-label pt-0" for="exampleInputEmail1">Vehicle Slug</label><span style="color: red; margin:4px;">*</span>
                                        <input class="form-control" id="vehicle_slug" type="text" name="slug" Value="{{ $random_val }}" aria-describedby="emailHelp" placeholder="Enter Vehicle Slug">
                                        @error('slug')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-6 mb-3">
                                        <label class="col-form-label pt-0" for="exampleInputEmail1">Base Location</label><span style="color: red; margin:4px;">*</span>
                                        <input class="form-control" id="vehicle_company" type="text" name="vehicle_base_location" value="{{ old('vehicle_base_location') }}" aria-describedby="emailHelp" placeholder="Enter Vehicle Base Location">

                                        
                                        @error('vehicle_base_location')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6 mb-3">
                                        <label class="col-form-label pt-0" for="exampleInputEmail1">Vehicle Make</label><span style="color: red; margin:4px;">*</span>
                                        <input class="form-control" id="vehicle_make" type="text" name="vehicle_make" value="{{ old('vehicle_make') }}" aria-describedby="emailHelp" placeholder="Enter Vehicle Make">
                                        @error('vehicle_make')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-6 mb-3">
                                        <label class="col-form-label pt-0" for="exampleInputEmail1">Vehicle Model</label><span style="color: red; margin:4px;">*</span>
                                        <input class="form-control" id="vehicle_model" type="text" name="vehicle_model" value="{{ old('vehicle_model') }}" aria-describedby="emailHelp" placeholder="Enter Vehicle Model">
                                        
                                        @error('vehicle_model')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6 mb-3">
                                        <label class="col-form-label pt-0" for="exampleInputEmail1">Vehicle Company</label><span style="color: red; margin:4px;">*</span>
                                        <input class="form-control" id="vehicle_company" type="text" name="vehicle_company" value="{{ old('vehicle_company') }}" aria-describedby="emailHelp" placeholder="Enter Vehicle Company">
                                        @error('vehicle_company')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-6 mb-3">
                                        <label class="col-form-label pt-0" for="exampleInputEmail1">Vehicle Status</label><span style="color: red; margin:4px;">*</span>
                                        <select class="form-select digits" id="exampleFormControlSelect9" name="status">
                                            <option value="ACTIVE">ACTIVE</option>
                                            <option value="INACTIVE" selected>INACTIVE</option>
                                        </select>
                                    </div>
                                    {{-- <div class="col-6 mb-3">
                                        <label class="col-form-label pt-0" for="exampleInputEmail1">Number of children</label><span style="color: red; margin:4px;">*</span>
                                        <input class="form-control" id="vehicle_company" type="text" name="no_of_child" value="{{ old('no_of_child') }}" aria-describedby="emailHelp" placeholder="Enter Number Of Children">
                                        @error('no_of_child')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div> --}}
                                </div>
                                {{-- <div class="row">
                                    <div class="col-6 mb-3">
                                        <label class="col-form-label pt-0" for="exampleInputEmail1">Number of passengers</label><span style="color: red; margin:4px;">*</span>
                                        <input class="form-control" id="no_of_passenger" type="text" name="no_of_passengers" value="{{ old('no_of_passengers') }}" aria-describedby="emailHelp" placeholder="Enter Vehicle Passenger Capacity">
                                        @error('no_of_passengers')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-6 mb-3">
                                        <label class="col-form-label pt-0" for="exampleInputEmail1">Number of suitcases</label><span style="color: red; margin:4px;">*</span>
                                        <input class="form-control" id="no_of_suitcases" type="text" name="no_of_suitcases" value="{{ old('no_of_suitcases') }}" aria-describedby="emailHelp" placeholder="Enter Vehicle Suitcase Capacity">
                                        @error('no_of_suitcases')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div> --}}
                                <div class="mb-3">
                                    <label class="col-form-label pt-0" for="exampleInputEmail1">Description</label><span style="color: red; margin:4px;">*</span>
                                    <textarea class="form-control" id="vehicle_description" type="text" name="vehicle_description" aria-describedby="emailHelp">{{ old('vehicle_description') }}</textarea>
                                    @error('vehicle_description')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="col-form-label pt-0" for="exampleInputEmail1">Vehicle Thumbnail</label><span style="color: red; margin:4px;">*</span>
                                    <input class="form-control" id="vehicle_thumbnail" type="file" name="vehicle_thumbnail" aria-describedby="emailHelp" placeholder="Enter Vehicle Type">
                                    @error('vehicle_thumbnail')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="col-form-label pt-0" for="exampleInputEmail1">Multiple Vehicle Images</label><span style="color: red; margin:4px;">*</span>
                                    {{-- <input class="form-control" id="upload_file" type="file" name="vehicle_images[]" onchange="preview_image();" aria-describedby="emailHelp" placeholder="Enter Vehicle Type" multiple> --}}
                                    <input class="form-control" id="fileupload" name="vehicle_images[]" type="file" multiple="multiple" />
                                    <div id="dvPreview">
                                    @error('vehicle_images')
                                            <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                {{-- <hr>
                                <div class="mb-5">
                                    <span style="font-size: 138%;font-weight: 600;">Add Vehicle Price</span>
                                </div>
                                
                                <div class="row">
                                    <div class="col-3 mb-3">
                                        <label class="col-form-label pt-0" for="exampleInputEmail1">Base Price</label><span style="color: red; margin:4px;">*</span>
                                        <div class="input-group"><span class="input-group-text">$</span>
                                            <input class="form-control" type="number" name="base_price" value="{{ old('base_price') }}" placeholder="Enter Base Price">
                                            @error('base_price')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                        </div>
                                    </div>
                                    <div class="col-3 mb-3">
                                        <label class="col-form-label pt-0" for="exampleInputEmail1">Price Per Minute</label><span style="color: red; margin:4px;">*</span>
                                        <div class="input-group"><span class="input-group-text">$</span>
                                            <input class="form-control" type="number" name="price_per_min" value="{{ old('price_per_min') }}" placeholder="Enter Price Per Minute">
                                            @error('price_per_min')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                        </div>
                                    </div>
                                    <div class="col-3 mb-3">
                                        <label class="col-form-label pt-0" for="exampleInputEmail1">Price Per Hour</label><span style="color: red; margin:4px;">*</span>
                                        <div class="input-group"><span class="input-group-text">$</span>
                                            <input class="form-control" type="number" name="price_per_hour" value="{{ old('price_per_hour') }}" placeholder="Enter Price Per Hour">
                                            @error('price_per_hour')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                        </div>
                                    </div>
                                    <div class="col-3 mb-3">
                                        <label class="col-form-label pt-0" for="exampleInputEmail1">Price Per KM</label><span style="color: red; margin:4px;">*</span>
                                        <div class="input-group"><span class="input-group-text">$</span>
                                            <input class="form-control" type="number" name="price_per_km" value="{{ old('price_per_km') }}" placeholder="Enter Price Per Kilometer">
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
                                        <input class="form-control" type="number" name="extra_waiting_time" value="{{ old('extra_waiting_time') }}" placeholder="Enter Extra Waiting Time">
                                        @error('extra_waiting_time')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    </div>
                                    <div class="col-3 mb-3">
                                        <label class="col-form-label pt-0" for="exampleInputEmail1">Minimum Charge</label><span style="color: red; margin:4px;">*</span>
                                        <div class="input-group"><span class="input-group-text">$</span>
                                        <input class="form-control" type="number" name="minimum_charge" value="{{ old('minimum_charge') }}" placeholder="Enter Minimum Vehicle Charge">
                                        @error('minimum_charge')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    </div>
                                    <div class="col-3 mb-3">
                                        <label class="col-form-label pt-0" for="exampleInputEmail1">Minimum Hour</label><span style="color: red; margin:4px;">*</span>
                                        <div class="input-group"><span class="input-group-text">$</span>
                                        <input class="form-control" type="number" name="minimum_hour" value="{{ old('minimum_hour') }}" placeholder="Enter Minimum Vehicle Hour">
                                        @error('minimum_hour')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    </div>
                                    <div class="col-3 mb-3">
                                        <label class="col-form-label pt-0" for="exampleInputEmail1">International Airport Pickup Charge</label><span style="color: red; margin:4px;">*</span>
                                        <div class="input-group"><span class="input-group-text">$</span>
                                        <input class="form-control" type="number" name="international_airport_pickup_charges" value="{{ old('international_airport_pickup_charges') }}" placeholder="Enter Minimum Vehicle Hour">
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
                                        <input class="form-control" type="number" name="domestic_airport_pickup_charges" value="{{ old('domestic_airport_pickup_charges') }}" placeholder="Enter Extra Waiting Time">
                                        @error('domestic_airport_pickup_charges')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    </div>
                                    <div class="col-3 mb-3">
                                        <label class="col-form-label pt-0" for="exampleInputEmail1">Child Seat Charge</label><span style="color: red; margin:4px;">*</span>
                                        <div class="input-group"><span class="input-group-text">$</span>
                                        <input class="form-control" type="number" name="child_seat_charges" value="{{ old('child_seat_charges') }}" placeholder="Enter Minimum Vehicle Charge">
                                        @error('child_seat_charges')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    </div>
                                </div>--}}
                                <hr>
                                <div class="mb-5">
                                    <span style="font-size: 138%;font-weight: 600;">Add Vehicle Attribute</span><span style="color: black; margin:4px;">(Optional)</span>
                                </div>
                                <div class="table-responsive mb-3">
                                    <table class="table table-bordered checkbox-td-width">
                                        <tbody>
                                            <tr>
                                                <th>Attribute Name</th>
                                                <th>Value</th>
                                            </tr>
                                            @foreach($attributes as $attr)
                                            <tr>
                                                <td>{{ $attr->vehicle_attribute }}</td>
                                                <td class="w-50">
                                                    <input type="hidden" name="attribute_id[]" value="{{ $attr->id }}">
                                                    <input class="form-control input-primary" id="exampleFormControlInput1" type="text" name="vehicle_attr_val[]" placeholder="Add attribute value">
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div> 
                                <hr>
                                {{-- <div class="mb-5">
                                    <div class="col mb-3">
                                        <label class="col-form-label pt-0" for="exampleInputEmail1">Vehicle Status</label><span style="color: red; margin:4px;">*</span>
                                        <select class="form-select digits" id="exampleFormControlSelect9" name="status">
                                            <option value="ACTIVE">ACTIVE</option>
                                            <option value="INACTIVE" selected>INACTIVE</option>
                                        </select>
                                    </div>
                                </div> --}}
                                <button class="btn btn-primary" type="submit">Submit</button>
                                <button class="btn btn-secondary" type="reset">Cancel</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div> 
    </div> 
@endsection
@section('script')
<script language="javascript" type="text/javascript">
    $(function () {
        $("#fileupload").change(function () {
            if (typeof (FileReader) != "undefined") {
                var dvPreview = $("#dvPreview");
                dvPreview.html("");
                var regex = /^([a-zA-Z0-9\s_\\.\-:])+(.jpg|.jpeg|.gif|.png|.bmp)$/;
                $($(this)[0].files).each(function () {
                    var file = $(this);
                    if (regex.test(file[0].name.toLowerCase())) {
                        var reader = new FileReader();
                        reader.onload = function (e) {
                            var img = $("<img />");
                            img.attr("style", "height:200px;width: 200px; margin: 10px; border: solid #0a55424f;");
                            img.attr("src", e.target.result);
                            dvPreview.append(img);
                        }
                        reader.readAsDataURL(file[0]);
                    } else {
                        alert(file[0].name + " is not a valid image file.");
                        dvPreview.html("");
                        return false;
                    }
                });
            } else {
                alert("This browser does not support HTML5 FileReader.");
            }
        });
    });
    </script>
@endsection