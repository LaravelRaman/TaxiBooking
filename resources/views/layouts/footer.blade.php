<footer id="footer" class="footer-04">
    <div class="container">				
        <div class="row">
            <div class="col-md-4 ft1">
                <div class="widget-footer widget-about">
                    <div class="logo-ft">
                        <a href="{{ url('/') }}" title="">
                            <img src="{{ asset('frontend/images/logo.png') }}" alt="">
                        </a>
                    </div>
                    <p>
                        <i class="fa fa-map-marker"></i> 329 Queensberry Street, North Melbourne VIC 3051, Australia.
                    </p>
                    <ul class="infomation-ft">
                        <li><i class="fa fa-phone"></i> 123 456 7890</li>
                        <li><i class="fa fa-envelopes"></i> upport@prodrive.com</li>
                    </ul>
                    {{-- <ul class="social-ft">
                        <li>
                            <a href="#" title="Facebook">
                                <i class="fa fa-facebook" aria-hidden="true"></i>
                            </a>
                        </li>
                        <li>
                            <a href="#" title="Twitter">
                                <i class="fa fa-twitter" aria-hidden="true"></i>
                            </a>
                        </li>
                        <li>
                            <a href="#" title="Instagram">
                                <i class="fa fa-instagram" aria-hidden="true"></i>
                            </a>
                        </li>
                        <li>
                            <a href="#" title="Pinterest">
                                <i class="fa fa-pinterest" aria-hidden="true"></i>
                            </a>
                        </li>
                        <li>
                            <a href="#" title="Dribble">
                                <i class="fa fa-dribbble" aria-hidden="true"></i>
                            </a>
                        </li>
                        <li>
                            <a href="#" title="Google">
                                <i class="fa fa-google" aria-hidden="true"></i>
                            </a>
                        </li>
                    </ul> --}}
                </div>
            </div>
            <div class="col-md-4 ft2">
                <div class="widget-footer widget-services">
                    <h3 class="title-ft">
                        Our services
                    </h3>
                    <ul>
                        @php
                            $count = 0;
                        @endphp
                        @foreach ($services as $service)
                            {{-- @php
                                if ($count == floor(count($services) / 2)) {
                                    echo '</ul><ul>';
                                }
                                $count++;
                            @endphp --}}
                            <li>
                                <a href="{{ route('service-home', ['slug' => $service->service_slug]) }}">{{ $service->service_name }}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            {{-- <div class="col-md-2 ft2">
                <div class="widget-footer widget-services">
                    <h3 class="title-ft">
                        About us
                    </h3>
                    <ul>
                        <li>
                            <a href="#" title="">Chauffeurs</a>
                        </li>
                        <li>
                            <a href="#" title="">About us</a>
                        </li>
                        <li>
                            <a href="#" title="">Blog</a>
                        </li>
                        <li>
                            <a href="#" title="">FAQs</a>
                        </li>
                        <li>
                            <a href="#" title="">Testimonials</a>
                        </li>
                        <li>
                            <a href="#" title="">Terms & Conditions</a>
                        </li>
                        <li>
                            <a href="#" title="">Contact</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-md-2 ft2">
                <div class="widget-footer widget-services">
                    <h3 class="title-ft">
                        Our cars
                    </h3>
                    <ul>
                        <li>
                            <a href="#" title="">Mercedes S-Class</a>
                        </li>
                        <li>
                            <a href="#" title="">Mercedes E-Class</a>
                        </li>
                        <li>
                            <a href="#" title="">Rolls-Royce Phantom</a>
                        </li>
                        <li>
                            <a href="#" title="">Bentley Mulsanne</a>
                        </li>
                        <li>
                            <a href="#" title="">Mercedes V-Class</a>
                        </li>
                        <li>
                            <a href="#" title="">Range Rover</a>
                        </li>
                        <li>
                            <a href="#" title="">Luxury Minibus</a>
                        </li>
                    </ul>
                </div>
            </div> --}}
            <div class="col-md-3 ft1">
                <div class="widget-footer newletter">
                    <h3 class="title-ft">
                        Newsletter
                    </h3>
                    <p class="content-newletter">Subscribe to our newsletter for news, 
                    updates, exclusive discounts and offers.</p>
                    <form id="subscribe-form" action="#" method="post" accept-charset="utf-8" data-mailchimp="true">
                        <div id="subscribe-content">
                            <div class="field-one-third">
                                <div class="field-name">
                                    <input id="subscribe-email" type="text" name="email" placeholder="Email">
                                </div>
                            </div>
                            <div class="btn-submit">
                                <button id="subscribe-button" type="button" class="base box-shadow"><img src="images/icon/arrow-gay.png" alt=""></button>
                            </div>
                        </div>
                        <div id="subscribe-msg">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- End Footer -->
<!-- Start Copyright -->
<section class="copyright">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <p>Copyright Prodrive © 2018.  All Rights Reserved</p>
            </div>
            <div class="col-md-4">
                <a href="{{ url('/') }}" title="">
                    <img src="{{ asset('frontend/images/logo.png') }}" alt="">
                </a>
            </div>
            <div class="col-md-4" style="margin-left:-50px;">
                <ul class="social-ft">
                    <li>
                        <a href="#" title="Facebook">
                            <i class="fa fa-facebook" aria-hidden="true"></i>
                        </a>
                    </li>
                    <li>
                        <a href="#" title="Instagram">
                            <i class="fa fa-instagram" aria-hidden="true"></i>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>			
</section>