@extends('admin.layouts.app')

@section('content')
    <div class="page-body">
        <div class="container-fluid">
            <div class="page-header">
                <div class="row">
                    <div class="col-sm-6">
                        <h3>Invoice Table</h3>
                        <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                        <li class="breadcrumb-item">Invoice History</li>
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
                    <h5> Invoice History</h5>
                    </div>
                    <div class="card-body">
                    <div class="order-history table-responsive">
                        <table class="table table-bordernone display" id="basic-1">
                            <thead>
                              <tr>
                                {{-- <th scope="col">Create Date</th> --}}
                                <th scope="col">Invoice No</th>
                                <th scope="col">Invoice Date</th>
                                <th scope="col">Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Status</th>
                                <th scope="col">Action</th>
                              </tr>
                            </thead>
                            <tbody>
                            @foreach($invoices as $book)
                              <tr>
                                <td>{{ !empty($book->invoice_no)?$book->invoice_no:"NA" }}</td>
                                <td>{{ !empty($book->invoice_date)?$book->invoice_date:"NA" }}</td>
                                <td>{{ !empty($book->name)?$book->name:'NA' }}</td>
                                <td>{{ !empty($book->email)?$book->email:'NA' }}</td>
                                <td>{{ !empty($book->status)?$book->status:'NA' }}</td>
                                <td>
                                    <a href="{{ route('admin.invoice-detail',['id' => $book->id]) }}"><button class="btn btn-warning"><i class="fa fa-eye"></i></button></a>
                                    <a href="{{ route('admin.delete-invoices',['id' => $book->id]) }}"><button class="btn btn-danger"><i class="fa fa-trash"></i></button></a>
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