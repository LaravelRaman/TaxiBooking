@extends('admin.layouts.app')

@section('content')
    <div class="page-body">
        <div class="container-fluid">
            <div class="page-header">
                <div class="row">
                    <div class="col-sm-6">
                        <h3>Message</h3>
                        <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                        <li class="breadcrumb-item">Message</li>
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
                                <h5> Add Event/Service </h5>
                            </div>
                            <div class="col-6">
                                <a href="{{ url('admin/vehicle') }}"><button class="btn btn-danger" style="float:right;">Back</button></a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                       <div class="row">
                            <div class="col-6 mb-3">
                                <label class="col-form-label pt-0" for="exampleInputEmail1">Name</label>
                                <input class="form-control" id="" type="text" name="service_name" value="{{ $contact->name }}" aria-describedby="emailHelp" placeholder="Enter Service Name" disabled>
                            </div>
                            <div class="col-6 mb-3">
                                <label class="col-form-label pt-0" for="exampleInputEmail1">Email</label>
                                <input class="form-control" id="" value="{{ $contact->email }}" type="text" name="slug" aria-describedby="emailHelp" placeholder="Enter Service Slug" disabled>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6 mb-3">
                                <label class="col-form-label pt-0" for="exampleInputEmail1">Phone</label>
                                <input class="form-control" id="" type="text" value="{{ $contact->phone }}" aria-describedby="emailHelp" placeholder="Enter The Description Text Line" disabled>
                            </div>
                            <div class="col-6 mb-3">
                                <label class="col-form-label pt-0" for="exampleInputEmail1">Subject</label>
                                <input class="form-control" id="" type="text" value="{{ $contact->subject }}" aria-describedby="emailHelp" placeholder="Enter The Description Text Line" disabled>
                            </div>
                        </div> 
                        <div class="mb-3">
                            <label class="col-form-label pt-0" for="exampleInputEmail1">Description</label>
                            <textarea class="form-control" id="vehicle_type_description" type="text" name="slider_description" aria-describedby="emailHelp" disabled>{{ $contact->message }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label class="col-form-label pt-0" for="exampleInputEmail1">Status</label>
                            <select class="form-select digits" id="exampleFormControlSelect9" name="status">
                                <option value="Pending" selected>PENDING</option>
                                <option value="Viewed">VIEWED</option>
                                 <option value="Closed">CLOSED</option>
                            </select>
                        </div>
                    </div>
                </div>
                </div>
            </div>
        </div> 
    </div> 
@endsection