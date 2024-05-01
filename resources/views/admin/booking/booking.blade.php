@extends('admin.layouts.app')

@section('content')
    <div class="page-body">
        <div class="container-fluid">
            <div class="page-header">
                <div class="row">
                    <div class="col-sm-6">
                        <h3>Bookings Table</h3>
                        <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                        <li class="breadcrumb-item">Booking History</li>
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
                    <h5> Bookings History</h5>
                    </div>
                    <div class="card-body">
                    <div class="order-history table-responsive">
                        <table class="table table-bordernone display" id="basic-1">
                            <thead>
                              <tr>
                                {{-- <th scope="col">Create Date</th> --}}
                                <th scope="col">Created Date</th>
                                <th scope="col">Booking Date</th>
                                <th scope="col">Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Amount</th>
                                <th scope="col">Status</th>
                                <th scope="col">Action</th>
                              </tr>
                            </thead>
                            <tbody>
                            @foreach($bookings as $book)
                              <tr>
                                <td>{{ date('d-m-Y', strtotime($book->created_at)); }}</td>
                                <td data-toggle='tooltip' title="view booking details"><a href="{{ route('admin.view-bookings',['id' => $book->id]) }}">{{ !empty($book->booking_date)?$book->booking_date:"NA" }}</a></td>
                                <td>{{ !empty($book->name)?$book->name:"NA" }}</td>
                                <td>{{ !empty($book->email)?$book->email:'NA' }}</td>
                                <td>{{ !empty($book->total_price)?$book->total_price:'NA' }}</td>
                                <td>{{ !empty($book->status)?$book->status:'NA' }}</td>
                                <td>
                                    <a href="{{ route('admin.delete-bookings',['id' => $book->id]) }}"><button class="btn btn-danger"><i class="fa fa-trash"></i></button></a>
                                </td>
                              </tr>
                            @endforeach
                            </tbody>
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
<script>
    $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip(); 
    });
  </script>
@endsection