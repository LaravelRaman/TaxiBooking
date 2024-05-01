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
                        <li class="breadcrumb-item"><a href="{{ url('admin/vehicle-attribute') }}">Vehicle Attributes</a></li>
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
                    <h5> Add Vehicle Attribute </h5>
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
                            <form class="theme-form" method="POST" action="{{ url('/admin/add-vehicle-attribute') }}" enctype="multipart/formdata">
                                @csrf
                                <div class="row">
                                    <div class="col-6 mb-3">
                                        <label class="col-form-label pt-0" for="exampleInputEmail1">Vehicle Attribute</label><span style="color: red; margin:4px;">*</span>
                                        <input class="form-control" id="vehicle" type="text" name="vehicle_attribute" value="{{ old('vehicle_attribute') }}" aria-describedby="emailHelp" placeholder="Enter Vehicle Attribute">
                                        @error('vehicle_attribute')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <?php 
                                        $random_val = Str::random(8);
                                    ?>
                                    <div class="col-6 mb-3">
                                        <label class="col-form-label pt-0" for="exampleInputEmail1">Vehicle Attribute Slug</label><span style="color: red; margin:4px;">*</span>
                                        <input class="form-control" id="vehicle_type_slug" type="text" name="slug" value="{{ $random_val }}" aria-describedby="emailHelp" placeholder="Enter Vehicle Attribute Slug">
                                        @error('slug')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <button class="btn btn-primary" type="submit">Submit</button>
                                <button class="btn btn-secondary" type="reset">Cancel</button>
                            </form>
                        </div>
                        <div class="table-responsive">
                            <table class="stripe" id="example-style-8">
                            <thead>
                                <tr>
                                <th>Vehicle Attribute</th>
                                <th>Slug</th>
                                <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($attributes as $data)
                                <tr>
                                    <td>{{ !empty($data->vehicle_attribute)?$data->vehicle_attribute:'NA' }}</td>
                                    <td>{{ !empty($data->vehicle_attribute_slug)?$data->vehicle_attribute_slug:'NA' }}</td>
                                    <td>
                                        <a href="{{ url('admin/edit-vehicle-attribute',$data->id) }}"><button class="btn btn-warning"><i class="fa fa-pencil"></i></button> </a>
                                        <a href="{{ url('admin/delete-vehicle-attribute',$data->id) }}"><button class="btn btn-danger"><i class="fa fa-trash"></i></button></a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                <th>Vehicle Attribute</th>
                                <th>Slug</th>
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