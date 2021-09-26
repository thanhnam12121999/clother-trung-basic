@extends('user.layouts.master')
@section('title', 'Giỏ hàng')
@section('breadcrumb')
    <!-- Breadcrumb Section Begin -->
    <div class="breacrumb-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-text product-more">
                        <a href="{{ route('home') }}"><i class="fa fa-home"></i> Trang chủ</a>
                        <a href="{{ route('products.index') }}">Shop</a>
                        <span>Giỏ hàng</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb Section Begin -->
@endsection
@section('content')
    <!-- Shopping Cart Section Begin -->
    <section class="shopping-cart spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="cart-table">
                        <table>
                            <thead>
                            <tr>
                                <th>Ảnh</th>
                                <th class="p-name">Tên sản phẩm</th>
                                <th>Đơn giá</th>
                                <th>Số lượng</th>
                                <th>Số tiền</th>
                                <th><i class="ti-close"></i></th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td class="cart-pic first-row"><img src="{{ asset('user/img/cart-page/product-1.jpg') }}" alt=""></td>
                                <td class="cart-title first-row">
                                    <h5>Pure Pineapple</h5>
                                </td>
                                <td class="p-price first-row">$60.00</td>
                                <td class="qua-col first-row">
                                    <div class="quantity">
                                        <div class="pro-qty">
                                            <input type="text" value="1">
                                        </div>
                                    </div>
                                </td>
                                <td class="total-price first-row">$60.00</td>
                                <td class="close-td first-row"><i class="ti-close"></i></td>
                            </tr>
                            <tr>
                                <td class="cart-pic"><img src="{{ asset('user/img/cart-page/product-2.jpg') }}" alt=""></td>
                                <td class="cart-title">
                                    <h5>American lobster</h5>
                                </td>
                                <td class="p-price">$60.00</td>
                                <td class="qua-col">
                                    <div class="quantity">
                                        <div class="pro-qty">
                                            <input type="text" value="1">
                                        </div>
                                    </div>
                                </td>
                                <td class="total-price">$60.00</td>
                                <td class="close-td"><i class="ti-close"></i></td>
                            </tr>
                            <tr>
                                <td class="cart-pic"><img src="{{ asset('user/img/cart-page/product-3.jpg') }}" alt=""></td>
                                <td class="cart-title">
                                    <h5>Guangzhou sweater</h5>
                                </td>
                                <td class="p-price">$60.00</td>
                                <td class="qua-col">
                                    <div class="quantity">
                                        <div class="pro-qty">
                                            <input type="text" value="1">
                                        </div>
                                    </div>
                                </td>
                                <td class="total-price">$60.00</td>
                                <td class="close-td"><i class="ti-close"></i></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="cart-buttons">
                                <a href="#" class="primary-btn continue-shop">Tiếp tục mua sắm</a>
                                <a href="#" class="primary-btn up-cart">Cập nhật giỏ hàng</a>
                            </div>
{{--                            <div class="discount-coupon">--}}
{{--                                <h6>Discount Codes</h6>--}}
{{--                                <form action="#" class="coupon-form">--}}
{{--                                    <input type="text" placeholder="Enter your codes">--}}
{{--                                    <button type="submit" class="site-btn coupon-btn">Apply</button>--}}
{{--                                </form>--}}
{{--                            </div>--}}
                        </div>
                        <div class="col-lg-4 offset-lg-2">
                            <div class="proceed-checkout">
                                <ul>
{{--                                    <li class="subtotal">Subtotal <span>$240.00</span></li>--}}
                                    <li class="cart-total">Tổng thanh toán<span>$240.00</span></li>
                                </ul>
                                <a href="{{ route('payment.index') }}" class="proceed-btn">THANH TOÁN</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Shopping Cart Section End -->
@endsection