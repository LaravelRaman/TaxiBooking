@extends('admin.layouts.app')

@section('content')
    <div class="page-body">
        <div class="container-fluid">
            <div class="page-header">
                <div class="row">
                    <div class="col-sm-6">
                        <h3>Customer Table</h3>
                        <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                        <li class="breadcrumb-item">Customers</li>
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
                        @if ($message = Session::get('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong class>{{ $message }}</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif 
                    <h5> Customers </h5>
                    </div>
                    <div class="card-body">
                    <div class="table-responsive">
                        <table class="stripe" id="example-style-8">
                        <thead>
                            <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Bill To Name</th>
                            <th>Billing Address</th>
                            <th>ABN Number</th>
                            <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                            <tr>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ !empty($user->bill_to_name)?$user->bill_to_name:'NA' }}</td>
                                <td>{{ !empty($user->billing_addr)?$user->billing_addr:'NA' }}</td>
                                <td>{{ !empty($user->abn_number)?$user->abn_number:'NA' }}</td>
                                <td>
                                    <a href="{{ route('admin.edit-user',['slug' => $user->id]) }}"><button class="btn btn-warning"><i class="fa fa-pencil"></i></button> </a>
                                    <a href="{{ route('admin.delete-user',['slug' => $user->id]) }}"><button class="btn btn-danger"><i class="fa fa-trash"></i></button></a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Bill To Name</th>
                            <th>Billing Address</th>
                            <th>ABN Number</th>
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