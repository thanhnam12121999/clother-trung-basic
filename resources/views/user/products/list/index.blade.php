@extends('user.layouts.master')
@section('title', 'Danh sách sản phẩm')
@section('breadcrumb')
    <!-- Breadcrumb Section Begin -->
    <div class="breacrumb-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-text">
                        <a href="{{ route('home') }}"><i class="fa fa-home"></i> Trang chủ</a>
                        <span>Danh sách sản phẩm</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb Section Begin -->
@endsection

@section('content')
    <!-- Product Shop Section Begin -->
    <section class="product-shop spad">
        <div class="container">
            <div class="row">
                @include('user.products.components.sidebar')
                @include('user.products.list.product-list')
            </div>
        </div>
    </section>
    <!-- Product Shop Section End -->
@endsection
