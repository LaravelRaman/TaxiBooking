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
                    <h5> Add Sliders </h5>
                    </div>
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong class>{{ $message }}</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                aria-label="Close"></button>
                        </div>
                    @endif
                    <div class="card-body">
                        <div class="mb-5">
                            <form class="theme-form" action="{{ url('/admin/add-slider-master') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-6 mb-3">
                                        <label class="col-form-label pt-0" for="exampleInputEmail1">Slider Tag Line</label><span style="color: red; margin:4px;">*</span>
                                        <input class="form-control" id="vehicle_type" type="text" name="slider_tag" value="{{ old('slider_tag') }}" aria-describedby="emailHelp" placeholder="Enter Slider Tag Line">
                                        @error('slider_tag')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-6 mb-3">
                                        <label class="col-form-label pt-0" for="exampleInputEmail1">Slider Title</label><span style="color: red; margin:4px;">*</span>
                                        <input class="form-control" id="vehicle_type_slug" type="text" name="slider_title" value="{{ old('slider_title') }}" aria-describedby="emailHelp" placeholder="Enter Slider Title">
                                        @error('slider_title')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="col-form-label pt-0" for="exampleInputEmail1">Slider Button Link</label><span style="color: red; margin:4px;">*</span>
                                    <input class="form-control" id="vehicle_type_slug" type="text" name="slider_btn_link" value="{{ old('slider_btn_link') }}" aria-describedby="emailHelp" placeholder="Enter Slider Button Link">
                                    @error('slider_btn_link')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="col-form-label pt-0" for="exampleInputEmail1">Description</label><span style="color: red; margin:4px;">*</span>
                                    <textarea class="form-control ckeditor" id="vehicle_type_description" type="text" name="slider_description" aria-describedby="emailHelp">{{ old('slider_description') }}</textarea>
                                    @error('slider_description')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="col-form-label pt-0" for="exampleInputEmail1">Slider Image</label><span style="color: red; margin:4px;">*</span>
                                    <input class="form-control" id="vehicle_type_slug" type="file" name="slider_image" aria-describedby="emailHelp" placeholder="Add Slider Image">
                                    <span style="color:red;">*Please add a image meeting dimensions (1600 x 729)</span><br>
                                    @error('slider_image')
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
                                <th>Slider Image</th>
                                <th>Slider Tag Line</th>
                                <th>Slider title</th>
                                <th>Slider Description</th>
                                <th>Slider Button Link</th>
                                <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($sliders as $vehicle)
                                    <tr>
                                        <td><img src="{{asset('uploads/sliders/'.$vehicle->slider_image) }}" alt="" srcset="" style="height: 188px; 270px;"></td>
                                        <td>{{ !empty($vehicle->slider_tag)?$vehicle->slider_tag:'NA' }}</td>
                                        <td>{{ !empty($vehicle->slider_title)?$vehicle->slider_title:'NA' }}</td>
                                        <td>{{ !empty($vehicle->slider_description)?$vehicle->slider_description:'NA' }}</td>
                                        <td>{{ !empty($vehicle->slider_btn_link)?$vehicle->slider_btn_link:'NA' }}<br/>
                                        </td>
                                        <td>
                                            <a href="{{ url('admin/edit-slider-master',$vehicle->id) }}"><button class="btn btn-warning" style="margin-bottom:2px;"><i class="fa fa-pencil"></i></button> </a>
                                            <a href="{{ url('admin/delete-slider-master',$vehicle->id) }}"><button class="btn btn-danger"><i class="fa fa-trash"></i></button></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                <th>Slider Image</th>
                                <th>Slider Tag Line</th>
                                <th>Slider title</th>
                                <th>Slider Description</th>
                                <th>Slider Button Link</th>
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
@section('script')
<script src="https://cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $('.ckeditor').ckeditor();
    });
</script>
@endsection