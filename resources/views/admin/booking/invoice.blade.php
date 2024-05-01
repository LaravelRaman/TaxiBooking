{{-- <!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Invoice</title>
    <style>
        * {
            font-family: arial;
        }

        .invoice_container {
            padding: 10px 10px;
        }

        .invoice_header {
            display: flex;
            justify-content: space-between;
            width: 100%;
            background: #e7c9c9;
            padding-bottom: 50px;
        }

        .logo_container {
            margin-top: 10px;
            margin-bottom: 10px;
            margin-left: 10px;
        }

        .company_address {
            margin-left: 10px;
        }

        .invoice_header h2 {
            margin-top: 0;
        }

        .invoice_header p {
            margin-top: 10px;
        }

        .logo_container img {
            height: 60px;
        }

        .customer_container {
            padding: 0 10px;
            display: flex;
            justify-content: space-between;
        }

        .customer_container h2 {
            margin-bottom: 10px;
        }

        .customer_container h4 {
            margin-bottom: 10px;
            margin-top: 0;
        }

        .customer_container p {
            margin: 0;
        }

        .in_details {
            margin-top: auto;
            margin-bottom: auto;
        }

        .product_container {
            padding: 0 10px;
            margin-top: 10px;
        }

        .item_table {
            width: 100%;
            text-align: left;
        }

        .item_table td,
        th {
            padding: 5px 10px;
        }

        .invoice_footer {
            padding: 0 10px;
            display: flex;
            justify-content: space-between;
        }

        .invoice_footer h2 {
            margin-bottom: 10px;
        }

        .note {
            width: 50%;
        }

        .invoice_footer_amount {
            margin: auto 0;
            background: #e7c9c9;
        }

        .amount_table td,
        th {
            padding: 5px 10px;
        }

        .in_head {
            margin: 0;
            text-align: center;
            background: #e7c9c9;
            padding: 5px;
        }

        .float-parent-element {
            width: 100%;
            padding-bottom: 50px;
        }

        .float-child-element {
            float: right;
            width: 50%;
        }

        .red {
            background-color: rgba(234, 178, 178, 0.801);
            margin-left: 50%;
            height: 50px;
        }

        .yellow {
            margin-left: 0%;
            margin-bottom: 20px;
            height: 50px;
        }
        .page-break {
            page-break-after: always;
        }
    </style>
</head>

<body>
    
    <div class="invoice_container">
        <div class="float-parent-element" style="margin-bottom:10px;">
            <div class="float-child-element">
                <div class="red" style="text-align: center;">{{ date('j M Y') }} <br>{{ date('D') }}</div>
            </div>
            <div class="float-child-element">
                <img src="{{ public_path('/frontend/images/logo.png')}}" height="50px;">
            </div>
        </div>
        <hr>
        <div class="in_details">
            <h1 class="in_head">INVOICE</h1>
        </div>
        <hr>
        <div class="invoice_header">
            <div class="logo_container">
                <h2 style="margin-top: 20px;">MrDrivers</h2>
                <p>
                    100 Harris St. Pyrmont, NSW 2009 <br>
                    Email : admin@mrdrivers.com.au, <br />  
                    Telephone : +61415880519 <br />
                    APN Number - 19 645 379 102<br />
                    BSP - 416641<br />
                </p>
                <hr style="margin-bottom: 30px;">
                <h2>Billing To</h2>
                <p>
                    <b style="padding-bottom: 20px;">{{ $user }}</b><br>

                    Email: {{ $order['email'] }} <br>
                    Phone: {{ $order['phone'] }}
                </p>
            </div> 
        </div>
        <hr>
        <table class="item_table" border="1" cellspacing="0">
            <tr>
                <td>Invoice ID</td>
                <td><b>{{ $order['booking_slug'] }}</b></td>
            </tr>
            <tr>
                <td>Date</td>
                <td><b>{{ $invoice_date }}</b></td>
            </tr>
            <tr>
                <td>Time</td>
                <td><b>{{ $invoice_time }}</b></td>
            </tr>
        </table>
        <hr>
        <table class="item_table" border="1" cellspacing="0">
            <tr>
                <th>Sl. No.</th>
                <th>Item</th>
                <th>Description</th>
            </tr>
            <tr>
                <td>1</td>
                <td>Booking Transfer Detail</td>
                <td>{{ $order['booking_transfer_type'] }} - ({{ $order['booking_from'] }} to {{ $order['booking_to'] }})</td>
            </tr>
            <tr>
                <td>2</td>
                <td>Vehicle Type</td>
                <td>{{ $vehicle_type }}</td>
            </tr>
            <tr>
                <td>3</td>
                <td>Vehicle Price</td>
                <td>${{ $v['travel_cost'] }}</td>
            </tr>
            <tr>
                <td>4</td>
                <td>International Airport Pickup x {{ $order['international_airport_pickup_nos'] }}</td>
                <?php
                    $international_airport_charge = $order['international_airport_pickup_nos'] * $v['international_airport_pickup_charges'];
                ?>
                <td>${{ $international_airport_charge }}</td>
            </tr>
            <tr>
                <td>5</td>
                <td>Domestic Airport Pickup x {{ $order['domestic_airport_pickup_nos'] }}</td>
                <?php
                    $domestic_airport_charge = $order['domestic_airport_pickup_nos'] * $v['domestic_airport_pickup_charges'];
                ?>
                <td>${{ $domestic_airport_charge }}</td>
            </tr>
            <tr>
                <td>6</td>
                <td>Child Seat Charge x {{ $order['child_seat_nos'] }}</td>
                <?php
                    $extra_child_charge = $order['child_seat_nos'] * $v['child_seat_charges'];
                ?>
                <td>${{ $domestic_airport_charge }}</td>
            </tr>
        </table>
        <div class="customer_container">
            <h3>Pricing details listed below.</h3>
        </div>
        <div class="page-break"></div>
        <div class="invoice_footer">
            <div class="invoice_footer_amount">
                <table class="item_table" cellspacing="0" border="1">
                    <tr>
                        <td >GST (10%)</td>
                        @php
                            $gst = $vehicle_estimated_price/1.1;
                            $gst_cutamount = $vehicle_estimated_price-$gst;
                        @endphp
                        <td style="width:50%"> <b>${{ round($gst_cutamount) }}</b></td>
                    </tr>
                    <tr>
                        <td>Booking Price</td>
                        @php
                            $book_price = $vehicle_estimated_price-$gst_cutamount;
                        @endphp
                        <td> <b>${{ round($book_price) }}</b></td>
                    </tr>
                    <tr>
                        <td><h3>Total</h3></td>
                        <td> <b>${{ $vehicle_estimated_price }}</b></td>
                    </tr>
                </table>
            </div>
            <div class="note">
                <h2>Thank You!</h2>
            </div>
            <p>
                <b  style="color:red">This is computer generated invoice no signature required</b>
            </p>
        </div>
    </div>
</body>

</html> --}}

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Invoice</title>
    <style>
        * {
            font-family: Sans-serif;
        }

        .invoice_container {
            padding: 10px 10px;
        }
        .float-parent-element {
            width: 100%;
            padding-bottom: 50px;
        }

        .float-child-element {
            float: center;
            width: 50%;
        }

        .red {
            margin-left: 50%;
            height: 50px;
        }

        .yellow {
            margin-left: 0%;
            margin-bottom: 20px;
            height: 50px;
        }
        .page-break {
            page-break-after: always;
        }
        table{ 
            page-break-inside: auto ;
        }
        .card {
            width: 100%;
        }
        .in_head {
            margin: 0;
            text-align: left;
            background: #464444;
            padding: 5px;
            padding-left: 40px;
            color:aliceblue;
        }
        .in_details {
            padding-top: 60px !important;
            margin-bottom: auto;
        }
        .item_table {
            width: 100%;
            text-align: left;
        }

        .item_table td,
        th {
            padding: 5px 10px;
        }
    </style>
