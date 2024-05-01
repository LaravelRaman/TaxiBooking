@extends('layouts.app')

@section('content')
<section class="top-title ver-1" style="background-image: url('{{ asset('uploads/event_banner/' . $image->banner_image) }}'); background-size: 100% 100%;">
    <div class="top-page">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="top-page-heading">
                        <h1>{{ $service->event_name }}</h1>
                        <p class="sub-title">Lorem Ipsum has been the industry's standard dummy text ever since the 1500s</p>
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
                            <a href="#">Home</a>
                        </li>
                        <li>
                            / Service
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="customs-single ver-1">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <article class="block-customs-single ver-1">
                    <div class="featured-customs">
                        <img src="{{ asset('uploads/event_thumbnail/' . $service->thumbnail) }}" style="width: 100%;">
                    </div>
                    <div class="entry-customs">
                        <div class="entry-box">
                            <h3>{{ $service->event_text }}</h3>
                            <p>{!! $service->description !!}</p>
                        </div>
                    </div>
                </article>
            </div>
            <!-- <div class="col-md-4">
                <div class="sidebar">
                    <div class="widget widget-category">
                        <h3>Service</h3>
                        <ul>
                            <li>
                                <a href="#" title=""><img src="images/icon/next.png" alt="">Business class</a>
                            </li>
                            <li>
                                <a href="#" title=""><img src="images/icon/next.png" alt="">Proms</a>
                            </li>
                            <li>
                                <a href="#" title=""><img src="images/icon/next.png" alt="">Airport transport</a>
                            </li>
                            <li>
                                <a href="#" title=""><img src="images/icon/next.png" alt="">Chauffeur Service</a>
                            </li>
                            <li>
                                <a href="#" title=""><img src="images/icon/next.png" alt="">Weddings</a>
                            </li>
                            <li>
                                <a href="#" title=""><img src="images/icon/next.png" alt="">Parties</a>
                            </li>
                        </ul>
                    </div>
                    <div class="widget-infomation">
                        <ul>
                            <li>
                                <div class="text">
                                    <h5>Address</h5>
                                    <p>329 Queensberry Street, North Melbourne VIC 3051, Australia.</p>
                                </div>
                                <div class="icon">
                                    <img src="images/icon/address.png" alt="">
                                </div>
                            </li>
                            <li>
                                <div class="text">
                                    <h5>Phone</h5>
                                    <p>123 456 7890</p>
                                </div>
                                <div class="icon">
                                    <img src="images/icon/phone.png" alt="">
                                </div>
                            </li>
                            <li>
                                <div class="text">
                                    <h5>Email</h5>
                                    <p>info@prodrive.com</p>
                                </div>
                                <div class="icon">
                                    <img src="images/icon/email.png" alt="">
                                </div>
                            </li>
                            <li class="download">
                                <a href="#">
                                    <div class="text">
                                        <h5>Download PDF brochure</h5>
                                    </div>
                                    <div class="icon">
                                        <img src="images/icon/download.png" alt="">
                                    </div>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div> -->
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
                                    <a href="#" class="register_now">Reserve Now<img src="{{ asset('frontend/images/icon/arrow-white.png') }}" alt=""></a>
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
                                    <a href="#" class="register_now">Reserve Now<img src="{{ asset('frontend/images/icon/arrow-white.png') }}" alt=""></a>
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
                                    <a href="#" class="register_now">Reserve Now<img src="{{ asset('frontend/images/icon/arrow-white.png') }}" alt=""></a>
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
                                <img src="{{ asset('frontend/images/icon/fr1.png') }}" alt="">
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
                                <img src="{{ asset('frontend/images/icon/fr2.png') }}" alt="">
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
                                <img src="{{ asset('frontend/images/icon/fr3.png') }}" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection