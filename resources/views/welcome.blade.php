@extends('layouts.app')

@section('content')
<section class="tp-banner has-tab">
	<div id="rev_slider_1078_2_wrapper" class="rev_slider_wrapper fullwidthbanner-container" data-alias="classic4export" data-source="gallery" style="margin:0px auto;background-color:transparent;padding:0px;margin-top:0px;margin-bottom:0px;">
		<!-- START REVOLUTION SLIDER 5.3.0.2 auto mode -->
		<div id="rev_slider_1078_2" class="rev_slider fullwidthabanner" style="display:none;" data-version="5.3.0.2">
			<div class="slotholder"></div>
			<ul><!-- SLIDE  -->
				<!-- SLIDE 1 -->
				@foreach ($sliders as $slider)
				<li data-index="rs-3049" data-transition="slideremovedown" data-slotamount="7" data-hideafterloop="0" data-hideslideonmobile="off"  data-easein="Power3.easeInOut" data-easeout="Power3.easeInOut" data-masterspeed="2000"    data-rotate="0"  data-saveperformance="off"  data-title="Ken Burns" data-param1="" data-param2="" data-param3="" data-param4="" data-param5="" data-param6="" data-param7="" data-param8="" data-param9="" data-param10="" data-description="">                        
					<!-- MAIN IMAGE -->
					<img src="{{ asset('uploads/sliders/'.$slider->slider_image) }}"  alt=""  data-bgposition="center center" data-kenburns="off" data-duration="30000" data-ease="Linear.easeNone" data-scalestart="100" data-scaleend="120" data-rotatestart="0" data-rotateend="0" data-offsetstart="0 0" data-offsetend="0 0" data-bgparallax="10" class="rev-slidebg" data-no-retina>
					<!-- LAYERS -->
					<div class="tp-caption title ff-2 color-white" 
						id="slide-3049-layer-1" 
						data-x="['center','center','center','center']" data-hoffset="['275','0','0','0']" 
						data-y="['middle','middle','middle','middle']" data-voffset="['21','21','21','21']" 
						data-fontsize="['60','40','30','26']"
						data-lineheight="['65','60','50','32']"
						data-fontweight="['400','400','400','400']"
						data-width="100%"
						data-height="auto"
						data-type="text" 
						data-whitespace="normal" 
						data-responsive_offset="on"                             
						data-frames='[{"delay":0,"split":"chars","splitdelay":0.05,"speed":1000,"frame":"0","from":"x:[105%];z:0;rX:45deg;rY:0deg;rZ:90deg;sX:1;sY:1;skX:0;skY:0;","mask":"x:0px;y:0px;s:inherit;e:inherit;","to":"o:1;","ease":"Power4.easeInOut"},{"delay":"wait","speed":300,"frame":"999","to":"auto:auto;","ease":"Power3.easeInOut"}]'
						data-textAlign="['center','center','center','center']"
						data-paddingright="[0,0,0,0]"
						data-paddingbottom="[0,0,0,0"
						data-paddingleft="[0,0,0,0]"
						style="z-index: 16; white-space: nowrap;font-weight: 400;">ONLY THE BEST FOR YOU!
					</div>
					 <a href="#" target="_self" class="tp-caption button-a text-center"         
					data-frames='[{"from":"y:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:0;","mask":"x:0px;y:[100%];s:inherit;e:inherit;","speed":2000,"to":"o:1;","delay":2000,"ease":"Power4.easeInOut"},{"delay":"wait","speed":1000,"to":"y:[100%];","mask":"x:inherit;y:inherit;s:inherit;e:inherit;","ease":"Power2.easeInOut"}]'
					data-x="['center','center','center','center']" data-hoffset="['300','-95','-95','-75']" 
					data-y="['middle','middle','middle','middle']" data-voffset="['104','104','104','104']" 
					data-fontsize="['16','16','16','16']"
					data-lineheight="['24','24','24','24']"
					data-fontweight="['400','400','400','400']"
					data-width="['auto']"
					data-height="['auto']"
					style="z-index: 3;">OUR company
					</a><!-- END LAYER LINK -->
					<a href="{{ route('contact') }}" target="_self" class="tp-caption button-b text-center"         
					data-frames='[{"from":"y:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:0;","mask":"x:0px;y:[100%];s:inherit;e:inherit;","speed":2000,"to":"o:1;","delay":2000,"ease":"Power4.easeInOut"},{"delay":"wait","speed":1000,"to":"y:[100%];","mask":"x:inherit;y:inherit;s:inherit;e:inherit;","ease":"Power2.easeInOut"}]'
					data-x="['center','center','center','center']" data-hoffset="['490','95','95','75']" 
					data-y="['middle','middle','middle','middle']" data-voffset="['104','104','104','104']"
					data-fontsize="['16','16','16','16']"
					data-lineheight="['24','24','24','24']"
					data-fontweight="['400','400','400','400']"
					data-width="['auto']"
					data-height="['auto']"
					style="z-index: 3;">contact us
					</a><!-- END LAYER LINK -->
				</li>
				@endforeach
			</ul>
		</div>
	</div><!-- END REVOLUTION SLIDER -->
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="sdl-booking add-box">
					<ul class="tab_booking">
						<li class="active"><a href="#bk-1">Distance</a></li>
						<li><a href="#bk-2">Hourly</a></li>
						<li><a href="#bk-3">Flat Rate</a></li>
					</ul>
					<div id="bk-1" class="schedule-booking">
						<form class="form-booking" method="get" action="#">
							<div class="pick-address">
								<label>Pick Up Address</label>
								<input type="text" name="pick-up" placeholder="From: address, airport, hotel, ...">
							</div>
							<div class="pick-dropday">
								<label>Drop Off Address</label>
								<input type="text" name="pick-up" placeholder="From: address, airport, hotel, ...">
							</div>
							<div class="pick-date">
								<label>Pick Up Date</label>
								<div class=" date form_date" data-date="" data-date-format="dd MM yyyy" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">
									<input size="16" type="text" value="" placeholder="Wed 19 July, 2017" readonly>
									<span class="add-on"><i class="icon-remove"></i></span>
									<span class="add-on"><i class="icon-th"></i></span>
								</div>
								<input type="hidden" id="dtp_input2" value="" /><br/>
							</div>
							<div class="pick-time">
								<label>Pick Up Time</label>
								<div class="controls input-append date form_time" data-date="" data-date-format="hh:ii p" data-link-field="dtp_input3" data-link-format="hh:ii">
									<input size="16" type="text" value="" placeholder="12:25 am" readonly>
									<span class="add-on"><i class="icon-remove"></i></span>
									<span class="add-on"><i class="icon-th"></i></span>
								</div>
								<input type="hidden" id="dtp_input3" value="" /><br/>
							</div>
							<div class="btn-submit">
								<a href="#" class="register_now">Reserve Now<img src="images/icon/arrow-white.png" alt=""></a>
							</div>
						</form>
					</div>
					<div id="bk-2" class="schedule-booking">
						<h1 class="text-over">RESERVE NOW</h1>
						<form class="form-booking" method="get" action="#">
							<div class="pick-address">
								<label>Pick Up Address</label>
								<input type="text" name="pick-up" placeholder="From: address, airport, hotel, ...">
							</div>
							<div class="pick-dropday">
								<label>Drop Off Address</label>
								<input type="text" name="pick-up" placeholder="From: address, airport, hotel, ...">
							</div>
							<div class="pick-date">
								<label>Pick Up Date</label>
								<div class=" date form_date" data-date="" data-date-format="dd MM yyyy" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">
									<input size="16" type="text" value="" placeholder="Wed 19 July, 2017" readonly>
									<span class="add-on"><i class="icon-remove"></i></span>
									<span class="add-on"><i class="icon-th"></i></span>
								</div>
								<input type="hidden" id="dtp_input2" value="" /><br/>
							</div>
							<div class="pick-time">
								<label>Pick Up Time</label>
								<div class="controls input-append date form_time" data-date="" data-date-format="hh:ii p" data-link-field="dtp_input3" data-link-format="hh:ii">
									<input size="16" type="text" value="" placeholder="12:25 am" readonly>
									<span class="add-on"><i class="icon-remove"></i></span>
									<span class="add-on"><i class="icon-th"></i></span>
								</div>
								<input type="hidden" id="dtp_input3" value="" /><br/>
							</div>
							<div class="btn-submit">
								<a href="#" class="register_now">Reserve Now<img src="images/icon/arrow-white.png" alt=""></a>
							</div>
						</form>
					</div>
					<div id="bk-3" class="schedule-booking">
						<h1 class="text-over">RESERVE NOW</h1>
						<form class="form-booking" method="get" action="#">
							<div class="pick-address">
								<label>Pick Up Address</label>
								<input type="text" name="pick-up" placeholder="From: address, airport, hotel, ...">
							</div>
							<div class="pick-dropday">
								<label>Drop Off Address</label>
								<input type="text" name="pick-up" placeholder="From: address, airport, hotel, ...">
							</div>
							<div class="pick-date">
								<label>Pick Up Date</label>
								<div class=" date form_date" data-date="" data-date-format="dd MM yyyy" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">
									<input size="16" type="text" value="" placeholder="Wed 19 July, 2017" readonly>
									<span class="add-on"><i class="icon-remove"></i></span>
									<span class="add-on"><i class="icon-th"></i></span>
								</div>
								<input type="hidden" id="dtp_input2" value="" /><br/>
							</div>
							<div class="pick-time">
								<label>Pick Up Time</label>
								<div class="controls input-append date form_time" data-date="" data-date-format="hh:ii p" data-link-field="dtp_input3" data-link-format="hh:ii">
									<input size="16" type="text" value="" placeholder="12:25 am" readonly>
									<span class="add-on"><i class="icon-remove"></i></span>
									<span class="add-on"><i class="icon-th"></i></span>
								</div>
								<input type="hidden" id="dtp_input3" value="" /><br/>
							</div>
							<div class="btn-submit">
								<a href="#" class="register_now">Reserve Now<img src="images/icon/arrow-white.png" alt=""></a>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- End Tp Banner -->