</head>

<body>
    
    <div class="invoice_container">
        <div class="row">
            <div class="col-12" style="text-align: center;">
                <img src="{{ public_path('/frontend/images/logo.png')}}" height="90px;">
            </div>
        </div>
        {{-- <div class="float-parent-element" style="margin-bottom:10px;">
            <div class="float-child-element">
                <div class="red" style="text-align: center; margin-top:40px;">&nbsp;</div>
            </div>
            <div class="float-child-element">
                <img src="{{ public_path('/frontend/images/logo.png')}}" height="90px;">
            </div>
        </div> --}}
        <div class="in_details">
            <h3 class="in_head">Invoice</h3>
        </div>
        <table border="0" cellspacing="0" style="width: 100%;height:auto;border-bottom: 1pt solid rgba(247, 250, 59, 0.856);border-top: 1pt solid rgba(247, 250, 59, 0.856);margin-top:5px;background-color:rgb(166, 168, 172);">
            <tr>
                <td style="width:50%;">
                    <b style="padding-left: 40px;">Invoice No.: {{ $order['booking_slug'] }}</b>
                </td>
                <td>
                    <b>Invoice Date: {{ date('j M Y') }}</b>
                </td>
            </tr>
        </table>
        <table style="height:10px;">

        </table>
        <table border="0" cellspacing="0" style="width: 100%;height:auto;">
            <tr style="">
                <td style="width:50%; padding-left:20px;">
                    <div class="card">
                        <b>MR DRIVER PTY LTD</b>
                        <div class="card-body" style="font-size:15px;">
                            100 Harris St. Pyrmont<br>
                            NSW 2009 <br>
                            Contact: +61415880519<br>
                            E-mail.: admin@mrdrivers.com.au<br>
                            Web. : www.mrdrivers.com.au
                        </div>
                        <div class="card-footer" style="font-size:15px;">
                            APN No. : 19 645 379 102<br>
                            License Code : BSP-416641
                        </div>
                    </div>
                </td>
                <td style="vertical-align: top; text-align: left;">
                    <div class="card">
                        <b style="margin-bottom:20px;">To,</b>
                        <div class="card-body" style="font-size:15px;">
                            <b>{{ $user }}</b>
                        </div>
                        <div class="card-footer" style="font-size:15px;">
                            Mob: {{ $order['phone'] }} <br>
                            Email : {{ $order['email'] }}
                        </div>
                    </div>
                </td>
            </tr>
        </table>
        <table border="0" cellspacing="0" style="width: 100%;height:auto;border-bottom: 1pt solid rgba(247, 250, 59, 0.856);border-top: 1pt solid rgba(247, 250, 59, 0.856);margin-top:5px;background-color:rgb(166, 168, 172);">
            <tr>
                <td style="width:50%;">
                    &nbsp;
                </td>
                <td>
                    &nbsp;
                </td>
            </tr>
        </table>
        <table style="height:10px;">

        </table>
        @php
            $gst = $vehicle_estimated_price/1.1;
            $gst_cutamount = $vehicle_estimated_price-$gst;
            $book_price = $vehicle_estimated_price-$gst_cutamount;
        @endphp
        <table border="1" cellspacing="0">
            <tr>
                <th>Sr. No.</th>
                <th>Description</th>
                <th>Amount</th>
                <th>GST</th>    
            </tr>
            <tr style="vertical-align: top; width:100%;">
                <td style="font-size:15px;height:200px;text-align: center;width:10%;">1.</td>
                <td style="font-size:13px;height:100px;text-align: center;width:50%;"><b>{{ $order['booking_transfer_type'] }} - ({{ $order['booking_from'] }} to {{ $order['booking_to'] }})</b></td>
                <td style="font-size:13px;height:100px;text-align: center;width:20%;"><b>AUD {{ round($book_price,2) }}</b></td>
                <td style="font-size:13px;height:100px;text-align: center;width:20%;"><b>AUD {{ round($gst_cutamount,2) }}</b></td>
            </tr>
            <tr style="font-size:15px;">
                @php
                    $digit = new NumberFormatter("en", NumberFormatter::SPELLOUT);
                @endphp
                <td colspan="2" rowspan="2"><b>Round Amount Chargeable (In Words):</b> <br> Australian Dollar {{ Str::ucfirst($digit->format(round($book_price))) }} Only</td>
                <td style="font-size:15px;text-align: center;">Amount</td>
                <td style="font-size:15px;text-align: center;"><b>AUD {{ round($book_price,2) }}</b></td>
            </tr>
            <tr>
                <td style="font-size:15px;text-align: center;">
                    GST
                </td>
                <td style="font-size:15px;text-align: center;">
                    <b>AUD {{ round($gst_cutamount,2) }}</b>
                </td>
            </tr>
            <tr>
                <td colspan="2" style="font-size:15px;text-align: left; vertical-align: top;">
                    <p>
                        <b>Bank Details:</b> <br>
                        MR DRIVER PTY LTD <br>
                        Account Number: xxxx <br>
                        Bank Name: xxxx 
                    </p>
                </td>
                <td style="vertical-align: top;text-align: center;font-size:15px;">
                    Discount
                </td>
                <td style="vertical-align: top;text-align: center;font-size:15px;">
                    <b>AUD 0.00</b>
                </td>
            </tr>
            <tr style="font-size:15px;">
                <td colspan="2">
                    
                </td>
                <td style="font-size:15px;text-align: center;">
                    Total Amount
                </td>
                <td style="font-size:15px;text-align: center;">
                    <b>AUD {{ $vehicle_estimated_price }}</b>
                </td>
            </tr>
        </table>
        <table border="0" cellspacing="0" style="width: 100%;height:auto;border-bottom: 1pt solid rgba(247, 250, 59, 0.856);border-top: 1pt solid rgba(247, 250, 59, 0.856);margin-top:5px;background-color:rgb(166, 168, 172);">
            <tr>
                <td style="width:50%;">
                    &nbsp;
                </td>
                <td>
                    &nbsp;
                </td>
            </tr>
        </table>
        <div style="text-align: center; vertical-align:middle; margin-top:30px;">
            <p><b style="color: rgba(53, 51, 51, 0.849);">This is computer generated invoice no signature required.</b></p>
        </div>
        
    </div>
</body>

</html>
