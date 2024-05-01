<div class="navigation" style="margin-top: 7px;">
    <div class="mobile-menu">
        <span></span>
    </div>
    <div id="main-menu" class="main-menu">
        <div class="top-text">
            <span>
                <a href="{{ url('/') }}" title=""><img src="{{ asset('frontend/images/logo.png') }}" alt=""></a>
            </span>
            <i class="pe-7s-close"></i>
        </div>
        <ul class="menu">
            <li class="has-dropdown">
                <a href="{{ url('/') }}">Home</a>
                <!-- <ul class="menu-dropdown">
                    <li><a href="index.html">Home 01</a></li>
                    <li><a href="index2.html">Home 02</a></li>
                    <li><a href="index3.html">Home 03</a></li>
                    <li><a href="index4.html">Home 04</a></li>
                    <li><a href="index5.html">Home 05</a></li>
                </ul> -->
            </li>
            <li class="has-dropdown">
                <a href="{{ route('book-now') }}">Book Online</a>
            </li>
            <li class="has-dropdown">
                <a href="{{ route('about') }}">About Us</a>
            </li>
            <li class="has-dropdown">
                <a href="{{ route('service') }}">Our Service</a>
                <ul class="menu-dropdown">
                    @php
                        $services = \App\Models\Event::where('type','service')->get();
                        $fleet = \App\Models\VehicleType::get();
                    @endphp
                    @foreach($services as $service)
                        <li><a href="{{ route('service-home',['slug' => $service->event_slug]) }}">{{$service->event_name}}</a></li>
                    @endforeach
                </ul>
            </li>
            <li class="has-dropdown">
                <a href="{{ route('fleet') }}">Our Fleet</a>
                <ul class="menu-dropdown">
                    @foreach($fleet as $flt)
                        <li><a href="{{ route('fleet',str_replace(' ','_',strtolower($flt->vehicle_type))) }}">{{$flt->vehicle_type}}</a></li>
                    @endforeach
                </ul>
            </li>
            <li class="has-dropdown">
                <a href="{{ route('event') }}">Events</a>
                <!-- <ul class="menu-dropdown">
                    <li><a href="booking-car-class.html">Booking Car Class</a></li>
                    <li><a href="booking-card.html">Booking Card</a></li>
                    <li><a href="booking-check-out.html">Booking Checkout</a></li>
                    <li><a href="booking-login.html">Booking Login</a></li>
                    <li><a href="booking-options.html">Booking Options</a></li>
                    <li><a href="404.html">404 Page</a></li>
                    <li><a href="about1.html">About 01</a></li>
                    <li><a href="about2.html">About 02</a></li>
                    <li><a href="accordion.html">Accordion</a></li>
                    <li><a href="alert.html">Alert</a></li>
                    <li><a href="button.html">Button</a></li>
                    <li><a href="price-table.html">Price Table</a></li>
                    <li><a href="progress.html">Progress</a></li>
                    <li><a href="tables.html">Tables</a></li>
                    <li><a href="tabs.html">Tabs</a></li>
                    <li><a href="typography.html">Typography</a></li>
                </ul> -->
            </li>
            <li class="has-dropdown">
                <a href="{{ route('faq') }}">FAQs</a>
                <!-- <ul class="menu-dropdown">
                    <li><a href="blog.html">Blog</a></li>
                    <li><a href="blog-grid.html">Blog Grid</a></li>
                    <li><a href="blog-sidebar.html">Blog Sidebar</a></li>
                    <li><a href="blog-fullwidth.html">Blog Fullwidth</a></li>
                    <li><a href="blog-fullwidth-sidebar.html">Blog Fullwidth Sidebar</a></li>
                    <li><a href="blog-single.html">Blog Single</a></li>
                </ul> -->
            </li>
            <li class="has-dropdown">
                <a href="{{ route('contact') }}">Reach Us</a>
                <!-- <ul class="menu-dropdown">
                    <li><a href="contact1.html">Contact 01</a></li>
                    <li><a href="contact2.html">Contact 02</a></li>
                </ul> -->
            </li>
        </ul>
    </div>
</div>