<!-- Start Template title -->
<section class="template-title has-over text-up">
	<div class="container">
		<h3 class="title">The Prodrive Fleet</h3>
		<p class="subtitle">We also take custom orders and will help you acquire a specific yacht</p>
	</div>
</section>
<!-- End Template title -->
<!-- Start Block Fleet -->
<section class="block-fleet no-slider mt">
	<div class="container">
		<ul class="tab_menu">
			@php 
				$count = 0;
			@endphp
			<li class="current {{$count==0?'active':''}}"><a href="#fleet_0">All</a></li>
			@php 
                        $count++;
			foreach ($types as $type) {
			@endphp
				<li class="{{$count==0?'active':''}}"><a href="#fleet_{{$type->id}}">{{ $type->vehicle_type }}</a></li>
			@php
				$count++;
			}
			@endphp
		</ul>
		<div id="fleet_0" class="fleet-carousels">
				@foreach($vehicles as $vehicle)
					@if($vehicle->status=='ACTIVE')
					<div class="fleet-item">
						<div class="images">
								<img src="{{ asset('uploads/vehicle/'.$vehicle->vehicle_thumbnail) }}">
						</div>
						<div class="fleet-content">
							<h4 class="fleet-title">
								<a href="{{ route('fleet-detail',['slug' => $vehicle->vehicle_slug]) }}">{{ $vehicle->vehicle_name }}</a>
							</h4>
							<h4 class="automatic">4 Matic</h4>
							<ul>
								<li class="author">
									<a href="#"><img src="{{ asset('frontend/images/icon/author.png') }}" alt="">Max . 3</a>
								</li>
								<li class="mail">
									<a href="#"><img src="{{ asset('frontend/images/icon/mail.png') }}" alt="">Max . 2</a>
								</li>
							</ul>
						</div>
					</div>
					@endif
				@endforeach
		</div>
		@php 
		$count++;
		foreach($types as $type){
		@endphp
		<div id="fleet_{{$type->id}}" class="fleet-carousels {{ $count == 0?'active':'' }}">
			@foreach($type->vehicles as $vehicle)
				@if($vehicle->status=='ACTIVE')
				<div class="fleet-item">
					<div class="images">
						<img src="{{ asset('uploads/vehicle/'.$vehicle->vehicle_thumbnail) }}">
					</div>
					<div class="fleet-content">
						<h4 class="fleet-title">
							<a href="{{ route('fleet-detail',['slug' => $vehicle->vehicle_slug]) }}">{{ $vehicle->vehicle_name }}</a>
						</h4>
						<h4 class="automatic">4 Matic</h4>
						<ul>
							<li class="author">
								<a href="#"><img src="{{ asset('frontend/images/icon/author.png') }}" alt="">Max . 3</a>
							</li>
							<li class="mail">
								<a href="#"><img src="{{ asset('frontend/images/icon/mail.png') }}" alt="">Max . 2</a>
							</li>
						</ul>
					</div>
				</div>
				@endif
			@endforeach
		</div>
		@php  
			$count++;
			} 
		@endphp
	</div>
