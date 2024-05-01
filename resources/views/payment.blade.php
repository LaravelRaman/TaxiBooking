@extends('layouts.app')

@section('content')
<section class="booking-steps-area mht">
    <div class="container" style="margin-top: 30px;">
        <div class="row">
            <div class="col-sm-12 progressbar">
                <ul class="booking-steps">
                    <li>
                        <span>1</span>	
                        <div class="icon">
                            <img src="{{ asset('frontend/images/booking/car.png') }}" alt="">				    		
                        </div>
                        <div class="text">
                            CAR CLASS
                        </div>
                    </li>
                    <li>
                        <span>2</span>	
                        <div class="icon">
                            <img src="{{ asset('frontend/images/booking/options.png') }}" alt="">
                        </div>
                        <div class="text">
                            OPTIONS
                        </div>
                    </li>
                    <li>
                        <span>3</span>	
                        <div class="icon">
                            <img src="{{ asset('frontend/images/booking/login.png') }}" alt="">
                        </div>
                        <div class="text">
                            LOGIN
                        </div>
                    </li>
                    <li class="active">
                        <span>4</span>	
                        <div class="icon">
                            <img src="{{ asset('frontend/images/booking/card.png') }}" alt="">
                        </div>
                        <div class="text">
                            DETAILS
                        </div>
                    </li>
                    <li>
                        <span>5</span>	
                        <div class="icon">
                            <img src="{{ asset('frontend/images/booking/check-out.png') }}" alt="">
                        </div>
                        <div class="text">
                            CHECK OUT
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>
<div class="row">
    <div class="container">
        @if (Session::has('error'))
            <font color="red">{{ Session::get('error') }}</font>
        @endif
        <div class="row">
            @php
                $total_cost = $vhls['travel_cost'];
                $extra_cost = 0;
            @endphp
            <div class="col-sm-12" style="margin-bottom: 50px;">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="template-title center">
                            <h1>Booking Details</h1>
                            <span>DETAILS</span>
                            <p>We recommend you to verify and proceed to payment.</p>
                        </div>
                    </div>
                </div>
                @if (strtolower($booking_details['payment_status'])=='paid')
                    <div class="text-center text-success">Thanks for booking with us, your booking payment done successfully.</div>
                @endif
                <div class="col-sm-12 mt20 card details-card-web details-card" style="">
                    <div class="ride_form" data-aos="fade-up">

                        <div class="row head">
                            <div class="col-sm-12">
                                <h2>YOUR DETAILS</h2>
                            </div>
                        </div>
                        
                        <div class="row mt20">
                            <div class="col-sm-6">
                                <label class="" style="text:black;">Name</label>
                                <input type="text" class="form-control"
                                    value="{{ $booking_details['user'] ? $booking_details['user']['name'] : '' }}" disabled>
                            </div>
                            <div class="col-md-6">
                                <label class="" style="text:black;">Phone</label>
                                <input type="text" class="form-control"
                                    value="{{ $booking_details['user'] ? $booking_details['user']['phone'] : '' }}" disabled>
                            </div>
                        </div>

                        <div class="row mt20">
                            <div class="col-sm-6">
                                <label class="" style="text:black;">Email</label>
                                <input type="text" class="form-control"
                                    value="{{ $booking_details['email'] ? $booking_details['user']['email'] : '' }}" disabled>
                            </div>
                            <div class="col-sm-6">
                                <label class="" style="text:black;">ABN Number</label>
                                <input type="text" class="form-control"
                                    value="{{ $booking_details['user'] ? $booking_details['user']['abn_number'] : '' }}" disabled>
                            </div>
                            
                        </div>
                        <div class="row mt-20">
                            <div class="col-sm-12">
                                <label class="" style="text:black;">ABN Number</label>
                                <textarea name="" class="form-control" cols="30" rows="10" disabled>{{ $booking_details['user'] ? $booking_details['user']['billing_addr'] : '' }}</textarea>
                            </div>
                            <div class="col-sm-6 mt10">
                                <label class="" style="text:black;">Book For:</label>
                                <input type="radio" class="" name="booking_for"
                                    onclick="$('#dv_booking_for').hide();" value="me"
                                    {{ $booking_details_extra['booking_for'] == 'me' ? 'checked' : '' }} disabled>Me
                                <input type="radio" class="" name="booking_for"
                                    onclick="$('#dv_booking_for').show();" value="other"
                                    {{ $booking_details_extra['booking_for'] == 'other' ? 'checked' : '' }}
                                    disabled>Someone/Company
                            </div>
                        </div>
                    </div>
                </div>



                @if ($booking_details_extra['booking_for'] == 'other')
                    <div class="col-sm-12 mt20" id="dv_booking_for">
                        <div class="ride_form" data-aos="fade-up">

                            <div class="row head">
                                <div class="col-sm-12">
                                    <h2>BOOKING DETAILS</h2>
                                </div>
                            </div>
                            <div class="row mt20">
                                <div class="col-sm-6">
                                    <label class="" style="text:black;">Person/Company Name</label>
                                    <input type="text" name="company_person" class="form-control"
                                        value="{{ $booking_details_extra['company_person'] }}" disabled>
                                </div>
                                <div class="col-sm-6">
                                    <label class="" style="text:black;">Phone</label>
                                    <input type="text" name="other_phone_number" class="form-control"
                                        value="{{ $booking_details_extra['other_phone_number'] }}" disabled>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <label class="" style="text:black;">Email</label>
                                    <input type="email" name="other_email" class="form-control"
                                        value="{{ $booking_details_extra['other_email'] }}" disabled>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
                @if ($booking_details['is_international_airport_pickup_charges'] == 1)
                    <div class="col-sm-12 mt20 card" style="margin-top: 20px;margin-bottom: 30px; padding: 40px; background-color: #fff3d62e;">
                        <div class="ride_form" data-aos="fade-up">

                            <div class="row head">
                                <div class="col-sm-12">
                                    <h2>INTERNATIONAL AIRPORT PICKUP DETAILS</h2>
                                </div>
                            </div>
                            @for ($i = 0; $i < $booking_details['international_airport_pickup_nos']; $i++)
                                <div class="row mt20">
                                    <div class="col-sm-3">
                                        <label class="" style="text:black;">Flight No.
                                            {{ $i + 1 }}</label>
                                        <input type="text" name="i_flight[number][]"
                                            id="i_flight_no_{{ $i }}" class="form-control"
                                            value="{{ $booking_details_extra['international_flight_detail'][$i]['flight_no'] }}"
                                            disabled>
                                    </div>
                                    <div class="col-sm-3">
                                        <label class="" style="text:black;">Title. {{ $i + 1 }}</label>
                                        <select type="text" name="i_flight[title][]"
                                            id="i_title_{{ $i }}" class="form-control"
                                            value="{{ $booking_details_extra['international_flight_detail'][$i]['title'] }}"
                                            disabled>
                                            <option value="Mr"
                                                {{ $booking_details_extra['international_flight_detail'][$i]['title'] == 'Mr' ? 'selcted' : '' }}>
                                                Mr.</option>
                                            <option value="Mrs"
                                                {{ $booking_details_extra['international_flight_detail'][$i]['title'] == 'Mrs' ? 'selcted' : '' }}>
                                                Mrs.</option>
                                            <option value="Ms"
                                                {{ $booking_details_extra['international_flight_detail'][$i]['title'] == 'Ms' ? 'selcted' : '' }}>
                                                Ms.</option>
                                            <option value="Dr"
                                                {{ $booking_details_extra['international_flight_detail'][$i]['title'] == 'Dr' ? 'selcted' : '' }}>
                                                Dr.</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-3">
                                        <label class="" style="text:black;">Name on Board
                                            {{ $i + 1 }}</label>
                                        <input type="text" class="form-control" name="i_flight[board_name][]"
                                            id="i_name_{{ $i }}"
                                            value="{{ $booking_details_extra['international_flight_detail'][$i]['board_name'] }}"
                                            disabled>
                                    </div>
                                    <div class="col-sm-3">
                                        <label class="" style="text:black;">Pickup Time
                                            {{ $i + 1 }}</label>
                                        <input type="text" class="form-control" name="i_flight[time][]"
                                            id="i_time_{{ $i }}"
                                            value="{{ $booking_details_extra['international_flight_detail'][$i]['time'] }}"
                                            disabled>
                                    </div>
                                </div>
                            @endfor
                        </div>
                    </div>
                @endif
                @if ($booking_details['is_domestic_airport_pickup_charges'] == 1)
                    <div class="col-sm-12 card" style="margin-top: 20px;margin-bottom: 30px; padding: 40px; background-color: #fff3d62e;">
                        <div class="ride_form" data-aos="fade-up">

                            <div class="row head">
                                <div class="col-sm-12">
                                    <h2>DOMESTIC AIRPORT PICKUP DETAILS</h2>
                                </div>
                            </div>
                            @for ($i = 0; $i < $booking_details['domestic_airport_pickup_nos']; $i++)
                                <div class="row mt20">
                                    <div class="col-sm-3">
                                        <label class="" style="text:black;">Flight No.
                                            {{ $i + 1 }}</label>
                                        <input type="text" name="d_flight[number][]"
                                            id="d_flight_no_{{ $i }}" class="form-control"
                                            value="{{ $booking_details_extra['domestic_flight_detail'][$i]['flight_no'] }}"
                                            disabled>
                                    </div>
                                    <div class="col-sm-3">
                                        <label class="" style="text:black;">Title. {{ $i + 1 }}</label>
                                        <select name="d_flight[title][]" id="d_title_{{ $i }}"
                                            class="form-control"
                                            value="{{ $booking_details_extra['domestic_flight_detail'][$i]['title'] }}"
                                            disabled>
                                            <option value="Mr">Mr.</option>
                                            <option value="Mrs">Mrs.</option>
                                            <option value="Ms">Ms.</option>
                                            <option value="Dr">Dr.</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-3">
                                        <label class="" style="text:black;">Name on Board
                                            {{ $i + 1 }}</label>
                                        <input type="text" class="form-control" name="d_flight[board_name][]"
                                            id="d_name_{{ $i }}"
                                            value="{{ $booking_details_extra['domestic_flight_detail'][$i]['board_name'] }}"
                                            disabled>
                                    </div>
                                    <div class="col-sm-3">
                                        <label class="" style="text:black;">Pickup Time
                                            {{ $i + 1 }}</label>
                                        <input type="text" class="form-control" name="d_flight[time][]"
                                            id="d_time_{{ $i }}"
                                            value="{{ $booking_details_extra['domestic_flight_detail'][$i]['time'] }}"
                                            disabled>
                                    </div>
                                </div>
                            @endfor
                        </div>
                    </div>
                @endif

                <div style="padding: 10px 10px;">
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
                    <table border="0" cellspacing="0" style="width: 100%;height:auto;">
                        <tr style="">
                            <td style="width:50%;padding-left: 0px;">
                                <div class="card" style="padding: 20px; font-size: 40px; margin-bottom: 20px;">
                                    <b style="margin-bottom: 20px; color:black;">Details</b>
                                    <div class="card-body" style="font-size:15px;">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <b>PICKUP DATE,TIME</b> <br> <span>{{ $booking_details['booking_date'] }},{{ $booking_details['booking_time'] }}</span><br>
                                                <b>VEHICLE</b> <br> <span>{{ $vhls['vehicle_type'] }}: {{ $vhls['vehicle_type_description'] }}</span><br>
                                                <b>FROM</b> <br> {{ $booking_details['booking_from'] }} <br>
                                                @if(!empty($booking_details['waypoint']))
                                                    @php $waypoints=json_decode($booking_details['waypoint'],TRUE);@endphp
                                                    <b>Waypoint</b> <br>      
                                                    @for($wi=1;$wi<=$waypoints['total_waypoints'];$wi++)
                            
                                                        <br />{{ $wi.". ".$waypoints['booking_waypoint_'.$wi] }}

                                                    @endfor <br>
                                                @endif
                                                <b>TO</b> <br> {{ $booking_details['booking_to'] }} <br>
                                                @if(!empty($booking_details['booking_transfer_type']) && $booking_details['booking_transfer_type']=='Return Trip')
                                                    <b>Return date, time</b> <br> {{ $booking_details['return_date'],$booking_details['return_time'] }} <br>
                                                @endif
                                                @if(false && $booking_details['booking_transfer_type']!='Hourly Rate')
                                                    <b>Service type</b> <br> {{ $booking_details['booking_transfer_type']=='Hourly Rate'?'Hourly Rate':'Distance wise Rate' }} <br>
                                                @endif
                                                @if($booking_details['booking_transfer_type']=='Hourly Rate')
                                                    <b>Booking Hours</b> <br> {{ $booking_details['extra_hours_nos'] }} hours <br>
                                                @else
                                                    @if($booking_details['extra_hours_nos']>0)
                                                    <b>Extra time</b> <br> {{ $booking_details['extra_hours_nos'] }} hours <br>
                                                    @endif
                                                    <b>TOTAL DISTANCE</b> <br> {{ $booking_details['distance'] }} km <br>

                                                    <b>TOTAL TIME</b> <br> {{ floor($booking_details['duration'] / 3600) + $booking_details['extra_hours_nos'] }} h
                                                    {{ $booking_details['duration'] % 60 }} m <br>

                                                @endif
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="car-choose">
                                                    <img src="{{ asset('frontend/images/booking/car-01.jpg') }}" alt="" style="margin-top: 127px;">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="card-footer" style="font-size:15px;color:black;text-align:right;">
                                        <b style="margin-bottom: 20px; color:black;font-size: 20px;">PRODRIVE</b><br>
                                        ABN No. : 19 645 379 102<br>
                                        License Code : BSP-416641
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
                    
                </div>

                <div class="col-sm-12 mt20">
                    <div class="ride_form" data-aos="fade-up">
                        <div class="row text-right mt20">
                            <div class="col-sm-12 ">
                                <label class="lp">Total Price *</label>
                                <input type="text" name="total_price" class="form-control text-right "
                                    value="AUD {{ $total_cost }}" disabled>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 text-right mb30 mt10">
        
                    <a href="{{ route('checkout',['slug'=>$booking_details['booking_slug']]) }}"><button class="btn btn-raised btn-primary">PROCEED TO CHECKOUT</button></a>
                    {{-- <a href="{{ route('make-payment',['slug' => $booking_details['booking_slug']]) }}"><button type="button" class="btn common-btn">PAY</button></a> --}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 
@section('scripts')

    <link rel="stylesheet" type="text/css" href="https://www.paypalobjects.com/webstatic/en_US/developer/docs/css/cardfields.css"/>
    @if (strtolower($booking_details['payment_status'])!='paid')
    <script src="https://api.payway.com.au/rest/v1/payway.js"></script>

    <script>
        var submit = document.getElementById('payway-cc-submit');
        payway.createCreditCardFrame({
            publishableApiKey: 'T17261_PUB_fknui66vpj5gdht78r29i97fnp5jzvcxqa24mhxcq8hhhrv44pgw59bkvmvq',
            onValid: function() {
                submit.disabled = false;
            },
            onInvalid: function() {
                submit.disabled = true;
            }
        });
    </script>
   
    <script src="https://www.paypal.com/sdk/js?client-id={{env('PAYPAL_CLIENT_ID')}}&locale=en_AU&currency=USD"></script>

    <script>
        $(function() {
            paypal.Buttons({
                
            createOrder: function(data, actions) {
                return actions.order.create({
                    purchase_units: [{
                        reference_id: "{{$booking->booking_slug}}",
                        description: "{{$booking->booking_slug}}",

                        custom_id: "CUST-{{$booking_details['booking_by']}}",
                        soft_descriptor: "{{$booking->customer->name}}",
                        amount: {
                            currency_code: "USD",
                            value: "{{$booking->total_price}}",
                            
                        },
                        
                        @if(false)
                        shipping: {
                            method: "United States Postal Service",
                            address: {
                                @php 
                                

                                @endphp
                                name: {
                                    full_name: "{{$booking->customer->name}}",
                                    surname: ""
                                },
                                address_line_1: "",
                                address_line_2: "",
                                admin_area_2: "",
                                admin_area_1: "",
                                postal_code: "",
                                country_code: "AU"
                            }
                        }
                        @endif
                    }]
                })
            },
            onApprove: function(data, actions) {
                return actions.order.capture().then(function(details) {
                    alert('Transaction completed by ' + details.payer.name.given_name)
                    // Call your server to save the transaction
                    $('#paypal_order_id').val(data.orderID);
                    $('#paypal-response-form').submit();

                    /*return fetch('{{route('paypal-payment-process',$booking->booking_slug)}}', {
                        method: 'post',
                        headers: {
                            "Authorization":$`Bearer ${localStorage.getItem("token")}`,
                            'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content'),
                            'Cache-Control': 'no-cache, no-store, must-revalidate', 
                            'Pragma': 'no-cache', 
                            'Expires': '0'
                        },
                        body: JSON.stringify({
                            orderID: data.orderID,
                        })
                    })*/
                })
            }
        }).render('#paypal-button-container')
    });
    </script>

    <script type="text/javascript" src="https://js.stripe.com/v2/"></script>
    <script type="text/javascript">
        $(function() {
            var $form = $(".require-validation");
            $('form.require-validation').bind('submit', function(e) {
                var $form = $(".require-validation"),
                    inputSelector = ['input[type=email]', 'input[type=password]',
                        'input[type=text]', 'input[type=file]',
                        'textarea'
                    ].join(', '),
                    $inputs = $form.find('.required').find(inputSelector),
                    $errorMessage = $form.find('div.error'),
                    valid = true;
                $errorMessage.addClass('hide');
                $('.has-error').removeClass('has-error');
                $inputs.each(function(i, el) {
                    var $input = $(el);
                    if ($input.val() === '') {
                        $input.parent().addClass('has-error');
                        $errorMessage.removeClass('hide');
                        e.preventDefault();
                    }
                });
                if (!$form.data('cc-on-file')) {
                    e.preventDefault();
                    Stripe.setPublishableKey($form.data('stripe-publishable-key'));
                    Stripe.createToken({
                        number: $('.card-number').val(),
                        cvc: $('.card-cvc').val(),
                        exp_month: $('.card-expiry-month').val(),
                        exp_year: $('.card-expiry-year').val()
                    }, stripeResponseHandler);
                }
            });

            function stripeResponseHandler(status, response) {
                if (response.error) {
                    $('.error')
                        .removeClass('hide')
                        .find('.alert')
                        .text(response.error.message);
                } else {
                    /* token contains id, last4, and card type */
                    var token = response['id'];
                    $form.find('input[type=text]').empty();
                    $form.append("<input type='hidden' name='stripeToken' value='" + token + "'/>");
                    $form.get(0).submit();
                }
            }
        });
    </script>
    @endif
@endsection