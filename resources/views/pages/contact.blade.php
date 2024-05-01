@extends('layouts.app')

@section('content')
<section id="map" style="margin-top: 107px;">
    <div id="contact-map" class="pdmap">
           <div class="contact-maps" data-address="Camberwell Victoria 3124, Úc" data-height="503" data-images="images/icon/map.png" data-name="Themesflat Map"></div>
        <div class="gm-map">                
            <div class="map"></div>                        
        </div>
    </div><!-- /#contact-map -->
</section>
<!-- End Map -->
<!-- Start contact Area -->
<section class="contact-area">
    <div class="container">
        <div class="template-title center has-over">
            <h1>Enjoy Coffee With Us</h1>
            <span>Enjoy Coffee With Us</span>
        </div>
        <div class="row">
            <div class="col-lg-2 col-sm-1"></div>
            <div class="col-lg-4 col-sm-5">
                <div class="address-box">
                    <h4>Melbourne, Australia</h4>
                    <p>329 Queensberry Street, North Melbourne VIC 3051, Australia. </p>
                    <div class="contact">
                        <p><span>Email: </span>support@prodrive.com</p>
                        <p><span>Skype: </span>prodrive</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-1 col-sm-1">
            </div>
            <div class="col-lg-3 col-sm-5">
                <div class="address-box style1">
                    <h4>Call directly</h4>
                    <p class="phone">+99 (0) 123 456 78 90</p>
                    <div class="hours">
                        <h5>Work Hours</h5>
                        <ul>
                            <li>Monday - Friday : 08h00 - 17h30</li>
                            <li>Saturday: 08h00 - 12h00, Sunday off work</li>
                        </ul>
                    </div>
                    <div class="follow">
                        <h5>Follow Us</h5>
                        <ul>
                            <li>
                                <a href="#" title="">
                                    <i class="fa fa-facebook" aria-hidden="true"></i>
                                </a>
                            </li>
                            <li>
                                <a href="#" title="">
                                    <i class="fa fa-twitter" aria-hidden="true"></i>
                                </a>
                            </li>
                            <li>
                                <a href="#" title="">
                                    <i class="fa fa-instagram" aria-hidden="true"></i>
                                </a>
                            </li>
                            <li>
                                <a href="#" title="">
                                    <i class="fa fa-pinterest" aria-hidden="true"></i>
                                </a>
                            </li>
                            <li>
                                <a href="#" title="">
                                    <i class="fa fa-dribbble" aria-hidden="true"></i>
                                </a>
                            </li>
                            <li>
                                <a href="#" title="">
                                    <i class="fa fa-google" aria-hidden="true"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-md-1"></div>
        </div>
        <div class="row">
            <div class="col-lg-2"></div>
            <div class="col-lg-8">
                <div class="contact-form">
                    <h4 class="center">Please fulfil the form below.</h4>
                    <form action="{{ route('add.contact') }}" method="POST" enctype="multipart-formdata">
                    @csrf
                        <div class="form form-name one-half">
                            <label for="name">Name</label>
                            <input type="text" id="name" name="name" placeholder="Name">
                        </div>
                        <div class="form form-email one-half">
                            <label for="email">Email</label>
                            <input type="text" id="email" name="email" placeholder="example.prodrive@gmail.com">
                        </div>
                        <div class="form form-comment">
                            <label for="comment">Subject</label>
                            <input type="text" id="email" name="subject" placeholder="Subject">
                        </div>
                        <div class="form form-comment">
                            <label for="comment">Comment</label>
                            <textarea name="message" id="comment" placeholder="Your Message"></textarea>
                        </div>
                        <div class="btn-submit-form">
                            <button type="submit">Submit <img src="{{ asset('frontend/images/icon/right-3.pngchro') }}" alt=""></button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-lg-2"></div>
        </div>
    </div>
</section>
@endsection
@section('scripts')
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCjGtMl0hHyRNVj0bEc3FDEOgqRyc5aiRs&callback=initMap"type="text/javascript"></script>
<script type="text/javascript" src="{{ asset('frontend/js/gmap3.min.js') }}"></script>
@endsection