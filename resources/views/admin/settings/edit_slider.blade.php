@extends('admin.layouts.app')

@section('content')
    <div class="page-body">
        <div class="container-fluid">
            <div class="page-header">
                <div class="row">
                    <div class="col-sm-6">
                        <h3>Slider Master<h3>
                        <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item">Slider Master</li>
                        <li class="breadcrumb-item"><a href="{{ url('admin/edit-slider-master',$slider->id) }}">Edit Slider Master</a></li>
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
                    <h5> Edit Slider </h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-5">
                            <form class="theme-form" action="{{ url('/admin/update-slider-master',$slider->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-6 mb-3">
                                        <label class="col-form-label pt-0" for="exampleInputEmail1">Slider Tag Line</label><span style="color: red; margin:4px;">*</span>
                                        <input class="form-control" id="vehicle_type" type="text" name="slider_tag" value="{{ !empty($slider->slider_tag)?$slider->slider_tag:'' }}" aria-describedby="emailHelp" placeholder="Enter Slider Tag Line">
                                        @error('slider_tag')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-6 mb-3">
                                        <label class="col-form-label pt-0" for="exampleInputEmail1">Slider Title</label><span style="color: red; margin:4px;">*</span>
                                        <input class="form-control" id="vehicle_type_slug" type="text" name="slider_title" value="{{ !empty($slider->slider_title)?$slider->slider_title:'' }}" aria-describedby="emailHelp" placeholder="Enter Slider Title">
                                        @error('slider_title')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="col-form-label pt-0" for="exampleInputEmail1">Slider Button Link</label><span style="color: red; margin:4px;">*</span>
                                    <input class="form-control" id="vehicle_type_slug" type="text" name="slider_btn_link" value="{{ !empty($slider->slider_btn_link)?$slider->slider_btn_link:'' }}" aria-describedby="emailHelp" placeholder="Enter Slider Button Link">
                                    @error('slider_btn_link')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="col-form-label pt-0" for="exampleInputEmail1">Description</label><span style="color: red; margin:4px;">*</span>
                                    <textarea class="form-control" id="vehicle_type_description" type="text" name="slider_description" aria-describedby="emailHelp">{{ !empty($slider->slider_description)?$slider->slider_description:'' }}</textarea>
                                    @error('slider_description')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="col-form-label pt-0" for="exampleInputEmail1">Slider Image</label><span style="color: black; margin:4px;">(Optional)</span>
                                    <input class="form-control" id="vehicle_type_slug" type="file" name="slider_image" aria-describedby="emailHelp" placeholder="Add Slider Image">
                                    <span style="color:red;">*Please add a image meeting dimensions (1600 x 729)</span>
                                    @error('slider_image')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                </div>
                                <button class="btn btn-primary" type="submit">Update</button>
                                <a href="{{ route('admin.slider_master') }}"><button class="btn btn-secondary" type="button">Back</button></a>
                            </form>
                        </div>
                    </div>
                </div>
                </div>
            </div>
        </div> 
    </div> 
@endsection