</section>
<!-- End Block Fleet -->
<!-- Start Template Title -->
<section class="template-title has-over top160">
	<div class="container">
		<h3 class="title">Our Services</h3>
		<span class="title_over">Our Services</span>
		<p class="subtitle">Our aim is to fill a gap in niche market of Trade</p>
	</div>
</section>
<!-- End Template Title -->
<!-- Start Our Services -->
<section class="our_services">
	<div class="container">
		<div class="row">
            @foreach ($services as $service)
            <div class="col-md-4 col-sm-6">
                <div class="services-item center">
                    <div class="services-image">
                    	<img src="{{ asset('uploads/event_thumbnail/' . $service->thumbnail) }}">
                    </div>
                    <div class="services-content">
                        <h4><a href="{{ route('service-home', ['slug' => $service->event_slug]) }}">{{ $service->event_name }}</a></h4>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
	</div>
</section>
<!-- End Our Services -->
<!-- Start Template title -->
<section class="template-title has-over text-up">
	<div class="container">
		<h3 class="title">Why Choose Us</h3>
		<p class="subtitle">Explore our first class limousine & car rental services</p>
	</div>
</section>
<!-- End Template title -->
<!-- Start Section Iconbox -->
<section class="section-iconbox fix-ts">
	<div class="container">
		<div class="row">
			<div class="col-md-3 col-sm-6 col-xs-12 size-table">
				<div class="iconbox center">
					<div class="iconbox-icon">
						<img src="{{ asset('frontend/images/iconbox/001.png') }}" alt="">
					</div>
					<div class="iconbox-content">
						<h3>
							<a href="#" title="">Easy Online Booking</a>
						</h3>
						<p>Lorem ipsum dolor sit amet, consectadipiscing elit. Aenean commodo ligula eget dolor.</p>
					</div>
				</div>
			</div>
			<div class="col-md-3 col-sm-6 col-xs-12 size-table">
				<div class="iconbox center">
					<div class="iconbox-icon">
						<img src="{{ asset('frontend/images/iconbox/002.png') }}" alt="">
					</div>
					<div class="iconbox-content">
						<h3>
							<a href="#" title="">Professional Drivers</a>
						</h3>
						<p>A new shuttle train service between Singapore and Johor Bahru kicked off on Wednesday. </p>
					</div>
				</div>
			</div>
			<div class="col-md-3 col-sm-6 col-xs-12 size-table">
				<div class="iconbox center">
					<div class="iconbox-icon">
						<img src="{{ asset('frontend/images/iconbox/003.png') }}" alt="">
					</div>
					<div class="iconbox-content">
						<h3>
							<a href="#" title="">Variety of Car Brands</a>
						</h3>
						<p>The service, called Shuttle Tebrau, is  operated by Malaysia’s JB Sentral in just five minutes.</p>
					</div>
				</div>
			</div>
			<div class="col-md-3 col-sm-6 col-xs-12 size-table">
				<div class="iconbox center">
					<div class="iconbox-icon">
						<img src="{{ asset('frontend/images/iconbox/004.png') }}" alt="">
					</div>
					<div class="iconbox-content">
						<h3>
							<a href="#" title="">Online Payment</a>
						</h3>
						<p>York Airport Service is a private bus company that provides transportation area airports and Manhattan.</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- End Section Iconbox -->
