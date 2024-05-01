<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Email Template</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://kit.fontawesome.com/52009647a4.css" crossorigin="anonymous">
    <style type="text/css">
        body {
            font-family: Arial, sans-serif;
            font-size: 16px;
            line-height: 1.5;
            color: #333333;
            background-color: #f1f1f1;
            padding: 0;
            margin: 0;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
        }

        /* td {
   padding: 20px;
   text-align: left;
   vertical-align: top;
  } */
        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            margin-top: 0;
            margin-bottom: 0.5rem;
            color: #333333;
        }

        p {
            margin-top: 0;
            margin-bottom: 1rem;
            line-height: 1.5;
        }

        a {
            color: #007bff;
            text-decoration: none;
        }

        img {
            display: block;
            max-width: 100%;
            height: auto;
        }

        .btn {
            display: inline-block;
            font-weight: 400;
            color: #ffffff;
            background-color: #007bff;
            border: none;
            border-radius: 0.25rem;
            padding: 0.5rem 1rem;
            font-size: 1rem;
            line-height: 1.5;
            cursor: pointer;
            text-align: center;
            text-decoration: none;
            white-space: nowrap;
        }

        .btn:hover {
            background-color: #0069d9;
            color: #ffffff;
        }
    </style>
</head>

<body>
    <div class="container" style="border:solid rgb(210, 206, 206) 1px;">
      <table>
        <tr>
            <td>
                <img src="{{ $message->embed(public_path() . '/frontend/images/logo.png') }}" height="90px;"
                    style="padding-left: 204px; margin-bottom: 24px;">
            </td>
        </tr>
        <tr>
            <td>
                <svg viewbox="1 -11 511.99988 511" xmlns="http://www.w3.org/2000/svg"
                    style="fill:#2bbd2b;width: 110px;">
                    <path
                        d="m507.949219 232.933594-42.386719-56.027344 1.367188-70.25c.175781-8.953125-5.625-16.929688-14.199219-19.527344l-67.246094-20.367187-40.125-57.679688c-5.121094-7.363281-14.515625-10.417969-22.992187-7.46875l-66.367188 23.09375-66.371094-23.09375c-8.46875-2.945312-17.867187.101563-22.988281 7.46875l-40.125 57.679688-67.246094 20.367187c-8.574219 2.597656-14.375 10.574219-14.199219 19.527344l1.367188 70.25-42.386719 56.027344c-5.402343 7.136718-5.402343 16.996094 0 24.132812l42.386719 56.027344-1.367188 70.25c-.175781 8.953125 5.625 16.933594 14.199219 19.527344l67.246094 20.371094 40.125 57.675781c5.121094 7.363281 14.515625 10.417969 22.988281 7.46875l66.371094-23.09375 66.371094 23.09375c8.46875 2.945312 17.867187-.101563 22.988281-7.46875l40.125-57.679688 67.246094-20.367187c8.574219-2.597656 14.375-10.574219 14.199219-19.527344l-1.367188-70.25 42.386719-56.027344c5.402343-7.136718 5.402343-16.996094 0-24.132812zm-78.464844 61.550781c-2.707031 3.582031-4.132813 7.96875-4.046875 12.457031l1.207031 62.039063-59.40625 17.992187c-4.308593 1.304688-8.050781 4.023438-10.621093 7.71875l-35.429688 50.933594-58.613281-20.394531c-4.257813-1.484375-8.890625-1.484375-13.148438 0l-58.613281 20.394531-35.429688-50.933594c-2.570312-3.695312-6.3125-6.414062-10.621093-7.71875l-59.40625-17.992187 1.207031-62.039063c.085938-4.488281-1.339844-8.875-4.046875-12.453125l-37.4375-49.488281 37.4375-49.484375c2.710937-3.582031 4.136719-7.96875 4.046875-12.457031l-1.207031-62.039063 59.40625-17.992187c4.308593-1.304688 8.050781-4.023438 10.621093-7.71875l35.429688-50.933594 58.617188 20.394531c4.253906 1.480469 8.886718 1.480469 13.144531 0l58.613281-20.394531 35.433594 50.933594c2.570312 3.691406 6.3125 6.414062 10.617187 7.71875l59.40625 17.992187-1.207031 62.039063c-.085938 4.488281 1.339844 8.875 4.046875 12.453125l37.4375 49.488281zm-70.554687-122.816406c7.808593 7.808593 7.808593 20.472656 0 28.285156l-118.382813 118.378906c-7.792969 7.792969-20.464844 7.820313-28.285156 0l-59.191407-59.1875c-7.808593-7.8125-7.808593-20.476562 0-28.285156 7.8125-7.8125 20.476563-7.8125 28.285157 0l45.050781 45.046875 104.238281-104.238281c7.808594-7.8125 20.472657-7.8125 28.285157 0zm0 0">
                    </path>
                </svg>
            </td>
        </tr>
        <tr>
            <td>
                <h2>Hi {{ $data['user'] }},</h2>
                <h3 class="title">Thank You</h3>
            </td>
        </tr>
        <tr>
            <td>
                <p style="color: #cba230;">{{env('BOOKING_PENDING_TEXT')}}</p>
                <p style="color:#cba230;">Transaction ID:<span
                        style="color: black;"><b>{{ $data['booking_slug'] }}</b></span></p>
            </td>
        </tr>
        <tr>
            <td>
                <div style="border-top:1px solid #777;height:1px;margin-top: 20px;"></div>
            </td>
        </tr>
    </table>
    <table style="margin-top:30px;">
        <tr>
            <td>
                <div
                    style="background-color: #f8f8f8; border-radius: 10px; box-shadow: 0 2px 2px rgba(0, 0, 0, 0.1); padding: 20px;">
                    <h5
                        style="font-size: 16px; font-weight:600;color: #000; line-height: 16px; padding-bottom: 13px; border-bottom: 1px solid #e6e8eb; letter-spacing: -0.65px; margin-top:0; margin-bottom: 13px;">
                        BOOKING FROM</h5>
                    <p
                        style="text-align: left;font-weight: normal; font-size: 14px; color: #aba8a8;line-height: 21px;    margin-top: 0;">
                        {{ $data['booking_from'] }}</p>
                </div>
            </td>
            <td>
                <img src="{{ $message->embed(public_path() . '/admin/assets/images/email-template/space.jpg') }}"
                    alt=" " height="25" width="20">
            </td>
            <td>
                <div
                    style="background-color: #f8f8f8; border-radius: 10px; box-shadow: 0 2px 2px rgba(0, 0, 0, 0.1); padding: 20px;">
                    <h5
                        style="font-size: 16px;font-weight: 600;color: #000; line-height: 16px; padding-bottom: 13px; border-bottom: 1px solid #e6e8eb; letter-spacing: -0.65px; margin-top:0; margin-bottom: 13px;">
                        BOOKING TO</h5>
                    <p
                        style="text-align: left;font-weight: normal; font-size: 14px; color: #aba8a8;line-height: 21px;    margin-top: 0;">
                        {{ $data['booking_to'] }}</p>
                </div>
            </td>
        </tr>
    </table>
    <table style="margin-top:20px;">
        <tbody>
            <tr>
                <td style="text-align: center;background-color:f8f8f8;border-radius: 10px;">
                    <h3 class="title">YOUR ORDER DETAILS</h3>
                </td>
            </tr>
        </tbody>
    </table>

    <table border="1" cellpadding="0" cellspacing="0" align="center"
        style="margin-top: 20px; margin-bottom: 30px;border-radius: 10px;border:solid black 1px; border-collapse:separate;">
        <?php
        $international_airport_charge = $data['international_airport_pickup_nos'] * $data['international_airport_pickup_charges'];
        ?>
        <tbody>
            <tr align="center" style="border:solid rgb(81, 78, 78);">
                <th>VEHICLE</th>
                <th style="padding-left: 15px;">DESCRIPTION</th>
                <th>PRICE </th>
            </tr>
            <tr style="border:solid rgb(81, 78, 78);">
                <td><img src="{{ asset('uploads/vehicle/' . $data['vehicle_type_image']) }}" alt=""
                        width="130"></td>
                <td valign="top" style="padding-left: 15px;">
                    <h5 style="margin-top: 15px;">Vehicle Name : {{ $data['vehicle_type'] }} <br>
                        {{ $data['vehicle_type_description'] }}
                    </h5>
                </td>
                <td valign="top" style="padding-left: 15px;">
                    <h5 style="font-size: 14px; color:#444;margin-top:15px"><b>${{ $data['total_cost'] }}</b></h5>
                </td>
            </tr>
            @if ($data['international_airport_pickup_nos'] > 0)
                <tr style="border:solid rgb(81, 78, 78);">
                    <td colspan="2"
                        style="line-height: 49px;font-size: 13px;color: #000000;padding-left: 20px;text-align:left;">
                        International Airport Pickup Details:</td>

                    <td colspan="3"
                        style="line-height: 49px;text-align: right;padding-right: 28px;font-size: 13px;color: #000000;text-align:right;border-left: unset;">
                        <hr>
                        @foreach (json_decode($data['international_airport_pickup_detail']) as $val)
                            <label>Flight No :</label> {{ $val->flight_no }}<br />
                            <label>Flight Time :</label> {{ $val->time }}<br />
                            <label>Flight Board Name :</label> {{ $val->board_name }}<br />
                            <hr>
                        @endforeach
                    </td>
                </tr>
            @endif
            <tr>
                <td colspan="2"
                    style="line-height: 49px;font-size: 13px;color: #000000;padding-left: 20px;text-align:left;">
                    International Airport Pickup x {{ $data['international_airport_pickup_nos'] }}:</td>
                <?php
                $international_airport_charge = $data['international_airport_pickup_nos'] * $data['international_airport_pickup_charges'];
                ?>

                <td colspan="3"
                    style="line-height: 49px;text-align: right;padding-right: 28px;font-size: 13px;color: #000000;text-align:right;border-left: unset;">
                    <b>${{ $international_airport_charge }}</b></td>
            </tr>
            @if ($data['domestic_airport_pickup_nos'] > 0)
                <tr>
                    <td colspan="2"
                        style="line-height: 49px;font-size: 13px;color: #000000;padding-left: 20px;text-align:left;">
                        Domestic Airport Pickup Details:</td>

                    <td colspan="3"
                        style="line-height: 49px;text-align: right;padding-right: 28px;font-size: 13px;color: #000000;text-align:right;border-left: unset;">
                        <hr>
                        @foreach (json_decode($data['domestic_airport_pickup_detail']) as $val)
                            <label>Flight No :</label> {{ $val->flight_no }}<br />
                            <label>Flight Time :</label> {{ $val->time }}<br />
                            <label>Flight Board Name :</label> {{ $val->board_name }}<br />
                            <hr>
                        @endforeach
                    </td>
                </tr>
            @else
                <tr>
                    <td colspan="2"
                        style="line-height: 49px;font-family: Arial;font-size: 13px;color: #000000;padding-left: 20px;text-align:left;">
                        Domestic Airport Pickup x {{ $data['domestic_airport_pickup_nos'] }}:</td>
                    <?php
                    $domestic_airport_charge = $data['domestic_airport_pickup_nos'] * $data['domestic_airport_pickup_charges'];
                    ?>
                    <td colspan="3"
                        style="line-height: 49px;text-align: right;padding-right: 28px;font-size: 13px;color: #000000;text-align:right;border-left: unset;">
                        <b>${{ $domestic_airport_charge }}</b></td>
                </tr>
                <tr>
                    <td colspan="2"
                        style="line-height: 49px;font-size: 13px;color: #000000;padding-left: 20px;text-align:left;">
                        Child Seat Charge x {{ $data['child_seat_nos'] }}:</td>
                    <?php
                    $extra_child_charge = $data['child_seat_nos'] * $data['child_seat_charges'];
                    ?>
                    <td colspan="3"
                        style="line-height: 49px;text-align: right;padding-right: 28px;font-size: 13px;color: #000000;text-align:right;border-left: unset;">
                        <b>${{ $extra_child_charge }}</b></td>
                </tr>
            @endif
        </tbody>
    </table>
    <?php
    $gst = $data['vehicle_estimated_price'] / 1.1;
    $gst_cutamount = $data['vehicle_estimated_price'] - $gst;
    $book_price = $data['vehicle_estimated_price'] - $gst_cutamount;
    ?>
    <table border="1" cellpadding="0" cellspacing="0" align="center"
        style="margin-top: 20px; margin-bottom: 30px;border-radius: 10px;border:solid black 1px; border-collapse:separate;">
        <tr>
            <td style="line-height: 49px;font-size: 13px;color: #000000;padding-left: 20px;text-align:left;">Subtotal
                (Before GST):</td>
            <td
                style="line-height: 49px;text-align: right;padding-right: 28px;font-size: 13px;color: #000000;text-align:right;">
                <b>${{ round($book_price, 2) }}</b></td>
        </tr>
        <tr>
            <td style="line-height: 49px;font-size: 13px;color: #000000;padding-left: 20px;text-align:left;">TAX (GST):
            </td>
            <td
                style="line-height: 49px;text-align: right;padding-right: 28px;font-size: 13px;color: #000000;text-align:right;">
                <b>${{ round($gst_cutamount, 2) }}</b></td>
        </tr>
        <tr>
            <td style="line-height: 49px;font-size: 13px;color: #000000;padding-left: 20px;text-align:left;">Discount:
            </td>
            <td
                style="line-height: 49px;text-align: right;padding-right: 28px;font-size: 13px;color: #000000;text-align:right;">
                <b>$0</b></td>
        </tr>
        <tr>
            <td style="line-height: 49px;font-size: 13px;color: #000000;padding-left: 20px;text-align:left;">Total:</td>
            <td
                style="line-height: 49px;text-align: right;padding-right: 28px;font-size: 13px;color: #000000;text-align:right;">
                <b>${{ $data['vehicle_estimated_price'] }}</b></td>
        </tr>
    </table>
    <table style="margin-top:20px;">
        <tbody>
            <tr>
                <td style="text-align: center;background-color:f8f8f8;border-radius: 10px;">
                    <h2 class="title">Follow Us</h2>
                </td>
            </tr>
        </tbody>
    </table>
    <table>
        <tr>
            <td style="text-align: center;">
                <div style="display: inline-flex;">
                    <a href="#"><img
                            src="{{ $message->embed(public_path() . '/frontend/images/facebook.png') }}" alt=""
                            style="height: 50px; width: 50px;"></a>
                    <a href="#"><img
                            src="{{ $message->embed(public_path() . '/frontend/images/insta.png') }}" alt=""
                            style="height: 50px; width: 50px;"></a>
                </div>
            </td>
        </tr>
        <tr>
            <td style="text-align: center;">
                <p><b>© 2023 Grandeur Chauffuers, All Rights Reserved</b></p>
            </td>
        </tr>
    </table>
    </div>
</body>
</html>
