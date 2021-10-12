@extends('user.layouts.master')
@section('title', 'Thanh toán')
@section('custom-css')
    <link rel="stylesheet" href="{{ asset('user/custom-css/payment/style.css') }}">
@endsection
@section('breadcrumb')
    <!-- Breadcrumb Section Begin -->
    <div class="breacrumb-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-text product-more">
                        <a href="{{ route('home') }}"><i class="fa fa-home"></i> Trang chủ</a>
                        <a href="{{ route('products.index') }}">Shop</a>
                        <span>Thanh toán</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb Section Begin -->
@endsection
@section('content')
    <!-- Shopping Cart Section Begin -->
    <section class="checkout-section spad">
        <div class="container">
            <form action="{{ route('payment.handle') }}" method="POST" class="checkout-form">
                @csrf
                <div class="row">
                    <div class="col-lg-6">
                        <h4>Thông tin người nhận</h4>
                        <div class="row">
                            <div class="col-lg-12 mb-4">
                                <label for="name">Họ tên<span>*</span></label>
                                <input class="mb-0 form-control @error('name') is-invalid @enderror" type="text" id="name" name="name" value="{{ isMemberLogged() ? getLoggedInUser()->name : old('name') }}">
                                @error('name')
                                <p class="text-danger mb-0">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="col-lg-12 mb-4">
                                <label for="address">Địa chỉ<span>*</span></label>
                                <input class="mb-0 form-control @error('address') is-invalid @enderror" type="text" id="address" name="address" value="{{ isMemberLogged() ? getAccountInfo()->address : old('address') }}">
                                @error('address')
                                <p class="text-danger mb-0">{{ $message }}</p>
                                @enderror
                            </div>
                            {{-- <div class="col-lg-12">
                                <label for="street">Street Address<span>*</span></label>
                                <input type="text" id="street" class="street-first">
                                <input type="text">
                            </div>
                            <div class="col-lg-12">
                                <label for="zip">Postcode / ZIP (optional)</label>
                                <input type="text" id="zip">
                            </div>
                            <div class="col-lg-12">
                                <label for="town">Town / City<span>*</span></label>
                                <input type="text" id="town">
                            </div> --}}
                            <div class="col-lg-6 mb-4 pr-1">
                                <label for="phone-number">Số điện thoại<span>*</span></label>
                                <input class="mb-0 form-control @error('phone_number') is-invalid @enderror" type="text" id="phone-number" name="phone_number" value="{{ isMemberLogged() ? getLoggedInUser()->phone_number : old('phone_number') }}">
                                @error('phone_number')
                                <p class="text-danger mb-0">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="col-lg-6 mb-4 pl-0">
                                <label for="email">Email<span>*</span></label>
                                <input class="mb-0 form-control @error('email') is-invalid @enderror" type="email" id="email" name="email" value="{{ isMemberLogged() ? getLoggedInUser()->email : old('email') }}">
                                @error('email')
                                <p class="text-danger mb-0">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="col-lg-12 mb-4">
                                <label for="note">Lời nhắn</label>
                                <textarea class="form-control mb-0" name="note" id="note" rows="5"></textarea>
                            </div>
                            <div class="payment-check col-lg-12 mb-4">
                                <select class="form-control pc-method mb-0 @error('payment_method') is-invalid @enderror" name="payment_method" id="payment-method">
                                    <option value="">--Chọn Phương thức thanh toán--</option>
                                    <option value="atm">Thẻ ATM nội địa</option>
                                    <option value="cod">Thanh toán khi nhận hàng</option>
                                </select>
                                @error('payment_method')
                                <p class="text-danger mb-0">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="col-lg-12">
                                <div class="order-btn">
                                    <button type="submit" class="site-btn place-btn">Đặt hàng</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="place-order">
                            <h4>Đơn hàng của bạn</h4>
                            <div class="order-total">
                                <div class="row mb-4 order-table">
                                    <div class="col-12 order-table__heading">
                                        <div class="row">
                                            <div class="col-9">
                                                <h5 class="title">Sản phẩm</h5>
                                            </div>
                                            <div class="col-3">
                                                <h5 class="title float-right">Số tiền</h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 order-table__content">
                                        @if (!empty(getCart()))
                                            @foreach (getCart() as $item)
                                            <div class="row order-item">
                                                <div class="col-9">
                                                    <div class="row">
                                                        <div class="col-3 order-item__image">
                                                            <div class="w-100 pd-image">
                                                                <img class="w-100" src="{{ getProductImageInCart($item['options']['product_id']) }}" alt="">
                                                            </div>
                                                        </div>
                                                        <div class="col-9 px-0 order-item__content">
                                                            <p class="pd-option mb-0">
                                                                <span>{{$item['name']}}</span><span style="font-weight: 700;"> X {{$item['qty']}}</span>
                                                            </p>
                                                            <p class="pd-variant mb-0">{{ implode("-", $item['options']['attributes']) }}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                @php
                                                    $totalItem = $item['price'] * $item['qty']
                                                @endphp
                                                <div class="col-3">
                                                    <span class="pd-price float-right">{{ number_format($totalItem, 0, ',', '.') }}đ</span>
                                                </div>
                                            </div>
                                            @endforeach
                                        @endif
                                    </div>
                                    <div class="col-12 order-table__footer">
                                        <div class="row">
                                            <div class="col-9">
                                                <h5 class="ft-title price-total__title">Tổng đơn hàng</h5>
                                            </div>
                                            <div class="col-3">
                                                <h5 class="ft-title price-total__value">{{ getCartTotal() }}đ</h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
    <!-- Shopping Cart Section End -->
@endsection
