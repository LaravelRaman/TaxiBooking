@extends('layouts.app')

@section('content')
    <!-- Start Booking Steps Area -->
    <div class="booking-step booking-step-1">
        <section class="booking-steps-area mht">
            <div class="container" style="margin-top: 30px;">
                <div class="row">
                    <div class="col-sm-12 progressbar">
                        <ul class="booking-steps">
                            <li class="active">
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
                                    VEHICLE
                                </div>
                            </li>
                            <li>
                                <span>3</span>
                                <div class="icon">
                                    <img src="{{ asset('frontend/images/booking/login.png') }}" alt="">
                                </div>
                                <div class="text">
                                    OPTIONS
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
        <div class="row" stye="width:100%; height:600px;">
            <div class="col-sm-4 booking-form">
                <section class="summary-bar-area">
                    <div class="container">
                        <div class="row" style="margin: 40px;">
                            <div class="col-sm-12">
                                <ul>
                                    <li style="width: 100%;">
                                        <div class="info">
                                            Pick Up Address
                                        </div>
                                        <input type="text" class="form-control booking-fields" id="booking_from_location"
                                            onchange="clear_lat(this)" placeholder="Enter a location"
                                            value="{{ $booking_details != null && !empty($booking_details['booking_from_location']) ? $booking_details['booking_from_location'] : '' }}"
                                            style="background-color: white;" />
                                        <input type="hidden" id="origin" name="origin"
                                            value="{{ $booking_details != null && !empty($booking_details['origin']) ? $booking_details['origin'] : '' }}"
                                            required />
                                    </li>
                                    @php
                                    $total_waypoints = $booking_details != null && !empty($booking_details['total_waypoints']) ? $booking_details['total_waypoints'] : '0';
                                    @endphp
                                    <div class="row mt20" id="dv_way_point_1"
                                        style="{{ $total_waypoints < 1 ? 'display:none;' : '' }}">
                                        <div class="col-md-12">
                                            <label class="lp">Way Point 1 <a href="javascript:;"
                                                    onclick="delete_waypoint();" id="a_remove_waypoint_1"
                                                    class="text-danger">Remove Waypoint</a></label>
                                            <input type="text" class="form-control booking-fields" id="booking_waypoint_1"
                                                onchange="clear_lat(this)" placeholder="Enter a Waypoint"
                                                value="{{ $booking_details != null && !empty($booking_details['booking_waypoint_1']) ? $booking_details['booking_waypoint_1'] : '' }}" />
                                            <input type="hidden" id="waypoint_1" name="waypoint_1"
                                                value="{{ $booking_details != null && !empty($booking_details['waypoint_1']) ? $booking_details['waypoint_1'] : '' }}"
                                                required />
                                        </div>
                                    </div>
                                    <div class="row mt20" id="dv_way_point_2"
                                        style="{{ $total_waypoints < 2 ? 'display:none;' : '' }}">
                                        <div class="col-md-12">
                                            <label class="lp">Way Point 2 <a href="javascript:;"
                                                    onclick="delete_waypoint();" id="a_remove_waypoint_2"
                                                    class="text-danger">Remove Waypoint</a></label>
                                            <input type="text" class="form-control booking-fields" id="booking_waypoint_2"
                                                onchange="clear_lat(this)" placeholder="Enter a Waypoint"
                                                value="{{ $booking_details != null && !empty($booking_details['booking_waypoint_2']) ? $booking_details['booking_waypoint_2'] : '' }}" />
                                            <input type="hidden" id="waypoint_2" name="waypoint_2"
                                                value="{{ $booking_details != null && !empty($booking_details['waypoint_2']) ? $booking_details['waypoint_2'] : '' }}"
                                                required />
                                        </div>
                                    </div>
                                    <div class="row mt20" id="dv_way_point_3"
                                        style="{{ $total_waypoints < 3 ? 'display:none;' : '' }}">
                                        <div class="col-md-12">
                                            <label class="lp">Way Point 3 <a href="javascript:;"
                                                    onclick="delete_waypoint();" id="a_remove_waypoint_3"
                                                    class="text-danger">Remove Waypoint</a></label>
                                            <input type="text" class="form-control booking-fields" id="booking_waypoint_3"
                                                onchange="clear_lat(this)" placeholder="Enter a Waypoint"
                                                value="{{ $booking_details != null && !empty($booking_details['booking_waypoint_3']) ? $booking_details['booking_waypoint_3'] : '' }}" />
                                            <input type="hidden" id="waypoint_3" name="waypoint_3"
                                                value="{{ $booking_details != null && !empty($booking_details['waypoint_3']) ? $booking_details['waypoint_3'] : '' }}"
                                                required />
                                        </div>
                                    </div>
                                    <li style="width: 100%;">
                                        <div class="col-md-12 text-right">
                                            <a href="javascript:;" id="a_dv_add_waypoint" style="color:white;">Add
                                                Waypoint</a>
                                        </div>
                                        <div class="info">
                                            Drop Off Address
                                        </div>
                                        <input type="text" class="form-control booking-fields" id="booking_to_location"
                                            onchange="clear_lat(this)" placeholder="Enter a location"
                                            value="{{ $booking_details != null && !empty($booking_details['booking_to_location']) ? $booking_details['booking_to_location'] : '' }}"
                                            style="background-color: white;" />
                                        <input type="hidden" id="destination" name="destination"
                                            value="{{ $booking_details != null && !empty($booking_details['destination']) ? $booking_details['destination'] : '' }}"
                                            required />
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
            <div class="col-sm-6" style="margin-top: -104px;">
                <section class="select-vehicle-area">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12 map-mob">
                                <input type="hidden" name="total_waypoints" id="total_waypoints"
                                    value="{{ $booking_details != null && !empty($booking_details['total_waypoints']) ? $booking_details['total_waypoints'] : '0' }}" />
                                <input type="hidden" name="w_latitude_1" id="w_latitude_1"
                                    value="{{ $booking_details != null && !empty($booking_details['w_s_latitude_1']) ? $booking_details['w_s_latitude_1'] : '' }}" />
                                <input type="hidden" name="w_longitude_1" id="w_longitude_1"
                                    value="{{ $booking_details != null && !empty($booking_details['w_s_longitude_1']) ? $booking_details['w_s_longitude_1'] : '' }}" />
                                <input type="hidden" name="w_latitude_2" id="w_latitude_2"
                                    value="{{ $booking_details != null && !empty($booking_details['w_s_latitude_2']) ? $booking_details['w_s_latitude_2'] : '' }}" />
                                <input type="hidden" name="w_longitude_2" id="w_longitude_2"
                                    value="{{ $booking_details != null && !empty($booking_details['w_s_longitude_2']) ? $booking_details['w_s_longitude_2'] : '' }}" />
                                <input type="hidden" name="w_latitude_3" id="w_latitude_3"
                                    value="{{ $booking_details != null && !empty($booking_details['w_s_latitude_3']) ? $booking_details['w_s_latitude_3'] : '' }}" />
                                <input type="hidden" name="w_longitude_3" id="w_longitude_3"
                                    value="{{ $booking_details != null && !empty($booking_details['w_s_longitude_3']) ? $booking_details['w_s_longitude_3'] : '' }}" />
            
                                <input type="hidden" name="s_latitude" id="origin_latitude"
                                    value="{{ $booking_details != null && !empty($booking_details['s_latitude']) ? $booking_details['s_latitude'] : '' }}" />
                                <input type="hidden" name="s_longitude" id="origin_longitude"
                                    value="{{ $booking_details != null && !empty($booking_details['s_longitude']) ? $booking_details['s_longitude'] : '' }}" />
                                <input type="hidden" name="d_latitude" id="destination_latitude"
                                    value="{{ $booking_details != null && !empty($booking_details['d_latitude']) ? $booking_details['d_latitude'] : '' }}" />
                                <input type="hidden" name="d_longitude" id="destination_longitude"
                                    value="{{ $booking_details != null && !empty($booking_details['d_longitude']) ? $booking_details['d_longitude'] : '' }}" />
                                <input type="hidden" name="current_longitude" id="long" />
                                <input type="hidden" name="current_latitude" id="lat" />
                                <input type="hidden" name="distance" id="distance"
                                    value="{{ $booking_details != null && !empty($booking_details['distance']) ? $booking_details['distance'] : '' }}" />
                                <input type="hidden" name="duration" id="duration"
                                    value="{{ $booking_details != null && !empty($booking_details['duration']) ? $booking_details['duration'] : '' }}" />
                                <input type="hidden" name="booking-csrf-token" id="booking-csrf-token"
                                    value="{{ csrf_token() }}" />
                                <input type="hidden" name="booking-url" value="{{ route('booking') }}" />
                                <input type="hidden" name="home-url" value="{{ route('home') }}" />
                                <input type="hidden" name="booking-next-url" value="{{ route('book-vehicle') }}" />
                                <div class="g__map" id="g_map" style="height:451px">
            
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
            <div class="col-sm-2">
                <div class="row location__info">
                    <div class="col-md-12 spo calculate">
                        <div class="card"
                            style="margin-top:-55px; margin-bottom:20px; margin-right:20px;padding:10px;background-color:#e1e1e1;color:white;text-align:center;">
                            <span class="icon-route">
                                <img src="{{ asset('frontend/images/distance.png') }}" style="height:70px;">
                            </span>
                            <p style="font-size: 30px;">TOTAL DISTANCE</p>
                            <h2 id="dvDistance">0 km</h2>
                            </span>
                        </div>
                    </div>
                    <div class="col-md-12 spo calculate" style="text-align:right;">
                        <div class="card" style="margin-top:20px; margin-bottom:20px; margin-right:20px;padding:10px;background-color:#e1e1e1;color:white;text-align:center;">
                            <span class="icon-route">
                                <img src="{{ asset('frontend/images/clock.png') }}" style="height:70px;">
                            </span>
                            <p style="font-size: 30px;">TOTAL TIME</p>
                            <h2 id="dvDuration">0 h 0 m</h2>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="row mb20">
                    <div class="select-car choose-button">
                        <div class="box-text one-half">
                            <div class="bottom">
                                <div class="btn-select">
                                    <a href="javascript:;" onclick="choose_ride_details()"
                                        class="btn common-btn booking-pre-next"><span>CHOOSE</span></a>
                                </div>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="booking-step booking-step-2">
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
                            <li class="active">
                                <span>2</span>	
                                <div class="icon">
                                    <img src="{{ asset('frontend/images/booking/options.png') }}" alt="">
                                </div>
                                <div class="text">
                                    VEHICLE
                                </div>
                            </li>
                            <li>
                                <span>3</span>	
                                <div class="icon">
                                    <img src="{{ asset('frontend/images/booking/login.png') }}" alt="">
                                </div>
                                <div class="text">
                                    OPTIONS
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
        <section class="select-vehicle-area">
            <div class="container" style="margin-top: 100px; padding: 40px;">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="row booking-step booking-step-4">

                            <div class="ride_form card" data-aos="fade-up"  style="margin-top: -73px; width: 100%; padding: 40px; background-color: #fff3d62e;border-radius: 10px;box-shadow: 0px 2px 10px rgba(0, 0, 0, 0.1);">
        
                                <div class="row head">
                                    <div class="col-md-12">
                                        <h2>VEHICLES FILTER</h2>
                                        <p id="dv_load_vehicle_error" class="text-danger"></p>
                                    </div>
                                </div>
        
                                <div class="row mt20">
                                    <div class="col-md-4">
                                        <label class="lp">PASSENGERS</label>
                                        
                                        <input type="hidden" name="booking-url" value="{{route('booking')}}" />
                                        <input type="hidden" name="booking-get-vehicles-url" value="{{route('get-vehicles')}}" />
                                        <input type="hidden" name="asset-url" value="{{asset('uploads/vehicle_type/')}}" />
                                            <select class="form-control bor0" name="number_of_passenger" onchange="load_vehicles()" id="number_of_passenger" placeholder="Choose no. of passengers">
                                                <option value="1"> 1 </option>
                                                <option value="2"> 2 </option>
                                                <option value="3"> 3 </option>
                                                <option value="4"> 4 </option>
                                                <option value="5"> 5 </option>
                                                <option value="6"> 6 </option>
                                                <option value="7"> 7 </option>
                                                <option value="8"> 8 </option>
                                                <option value="9"> 9 </option>
                                                <option value="10"> 10 </option>
                                                
                                            </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="lp">SUITCASES </label>
                                        <select class="form-control bor0" name="number_of_suitcase" onchange="load_vehicles()" id="number_of_suitcase" placeholder="Choose no. of suitcase">
                                            <option value="1"> 1 </option>
                                            <option value="2"> 2 </option>
                                            <option value="3"> 3 </option>
                                            <option value="4"> 4 </option>
                                            <option value="5"> 5 </option>
                                            <option value="6"> 6 </option>
                                            <option value="7"> 7 </option>
                                            <option value="8"> 8 </option>
                                            <option value="9"> 9 </option>
                                            <option value="10"> 10 </option>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="lp">TYPE </label>
                                        <select class="form-control bor0" name="vehicle_type" onchange="load_vehicles()" id="vehicle_type" placeholder="Choose vehicle type">
                                            <option value="0" selected>- All vehicles - </option>
                                            @foreach($types as $type)
                                                <option value="{{ $type->id }}">{{ $type->vehicle_type }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <section class="our-fleet-area pdbts">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-sm-12 vehicle-text">
                                            <div class="template-title center">
                                                <h1>The Prodrive Vehicles</h1>
                                                <span>Prodrive Vehicles</span>
                                                <p>We recommend you to choose the best with us.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row" id="vehicle_ajax">
                                        
                                    </div>
                                </div>
                            </section>
                            <div class="row mb10">
                                <div class="col-sm-12 text-left">
                                    <p class="text-danger text-center booking-pre-next" id='dv_vehicle_error' ></p>
                                </div>    
                            </div>    
                            <input type="hidden" id="v_count" value="-1" />
                            <div class="row mb20" >
                                @if(false)
                                <div class="col-sm-6 text-left">
                                    <a href="javascript:;" onclick="booking_step(1)" class="btn common-btn booking-pre-next">CHANGE RIDE DETAILS </a>
                                </div>
                                @endif
                            </div>
                        </div>
                        <div class="booking-step booking-step-3">
                            <div class="container" style="margin-top: -180px;">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="row">
                                            <div class="col-sm-12" style="margin-bottom:15px;">
                                                <div class="template-title center">
                                                    <h1>BOOKINGS</h1>
                                                    <span>The booking summary</span>
                                                    <p>We recommend you to complete the booking process.</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row" id="selected_vehicle_ajax">

                                        </div>
                                        <div class="row" style="margin-top: 30px;">
                                            <div class="col-sm-12 mb20" style="margin-bottom: 30px;">
                                                <h2>Extra options:</h2>
                                                <hr>
                                                <input type="checkbox" id="chk_international_airport_pickup_charges" onclick="extra_charges('international_airport_pickup_charges',this)" /> International Airport Pickup
                                                <input type="checkbox" id="chk_domestic_airport_pickup_charges" onclick="extra_charges('domestic_airport_pickup_charges',this)"/> Domestic Airport Pickup
                                                <input type="checkbox" id="chk_child_seat_charges" onclick="extra_charges('child_seat_charges',this)"/> Child Seat
                                                <input type="checkbox" id="chk_extra_hours_charges" onclick="extra_charges('extra_hours_charges',this)"/> Extra Hours
                                            </div>
                    
                                            <div class="clearfix"></div>
                    
                                            <div class="col-sm-12">
                                                <div class="extra_option_select international_airport_pickup_charges" data-aos="fade-up" style="margin-bottom: 30px;">
                                                    <div class="row" style="margin-bottom: 30px;">
                                                        <div class="col-sm-6">
                                                            <div class="left full">
                                                                <h3>International Airport Pickup <span id='i_airport_pickup_charges'>$40.00</span></h3>
                                                                <input type="hidden" id='international_airport_pickup_charges' value="40" />
                                                                <input type="hidden" id='is_international_airport_pickup_charges' value="0" />
                                                                <p>Free waiting time 60 mins,pick up at exit hall with name boards.</p>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="center">
                                                                <div class="row" id="field1">
                                                                    <div class="col-sm-6" style="color:black; text-align:left;"><h4>Number</h4></div>
                                                                    <div class="col-sm-2">
                                                                        <button type="button" onclick="num_up_down('down','international_airport_pickup_nos')" class="sub">-</button>
                                                                    </div>
                                                                    <div class="col-sm-2">
                                                                        <input type="text" onchange="num_up_down('change','international_airport_pickup_nos')" id="international_airport_pickup_nos" value="1" min="1"max="3" />
                                                                    </div>
                                                                    <div class="col-sm-2">
                                                                        <button type="button" onclick="num_up_down('up','international_airport_pickup_nos')" class="add">+</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="left full-content" id="international_airport_pickup_charges_content"></div>
                                                </div>
                    
                                                <div class="extra_option_select domestic_airport_pickup_charges" data-aos="fade-up" style="margin-bottom: 30px;">
                                                    <div class="row" style="margin-bottom: 30px;">
                                                        <div class="col-sm-6">
                                                            <div class="left full">
                                                                <h3>Domestic Airport Pickup <span id='d_airport_pickup_charges'>$40.00</span></h3>
                                                                <input type="hidden" id='domestic_airport_pickup_charges' value="40" />
                                                                <input type="hidden" id='is_domestic_airport_pickup_charges' value="0" />
                                                                <p>Free waiting time 60 mins,pick up at exit hall with name boards.</p>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="center">
                                                                <div class="row" id="field1">
                                                                    <div class="col-sm-6" style="color:black; text-align:left;"><h4>Number</h4></div>
                                                                    <div class="col-sm-2">
                                                                        <button type="button" onclick="num_up_down('down','domestic_airport_pickup_nos')" class="sub">-</button>
                                                                    </div>
                                                                    <div class="col-sm-2">
                                                                        <input type="text" onchange="num_up_down('change','domestic_airport_pickup_nos')" id="domestic_airport_pickup_nos" value="1" min="1" max="5" />
                                                                    </div>
                                                                    <div class="col-sm-2">
                                                                        <button type="button" onclick="num_up_down('up','domestic_airport_pickup_nos')" class="add">+</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="left full-content" id="domestic_airport_pickup_charges_content"></div>
                                                </div>
                    
                                                <div class="extra_option_select child_seat_charges" data-aos="fade-up">
                                                    <div class="row" style="margin-bottom: 30px;">
                                                        <div class="left full">
                                                            <h3>Child Seat <span id='c_seat_charges'>$40.00</span></h3>
                                                            <input type="hidden" id='child_seat_charges' value="40" />
                                                            <input type="hidden" id='is_child_seat_charges' value="0" />
                                                            
                                                            <p>Free waiting time 60 mins,pick up at exit hall with name boards.</p>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="center">
                                                                <div class="row" id="field1">
                                                                    <div class="col-sm-6" style="color:black; text-align:left;"><h4>Number</h4></div>
                                                                    <div class="col-sm-2">
                                                                        <button type="button" onclick="num_up_down('down','child_seat_nos')" class="sub">-</button>
                                                                    </div>
                                                                    <div class="col-sm-2">
                                                                        <input type="text" onchange="num_up_down('change','child_seat_nos')" id="child_seat_nos" value="1" min="1" max="2" />
                                                                    </div>
                                                                    <div class="col-sm-2">
                                                                        <button type="button" onclick="num_up_down('up','child_seat_nos')" class="add">+</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="clearfix"></div>
                                            <div class="row mt20">
                                                <div class="col-sm-3">
                                                    <label class="lp">Pickup date</label>
                                                    <div class="input-group booking_date pull-center" data-placement="left" data-align="top" data-autoclose="true">
                                                    
                                                        <input class="form-control digits booking-fields" id="booking_date" name="booking_date" type="text" onchange="update_summary('date')" value="" readonly />
                                                        <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                                                    </div>
                                                </div>
                                                <div class="col-sm-3">
                                                    <label class="lp">Pickup time</label>
                                                    <div class="input-group clockpicker pull-center" data-placement="left" data-align="top" data-autoclose="true">
                                                        <input class="form-control booking-fields" type="text"  id="booking_time" name="booking_time"  onchange="update_summary('time')" value="{{get_min_time()}}" readonly /><span class="input-group-addon"><span class="glyphicon glyphicon-time"></span></span>
                                                    </div>
                                                </div>
                                                <div class="col-sm-3">
                                                    <label class="lp">Transfer type</label>
                                                    <select class="form-control bor0 booking-fields" id="booking_transfer_type" name="booking_transfer_type"  placeholder="Choose Transfer type" onChange="load_vehicles(selected_vehicle_row,1);">
                                                        <option {{$booking_details==null?'selected':(!empty($booking_details['booking_transfer_type']) && $booking_details['booking_transfer_type']=='One Way'?'selected':'')}}>One Way</option>
                                                        <option {{$booking_details==null?'':(!empty($booking_details['booking_transfer_type']) && $booking_details['booking_transfer_type']=='Round Trip'?'selected':'')}} >Round Trip</option>
                                                        <option {{$booking_details==null?'':(!empty($booking_details['booking_transfer_type']) && $booking_details['booking_transfer_type']=='Hourly Rate'?'selected':'')}} >Hourly Rate</option>
                                                        
                                                    </select>
                                                </div>
                                                <div class="col-sm-3" data-aos="fade-up">
                    
                                                    <div class="left full extra_hours_charges">
                                                        <label class="lp">Extra Hours <span id='c_extra_hours_charges'>$40.00</span></label>
                                                        <input type="hidden" id='extra_hours_charges' value="0" />
                                                        <input type="hidden" id='is_extra_hours_charges' value="0" />
                                                        <input type="number" onchange="num_up_down('change','extra_hours_nos')" id="extra_hours_nos" value="1" min="1"
                                                                max="24" />
                                                        <p>Need extra waiting time? it will be chargeble per hour basic.</p>
                                                    </div>
                    
                    
                                                </div>
                                                
                                            </div>
                    
                                            <div class="row mt20" style="{{$booking_details==null?'display:none;':(!empty($booking_details['booking_transfer_type']) && $booking_details['booking_transfer_type']=='Round Trip'?'':'display:none;')}}" id="display_div">
                                                
                                                <div class="col-sm-3">
                                                    <label class="lp">Return date</label>
                                                    <div class="input-group return_date pull-center" data-placement="left" data-align="top" data-autoclose="true">
                                                    
                                                        <input class="form-control digits booking-fields" id="return_date" name="return_date" type="text" onchange="update_summary('return_date')" value="" readonly />
                                                        <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                                                    </div>
                                                </div>
                                                <div class="col-sm-3">
                                                    <label class="lp">Return Pickup time</label>
                                                    <div class="input-group clockpicker pull-center" data-placement="left" data-align="top" data-autoclose="true">
                                                        <input class="form-control booking-fields" type="text"  id="return_time" name="return_time" onchange="update_summary('return_time')" value="{{get_min_time()}}" readonly /><span class="input-group-addon"><span class="glyphicon glyphicon-time"></span></span>
                                                    </div>
                                                </div>
                                            </div>
                    
                                            <div class="col-sm-12 mt20 card" style="margin-top: 10px; padding: 40px; background-color: #e4e4e4; color:black;">
                                                <div class="chbs-summary-price-element-vehicle-fee distance-cost">
                                                    <span>Duration &amp; Distance</span>
                                                    <span class="pull-right" id="dv_distance_duration"></span>
                                                </div>
                                                <div class="chbs-summary-price-element-vehicle-fee distance-cost">
                                                    <span id='dv_duration_distance'>Duration &amp; Distance Charges</span>
                                                    <span class="pull-right" id="dv_total_cost"></span>
                                                </div>
                                                <div class="chbs-summary-price-element-vehicle-fee" id="dv_total_extra_hours">
                                                    <span id="span_total_extra_hours_cost">Extra options</span>
                                                    <span class="pull-right" id="dv_total_extra_hours_cost"></span>
                                                </div>
                                                <div class="chbs-summary-price-element-total-extra" id="dv_total_extra">
                                                    <span>Extra options</span>
                                                    <span class="pull-right" id="dv_total_extra_cost"></span>
                                                </div>
                                                <div class="chbs-summary-price-element-total">
                                                    <span>Total</span>
                                                    <span class="pull-right" id="dv_total_booking_cost"></span>
                                                </div>
                                            </div>
                                        </div> 
                                            <div class="col-sm-12 mt20 booking_for_details" id="dv_booking_for_details" >
                                                <div class="ride_form" data-aos="fade-up">
                        
                                                    <div class="row head">
                                                        <div class="col-sm-12 card" style="margin-top: 50px; padding: 40px; background-color: #e4e4e4;">
                                                            <h2>YOUR DETAILS</h2>
                                                        </div>
                                                    </div>
                        
                                                    <div class="row mt20">
                                                        <div class="col-sm-6">
                                                            <label class="" style="text:black;">Name</label>
                                                            <input type="text" class="form-control" id="booking_form_user_name"
                                                                value="{{ Auth::user() ? Auth::user()->name : '' }}" disabled />
                                                        </div>
                                                        <div class="col-sm-6 mt10">
                                                            <label class="" style="text:black;">Email</label>
                                                            <input type="text" class="form-control" id="booking_form_user_email"
                                                                value="{{ Auth::user() ? Auth::user()->email : '' }}" disabled />
                                                        </div>
                                                    </div>
                                                    <div class="row mt20">
                                                        <div class="col-sm-6">
                                                            <label class="" style="text:black;">Phone</label>
                                                            <input type="text" class="form-control" id="booking_form_user_phone"
                                                                value="{{ Auth::user() ? Auth::user()->phone : '' }}" disabled />
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <label class="" style="text:black;">Billing address(Optional)</label>
                                                            <input type="text" class="form-control" id="booking_billing_addr"
                                                                value="{{ Auth::user() ? Auth::user()->billing_addr : '' }}" />
                                                        </div>
                                                    </div>
                                                    <div class="row mt20">
                                                        <div class="col-sm-6">
                                                            <label class="" style="text:black;">Bill To Name(Optional)</label>
                                                            <input type="text" class="form-control" id="booking_bill_to_name"
                                                                value="{{ Auth::user() ? Auth::user()->bill_to_name : '' }}" />
                                                        </div>
                                                        <div class="col-sm-6 mt10">
                                                            <label class="" style="text:black;">ABN Number(Optional):</label>
                                                            <input type="text" class="form-control" id="booking_abn_number" name="booking_abn_number"
                                                                value="{{ Auth::user() ? Auth::user()->abn_number : '' }}" />
                                                        </div>
                                                    </div>
                        
                                                    <div class="row mt20">
                                                        <div class="col-sm-6 mt10">
                                                            <label class="" style="text:black;">Book For:</label>
                                                            <input type="radio" class="" name="booking_for" id="chk_booking_for_me" onclick="$('#dv_booking_for').hide();" value="me" checked />Me
                                                            <input type="radio" class="" name="booking_for" id="chk_booking_for_other" onclick="$('#dv_booking_for').show();" value="other" />Someone/Company
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12 mt20 booking_for_details" id="dv_booking_for" style="display:none;">
                                                <div class="ride_form" data-aos="fade-up" style="width:100%;">
                        
                                                    <div class="row head">
                                                        <div class="col-sm-12 card" style="margin-top: 10px; padding: 40px; background-color: #e4e4e4;">
                                                            <h2>BOOKING DETAILS</h2>
                                                        </div>
                                                    </div>
                                                    <div class="row mt20">
                                                        <div class="col-sm-6">
                                                            <label class="" style="text:black;">Person/Company Name</label>
                                                            <input type="text" name="company_person" id="company_person" class="form-control" value="" />
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <label class="" style="text:black;">Phone</label>
                                                            <input type="text" name="other_phone_number" id="other_phone_number" class="form-control" value="" />
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-sm-12">
                                                            <label class="" style="text:black;">Email</label>
                                                            <input type="email" name="other_email" id="other_email" class="form-control" value="" />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <section class="login-booking-area" id="login_register_tab">
                                                <div class="container">
                                                    <div class="row">
                                                        <div class="col-sm-2"></div>
                                                        <div class="col-sm-8">
                                                            <div class="login-booking">
                                                                <ul class="login-tab-list">
                                                                    <li rel="tab-1" class="active">LOGIN</li>
                                                                    <li rel="tab-2">REGISTER</li>
                                                                </ul>
                                                                <div class="login-content">
                                                                    <div id="tab-1" class="content-tab">
                                                                        <input type="hidden" id="booking_form_login" name="booking_form_login" value="1" />
                                                                        <div class="login-form">
                                                                            <form class="booking_for_details" action="{{ route('login.post') }}" id="user_login_form" method="POST" enctype="multipart-formdata">
                                                                                @csrf
                                                                                <div id="errors-login"></div>
                    
                                                                                <input type="hidden" name="redirect_to" value="{{ route('booking-detail') }}" />
                                                                                <div class="one-half">
                                                                                    <div class="form-email">
                                                                                        <label for="">Email</label>
                                                                                        <input type="text" name="login_email" id="login_email" placeholder="creativelayer088@gmail.com">
                                                                                    </div>
                                                                                </div>
                                                                                <div class="one-half">
                                                                                    <div class="form-password">
                                                                                        <label for="">Password</label>
                                                                                        <input type="password" name="login_password" id="login_password" placeholder="************">
                                                                                    </div>
                                                                                </div>
                                                                                <div class="clearfix"></div>
                                                                                <div class="one-half">
                                                                                    <div class="remember">
                                                                                        <input type="checkbox" name="remember" id="remember" >
                                                                                        <label for="remember">Remember me</label>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="one-half">
                                                                                    <div class="btn-submit">
                                                                                        <p class="text-danger text-center" id='dv_login_error' ></p>
                                                                                        <a href="#" title="">Lost Your Password ?</a>
                                                                                        <button type="button" id="login_submit">LOGIN</button>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="clearfix"></div>
                                                                            </form>
                                                                        </div>
                                                                        <div class="login-social">
                                                                            <span>OR</span>
                                                                            <p>You can log in quickly with your account.</p>
                                                                            <ul class="social">
                                                                                <li class="facebook">
                                                                                    <a href="#" title="">
                                                                                        <span class="fa fa-facebook"></span>Connect with Facebook
                                                                                    </a>
                                                                                </li>
                                                                                <li class="twitter">
                                                                                    <a href="#" title="">
                                                                                        <span class="fa fa-twitter"></span>Connect with Twitter
                                                                                    </a>
                                                                                </li>
                                                                            </ul>
                                                                        </div>
                                                                    </div>
                                                                    <div id="tab-2" class="content-tab">
                                                                        <input type="hidden" id="booking_form_register" name="booking_form_register" value="1" />
                                                                        <div class="register-form">
                                                                            <form class="booking_for_details" action="{{ route('register.post') }}" id="handleAjax" method="POST" enctype="multipart-formdata">
                                                                                @csrf
                                                                                
                                                                                <input type="hidden" name="redirect_to" value="{{route('booking-detail')}}" />
                                                                                <div class="one-half email">
                                                                                    <label for="email">Email</label>
                                                                                    <input type="text" name="email" id="email_address" placeholder="creativelayer088@gmail.com">
                    
                                                                                    @if ($errors->has('email'))
                                                                                        <span class="text-danger">{{ $errors->first('email') }}</span>
                                                                                    @endif
                                                                                </div>
                                                                                <div class="one-half pass">
                                                                                    <label for="pass">Password</label>
                                                                                    <input type="text" name="password" id="password" >
                    
                                                                                    @if ($errors->has('password'))
                                                                                        <span class="text-danger">{{ $errors->first('password') }}</span>
                                                                                    @endif
                                                                                </div>
                                                                                <div class="one-half first-name">
                                                                                    <label for="firstname">Name *</label>
                                                                                    <input type="text" name="name" id="name" placeholder="Ali">
                    
                                                                                    @if ($errors->has('name'))
                                                                                        <span class="text-danger">{{ $errors->first('name') }}</span>
                                                                                    @endif
                                                                                </div>
                                                                                <div class="one-half phone">
                                                                                    <label for="phone">Phone *</label>
                                                                                    <input type="text" name="phone" id="phone" placeholder="(+90) 538 658 96 315">
                    
                                                                                    @if ($errors->has('phone'))
                                                                                        <span class="text-danger">{{ $errors->first('phone') }}</span>
                                                                                    @endif
                                                                                </div>
                                                                                <div class="one-half last-name">
                                                                                    <label for="lastname">Bill To Name *</label>
                                                                                    <input type="text" name="bill_to_name" id="bill_to_name" placeholder="TUF...">
                                                                                </div>
                                                                                <div class="one-half re-pass">
                                                                                    <label for="re-pass">ABN Number (optional)</label>
                                                                                    <input type="text" name="abn_number" id="abn_number">
                                                                                </div>
                                                                                <div class="one-half re-pass">
                                                                                    <label for="re-pass">Billing Address *</label>
                                                                                    <input type="text" name="billing_addr" id="billing_addr">
                                                                                </div>
                                                                                <div class="one-half checkbox">
                                                                                    <input type="checkbox" name="accept" id="accept">
                                                                                    <label for="accept">Accept <a href="#" title="">terms & conditions</a> and the <a href="#" title="">privacy policy</a> input</label>
                                                                                </div>
                                                                                <div class="one-half btn-submit">
                                                                                    <p class="text-danger text-center" id='dv_register_error' ></p>
                                                                                    <button type="submit">REGISTER</button>
                                                                                </div>
                                                                                <div class="clearfix"></div>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-2"></div>
                                                    </div>
                                                </div>
                                            </section>
                                        @if(false)
                                        <div class="row mb20"  id="dv_book_now">
                                            <div class="col-sm-6 text-left">
                                                <a href="javascript:;" onclick="booking_step(2)" class="btn common-btn booking-pre-next">CHOOSE OTHER VEHICLE </a>
                                            </div>
                                            
                                            <div class="col-sm-6 text-right">
                                                <input type="hidden" id="booking_save_url" value="{{ route('savebooking') }}" />
                                                <a href="javascript:;" onclick="book_my_ride()" class="btn common-btn booking-pre-next">BOOK MY RIDE </a>
                                            </div>
                                            
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mb30 mt50">
                    @if(false)
                    <div class="row">
                        <a href="javascript:;" onclick="booking_step(1)" class="btn common-btn booking-pre-next">CHANGE RIDE DETAILS </a>
                    </div>
                    @endif
                    
                </div>
            </div>
        </section>
        <div class="row mb30 mt50" style="justify-content:center;margin-bottom:20px;">
            <div class="row mb10">
                <div class="col-sm-12 text-left">
                    <p class="text-danger text-center booking-pre-next" id='dv_book_now_error' ></p>
                </div>    
            </div>
            <div class="row booking-step booking-step-3">
                <div class="col-sm-6 text-left mobile-btn">
                <a href="javascript:;" onclick="booking_step(1)" class="btn btn-raised btn-warning booking-pre-next">CHANGE RIDE DETAILS </a>
                </div>
                <div class="col-sm-6 text-right mobile-btn">
                    <input type="hidden" id="booking_save_url" value="{{ route('savebooking') }}" />
                    <a href="javascript:;" onclick="book_my_ride()" class="btn btn-raised btn-warning booking-pre-next">BOOK MY RIDE </a>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        var ip_details = [];
        var current_latitude = -33.8678447;
        var current_longitude = 151.2055967;

        function disableEnterKey(e) {
            var key;
            if (window.e) {
                key = window.e.keyCode; // IE
            } else {
                key = e.which; // Firefox
            }

            if (key == 13)
                return e.preventDefault();
        }
    </script>
    <script src="{{ asset('frontend/js/login.js?v=' . time()) }}"></script>
    <script src="{{ asset('frontend/js/register.js?v=' . time()) }}"></script>
    <script src="{{ asset('frontend/js/map.js?v=' . time()) }}"></script>
    <script src="{{ asset('frontend/js/booking.js?v=' . time()) }}"></script>
    <script src="{{ asset('frontend/js/vehicles.js?v=' . time()) }}"></script>
    <script src="{{ asset('frontend/js/booking_steps.js?v=' . time()) }}"></script>

    <script>
        $('#booking_transfer_type').on('change', function() {

            if (this.value == 'Round Trip') {
                $('#display_div').show();
                $('#display_div').attr('disabled', false);
            } else {
                $('#display_div').hide();
            }
        });
    </script>


    @if (false)
        <script
            src='https://maps.google.com/maps/api/js?key=AIzaSyCjGtMl0hHyRNVj0bEc3FDEOgqRyc5aiRs&libraries=places&language=en&callback=initMap'
            id='chbs-google-map-js'></script>
    @endif

    <script
        src='https://maps.googleapis.com/maps/api/js?key=AIzaSyCjGtMl0hHyRNVj0bEc3FDEOgqRyc5aiRs&v=3.exp&libraries=places&language=en&callback=initMap&mapDiv=g_map'
        id='chbs-google-map-js'></script>
    <script>
        @if (Auth::user())
            var auth_user = {
                'name': '{{ Auth::user()->name }}',
                'email': '{{ Auth::user()->email }}',
                'phone': '{{ Auth::user()->phone }}',
                'discount': '{{ Auth::user()->discount }}'
            };
        @else
            var auth_user = null;
        @endif
        $(function() {
            booking_step({{ $step }});
            @if ($step > 1)
                //            calculateDistance();
            @endif
            select_service_type('{{ $service_type }}');

            $('#a_dv_add_waypoint').on('click', function() {
                add_waypoint(1);
            });
            window.onpageshow = function(evt) {
                // If persisted then it is in the page cache, force a reload of the page.

                if (evt.persisted) {
                    document.body.style.display = "none";
                    location.reload();
                }
            };

        })
    </script>
    <script type="text/javascript">
        function CheckColors(val) {}
    </script>
@endsection
