@extends('admin.layouts.app')

@section('content')
    <div class="page-body">
        <div class="container-fluid">
            <div class="page-header">
                <div class="row">
                    <div class="col-sm-6">
                        <h3>Vehicle Attribute</h3>
                        <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item">Vehicle</li>
                        <li class="breadcrumb-item"><a href="{{ url('admin/vehicle-attribute') }}">Vehicle Attributes</a></li>
                        <li class="breadcrumb-item"><a href="{{ url('admin/vehicle-attribute') }}">Edit Vehicle Attributes</a></li>
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
                    <h5> Edit Vehicle Attribute </h5>
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
                        <form class="theme-form" method="POST" action="{{ url('/admin/update-vehicle-attribute',$attribute->id) }}" enctype="multipart/formdata">
                            @csrf
                            <div class="row">
                                <div class="col-6 mb-3">
                                    <label class="col-form-label pt-0" for="exampleInputEmail1">Vehicle Attribute</label><span style="color: red; margin:4px;">*</span>
                                    <input class="form-control" id="vehicle" type="text" name="vehicle_attribute" value="{{ !empty($attribute->vehicle_attribute)?$attribute->vehicle_attribute:'' }}" aria-describedby="emailHelp" placeholder="Enter Vehicle Attribute">
                                    @error('vehicle_attribute')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-6 mb-3">
                                    <label class="col-form-label pt-0" for="exampleInputEmail1">Vehicle Attribute Slug</label><span style="color: red; margin:4px;">*</span>
                                    <input class="form-control" id="vehicle_type_slug" type="text" name="slug" value="{{ $attribute->vehicle_slug }}" aria-describedby="emailHelp" placeholder="Enter Vehicle Attribute Slug">
                                    <input type="hidden" name="vehicle_attribute_slug" value="{{ $attribute->vehicle_attribute_slug }}">
                                    @error('slug')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <button class="btn btn-primary" type="submit">Update</button>
                            <a href="{{ route('admin.vehicle_attribute') }}"><button class="btn btn-secondary" type="button">Back</button></a>
                        </form>
                    </div>
                </div>
                </div>
            </div>
        </div> 
    </div> 
@endsection