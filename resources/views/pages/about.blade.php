@extends('layouts.app')

@section('content')
<section class="top-title">
    <div class="top-page">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="top-page-heading">
                        <h1>ABOUT</h1>
                        <p class="sub-title">We are the most popular limousine service in New York.</p>
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
                            <a href="{{ url('/') }}">Home </a>
                        </li>
                        <li>
                            / About
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Top Title -->
<!-- Start Custom Single -->
<section class="customs-single">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <article class="block-customs-single">
                    <div class="featured-customs">
                        <div class="images">
                            <img src="{{ asset('frontend/images/parallax/aboutus.jpg') }}" alt="" style="width: 750px;height: 484px;border: 2px solid #c3a05b;border-radius: 10px;">
                        </div>
                    </div>
                    <div class="entry-customs">
                        <div class="entry-box" id="scroll-to-div-about">
                            <h4>About Grandeur Chauffeurs - Car Chauffeur Service Sydney</h4>
                            <p>
                                Sydney’s Best Chauffeur Company for Leisure, Business & Corporate Travel
                            </p>
                            <p>
                                Grandeur Chauffeurs was established to offer professional chauffeur services and brand new luxury cars to individuals and corporations who value professionalism. We are bold in our promises and we take full responsibility for the service and guarantee a licensed, insured, professional drivers. Our company has a proven track record with existing clients – and indeed we strive to exceed all expectations at all times. This is our simple philosophy: If the client is happy, we are happy.
                            </p>
                            <p>Grandeur Chauffeurs is a Sydney based premier chauffeur company providing professional executive chauffeur services and affordable luxury chauffeur driven car hire in Sydney. Providing outstanding customer service for many years, Grandeur Chauffeurs offers secure and discreet chauffeur services for leisure and business travel.</p>
                        </div>
                        <div class="entry-box" id="scroll-to-div-vision">
                            <h4>Grandeur Chauffeurs’s Vision</h4>
                            <p>Grandeur Chauffeurs has the vision to be the best chauffeur company in Sydney. We aim to unlock our company’s great potential, helping to make us a leaner, more agile, and more transparent organization. One that delivers but, above all, makes us the best business chauffeur company for our customers. We think about customers first in everything we do, consistently striving to positive long-lasting relationships and helping them achieve their business goals.</p>
                            <p>By working together we will make a positive impact on customers, colleagues, and communities. By working together consistently in a collaborative way and really listening to what our customers need, we will build the best business chauffeur company for the customers and communities we serve.</p>
                        </div>
                        <div class="entry-box" id="scroll-to-div-ceo">
                            <h4>Message From The CEO</h4>
                            <p>We strive to provide outstanding customer service and the best chauffeur experience to the most discerning leisure and business travelers. Our objective is to keep the image of the word “Executive Chauffeur” where it should be and set an example of Sydney’s finest chauffeurs to all our clients. Professionalism is at the core of our business and at Grandeur Chauffeurs we have built our reputation on the basis of our performance alone, and we take this very seriously at all times.</p>
                        </div>
                    </div>
                </article>
            </div>
            <div class="col-md-4">
                <div class="sidebar">
                    <div class="widget widget-category">
                        <h3>Prodirve</h3>
                        <ul>
                            <li>
                                <a href="#scroll-to-div-about" title=""><img src="{{ asset('frontend/images/icon/next.png') }}" alt="">Our Company</a>
                            </li>
                            <li>
                                <a href="#scroll-to-div-vision" title=""><img src="{{ asset('frontend/images/icon/next.png') }}" alt="">Our Vision</a>
                            </li>
                            <li>
                                <a href="#scroll-to-div-ceo" title=""><img src="{{ asset('frontend/images/icon/next.png') }}" alt="">Message From CEO</a>
                            </li>
                            <li>
                                <a href="{{ route('service') }}" title=""><img src="{{ asset('frontend/images/icon/next.png') }}" alt="">Our Service</a>
                            </li>
                            <li>
                                <a href="{{ route('contact') }}" title=""><img src="{{ asset('frontend/images/icon/next.png') }}" alt="">Contact</a>
                            </li>
                        </ul>
                    </div>
                    <div class="widget-infomation">
                        <ul>
                            <li class="download">
                                <a href="#">
                                    <div class="text">
                                        <h5>Download PDF brochure</h5>
                                    </div>
                                    <div class="icon">
                                        <img src="{{ asset('frontend/images/icon/download.png') }}" alt="">
                                    </div>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Custom Single -->
<!-- Start Section Iconbox -->
<section class="section-iconbox">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-sm-6">
                <div class="iconbox center">
                    <div class="iconbox-icon">
                        <img src="{{ asset('frontend/images/iconbox/01.png') }}" alt="">
                    </div>
                    <div class="iconbox-content">
                        <h3>
                            <a href="#" title="">Easy Online Booking</a>
                        </h3>
                        <p>Lorem ipsum dolor sit amet, consectadipiscing elit. Aenean commodo ligula eget dolor.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">
                <div class="iconbox center">
                    <div class="iconbox-icon">
                        <img src="{{ asset('frontend/images/iconbox/02.png') }}" alt="">
                    </div>
                    <div class="iconbox-content">
                        <h3>
                            <a href="#" title="">Professional Drivers</a>
                        </h3>
                        <p>A new shuttle train service between Singapore and Johor Bahru kicked off on Wednesday. </p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">
                <div class="iconbox center">
                    <div class="iconbox-icon">
                        <img src="{{ asset('frontend/images/iconbox/03.png') }}" alt="">
                    </div>
                    <div class="iconbox-content">
                        <h3>
                            <a href="#" title="">Variety of Car Brands</a>
                        </h3>
                        <p>The service, called Shuttle Tebrau, is  operated by Malaysia’s JB Sentral in just five minutes.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">
                <div class="iconbox center">
                    <div class="iconbox-icon">
                        <img src="{{ asset('frontend/images/iconbox/04.png') }}" alt="">
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
@endsection