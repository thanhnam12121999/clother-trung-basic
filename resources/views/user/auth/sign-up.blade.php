@extends('user.layouts.master')
@section('title', 'Đăng ký')
@section('custom-css')
    <link rel="stylesheet" href="{{ asset('user/custom-css/auth/style.css') }}">
@endsection
@section('breadcrumb')
    <!-- Breadcrumb Section Begin -->
    <div class="breacrumb-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-text">
                        <a href="{{ route('home') }}"><i class="fa fa-home"></i> Trang chủ</a>
                        <span>Đăng ký</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb Form Section Begin -->
@endsection
@section('content')
    <!-- Register Section Begin -->
    <div class="register-login-section spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3">
                    <div class="register-form">
                        <h2>Đăng ký</h2>
                        <form class="register-form__main" method="post" action="{{ route('auth.register') }}">
                            @csrf
                            <div class="group-input">
                                <label for="email">Email *</label>
                                <input type="text" id="email" name="email" value="{{ old('email') }}">
                            </div>
                            @error('email')
                                <div class="alert alert-danger">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </div>
                            @enderror
                            <div class="group-input">
                                <label for="password">Mật khẩu *</label>
                                <input type="password" id="password" name="password">
                            </div>
                            <div class="group-input">
                                <label for="re-password">Xác nhận mật khẩu *</label>
                                <input type="password" id="re-password" name="password_confirmation">
                            </div>
                            @error('password')
                                <div class="alert alert-danger">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </div>
                            @enderror
                            <button type="submit" class="site-btn register-btn">Đăng ký</button>
                        </form>
                        <div class="switch-login">
                            <p{{-- >Có tài khoản rồi thì <a href="{{ route('auth.sign-in') }}" class="or-login">Đăng nhập</a> thôi! :D</p> --}}
                            <p>Bạn đã có tài khoản? <a href="{{ route('auth.sign-in') }}" class="or-login">Đăng nhập</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Register Form Section End -->
@endsection
@section('custom-js')
    <script src="{{ asset('user/js/jquery.validate.js') }}"></script>
    <script src="{{ asset('user/custom-js/auth/script.js') }}"></script>
@endsection