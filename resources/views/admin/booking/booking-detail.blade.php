@extends('admin.layouts.app')

@section('content')
    <div class="page-body">
        <div class="container-fluid">
            <div class="page-header">
                <div class="row">
                    <div class="col-sm-6">
                        <h3>Booking Detail</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                            <li class="breadcrumb-item">Bookings </li>
                            <li class="breadcrumb-item">Booking Detail</li>
                        </ol>
                    </div>
                    <div class="col-sm-6">
                        <!-- Bookmark Start-->
                        <div class="bookmark">
                            <ul>
                                <li><a href="javascript:void(0)" data-container="body" data-bs-toggle="popover"
                                        data-placement="top" title="" data-original-title="Tables"><i
                                            data-feather="inbox"></i></a></li>
                                <li><a href="javascript:void(0)" data-container="body" data-bs-toggle="popover"
                                        data-placement="top" title="" data-original-title="Chat"><i
                                            data-feather="message-square"></i></a></li>
                                <li><a href="javascript:void(0)" data-container="body" data-bs-toggle="popover"
                                        data-placement="top" title="" data-original-title="Icons"><i
                                            data-feather="command"></i></a></li>
                                <li><a href="javascript:void(0)" data-container="body" data-bs-toggle="popover"
                                        data-placement="top" title="" data-original-title="Learning"><i
                                            data-feather="layers"></i></a></li>
                                <li><a href="javascript:void(0)"><i class="bookmark-search" data-feather="star"></i></a>
                                    <form class="form-inline search-form">
                                        <div class="form-group form-control-search">
                                            <input type="text" placeholder="Search..">
                                        </div>
                                    </form>
                                </li>
                            </ul>
                        </div>
                        <!-- Bookmark Ends-->
                    </div>
                </div>
            </div>
            <!-- Container-fluid starts-->
            <div class="container invoice">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
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
                                <div>
                                    <div>
                                        <div class="row invo-header">
                                            <div class="col-sm-6">
                                                <div class="media">
                                                    <div class="media-left"><a href="index.html"><img
                                                                class="media-object img-150"
                                                                src="{{ asset('frontend/images/logo.png') }}" alt="" style="height: 54px; width: 81px;"></a>
                                                    </div>
                                                    <div class="media-body m-l-20">
                                                        <h4 class="media-heading f-w-600">MrDrivers</h4>
                                                        <p style="margin: 0px;">MrDrivers <br><span class="digits">+61415880519</span></p>
                                                        <p style="margin: 0px;">APN Number - <span class="digits">19 645 379 102</span></p>
                                                        <p style="margin: 0px;">BSP - <span class="digits">416641</span></p>
                                                    </div>
                                                </div>
                                                <!-- End Info-->
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="text-md-end text-xs-center">
                                                    <h3>Booking #<span class="">{{ !empty($booking->booking_slug)?$booking->booking_slug:"" }}</span></h3>
                                                    <p>Issued: {{ date('M', strtotime($booking->created_at)) }}<span class="digits"> {{ date('d, Y', strtotime($booking->created_at)) }}</span>
                                                </div>
                                                <!-- End Title                                 -->
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End InvoiceTop-->
                                    <div class="row invo-profile">
                                        <div class="col-xl-4">
                                            <div class="media">
                                                <div class="media-left"><img class="media-object rounded-circle img-60"
                                                        src="../assets/images/user/1.jpg" alt=""></div>
                                                <div class="media-body m-l-20" style="padding-left: 20px;">
                                                    <h4 class="media-heading f-w-600">{{ !empty($user)?$user:"" }}</h4>
                                                    <p>{{ !empty($booking->email)?$booking->email:"" }}<br><span class="digits">{{ !empty($booking->phone)?$booking->phone:"" }}</span></p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-8">
                                            <div class="text-xl-end" id="project">
                                                <h6>BOOKING TRANSFER TYPE : <u>{{ !empty($booking->booking_transfer_type)?$booking->booking_transfer_type:"" }}</u></h6>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Invoice Mid-->
                                    <div>
                                        <div class="table-responsive invoice-table" id="table">
                                            <table class="table table-bordered table-striped">
                                                <tbody>
                                                    <tr>
                                                        <td class="Hours" style="width: 50%;">
                                                            <h6 class="p-2 mb-0">Detail</h6>
                                                        </td>
                                                        <td class="item" colspan="3">
                                                            <h6 class="p-2 mb-0">Description</h6>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <label>Vehicle Type </label>
                                                        </td>
                                                        <td colspan="3" style="width: 50%;">
                                                            <p class="itemtext digits">{{ $vehicle_type }}</p>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <label>Vehicle Price</label>
                                                        </td>
                                                        <td colspan="3" style="width: 50%;">
                                                            <p class="text-black">${{ $v['travel_cost'] }}</p>
                                                        </td>
                                                    </tr>
                                                    @if ($booking->booking_for == "other")
                                                    <tr>
                                                        <td>
                                                            <label>Booking For</label>
                                                        </td>
                                                        <td colspan="3" style="width: 50%;">
                                                            <p style="color:black;">
                                                                <label>Name:</label> {{ $booking->company_person }}<br />
                                                                <label>Email:</label> {{ $booking->other_email }}<br />
                                                                <label>Phone Number:</label> {{ $booking->other_phone_number }}<br />
                                                            </p>
                                                        </td>
                                                    </tr>
                                                    @endif
                                                    <tr>
                                                        <td>
                                                            <label>Booking From</label>
                                                        </td>
                                                        <td colspan="3" style="width: 50%;">
                                                            <p class="text-black">{{ $booking->booking_from }}</p>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <label>Booking To</label>
                                                        </td>
                                                        <td colspan="3" style="width: 50%;">
                                                            <p class="text-black">{{ $booking->booking_to }}</p>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <label>International Airport Pickup Details</label>
                                                        </td>
                                                        <td colspan="3" style="width: 50%;">
                                                            <p style="color:black;"><b>Total {{ $booking->international_airport_pickup_nos }} airport pickup {{ $booking->international_airport_pickup_nos > 1 ?"bookings":"booking" }}. Details displayed below.</b></p>
                                                            <hr>
                                                            @foreach (json_decode($booking->international_airport_pickup_detail) as $val)
                                                                <label>Flight No :</label> {{ $val->flight_no }}<br/> 
                                                                <label>Flight Time :</label> {{ $val->flight_no }}<br/> 
                                                                <label>Flight Board Name :</label> {{ $val->flight_board }}<br/>
                                                                <hr> 
                                                            @endforeach
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <label>International Airport Pickup x {{ $booking->international_airport_pickup_nos }}</label>
                                                        </td>
                                                        <?php
                                                            $international_airport_charge = $booking->international_airport_pickup_nos * $v['international_airport_pickup_charges'];
                                                        ?>
                                                        <td colspan="3" style="width: 50%;">
                                                            <p class="itemtext digits">${{ $international_airport_charge }}</p>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <label>Domestic Airport Pickup Details</label>
                                                        </td>
                                                        <td colspan="3" style="width: 50%;">
                                                            <p style="color:black;"><b>Total {{ $booking->domestic_airport_pickup_nos }} airport pickup {{ $booking->domestic_airport_pickup_nos > 1 ?"bookings":"booking" }}. Details displayed below.</b></p>
                                                            <hr>
                                                            @foreach (json_decode($booking->domestic_airport_pickup_detail) as $val)
                                                                <label>Flight No :</label> {{ $val->flight_no }}<br/> 
                                                                <label>Flight Time :</label> {{ $val->flight_no }}<br/> 
                                                                <label>Flight Board Name :</label> {{ $val->flight_board }}<br/>
                                                                <hr> 
                                                            @endforeach
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <label>Domestic Airport Pickup x {{ $booking->domestic_airport_pickup_nos }}</label>
                                                        </td>
                                                        <?php
                                                            $domestic_airport_charge = $booking->domestic_airport_pickup_nos * $v['domestic_airport_pickup_charges'];
                                                        ?>
                                                        <td colspan="3" style="width: 50%;">
                                                            <p class="itemtext digits">${{ $domestic_airport_charge }}</p>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <label>Child Seat Charge x {{ $booking->child_seat_nos }}</label>
                                                        </td>
                                                        <?php
                                                            $extra_child_charge = $booking->child_seat_nos * $v['child_seat_charges'];
                                                        ?>
                                                        <td colspan="3" style="width: 50%;">
                                                            <p class="itemtext digits">${{ $extra_child_charge }}</p>
                                                        </td>
                                                    </tr>
                                                    @php
                                                        $gst = $vehicle_estimated_price/1.1;
                                                        $gst_cutamount = $vehicle_estimated_price-$gst;
                                                        $book_price = $vehicle_estimated_price-$gst_cutamount;
                                                    @endphp
                                                    <tr>
                                                        <td>
                                                            <label>GST(10%)</label>
                                                        </td>
                                                        <td colspan="3" style="width: 50%;">
                                                            <p class="itemtext digits">${{ round($gst_cutamount,2) }} (included in total cost)</p>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <label>Booking Price</label>
                                                        </td>
                                                        <td colspan="3" style="width: 50%;">
                                                            <p class="itemtext digits">${{ round($book_price,2) }} (After GST)</p>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="Rate" colspan="1">
                                                            <h6 class="mb-0 p-2">Total</h6>
                                                        </td>
                                                        <td class="payment digits" colspan="3" style="width: 50%;">
                                                            <h6 class="mb-0 p-2">${{ $vehicle_estimated_price }}</h6>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <!-- End Table-->
                                    </div>
                                    <!-- End InvoiceBot-->
                                    <div class="row mt-3">
                                        <form action="{{ route('admin.change-booking-status',['slug' => $booking->booking_slug]) }}" method="POST">
                                            @csrf
                                            <div class="col-12 mb-3">
                                                <label class="col-form-label pt-0" for="exampleInputEmail1">Status</label><span style="color: red; margin:4px;">*</span>
                                                <select class="form-select digits" id="mySelect" name="status">
                                                    <option value="PENDING" {{ $booking->status == "PENDING"?'selected':'' }}>PENDING</option>
                                                    <option value="CONFIRMED" {{ $booking->status == "CONFIRMED"?'selected':'' }}>CONFIRMED</option>
                                                    <option value="CANCELED" {{ $booking->status == "CANCELED"?'selected':'' }}>CANCELED</option>
                                                    <option value="FULFILLED" {{ $booking->status == "FULFILLED"?'selected':'' }}>FULFILLED</option>
                                                </select>
                                                @error('status')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            @if ($booking->status == "CONFIRMED" || $booking->status == "FULFILLED")
                                                <div class="form-check" id="myButtonBlock" style="display: block; margin-bottom:10px;">
                                                    @if (empty($invoice_generate))
                                                        <input id="myCheckbox" class="form-check-input" type="checkbox" name="generate_invoice" <?php if(isset($_POST['generate_invoice'])) echo "checked='checked'"; ?>>
                                                        <label class="mb-0 form-check-label" for="dafault-checkbox">Would you like to generate invoice?</label>
                                                    @else
                                                        <label class="mb-0 form-label" for="dafault-checkbox" style="color:red;">* You have already generated the invoice to this booking. Please check your invoice inbox.</label>
                                                    @endif
                                                </div>
                                            @endif
                                            <div class="col">
                                                <button class="btn btn btn-primary me-2" id="save_status" type="submit" style="display:none;">Update Status</button></a>
                                            </div>
                                        </form>
                                        <form action="{{ route('admin.generate-invoice') }}" method="post">
                                            @csrf
                                            <input type="hidden" name="booking_id" value="{{ $booking->id }}">
                                            <input type="hidden" name="user_id" value="{{ $booking_by->id }}">
                                            <input type="hidden" name="billing_addr" value="{{ $booking_by->billing_addr }}">
                                            <input type="hidden" name="international_airport_pickup_detail" value="{{ $booking->international_airport_pickup_detail }}">
                                            <input type="hidden" name="domestic_airport_pickup_detail" value="{{ $booking->domestic_airport_pickup_detail }}">
                                            <input type="hidden" name="net_amount" value="{{ $book_price }}">
                                            <input type="hidden" name="total_amount" value="{{ $vehicle_estimated_price }}">
                                            <input type="hidden" name="discount" value="{{ $booking_by->discount }}">
                                            <input type="hidden" name="gst" value="{{ $gst_cutamount }}">
                                            <div class="card" id="myDiv" style="display:none; background-color:rgba(244,247,247,255);">
                                                <div class="card-body">
                                                    @php
                                                        $invoices = App\Models\Invoice::get();
                                                        $count = count($invoices);
                                                        if ($count == 0) {
                                                            $invoice_no = 1;
                                                        }else {
                                                            $invoice_no = $invoice_no_from_admin + 1;
                                                        }
                                                    @endphp
                                                    <div class="row">
                                                        <div class="col-6 mb-3">
                                                            <label class="col-form-label pt-0" for="exampleInputEmail1">Invoice Number</label>
                                                            <input class="form-control" id="" type="text" name="invoice_number" value="{{ $invoice_no }}" aria-describedby="emailHelp" placeholder="Enter Invoice Number">
                                                            @error('invoice_number')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                        <div class="col-6 mb-3">
                                                            <label class="col-form-label pt-0" for="exampleInputEmail1">ABN Number</label>
                                                            <input class="form-control" id="" type="text" name="abn_number" value="{{ $booking_by->abn_number }}" aria-describedby="emailHelp" placeholder="Enter ABN Number">
                                                            @error('abn_number')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-6 mb-3">
                                                            <label class="col-form-label pt-0" for="exampleInputEmail1">Bill To Name</label>
                                                            <input class="form-control" id="" type="text" name="bill_to_name" value="{{ $booking_by->bill_to_name }}" aria-describedby="emailHelp" placeholder="Enter Bill To Name">
                                                            @error('bill_to_name')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                        <div class="col-6 mb-3">
                                                            <label class="col-form-label pt-0" for="exampleInputEmail1">Invoice Date</label>
                                                            <input class="form-control" id="minMaxExample" type="text" name="invoice_date" value="{{ old('invoice_date') }}" aria-describedby="emailHelp" placeholder="Select Invoice Date">
                                                            @error('invoice_date')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-12 mb-3">
                                                            <label class="col-form-label pt-0" for="exampleInputEmail1">Billing Address</label>
                                                            <input class="form-control" id="" type="text" name="billing_addr" value="{{ $booking_by->billing_addr }}" aria-describedby="emailHelp" placeholder="Enter Billing Address">
                                                            @error('billing_addr')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        @if (empty($invoice_generate))
                                                            <div class="col-6">
                                                                <button class="btn btn-primary" type="submit">Generate Invoice</button>
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="col-sm-12 text-center mt-3">
                                    <a href="{{ route('admin.bookings') }}"><button class="btn btn-secondary" type="button">Back</button></a>
                                </div>
                                <!-- End Invoice-->
                                <!-- End Invoice Holder-->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Container-fluid Ends-->
        </div>
    </div>
@endsection
@section('script')
<script>
    $(document).ready(function() {
      $('#myCheckbox').change(function() {
        if($(this).is(':checked')) {
          $('#myDiv').show();
        } else {
          $('#myDiv').hide();
        }
      });
    });
  </script>
<script type="text/javascript">
    $(".download-pdf").click(function(){
        var data = '';
        $.ajax({
            type: 'GET',
            url: "{{route('admin.generate-pdf')}}",
            data: data,
            xhrFields: {
                responseType: 'blob'
            },
            success: function(response){
                var blob = new Blob([response]);
                var link = document.createElement('a');
                link.href = window.URL.createObjectURL(blob);
                link.download = "techsolutionstuff.pdf";
                link.click();
            },
            error: function(blob){
                console.log(blob);
            }
        });
    });

</script>
<script>
    $('#mySelect').on('change', function() {
        if (this.value == 'CONFIRMED' || this.value == 'FULFILLED') {
            $('#myButtonBlock').show();
        } else {
            $('#myButtonBlock').hide();
        }
    });
</script>
<script>
    $('#mySelect').on('change', function() {
        $('#save_status').show();
    });
</script>
  
@endsection
