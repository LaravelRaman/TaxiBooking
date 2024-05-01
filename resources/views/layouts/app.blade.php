@php
    $fleet = fleet();
    $services = services();
@endphp
<!DOCTYPE html>
<html>
	<head>
		<!-- Basic Page Needs -->
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<meta name="description" content="{{!empty($meta_description)?$meta_description:''}}">
		<meta name="keywords" content="{{!empty($meta_keywords)?$meta_keywords:''}}">
		<meta name="author" content="CreativeLayers">
		<meta name="csrf-token" content="{{ csrf_token() }}">
		<title>{{!empty($meta_title)?$meta_title:'Granduer Chauffeurs'}}Prodrive</title>
		<!-- Boostrap style -->
		<link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/bootstrap.min.css')}}">
		<link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/bootstrap-glyphicons.css')}}">
		<link rel='dns-prefetch' href='https://maps.google.com' />

		<link rel="stylesheet" type="text/css" href="{{ asset('/frontend/css/date-picker.css') }}">
    	<link rel="stylesheet" type="text/css" href="{{ asset('/frontend/css/timepicker.css') }}">
		<!-- REVOLUTION LAYERS STYLES -->
		<link rel="stylesheet" type="text/css" href="{{ asset('frontend/revolution/css/layers.css')}}">
		<link rel="stylesheet" type="text/css" href="{{ asset('frontend/revolution/css/settings.css')}}">
		<!-- Theme style -->
		<link rel="stylesheet" href="{{ asset('frontend/css/style.css')}}">
		<!-- Responsive style -->
		<link rel="stylesheet" href="{{ asset('frontend/css/responsive.css')}}">
		<script src="https://sandbox.web.squarecdn.com/v1/square.js"></script>

		<style>
			.vehicle-select-btn-web{
				background-color: #d7d2bd;
				margin-top: 107px;
			}
			.details-card-web{
				margin-top: 50px;
				margin-bottom: 50px; 
				padding: 40px; 
				background-color: #fff3d62e;
			}
		@media (max-width: 768px) {
            .progressbar{
                margin-left: 85px;
    			margin-top: 37px;
            }
			.map-mobile{
				margin-top: 68px;
			}
			.calculate{
				padding-right: 9px;
    			padding-left: 30px;
    			margin-top: 20px;
			}
			.choose-button{
    			padding-left: 107px;
			}
			.map-mob{
				margin-top: 68px;
			}
			.container {
				max-width: 100%;
			}
			.vehicle-text{
				padding-right: 855px;
			}
			.vehicle-image{
				width: 26%;
    			margin-bottom: 20px;
			}
			.vehicle-select-btn{
				margin-top: 10px;
			}
			.mobile-btn{
				text-align: center;
			}
			.details-card{
				margin: 10px;
			}
		}
		</style>
	</head>
	<body>
		<div class="layout-theme">
			<div id="loading-overlay">
		        <div class="loader"></div>
		    </div>
		    <!-- Start Header -->
			<header id="header" class="header-04">
				<div class="top-header">
					<div class="container">
						<div class="row">
							<div class="col-xs-12 col-sm-12 col-md-6 left-content">
								<ul>
									<li><img src="{{ asset('frontend/images/icon/call.png') }}" alt="">(880) 172 380 956</li>
									<li><img src="{{ asset('frontend/images/icon/maind.png') }}" alt="">info@prodirve.com</li>
									<li><img src="{{ asset('frontend/images/icon/clock.png') }}" alt="">Mon-Sat: 8:00am-6:30pm</li>
								</ul>
							</div>
							<div class="col-xs-12 col-sm-12 col-md-6 right-content">
								@if (Auth::user())
								<a class="login" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" style="color:#bc410d;">
									<i class="fa fa-power-off" aria-hidden="true"></i> <b>Logout</b>
								</a>
								<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
									@csrf
								</form>
								@else
								<div class="login">
									<a href="{{ url('login') }}">Login/</a>
									<a href="{{ url('register') }}">Register</a>
								</div>
								@endif
								
								<div class="top-menuleft no_bo">
									<div class="x_language">
										<img src="images/icon/web.png" alt="">
										<select id="languages">
										  <option value="saab">KR</option>
										  <option value="vw">FR</option>
										  <option value="audi" selected>TR</option>
										</select>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="bottom-header" style="height: 99px;">
					<div class="container">
						<div id="logo" class="logo-pro">
							<a href="{{ url('/') }}" title="logo prodrive">
								<img src="{{ asset('frontend/images/logo.png') }}" alt="">
							</a>
						</div>
						@include('layouts.navigation')
						<div class="box-right">
							<div class="search">
								<a href="#" class="view_search"><i class="pe-7s-search"></i></a>
								<form class="form-search" method="get" action="#">
									<input class="action-text" type="text" name="s" placeholder="Type & Hit Enter...">
									<button type="submit" id="submit"><i class="pe-7s-search"></i></button>
									<a href="#" class="close-fixed" title="Close"><img src="{{ asset('frontend/images/icon/close_s.png') }}" alt=""></a>
								</form>
							</div>
						</div>
					</div>
				</div>
			</header>
			<!-- End Copyright -->
			<!-- Start Tp Banner -->
			@yield('content')
			<!-- End About Box -->
			<!-- Start Template title -->
			<!-- <section class="template-title has-over ovvs">
				<div class="container">
					<h3 class="title">Our Services</h3>
					<p class="subtitle">Our aim is to fill a gap in niche market of Trade</p>
				</div>
			</section> -->
			<!-- End Template title -->
			<!-- Start Icon Box -->
			<!-- <section class="icon-box bbt">
				<div class="container">
					<ul class="tab_services">
						<li class="active"><a href="#sv-1">
							<img src="images/icon/forma1.png" alt="">
							Limousine Service
						</a></li>
						<li><a href="#sv-2">
							<img src="images/icon/forma2.png" alt="">
							Chauffeur Service
						</a></li>
						<li><a href="#sv-3">
							<img src="images/icon/forma3.png" alt="">
							Airport Transfers
						</a></li>
					</ul>
					<div id="sv-1" class="content-box">
						<div class="position-content">
							<p class="left-content">The exclusive way to travel</p>
							<p class="center-content">Enjoy the comfort of our limousines and business vans. Prepare for your next business meeting in peace, or let your chauffeur show you the highlights of the city.</p>
							<p class="right-content">However you may spend your time – you can fully rely on your chauffeur, stay relaxed, and reach your destination safely. Step right in and sit back. We will take care of everything else.</p>
						</div>
						<div class="view_service">
							<a href="#">More Service<img src="images/icon/arrow-next.png" alt=""></a>
						</div>
					</div>
					<div id="sv-2" class="content-box">
						<div class="position-content">
							<p class="left-content">The exclusive way to travel</p>
							<p class="center-content">Enjoy the comfort of our limousines and business vans. Prepare for your next business meeting in peace, or let your chauffeur show you the highlights of the city.</p>
							<p class="right-content">However you may spend your time – you can fully rely on your chauffeur, stay relaxed, and reach your destination safely. Step right in and sit back. We will take care of everything else.</p>
						</div>
						<div class="view_service">
							<a href="#">More Service<img src="images/icon/arrow-next.png" alt=""></a>
						</div>
					</div>
					<div id="sv-3" class="content-box">
						<div class="position-content">
							<p class="left-content">The exclusive way to travel</p>
							<p class="center-content">Enjoy the comfort of our limousines and business vans. Prepare for your next business meeting in peace, or let your chauffeur show you the highlights of the city.</p>
							<p class="right-content">However you may spend your time – you can fully rely on your chauffeur, stay relaxed, and reach your destination safely. Step right in and sit back. We will take care of everything else.</p>
						</div>
						<div class="view_service">
							<a href="#">More Service<img src="images/icon/arrow-next.png" alt=""></a>
						</div>
					</div>
				</div>
			</section> -->
			<!-- End Icon Box -->
			
			<!-- Start Testimonial -->
			<!-- <section class="testimonial parallax">
				<div class="container">
					<div class="fleet-carousel" data-columns="1">
						<div class="owl-carousel">
							<div class="items">
								<div class="content">
									<img src="images/icon/qteleft.png" class="first" alt="">
									<p>I have used iChauffeur on a business level for a number of years now and always find them to have high quality vehicles
									available even at short notice, their drivers are always well turned out and very professional with any potential clients 
									we have with us. The booking and payment process is very easy and I wouldn’t hesitate to recommend 
									iChauffeur to anyone and have done so on many occasions!</p>
									<img src="images/icon/qteright.png" class="last" alt="">
								</div>
								<div class="info">
									<h4 class="name">Ali Tufan</h4>
									<p class="company">General Manager, Coca Co.</p>
								</div>
							</div>
							<div class="items">
								<div class="content">
									<img src="images/icon/qteleft.png" class="first" alt="">
									<p>I have used iChauffeur on a business level for a number of years now and always find them to have high quality vehicles
									available even at short notice, their drivers are always well turned out and very professional with any potential clients 
									we have with us. The booking and payment process is very easy and I wouldn’t hesitate to recommend 
									iChauffeur to anyone and have done so on many occasions!</p>
									<img src="images/icon/qteright.png" class="last" alt="">
								</div>
								<div class="info">
									<h4 class="name">Ali Tufan</h4>
									<p class="company">General Manager, Coca Co.</p>
								</div>
							</div>
							<div class="items">
								<div class="content">
									<img src="images/icon/qteleft.png" class="first" alt="">
									<p>I have used iChauffeur on a business level for a number of years now and always find them to have high quality vehicles
									available even at short notice, their drivers are always well turned out and very professional with any potential clients 
									we have with us. The booking and payment process is very easy and I wouldn’t hesitate to recommend 
									iChauffeur to anyone and have done so on many occasions!</p>
									<img src="images/icon/qteright.png" class="last" alt="">
								</div>
								<div class="info">
									<h4 class="name">Ali Tufan</h4>
									<p class="company">General Manager, Coca Co.</p>
								</div>
							</div>
							<div class="items">
								<div class="content">
									<img src="images/icon/qteleft.png" class="first" alt="">
									<p>I have used iChauffeur on a business level for a number of years now and always find them to have high quality vehicles
									available even at short notice, their drivers are always well turned out and very professional with any potential clients 
									we have with us. The booking and payment process is very easy and I wouldn’t hesitate to recommend 
									iChauffeur to anyone and have done so on many occasions!</p>
									<img src="images/icon/qteright.png" class="last" alt="">
								</div>
								<div class="info">
									<h4 class="name">Ali Tufan</h4>
									<p class="company">General Manager, Coca Co.</p>
								</div>
							</div>
						</div>
					</div>
				</div>
			</section> -->
			<!-- End Testimonial -->
			<!-- Start Template Title -->
			<!-- <section class="template-title has-over ovvs">
				<div class="container">
					<h3 class="title">Articles & Tips</h3>
					<p class="subtitle">Explore some of the best tips from around the world</p>
				</div>
			</section> -->
			<!-- End Template Title -->
			<!-- Start Blog Slider -->
			<!-- <section class="blog-slider">
				<div class="container">
					<div class="fleet-carousel" data-columns="3">
						<div class="owl-carousel">
							<article class="post">
								<div class="featured-image">
									<img src="images/blog/01.jpg" alt="">
								</div>							
								<div class="entry-content">
									<div class="entry-post-title">
										<h4 class="post-title"><a href="#">What To Do if Your Rental Car Has Met With An Accident</a></h4>
									</div>
									<ul>
										<li class="author">
											<a href="#"><img src="images/icon/author.png" alt="">Ali Tufan</a>
										</li>
										<li class="date">
											<a href="#"><img src="images/icon/date.png" alt="">January 18, 2017</a>
										</li>
									</ul>
								</div>
							</article>
							<article class="post">
								<div class="featured-image">
									<img src="images/blog/02.jpg" alt="">
								</div>							
								<div class="entry-content">
									<div class="entry-post-title">
										<h4 class="post-title"><a href="#">We’re Expanding To Los Angeles  Next Week!</a></h4>
									</div>
									<ul>
										<li class="author">
											<a href="#"><img src="images/icon/author.png" alt="">Ali Tufan</a>
										</li>
										<li class="date">
											<a href="#"><img src="images/icon/date.png" alt="">January 18, 2017</a>
										</li>
									</ul>
								</div>
							</article>
							<article class="post">
								<div class="featured-image">
									<img src="images/blog/03.jpg" alt="">
								</div>							
								<div class="entry-content">
									<div class="entry-post-title">
										<h4 class="post-title"><a href="#">Car Rental Mistakes That Can Cost You Big</a></h4>
									</div>
									<ul>
										<li class="author">
											<a href="#"><img src="images/icon/author.png" alt="">Ali Tufan</a>
										</li>
										<li class="date">
											<a href="#"><img src="images/icon/date.png" alt="">January 18, 2017</a>
										</li>
									</ul>
								</div>
							</article>
							<article class="post">
								<div class="featured-image">
									<img src="images/blog/04.jpg" alt="">
								</div>							
								<div class="entry-content">
									<div class="entry-post-title">
										<h4 class="post-title"><a href="#">Please Give A Warm Welcome To Our New Driver!</a></h4>
									</div>
									<ul>
										<li class="author">
											<a href="#"><img src="images/icon/author.png" alt="">Ali Tufan</a>
										</li>
										<li class="date">
											<a href="#"><img src="images/icon/date.png" alt="">January 18, 2017</a>
										</li>
									</ul>
								</div>
							</article>
							<article class="post">
								<div class="featured-image">
									<img src="images/blog/05.jpg" alt="">
								</div>							
								<div class="entry-content">
									<div class="entry-post-title">
										<h4 class="post-title"><a href="#">Save 15% For All Repeat Business Bookings</a></h4>
									</div>
									<ul>
										<li class="author">
											<a href="#"><img src="images/icon/author.png" alt="">Ali Tufan</a>
										</li>
										<li class="date">
											<a href="#"><img src="images/icon/date.png" alt="">January 18, 2017</a>
										</li>
									</ul>
								</div>
							</article>
							<article class="post">
								<div class="featured-image">
									<img src="images/blog/06.jpg" alt="">
								</div>							
								<div class="entry-content">
									<div class="entry-post-title">
										<h4 class="post-title"><a href="#">We Have Taken Delivery Of Our New Fleet!</a></h4>
									</div>
									<ul>
										<li class="author">
											<a href="#"><img src="images/icon/author.png" alt="">Ali Tufan</a>
										</li>
										<li class="date">
											<a href="#"><img src="images/icon/date.png" alt="">January 18, 2017</a>
										</li>
									</ul>
								</div>
							</article>
						</div>
					</div>
				</div>
			</section> -->
			<!-- End Blog Slider -->
			<!-- Start Footer -->
			@include('layouts.footer')
			<!-- End Copyright -->
			<div class="scroll-top">
			</div>
		</div>
		<!-- Javascript -->
		<script type="text/javascript" src="{{ asset('frontend/js/jquery.min.js') }}"></script>
		<script type="text/javascript" src="{{ asset('frontend/js/parallax.js') }}"></script>
		<script type="text/javascript" src="{{ asset('frontend/js/waypoints.min.js') }}"></script>
		<script type="text/javascript" src="{{ asset('frontend/js/waves.min.js') }}"></script>

		
		<!--   -->
		<script type="text/javascript" src="{{ asset('frontend/js/moment.min.js') }}"></script>
		<script type="text/javascript" src="{{ asset('frontend/js/owl.carousel.js') }}"></script>
		<script type="text/javascript" src="{{ asset('frontend/js/jquery.daterangepicker.js') }}"></script>
		<script type="text/javascript" src="{{ asset('frontend/js/bootstrap-datetimepicker.js') }}"></script>
		<script type="text/javascript" src="{{ asset('frontend/js/template.js') }}"></script>
		
		<!-- Revolution Slider -->
	    <script type="text/javascript" src="{{ asset('frontend/revolution/js/jquery.themepunch.tools.min.js') }}"></script>
	    <script type="text/javascript" src="{{ asset('frontend/revolution/js/jquery.themepunch.revolution.min.js') }}"></script>
	    <script type="text/javascript" src="{{ asset('frontend/revolution/js/slider.js') }}"></script>

		<script src="{{ asset('frontend/js/datepicker/date-picker/datepicker.js') }}"></script>
		<script src="{{ asset('/frontend/js/datepicker/date-picker/datepicker.en.js') }}"></script>
		<script src="{{ asset('/frontend/js/datepicker/date-picker/datepicker.custom.js?v=2.0') }}"></script>



		<script src="{{ asset('frontend/js/time-picker/jquery-clockpicker.min.js') }}"></script>
		<script src="{{ asset('frontend/js/time-picker/highlight.min.js') }}"></script>
		<script src="{{ asset('frontend/js/time-picker/clockpicker.js') }}"></script>
	    <!-- SLIDER REVOLUTION 5.0 EXTENSIONS  (Load Extensions only on Local File Systems !  The following part can be removed on Server for On Demand Loading) -->    
	    <script type="text/javascript" src="{{ asset('frontend/revolution/js/extensions/revolution.extension.actions.min.js') }}"></script>
	    <script type="text/javascript" src="{{ asset('frontend/revolution/js/extensions/revolution.extension.carousel.min.js') }}"></script>
	    <script type="text/javascript" src="{{ asset('frontend/revolution/js/extensions/revolution.extension.kenburn.min.js') }}"></script>
	    <script type="text/javascript" src="{{ asset('frontend/revolution/js/extensions/revolution.extension.layeranimation.min.js') }}"></script>
	    <script type="text/javascript" src="{{ asset('frontend/revolution/js/extensions/revolution.extension.migration.min.js') }}"></script>
	    <script type="text/javascript" src="{{ asset('frontend/revolution/js/extensions/revolution.extension.navigation.min.js') }}"></script>
	    <script type="text/javascript" src="{{ asset('frontend/revolution/js/extensions/revolution.extension.parallax.min.js') }}"></script>
	    <script type="text/javascript" src="{{ asset('frontend/revolution/js/extensions/revolution.extension.slideanims.min.js') }}"></script>
	    <script type="text/javascript" src="{{ asset('frontend/revolution/js/extensions/revolution.extension.video.min.js') }}"></script>
		<script>
			$(document).ready(function() {
				// smooth scrolling to the div on click
				$('a.scroll-link').click(function(event) {
					event.preventDefault();
					$('html, body').animate({
						scrollTop: $($(this).attr('href')).offset().top
					}, {
						duration: 3000,
						easing: 'easeInOutCubic'
					});
				});
			});
		</script>
		@yield('scripts')
	</body>
</html>