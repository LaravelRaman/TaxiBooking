@extends('admin.layouts.app')

@section('content')
    <div class="page-body">
        <div class="container-fluid">
            <div class="page-header">
                <div class="row">
                    <div class="col-sm-6">
                        <h3>Contacts Table</h3>
                        <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                        <li class="breadcrumb-item">Contacts</li>
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
                    <h5> Contacts </h5>
                    </div>
                    <div class="card-body">
                    <div class="table-responsive">
                        <table class="stripe" id="example-style-8">
                        <thead>
                            <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Message</th>
                            <th>Status</th>
                            <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($contacts as $contact)
                            <tr>
                                <td>{{ !empty($contact->name)?$contact->name:'NA' }}</td>
                                <td>{{ !empty($contact->email)?$contact->email:'NA' }}</td>
                                <td>{{ !empty($contact->message)?$contact->message:'NA' }}</td>
                                <td>{{ !empty($event->description)?$event->description:'NA' }}</td>
                                <td>
                                    <a href="{{ route('admin.view-message',['id' => $contact->id]) }}"><button class="btn btn-warning"><i class="fa fa-eye"></i></button> </a>
                                    <a href="{{ route('admin.delete-message',['id' => $contact->id]) }}"><button class="btn btn-danger"><i class="fa fa-trash"></i></button></a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Message</th>
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