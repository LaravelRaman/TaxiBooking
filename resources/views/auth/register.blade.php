@extends('layouts.app')

@section('content')
<section class="top-title">
    <div class="top-page">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="top-page-heading">
                        <h1>REGISTER</h1>
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
                            <a href="#">Home </a>
                        </li>
                        <li>
                            / Register
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="login-booking-area" id="login_register_tab">
    <div class="container">
        <div class="row">
            <div class="col-sm-2"></div>
            <div class="col-sm-8">
                <div class="login-booking">
                    <ul class="">
                        <li rel="tab-2" class="active">REGISTER</li>
                    </ul>
                    <div class="login-content">
                        <div id="tab-2" class="content-tab">
                            <div class="register-form">
                                <form action="{{ route('register') }}" method="POST" enctype="multipart-formdata">
                                    @csrf

                                    <div class="one-half first-name">
                                        <label for="firstname">Name *</label>
                                        <input id="name" type="text" class="@error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="one-half email">
                                        <label for="email">Email</label>
                                        <input id="email" type="email" class="@error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="one-half pass">
                                        <label for="pass">Password</label>
                                        <input id="password" type="password" class="@error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
        
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="one-half pass">
                                        <label for="pass">Confirm Password</label>
                                        <input id="password-confirm" type="password" class="@error('password') is-invalid @enderror" name="password_confirmation" required autocomplete="new-password">
                                    </div>
                                    <div class="one-half btn-submit">
                                        <p class="text-danger text-center" id='dv_register_error'></p>
                                        <button type="submit">REGISTER</button>
                                    </div>
                                    <div class="clearfix"></div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            <div class="col-sm-2"></div>
        </div>
    </div>
</section>
@endsection
