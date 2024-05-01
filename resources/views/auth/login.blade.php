@extends('layouts.app')

@section('content')
<section class="top-title">
    <div class="top-page">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="top-page-heading">
                        <h1>LOGIN</h1>
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
                            / Login
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Top Title -->
<!-- Start Custom Single -->
{{-- <section class="login-booking-area" id="login_register_tab">
    <div class="container">
        <div class="row">
            <div class="col-sm-2"></div>
            <div class="col-sm-8">
                <div class="login-booking">
                    <ul class="login-tab-list">
                        <li rel="tab-1" class="active">LOGIN</li>
                        <li rel="tab-2">REGISTER</li>
                    </ul>
                    <div class="login-content">
                        <div id="tab-1" class="content-tab">
                            <input type="hidden" id="booking_form_login" name="booking_form_login" value="1" />
                            <div class="login-form">
                                <form action="{{ route('login') }}" method="POST" enctype="multipart-formdata">
                                    @csrf
                                    <div class="one-half">
                                        <div class="form-email">
                                            <label for="">Email</label>
                                            <input id="email" type="email" class="@error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    
                                    <div class="one-half">
                                        <div class="form-password">
                                            <label for="">Password</label>
                                            <input id="password" type="password" class="@error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                            @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                    <div class="one-half">
                                        <div class="remember">
                                            <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                            <label for="remember">Remember me</label>
                                        </div>
                                    </div>
                                    <div class="one-half">
                                        <div class="btn-submit">
                                            <p class="text-danger text-center" id='dv_login_error' ></p>
                                            @if (Route::has('password.request'))
                                                <a href="{{ route('password.request') }}" title="">Lost Your Password ?</a>
                                            @endif
                                            <button type="submit" id="login_submit">LOGIN</button>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                </form>
                            </div>
                        </div>
                        <div id="tab-2" class="content-tab">
                            <input type="hidden" id="booking_form_register" name="booking_form_register" value="1" />
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
                                    <div class="one-half checkbox">
                                        <input type="checkbox" name="accept" id="accept">
                                        <label for="accept">Accept <a href="#" title="">terms & conditions</a> and the <a href="#" title="">privacy policy</a> input</label>
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
            </div>
            <div class="col-sm-2"></div>
        </div>
    </div>
</section> --}}
<section class="login-booking-area" id="login_register_tab">
    <div class="container">
        <div class="row">
            <div class="col-sm-2"></div>
            <div class="col-sm-8">
                <div class="login-booking">
                    <ul class="">
                        <li class="active">LOGIN</li>
                    </ul>
                    <div class="login-content">
                        <div id="" class="content-tab">
                            <div class="login-form">
                                <form action="{{ route('login') }}" method="POST" enctype="multipart-formdata">
                                    @csrf
                                    <div class="one-half">
                                        <div class="form-email">
                                            <label for="">Email</label>
                                            <input id="email" type="email" class="@error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    
                                    <div class="one-half">
                                        <div class="form-password">
                                            <label for="">Password</label>
                                            <input id="password" type="password" class="@error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                            @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                    <div class="one-half">
                                        <div class="remember">
                                            <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                            <label for="remember">Remember me</label>
                                        </div>
                                    </div>
                                    <div class="one-half">
                                        <div class="btn-submit">
                                            <p class="text-danger text-center" id='dv_login_error' ></p>
                                            @if (Route::has('password.request'))
                                                <a href="{{ route('password.request') }}" title="">Lost Your Password ?</a>
                                            @endif
                                            <button type="submit" id="login_submit">LOGIN</button>
                                        </div>
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
