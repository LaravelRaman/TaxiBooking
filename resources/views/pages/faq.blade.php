@extends('layouts.app')

@section('content')
<section class="top-title">
    <div class="top-page">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="top-page-heading">
                        <h1>ACCORDION</h1>
                        <p class="sub-title">Shortcode Usage</p>
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
                            / Shortcode
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Top Title -->
<!-- Start Accordion Area -->
<section class="accordion-area">
    <div class="container">
        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-10">
                <div class="accordion">
                    @foreach ($faqs as $faq)
                        <div class="accordion-toggle">
                            <div class="toggle-title {{ $faq->sno == 1?'active':'' }}">
                                {{ $faq->question }}
                                <span>
                                    <img src="{{ asset('frontend/images/icon/right-2.png') }}" alt="">
                                </span>
                            </div>
                            <div class="toggle-content">
                                <p>
                                    {!! $faq->answer !!}
                                </p>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="col-md-1"></div>
        </div>
    </div>
</section>
@endsection