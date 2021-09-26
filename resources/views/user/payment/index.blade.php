@extends('user.layouts.master')
@section('title', 'Thanh toán')
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
            <form action="#" class="checkout-form">
                <div class="row">
                    <div class="col-lg-6">
{{--                        <div class="checkout-content">--}}
{{--                            <a href="#" class="content-btn">Click Here To Login</a>--}}
{{--                        </div>--}}
                        <h4>Thông tin người nhận</h4>
                        <div class="row">
{{--                            <div class="col-lg-6">--}}
{{--                                <label for="fir">First Name<span>*</span></label>--}}
{{--                                <input type="text" id="fir">--}}
{{--                            </div>--}}
                            <div class="col-lg-12">
                                <label for="last">Họ tên<span>*</span></label>
                                <input type="text" id="last">
                            </div>
{{--                            <div class="col-lg-12">--}}
{{--                                <label for="cun-name">Company Name</label>--}}
{{--                                <input type="text" id="cun-name">--}}
{{--                            </div>--}}
                            <div class="col-lg-12">
                                <label for="cun">Địa chỉ<span>*</span></label>
                                <input type="text" id="cun">
                            </div>
{{--                            <div class="col-lg-12">--}}
{{--                                <label for="street">Street Address<span>*</span></label>--}}
{{--                                <input type="text" id="street" class="street-first">--}}
{{--                                <input type="text">--}}
{{--                            </div>--}}
{{--                            <div class="col-lg-12">--}}
{{--                                <label for="zip">Postcode / ZIP (optional)</label>--}}
{{--                                <input type="text" id="zip">--}}
{{--                            </div>--}}
{{--                            <div class="col-lg-12">--}}
{{--                                <label for="town">Town / City<span>*</span></label>--}}
{{--                                <input type="text" id="town">--}}
{{--                            </div>--}}
                            <div class="col-lg-6">
                                <label for="phone">Số điện thoại<span>*</span></label>
                                <input type="text" id="phone">
                            </div>
                            <div class="col-lg-6">
                                <label for="email">Email<span>*</span></label>
                                <input type="text" id="email">
                            </div>
                            <div class="col-lg-12">
                                <label for="note">Lời nhắn</label>
                                <textarea class="form-control" name="note" id="note" rows="5"></textarea>
                            </div>
{{--                            <div class="col-lg-12">--}}
{{--                                <div class="create-item">--}}
{{--                                    <label for="acc-create">--}}
{{--                                        Create an account?--}}
{{--                                        <input type="checkbox" id="acc-create">--}}
{{--                                        <span class="checkmark"></span>--}}
{{--                                    </label>--}}
{{--                                </div>--}}
{{--                            </div>--}}
                        </div>
                    </div>
                    <div class="col-lg-6">
{{--                        <div class="checkout-content">--}}
{{--                            <input type="text" placeholder="Enter Your Coupon Code">--}}
{{--                        </div>--}}
                        <div class="place-order">
                            <h4>Đơn hàng của bạn</h4>
                            <div class="order-total">
                                <ul class="order-table">
                                    <li>Sản phẩm <span>Số tiền</span></li>
                                    <li class="fw-normal">Combination x 1 <span>$60.00</span></li>
                                    <li class="fw-normal">Combination x 1 <span>$60.00</span></li>
                                    <li class="fw-normal">Combination x 1 <span>$120.00</span></li>
{{--                                    <li class="fw-normal">Subtotal <span>$240.00</span></li>--}}
                                    <li class="total-price">Tổng đơn hàng <span>$240.00</span></li>
                                </ul>
                                <div class="payment-check">
                                    <div class="pc-item">
                                        <label for="pc-credit">
                                            Thẻ tín dụng
                                            <input type="checkbox" id="pc-credit">
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                    <div class="pc-item">
                                        <label for="pc-atm">
                                            Thẻ ATM nội địa
                                            <input type="checkbox" id="pc-atm">
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                    <div class="pc-item">
                                        <label for="pc-cod">
                                            Thanh toán khi nhận hàng
                                            <input type="checkbox" id="pc-cod">
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="order-btn">
                                    <button type="submit" class="site-btn place-btn">Đặt hàng</button>
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