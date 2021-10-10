@extends('user.layouts.master')
@section('title', 'Giỏ hàng')
@section('custom-css')
    <link rel="stylesheet" href="{{ asset('user/custom-css/cart/style.css') }}">
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
            <form action="{{ route('cart.update') }}" method="post">
                @csrf
                @method('PUT')
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
                                    @if (!empty(getCart()))
                                        @foreach (getCart() as $item)
                                            <tr>
                                                <td class="cart-pic first-row">
                                                    <img style="width: 10rem;" src="{{ getProductImageInCart($item['options']['slug']) }}" alt="">
                                                </td>
                                                <td class="cart-title first-row">
                                                    <h5 class="mb-2">
                                                        <a class="pd-link" href="{{ route('products.slug', ['slug' => $item['options']['slug']]) }}">{{ $item['name'] }}</a>
                                                    </h5>
                                                    <h6 class="pd-variant">{{ implode("-", $item['options']['attributes']) }}</h6>
                                                </td>
                                                <td class="p-price first-row">
                                                    {{ number_format($item['price'], 0, ',', '.') }}đ
                                                </td>
                                                <td class="qua-col first-row">
                                                    <div class="quantity">
                                                        <div class="pro-qty">
                                                            <input type="text" value="{{ $item['qty'] }}" name="quantity[{{ $item['rowId'] }}]">
                                                        </div>
                                                    </div>
                                                </td>
                                                @php
                                                    $totalItem = $item['price'] * $item['qty']
                                                @endphp
                                                <td class="total-price first-row">
                                                    {{ number_format($totalItem, 0, ',', '.') }}đ
                                                </td>
                                                <td class="close-td first-row">
                                                    <a style="color: #0a0a0a;" href="{{ route('cart.remove', ['rowId'=>$item['rowId']]) }}">
                                                        <i class="ti-close"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="6">
                                                <h4 class="text-center mt-4">Không có sản phẩm nào</h4>
                                            </td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="cart-buttons">
                                    <a href="{{ route('products.index') }}" class="primary-btn continue-shop">Tiếp tục mua sắm</a>
                                    <button type="submit" class="primary-btn up-cart">Cập nhật giỏ hàng</button>
                                </div>
                                {{-- <div class="discount-coupon">
                                    <h6>Discount Codes</h6>
                                    <form action="#" class="coupon-form">
                                        <input type="text" placeholder="Enter your codes">
                                        <button type="submit" class="site-btn coupon-btn">Apply</button>
                                    </form>
                                </div> --}}
                            </div>
                            <div class="col-lg-4 offset-lg-2">
                                <div class="proceed-checkout">
                                    <ul>
                                        {{-- <li class="subtotal">Subtotal <span>$240.00</span></li> --}}
                                        <li class="cart-total">Tổng thanh toán<span>{{ getCartTotal() }}đ</span></li>
                                    </ul>
                                    <a href="{{ route('payment.index') }}" class="proceed-btn">THANH TOÁN</a>
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
