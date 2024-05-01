@extends('admin.layouts.app')

@section('content')
    <div class="page-body">
        <div class="container-fluid">
            <div class="page-header">
                <div class="row">
                    <div class="col-sm-6">
                        <h3>Admin User Table</h3>
                        <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                        <li class="breadcrumb-item">Admin Users</li>
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
                    <h5> Admin Users </h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-5">
                            <form class="theme-form" action="{{ route('admin.admin-add-user') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-12 mb-3">
                                        <label class="col-form-label pt-0" for="exampleInputEmail1">Name</label><span style="color: red; margin:4px;">*</span>
                                        <input class="form-control" id="" type="text" name="name" value="{{ old('name') }}" aria-describedby="emailHelp" placeholder="Enter Name">
                                        @error('name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6 mb-3">
                                        <label class="col-form-label pt-0" for="exampleInputEmail1">Email</label><span style="color: red; margin:4px;">*</span>
                                        <input class="form-control" id="" type="text" name="email" value="{{ old('email') }}" aria-describedby="emailHelp" placeholder="Enter Email">
                                        @error('email')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-6 mb-3">
                                        <label class="col-form-label pt-0" for="exampleInputEmail1">Phone</label><span style="color: red; margin:4px;">*</span>
                                        <input class="form-control" id="" type="text" name="phone" value="{{ old('phone') }}" aria-describedby="emailHelp" placeholder="Enter Phone Number">
                                        @error('phone')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6 mb-3">
                                        <label class="col-form-label pt-0" for="exampleInputEmail1">Role</label><span style="color: red; margin:4px;">*</span>
                                        <select class="form-select digits" id="exampleFormControlSelect9" name="role">
                                            <option value="1">Administrator</option>
                                            <option value="0" selected>User</option>
                                        </select>
                                        @error('role')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-6 mb-3">
                                        <label class="col-form-label pt-0" for="exampleInputEmail1">Password</label><span style="color: red; margin:4px;">*</span>
                                        <input class="form-control" id="" type="password" name="password" value="{{ old('password') }}" aria-describedby="emailHelp" placeholder="Set Password">
                                        @error('password')
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
                                <th>Name</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($admins as $user)
                                <tr>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->role }}</td>
                                    <td>
                                        <a href="{{ route('admin.admin-edit-user',['slug' => $user->id]) }}"><button class="btn btn-warning"><i class="fa fa-pencil"></i></button> </a>
                                        <a href="{{ route('admin.admin-delete-user',['slug' => $user->id]) }}"><button class="btn btn-danger"><i class="fa fa-trash"></i></button></a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Role</th>
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