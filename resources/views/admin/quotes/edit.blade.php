@extends('admin.layouts.app')

@section('content')
    <div class="page-body">
        <div class="container-fluid">
            <div class="page-header">
                <div class="row">
                    <div class="col-sm-6">
                        <h3>Quote Status</h3>
                        <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                        <li class="breadcrumb-item">Quote Status</li>
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
                    <h5> Quote Detail </h5>
                    </div>
                    <div class="card-body">
                       <form action="{{ route('admin.update-quote',['slug' => $quote->event_name]) }}" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-6 mb-3">
                                    <label class="col-form-label pt-0" for="exampleInputEmail1">Quote For</label>
                                    <input class="form-control" id="" type="text" name="service_name" value="{{ $quote->event_name }}" aria-describedby="emailHelp" placeholder="Enter Service Name" disabled>
                                </div>
                                <div class="col-6 mb-3">
                                    <label class="col-form-label pt-0" for="exampleInputEmail1">Name</label>
                                    <input class="form-control" id="" type="text" name="service_name" value="{{ $quote->name }}" aria-describedby="emailHelp" placeholder="Enter Service Name" disabled>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6 mb-3">
                                    <label class="col-form-label pt-0" for="exampleInputEmail1">Phone</label>
                                    <input class="form-control" id="" type="text" value="{{ $quote->phone }}" aria-describedby="emailHelp" placeholder="Enter The Description Text Line" disabled>
                                </div>
                                <div class="col-6 mb-3">
                                    <label class="col-form-label pt-0" for="exampleInputEmail1">Starting Point</label>
                                    <input class="form-control" id="" type="text" value="{{ $quote->starting_point }}" aria-describedby="emailHelp" placeholder="Enter The Description Text Line" disabled>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6 mb-3">
                                    <label class="col-form-label pt-0" for="exampleInputEmail1">Email</label>
                                    <input class="form-control" id="" value="{{ $quote->email }}" type="text" name="slug" aria-describedby="emailHelp" placeholder="Enter Service Slug" disabled>
                                </div>
                                <div class="col-6 mb-3">
                                    <label class="col-form-label pt-0" for="exampleInputEmail1">Destination</label>
                                    <input class="form-control" id="" type="text" value="{{ $quote->destination }}" aria-describedby="emailHelp" placeholder="Enter The Description Text Line" disabled>
                                </div>
                            </div> 
                            
                            <div class="mb-3">
                                <label class="col-form-label pt-0" for="exampleInputEmail1">Message</label>
                                <input class="form-control" id="" type="text" value="{{ $quote->message }}" aria-describedby="emailHelp" placeholder="Enter The Description Text Line" disabled>
                            </div>
                            <div class="mb-3">
                                <label class="col-form-label pt-0" for="exampleInputEmail1">Status</label>
                                <select class="form-select digits" id="colorselector" name="status">
                                    <option value="approved" {{ $quote->status == "approved"?'selected':"" }}>Quoatation Sent</option>
                                    <option value="pending" {{ $quote->status == "pending"?"selected":"" }}>Send Quoatation</option>
                                    <option value="canceled" {{ $quote->status == "canceled"?"selected":"" }}>Cancel</option>
                                </select>
                            </div>
                            <div id="approved" class="colors" style="display:none"> 
                                <div class="row">
                                    <div class="col-12 mb-3">
                                        <label class="col-form-label pt-0" for="exampleInputEmail1">Quote Price</label><span style="color: red; margin:4px;">*</span>
                                        <div class="input-group"><span class="input-group-text">$</span>
                                        <input class="form-control" type="number" name="quote_price" value="" placeholder="Enter Quote Price">
                                        @error('quote_price')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    </div>
                                    <div class="col-12 mb-3">
                                        <label class="col-form-label pt-0" for="exampleInputEmail1">Customer Remarks</label><span style="color: red; margin:4px;">*</span>
                                        <input class="form-control" id="" type="text" name="customer_remark" value="" aria-describedby="emailHelp" placeholder="Enter Customer Remrarks">
                                        @error('customer_remark')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror                                            
                                    </div>
                                </div>
                            </div>
                            <div id="pending" class="colors" style="display:none"> 
                                <div class="row">
                                    <div class="col-12 mb-3">
                                        <label class="col-form-label pt-0" for="exampleInputEmail1">Customer Remarks</label><span style="color: red; margin:4px;">*</span>
                                        <input class="form-control" id="" type="text" name="customer_remark" value="" aria-describedby="emailHelp" placeholder="Enter Customer Remrarks">
                                        @error('customer_remark')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror                                        
                                    </div>
                                </div>
                            </div>
                            <div id="canceled" class="colors" style="display:none"> 
                                <div class="row">
                                    <div class="col-12 mb-3">
                                        <label class="col-form-label pt-0" for="exampleInputEmail1">Customer Remarks</label><span style="color: red; margin:4px;">*</span>
                                        <input class="form-control" id="" type="text" name="customer_remark" value="" aria-describedby="emailHelp" placeholder="Enter Customer Remrarks">
                                        @error('customer_remark')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror                                        
                                    </div>
                                </div>
                            </div>
                            <button class="btn btn-primary" type="submit">Update</button>
                            <a href="{{ route('admin.quotes') }}"><button class="btn btn-secondary" type="button">Back</button></a>
                       </form>
                    </div>
                </div>
                </div>
            </div>
        </div> 
    </div> 
@endsection
@section('script')
<script>
    $(function() {
        $('#colorselector').change(function(){
            $('.colors').hide();
            $('#' + $(this).val()).show();
        });
    });
</script>
@endsection