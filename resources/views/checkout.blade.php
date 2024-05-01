@extends('layouts.app')

@section('content')
<section class="booking-steps-area mht">
    <div class="container">
        <div class="row">
            <div class="col-md-12 progressbar">
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
                    <li>
                        <span>4</span>	
                        <div class="icon">
                            <img src="{{ asset('frontend/images/booking/card.png') }}" alt="">
                        </div>
                        <div class="text">
                            DETAILS
                        </div>
                    </li>
                    <li class="active">
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
        <div class="col-md-12 mt20">
            <div class="ride_form" data-aos="fade-up">
                <div class="row text-right mt20">
                    <div class="col-md-12 ">
                        <label class="lp">Total Price *</label>
                        <input type="text" name="total_price" class="form-control text-right "
                            value="${{ $booking_details['total_price'] }}" disabled>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12 text-right mb30 mt10">
            
            @if (Session::has('error_msg'))
                <div class="text-center text-danger">{{Session::get('error_msg')}} </div>
            @elseif (Session::has('success_msg'))
                <div class="text-center text-success">{{Session::get('success_msg')}} </div>
            @endif
            @if (strtolower($booking_details['payment_status'])=='paid')
                <div class="text-center text-success">Thanks for booking with us, your booking payment done successfully.</div>
            @endif
            @if (strtolower($booking_details['payment_status'])!='paid')

                @if(env('PAYMENT_TYPE')=='STRIPE')
                <button type="button" class="btn common-btn" data-toggle="modal" data-target="#myPaymentModal">PAY</button>
                @elseif(env('PAYMENT_TYPE')=='PAYPAL')
                <form id="paypal-response-form" action="{{route('paypal-payment-process',$booking->booking_slug)}}" method="POST">
                    @csrf
                    <input type="hidden" name="orderID" id="paypal_order_id" />
                </form>
                <div id="paypal-button-container"></div>
                @elseif(env('PAYMENT_TYPE')=='SQUARE')
                    <div id="payment-form">
                        <div id="payment-status-container"></div>
                        <div id="card-container"></div>
                        <button id="card-button" type="button">Pay</button>
                        <input type="hidden" id="booking-slug" name="booking-slug" value="{{ $booking->booking_slug }}">
                    </div>
                @endif
            @endif 
            {{-- <a href="{{ route('make-payment',['slug' => $booking_details['booking_slug']]) }}"><button type="button" class="btn common-btn">PAY</button></a> --}}
        </div>
    </div>
</div>
@endsection 
@section('scripts')

    <script type="module">
        const payments = Square.payments('sandbox-sq0idb-MzHFX3Imu48ZDgtLOXR61g', 'LYQ8QF8RS568Z');
        const card = await payments.card();
        await card.attach('#card-container');

        const cardButton = document.getElementById('card-button');
        cardButton.addEventListener('click', async () => {
        const statusContainer = document.getElementById('payment-status-container');

        try {
            const result = await card.tokenize();
            if (result.status === 'OK') {
            console.log(`Payment token is ${result.token}`);
            statusContainer.innerHTML = "Payment Successful";

            var token = result.token;

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                var slug = $('#booking-slug').val();
            $.ajax({
                    url: '/payment-square',
                    type: 'POST',
                    data: {
                        token: token,
                        slug: slug,
                        // add any other payment details you want to send to the server
                    },
                    success: function(response) {
                        console.log(response);
                    },
                    error: function(xhr) {
                        console.log(xhr.responseText);
                    }
                });

            } else {
            let errorMessage = `Tokenization failed with status: ${result.status}`;
            if (result.errors) {
                errorMessage += ` and errors: ${JSON.stringify(
                result.errors
                )}`;
            }

            throw new Error(errorMessage);
            }
        } catch (e) {
            console.error(e);
            statusContainer.innerHTML = "Payment Failed";
        }
        });
    </script>

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