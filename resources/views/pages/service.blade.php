@extends('layouts.app')

@section('content')
<section class="top-title">
    <div class="top-page">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="top-page-heading">
                        <h1>SERVICES</h1>
                        <p class="sub-title">Service at the highest level!</p>
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
                            <a href="{{ url('/') }}">Home</a>
                        </li>
                        <li>
                            /Service
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Top Title -->
<!-- Start Services Area -->
<section class="services-area">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="template-title center">
                    <h1>Our Services</h1>
                    <span>Our Services</span>
                    <p class="subtitle">
                        Our aim is to fill a gap in niche market of Trade
                    </p>
                </div>
            </div>
        </div>
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
        {{-- <div class="row">
            <div class="col-md-12">
                <div class="pagination-area ver-3">
                    <ul>
                        <li class="prev ">
                            <a href="#" class="waves-effect" title="">
                                <img src="{{ asset('frontend/images/icon/prev.png')}}" alt="">
                            </a>
                        </li>
                        <li>
                            <a href="#" class="waves-effect" title="">1</a>
                        </li>
                        <li class="active"><a href="#" class="waves-effect" title="">2</a></li>
                        <li><a href="#" class="waves-effect" title="">3</a></li>
                        <li><a href="#" class="waves-effect" title="">...</a></li>
                        <li><a href="#" class="waves-effect" title="">22</a></li>
                        <li class="next">
                            <a href="#" class="waves-effect" title="">
                                <img src="{{ asset('frontend/images/icon/next.png')}}" alt="">
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div> --}}
    </div>
</section>
@endsection