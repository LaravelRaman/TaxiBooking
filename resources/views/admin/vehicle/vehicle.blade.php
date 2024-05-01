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
                        <li class="breadcrumb-item"><a href="{{ url('admin/vehicle') }}">Vehicles</a></li>
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
                            <h5> Vehicles </h5>
                        </div>
                        <div class="col-6">
                            <a href="{{ url('admin/add-vehicle') }}"><button class="btn btn-primary" style="float:right;">Add New Vehicle</button></a>
                        </div>
                        </div>
                    </div>
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong class>{{ $message }}</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                aria-label="Close"></button>
                        </div>
                    @endif
                    <div class="card-body">
                    <div class="table-responsive">
                        <table class="stripe" id="example-style-8">
                        <thead>
                            <tr>
                            <th>Thumbnail</th>
                            <th>Vehicle Title</th>
                            <th>Make and Model</th>
                            <th>Status</th>
                            <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($vehicles as $vehicle)
                                <tr>
                                    <td><img src="{{asset('uploads/vehicle/'.$vehicle->vehicle_thumbnail) }}" alt="" srcset="" style="height: 188px; 270px;"></td>
                                    <td>{{ !empty($vehicle->vehicle_name)?$vehicle->vehicle_name:'NA' }}</td>
                                    <td>
                                        Make: {{ !empty($vehicle->vehicle_make)?$vehicle->vehicle_make:'NA' }}<br/>
                                        Model: {{ !empty($vehicle->vehicle_model)?$vehicle->vehicle_model:'NA' }}
                                    </td>
                                    <td>
                                        {{ !empty($vehicle->status)?$vehicle->status:'NA' }}
                                    </td>
                                    <td>
                                        <a href="{{ url('admin/edit-vehicle',$vehicle->vehicle_slug) }}"><button class="btn btn-warning" style="margin-bottom:2px;"><i class="fa fa-pencil"></i></button> </a>
                                        <a href="{{ url('admin/delete-vehicle',$vehicle->vehicle_slug) }}"><button class="btn btn-danger"><i class="fa fa-trash"></i></button></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                            <th>Thumbnail</th>
                            <th>Vehicle Title</th>
                            <th>Make and Model</th>
                            <th>Status</th>
                            <th>Action</th>
                            </tr>
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