

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Booking Detail</title>
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
        <div class="in_details">
            <h3 class="in_head">Booking Details</h3>
        </div>
        <table border="0" cellspacing="0" style="width: 100%;height:auto;border-bottom: 1pt solid rgba(247, 250, 59, 0.856);border-top: 1pt solid rgba(247, 250, 59, 0.856);margin-top:5px;background-color:rgb(166, 168, 172);">
            <tr>
                <td style="width:50%;">
                    <b>Booking Time: {{ $invoice_time }}</b>
                </td>
                <td>
                    <b>Booking Date: {{ $invoice_date }}</b>
                </td>
            </tr>
        </table>
        <table style="height:10px;">

        </table>
        <table border="0" cellspacing="0" style="width: 100%;height:auto;">
            <tr style="">
                <td style="width:50%; padding-left:20px;">
                    <div class="card">
                        <b>GRANDEUR CHAUFFEURS</b>
                        <div class="card-body" style="font-size:15px;">
                            329 Queensberry Street, North Melbourne<br>
                            VIC 3051, Australia.<br>
                            Contact: (880) 172 380 956<br>
                            E-mail.: info@prodirve.com<br>
                            Web. : www.honeyonline.in
                        </div>
                        <div class="card-footer" style="font-size:15px;">
                            APN No. : XX XXX XXX XXX<br>
                            License Code : BSP-XXXX
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
                <td style="font-size:15px;height:100px;text-align: center;width:10%;">1.</td>
                <td style="font-size:13px;height:50px;text-align: center;width:50%;"><b>{{ $order['booking_transfer_type'] }} - ({{ $order['booking_from'] }} to {{ $order['booking_to'] }})</b></td>
                <td style="font-size:13px;height:50px;text-align: center;width:20%;"><b>AUD {{ round($book_price,2) }}</b></td>
                <td style="font-size:13px;height:50px;text-align: center;width:20%;"><b>AUD {{ round($gst_cutamount,2) }}</b></td>
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
        <table border="1" cellspacing="0" style="width: 100%;">
            <tr>
                <th colspan="3">Title</th>
                <th colspan="2">Description</th> 
            </tr>
            @if ($order['international_airport_pickup_nos'] > 0)
                <tr style="vertical-align: top; width:100%;">
                    <td colspan="3" style="font-size:13px;height:100px;text-align: center;width:50%;">International Airport Pickup Details:</td>

                    <td colspan="2" style="font-size:13px;height:100px;text-align: center;width:20%;">
                        <hr>
                        @foreach ($international_detail as $val)
                            <label>Flight No :</label> {{ $val->flight_no }}<br />
                            <label>Flight Time :</label> {{ $val->time }}<br />
                            <label>Flight Board Name :</label> {{ $val->board_name }}<br />
                            <hr>
                        @endforeach
                    </td>
                </tr>
            @endif
            <?php
                $international_airport_charge = $order['international_airport_pickup_nos'] * $v['international_airport_pickup_charges'];
            ?>
            <?php
                $domestic_airport_charge = $order['domestic_airport_pickup_nos'] * $v['domestic_airport_pickup_charges'];
            ?>
            <?php
                $extra_child_charge = $order['child_seat_nos'] * $v['child_seat_charges'];
            ?>
            <tr style="vertical-align: top; width:100%;">
                <td colspan="3" style="font-size:13px;height:100px;text-align: center;width:50%;"><b>International Airport Pickup x {{ $order['international_airport_pickup_no'] }}</b></td>
                <td colspan="2" style="font-size:13px;height:100px;text-align: center;width:20%;"><b>AUD {{ $international_airport_charge }}</b></td>
            </tr>
            @if ($order['domestic_airport_pickup_nos'] > 0)
                <tr style="vertical-align: top; width:100%;">
                    <td colspan="3" style="font-size:13px;height:100px;text-align: center;width:50%;">
                        Domestic Airport Pickup Details:</td>

                    <td colspan="2" style="font-size:13px;height:100px;text-align: center;width:20%;">
                        <hr>
                        @foreach ($domestic_detail as $val)
                            <label>Flight No :</label> {{ $val->flight_no }}<br />
                            <label>Flight Time :</label> {{ $val->time }}<br />
                            <label>Flight Board Name :</label> {{ $val->board_name }}<br />
                            <hr>
                        @endforeach
                    </td>
                </tr>
            @endif
            <tr style="vertical-align: top; width:100%;">
                <td colspan="3" style="font-size:13px;height:100px;text-align: center;width:50%;"><b>Domestic Airport Pickup x {{ $order['domestic_airport_pickup_nos'] }}:</b></td>
                <td colspan="2" style="font-size:13px;height:100px;text-align: center;width:20%;"><b>AUD {{ $domestic_airport_charge }}</b></td>
            </tr>
            <tr style="vertical-align: top; width:100%;">
                <td colspan="3" style="font-size:13px;height:100px;text-align: center;width:50%;"><b>Child Seat Charge x {{ $order['child_seat_nos'] }}:</b></td>
                <td colspan="2" style="font-size:13px;height:100px;text-align: center;width:20%;"><b>AUD {{ $extra_child_charge }}</b></td>
            </tr>
            <tr style="font-size:15px;">
                <td colspan="2">
                    
                </td>
                <td colspan="1" style="font-size:15px;text-align: center;">
                    Total Amount
                </td>
                <td colspan="2" style="font-size:15px;text-align: center;">
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
            <p><b style="color: rgba(218, 84, 51, 0.856);">This is computer generated booking details page no signature required.</b></p>
        </div>
        
    </div>
</body>

</html>
