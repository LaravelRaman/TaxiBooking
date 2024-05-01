@extends('layouts.app')

@section('content')
<section class="top-title">
    <div class="top-page">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="top-page-heading">
                        <h1>EVENTS</h1>
                        <p class="sub-title">All the events provided to you.</p>
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
                            /Event
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
<section id="main-post">
    <div class="container">
        <div class="row">
            @foreach ($events as $event)
            <div class="col-lg-4 col-sm-6">
                <article class="post">
                    <div class="featured-image">
                        <div class="item active">
                            <img src="{{ asset('uploads/event_thumbnail/' . $event->thumbnail) }}">
                        </div>
                    </div>							
                    <div class="entry-content">
                        <div class="entry-post-title">
                            <h4 class="post-title"><a href="#">{{ $event->event_name }}</a></h4>
                        </div>
                        <ul>
                            <li class="author">
                                <a href="#"><img src="{{ asset('frontend/images/icon/date.png') }}" alt="">From : {{ date('d F Y',strtotime($event->from_date)) }}</a>
                            </li>
                            <li class="date">
                                <a href="#"><img src="{{ asset('frontend/images/icon/date.png') }}" alt="">To : {{ date('d F Y',strtotime($event->to_date)) }}</a>
                            </li>
                        </ul>
                    </div>
                </article>
            </div>
            @endforeach
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="pagination-area">
                    <ul>
                        <li class="prev ">
                            <a href="#" class="waves-effect" title="">
                                <img src="{{ asset('frontend/images/icon/prev.png') }}" alt="">
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
                                <img src="{{ asset('frontend/images/icon/next.png') }}" alt="">
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection