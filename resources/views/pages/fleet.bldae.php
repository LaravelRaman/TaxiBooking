@extends('layouts.app')

@section('content')
<section class="top-title">
			<div class="top-page">
				<div class="container">
					<div class="row">
						<div class="col-md-12">
							<div class="top-page-heading">
								<h1>FLEET</h1>
								<p class="sub-title">Choose Your Dream Car From Among Six Different Categories</p>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="breadcrumbs">
				<div class="container">
					<div class="row">
						<div class="col-md-12">
							<ul>
								<li>
									<a href="#">Home </a>
								</li>
								<li>
									/ Fleet
								</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</section>
		<!-- End Top title -->
		<!-- Start Our Fleet Single -->
		<section class="our-fleet-single">
			<div class="container">
				<div class="template-title center">
					<h1>Ecomnomy Premium Limousine</h1>
					<span>Ecomnomy Premium Limousine</span>
					<p>We also take custom orders and will help you acquire a specific yacht.</p>
				</div>
				<div class="row">
					<div class="col-xs-12 col-sm-12 col-md-8 fix-bst">
						<article class="block-customs-single">
							<div class="featured-customs">
								<div class="owl-carousel">
									<div class="images">
										<img src="images/fleet/detail_fleet.jpg" alt="">
										<a href="#" class="bkings">Online Booking<img src="images/icon/arrow-white.png" alt=""></a>
									</div>
									<div class="images">
										<img src="images/fleet/detail_fleet.jpg" alt="">
										<a href="#" class="bkings">Online Booking<img src="images/icon/arrow-white.png" alt=""></a>
									</div>
									<div class="images">
										<img src="images/fleet/detail_fleet.jpg" alt="">
										<a href="#" class="bkings">Online Booking<img src="images/icon/arrow-white.png" alt=""></a>
									</div>
									<div class="images">
										<img src="images/fleet/detail_fleet.jpg" alt="">
										<a href="#" class="bkings">Online Booking<img src="images/icon/arrow-white.png" alt=""></a>
									</div>
									<div class="images">
										<img src="images/fleet/detail_fleet.jpg" alt="">
										<a href="#" class="bkings">Online Booking<img src="images/icon/arrow-white.png" alt=""></a>
									</div>
								</div>
							</div>
							<div class="info-fleet">
								<h3 class="title">Hiring a Mercedes E-Class with Prodrive</h3>
								<h5 class="sub-title">Mercedes E Class</h5>
								<p>The Mercedes Benz E Class chauffeur car is the perfect executive level chauffeur car for all types of business trips and airport transfers. The E Class packs safety, luxury and style into one very affordable package. The executive E Class has always been popular and like it is big brother the S Class Limousine features many of the hallmarks that have made Mercedes-Benz one of the finest automobile manufacturers.</p>
							</div>
						</article>
						<div class="bottom-content row">
							<div class="col-xs-12 col-sm-12 col-md-4 fix-bst">
								<ul class="detail-info">
									<li><span>Passengers</span><p>4</p></li>
									<li><span>Interior</span><p>Black Leather</p></li>
									<li><span>DVD Player</span><p>Yes</p></li>
									<li><span>On Board Wifi</span><p>Yes</p></li>
								</ul>
							</div>
							<div class="col-xs-12 col-sm-12 col-md-4 fix-bst">
								<ul class="detail-info">
									<li><span>Passengers</span><p>4</p></li>
									<li><span>Interior</span><p>Black Leather</p></li>
									<li><span>DVD Player</span><p>Yes</p></li>
									<li><span>On Board Wifi</span><p>Yes</p></li>
								</ul>
							</div>
							<div class="col-xs-12 col-sm-12 col-md-4 fix-bst">
								<ul class="detail-info">
									<li><span>Passengers</span><p>4</p></li>
									<li><span>Interior</span><p>Black Leather</p></li>
									<li><span>DVD Player</span><p>Yes</p></li>
									<li><span>On Board Wifi</span><p>Yes</p></li>
								</ul>
							</div>
						</div>
					</div>
					<div class="col-xs-12 col-sm-12 col-md-4 fix-bst">
						<div class="sidebar">
							<div class="sdl-booking add-box not-fixed">
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
							<div class="popular-fleet">
								<div class="items">
									<div class="content">
										<h3 class="title">PER HOUR RATE</h3>
										<div class="price">
											<span>$29</span> / hour
										</div>
										<p>*$3/hour Fuel Sercharges</p>
									</div>
									<div class="images">
										<img src="images/icon/fr1.png" alt="">
									</div>
								</div>
								<div class="items">
									<div class="content">
										<h3 class="title">PER HOUR RATE</h3>
										<div class="price">
											<span>$529</span> / hour
										</div>
										<p>*$3/hour Fuel Sercharges</p>
									</div>
									<div class="images">
										<img src="images/icon/fr2.png" alt="">
									</div>
								</div>
								<div class="items">
									<div class="content">
										<h3 class="title">PER HOUR RATE</h3>
										<div class="price">
											<span>$129</span> / hour
										</div>
										<p>*depend on picking up area</p>
									</div>
									<div class="images">
										<img src="images/icon/fr3.png" alt="">
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
@endsection