@extends('user.layouts.master')
@section('title', 'Chi tiết sản phẩm')
@section('custom-css')
    <link rel="stylesheet" href="{{ asset('user/custom-css/products/style.css') }}">
@endsection
@section('active-product')
    class="active"
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
                        <span>Chi tiết sản phẩm</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb Section Begin -->
@endsection
@section('content')
    <!-- Product Shop Section Begin -->
    <section class="product-shop spad page-details">
        <div class="container">
            <div class="row">
                @include('user.products.components.sidebar')
                @include('user.products.detail.components.detail')
            </div>
        </div>
    </section>
    <!-- Product Shop Section End -->
    <!-- Related Products Section End -->
    <div class="related-products spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <h2>Có thể bạn quan tâm</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach ($products as $product)
                @php
                    $isFeatureImageUrl = filter_var($product->feature_image, FILTER_VALIDATE_URL);
                @endphp
                <div class="col-lg-3 col-sm-6">
                    <div class="product-item">
                        <div class="pi-pic">
                            <img src="{{ $isFeatureImageUrl ? $product->feature_image : $product->feature_image_path }}" alt="">
                            <div class="sale">Sale</div>
                            <div class="icon">
                                <i class="icon_heart_alt"></i>
                            </div>
                            <ul>
                                <li class="w-icon active"><a href="#"><i class="icon_bag_alt"></i></a></li>
                                <li class="quick-view"><a href="{{ route('products.slug', [ 'slug' => $product->slug ]) }}">+ Chi tiết</a></li>
                                <li class="w-icon"><a href="#"><i class="fa fa-random"></i></a></li>
                            </ul>
                        </div>
                        <div class="pi-text">
                            <div class="catagory-name">{{$product->category->name}}</div>
                            <a href="#">
                                <h5>{{$product->name}}</h5>
                            </a>
                            @php
                            $price = 0;
                            foreach ($product->variants as $variant) {
                                if ($price == 0) {
                                    $price = $variant->unit_price;
                                }
                                if ($price > $variant->unit_price) {
                                    $price = $variant->unit_price;
                                }
                            }
                            @endphp
                            <div class="product-price">
                                {{number_format($price)}}&nbsp;<span style="font-size: 13px">vnđ</span>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- Related Products Section End -->
@endsection
@section('custom-js')
    <script src="{{ asset('user/custom-js/products/script.js') }}"></script>
@endsection
