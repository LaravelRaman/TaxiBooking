@extends('admin.layouts.app')

@section('content')
    <div class="page-body">
        <div class="container-fluid">
            <div class="page-header">
                <div class="row">
                    <div class="col-sm-6">
                        <h3>Events Quote<h3>
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Home</a></li>
                                    <li class="breadcrumb-item">Event Quotes</li>
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
                            <h5> Event Quotes </h5>
                        </div>
                        <div class="card-body">
                            @if (session()->has('message'))
                                <div class="alert alert-success">
                                    {{ session()->get('message') }}
                                </div>
                            @endif
                            <div class="table-responsive">
                                <table class="stripe" id="example-style-8">
                                    <thead>
                                        <tr>
                                            <th>Quote Date</th>
                                            <th>Quote Event</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>Starting Point</th>
                                            <th>Destination</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($quotes as $event)
                                            <tr>
                                                <td>{{ !empty($event->created_at->format('d-m-Y'))?$event->created_at->format('d-m-Y'):'NA' }}</td>
                                                <td>{{ !empty($event->event_name)?$event->event_name:'NA' }}</td>
                                                <td>{{ !empty($event->name)?$event->name:'NA' }}</td>
                                                <td>{{ !empty($event->email)?$event->email:'NA' }}</td>
                                                <td>{{ !empty($event->phone)?$event->phone:'NA' }}</td>
                                                <td>{{ !empty($event->starting_point)?$event->starting_point:'NA' }}</td>
                                                <td>{{ !empty($event->destination)?$event->destination:'NA' }}</td>
                                                <td>{{ !empty($event->status)?$event->status:'NA' }}</td>
                                                <td>
                                                    <a
                                                        href="{{ route('admin.edit-quote', ['slug' => $event->event_name]) }}"><button
                                                            class="btn btn-warning" style="margin-bottom:2px;"><i
                                                                class="fa fa-pencil"></i></button> </a>
                                                    <a
                                                        href="{{ route('admin.delete-quote', ['slug' => $event->event_name]) }}"><button
                                                            class="btn btn-danger"><i class="fa fa-trash"></i></button></a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Quote Date</th>
                                            <th>Quote Event</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>Starting Point</th>
                                            <th>Destination</th>
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
