@extends('user.layouts.master')
@section('title', 'Đăng nhập')
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
                        <span>Đăng nhập</span>
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
                    <div class="login-form">
                        <h2>Đăng nhập</h2>
                        <form class="login-form__main" method="post" action="{{ route('auth.login') }}">
                            @csrf
                            <div class="group-input">
                                <label for="email">Email/Tên đăng nhập *</label>
                                <input type="text" id="username" name="username" value="{{ old('username') }}">
                            </div>
                            @error('username')
                                <div class="alert alert-danger">
                                    <strong>{{ $errors->first('username') }}</strong>
                                </div>
                            @enderror
                            <div class="group-input">
                                <label for="password">Mật khẩu *</label>
                                <input type="password" id="password" name="password">
                            </div>
                            @error('password')
                                <div class="alert alert-danger">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </div>
                            @enderror
                            <div class="group-input gi-check">
                                <div class="gi-more">
                                    <label for="save-pass">
                                        Nhớ mật khẩu
                                        <input type="checkbox" id="save-pass" name="save_pass">
                                        <span class="checkmark"></span>
                                    </label>
                                    <a href="#" class="forget-pass">Quên mật khẩu</a>
                                </div>
                            </div>
                            <button type="submit" class="site-btn login-btn">Đăng nhập</button>
                        </form>
                        <div class="switch-login">
                            <p>Chưa có tài khoản thì <a href="{{ route('auth.sign-up') }}" class="or-login">Đăng ký</a> nha!</p>
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