<!-- Start Info Box -->
<section class="info-box parallax parallax_one change_text">
	<div class="container">
		<div class="wrapper-content">
			<h3 class="title">
				Or anywhere you need us to take
			</h3>
			<p class="content">Not only taking to night parties, weddings, casinos, birthdays but we also take you to anywhere you want to go. </p>
			<p class="contact">Call Now (1)-212-333-4343</p>
			<a href="#" class="booking">Online Booking<img src="{{ asset('frontend/images/icon/arrow-white.png') }}" alt=""></a>
		</div>
	</div>
</section>
<!-- End Info Box -->
<!-- Start About Box -->
<section class="about-box">
	<div class="container">
		<div class="template-title has-over mtt ovvs">
			<h3 class="title">How It Works</h3>
			<p class="subtitle">Our booking process is simple and efficient</p>
		</div>
		<div class="row">
			<div class="col-md-7 full-sm">
				<img src="{{ asset('frontend/images/about/macbook.png') }}" alt="">
			</div>
			<div class="col-md-5 full-sm">
				<ul>
					<li>
						<h3>1 - Book Via App Or Web</h3>
						<p>Enter your pickup & dropoff locations or the number of hours you wish to book a car and driver for</p>
					</li>
					<li>
						<h3>2 - Choose Your Ride</h3>
						<p>On the day of your ride, you will receive two email and SMS updates - one informing you that your car is on its way, and a second letting</p>
					</li>
					<li>
						<h3>3 - Enjoy Your Ride</h3>
						<p>After your ride has taken place, we would appreciate it if you could rate your car and driver.</p>
					</li>
				</ul>
			</div>
		</div>
	</div>
</section>
@endsection