@extends('user.layouts.master')
@section('title', 'Đơn mua')
@section('custom-css')
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/sweetalert2/sweetalert2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('user/custom-css/profile/style.css') }}">
@endsection
@section('active-profile-order', 'active')
@section('breadcrumb')
<!-- Breadcrumb Section Begin -->
<div class="breacrumb-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb-text">
                    <a href="{{ route('home') }}"><i class="fa fa-home"></i> Trang chủ</a>
                    <span>Đơn mua</span>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Breadcrumb Section Begin -->
@endsection
@section('content')
<section class="profile-background">
    <div class="container">
        <div class="profile-content">
            @php
            $infoUser = getLoggedInUser();
            if (getAccountInfo()->address) {
                $infoUser['address'] = getAccountInfo()->address;
            } else {
                $infoUser['address'] = '';
            }
            @endphp
            <form action="{{ route('profile.update', $infoUser->id) }}"  enctype="multipart/form-data" method="POST" >
            @csrf
            @method('PUT')
                <div class="row">
                    @include('user.profile.components.sidebar')
                    <!-- /.col -->
                    <div class="col-md-9">
                        <div class="order-tab">
                            <div class="tab-item">
                                <ul class="nav w-100" role="tablist">
                                    @foreach ($orderStatus as $status => $text)
                                        <li class="w-25">
                                            <a class="w-100 text-center {{ $status == 0 ? 'active' : '' }}" data-toggle="tab" href="#tab-{{$status}}" role="tab">{{ Str::upper($text) }}</a>
                                        </li>
                                    @endforeach
                                    {{-- <li>
                                        <a class="active" data-toggle="tab" href="#tab-1" role="tab">Mô tả sản phẩm</a>
                                    </li>
                                    <li>
                                        <a data-toggle="tab" href="#tab-2" role="tab">Chi tiết</a>
                                    </li> --}}
                                </ul>
                            </div>
                            <div class="tab-item-content">
                                <div class="tab-content">
                                    @foreach ($orderStatus as $status => $text)
                                    <div class="tab-pane {{ $status == 0 ? 'fade-in active' : '' }}" id="tab-{{$status}}" role="tabpanel">
                                        <div class="order-content">
                                            @if ($status == \App\Models\Order::WAITING_CONFIRM_STATUS)
                                                @if ($waitingOrders->isNotEmpty())
                                                    @foreach ($waitingOrders as $order)
                                                        <div class="card card-purple mt-2" style="min-height: 200px;">
                                                            <div class="card-body">
                                                                <div class="card-title clearfix">
                                                                    <div class="row">
                                                                        <div class="col-6 d-flex align-items-center">
                                                                            <h5>Mã đơn hàng: <span>{{ $order->order_code }}</span></h5>
                                                                        </div>
                                                                        <div class="col-6">
                                                                            <button type="button" data-url="{{ route('profile.order.update', ['order' => $order->id, 'order_status' => 3]) }}" class="primary-btn float-right btn-cancel">HỦY ĐƠN HÀNG</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <hr>
                                                                @foreach ($order->orderDetails as $detail)
                                                                    <div class="row">
                                                                        <div class="col-2">
                                                                            <img src="{{ $detail->productVariant->product->feature_image_path }}" alt="">
                                                                        </div>
                                                                        <div class="col-8">
                                                                            <p class="pd-option mb-0">
                                                                                {{ $detail->productVariant->product->name }}
                                                                            </p>
                                                                            <p class="pd-variant mb-0">Phân loại hàng: {{$detail->productVariant->variant_text}}</p>
                                                                            <p class="mb-0">{{ number_format($detail->productVariant->unit_price, 0, ',', '.') }}đ x {{$detail->amount}}</p>
                                                                        </div>
                                                                        @php
                                                                            $totalItem = $detail->productVariant->unit_price * $detail->amount
                                                                        @endphp
                                                                        <div class="col-2">
                                                                            <span class="pd-price float-right">{{ number_format($totalItem, 0, ',', '.') }}đ</span>
                                                                        </div>
                                                                    </div>
                                                                    <hr>
                                                                @endforeach
                                                                <div class="row">
                                                                    <div class="col-12">
                                                                        <h5 class="text-uppercase font-weight-bold float-left">Tổng số tiền</h5>
                                                                        <h5 class="price-total float-right font-weight-bold">{{ number_format($order->price_total, 0, ',', '.') }}đ</h5>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                @else
                                                    <div class="card mt-2" style="min-height: 200px;">
                                                        <div class="card-body">
                                                            <div style="height: 200px;" class="d-flex align-items-center justify-content-center">
                                                                <h4 class="text-center">Chưa có đơn hàng</h4>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                            @endif
                                            @if ($status == \App\Models\Order::CONFIRMED_DELIVERY_STATUS)
                                                @if ($confirmedOrders->isNotEmpty())
                                                    @foreach ($confirmedOrders as $order)
                                                        <div class="card card-purple mt-2" style="min-height: 200px;">
                                                            <div class="card-body">
                                                                <div class="card-title clearfix">
                                                                    <div class="row">
                                                                        <div class="col-6 d-flex align-items-center">
                                                                            <h5>Mã đơn hàng: <span>{{ $order->order_code }}</span></h5>
                                                                        </div>
                                                                        <div class="col-6">
                                                                            <a href="{{ route('profile.order.update', ['order' => $order->id, 'order_status' => 2]) }}" class="primary-btn float-right">ĐÃ NHẬN HÀNG</a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <hr>
                                                                @foreach ($order->orderDetails as $detail)
                                                                    <div class="row">
                                                                        <div class="col-2">
                                                                            <img src="{{ $detail->productVariant->product->feature_image_path }}" alt="">
                                                                        </div>
                                                                        <div class="col-8">
                                                                            <p class="pd-option mb-0">
                                                                                {{ $detail->productVariant->product->name }}
                                                                            </p>
                                                                            <p class="pd-variant mb-0">Phân loại hàng: {{$detail->productVariant->variant_text}}</p>
                                                                            <p class="mb-0">{{ number_format($detail->productVariant->unit_price, 0, ',', '.') }}đ x {{$detail->amount}}</p>
                                                                        </div>
                                                                        @php
                                                                            $totalItem = $detail->productVariant->unit_price * $detail->amount
                                                                        @endphp
                                                                        <div class="col-2">
                                                                            <span class="pd-price float-right">{{ number_format($totalItem, 0, ',', '.') }}đ</span>
                                                                        </div>
                                                                    </div>
                                                                    <hr>
                                                                @endforeach
                                                                <div class="row">
                                                                    <div class="col-12">
                                                                        <h5 class="text-uppercase font-weight-bold float-left">Tổng số tiền</h5>
                                                                        <h5 class="price-total float-right font-weight-bold">{{ number_format($order->price_total, 0, ',', '.') }}đ</h5>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                @else
                                                    <div class="card mt-2" style="min-height: 200px;">
                                                        <div class="card-body">
                                                            <div style="height: 200px;" class="d-flex align-items-center justify-content-center">
                                                                <h4 class="text-center">Chưa có đơn hàng</h4>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                            @endif
                                            @if ($status == \App\Models\Order::DELIVERED_STATUS)
                                                @if ($deliveredOrders->isNotEmpty())
                                                    @foreach ($deliveredOrders as $order)
                                                        <div class="card card-purple mt-2" style="min-height: 200px;">
                                                            <div class="card-body">
                                                                <div class="card-title clearfix">
                                                                    <div class="row">
                                                                        <div class="col-6 d-flex align-items-center">
                                                                            <h5>Mã đơn hàng: <span>{{ $order->order_code }}</span></h5>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <hr>
                                                                @foreach ($order->orderDetails as $detail)
                                                                    <div class="row">
                                                                        <div class="col-2">
                                                                            <img src="{{ $detail->productVariant->product->feature_image_path }}" alt="">
                                                                        </div>
                                                                        <div class="col-8">
                                                                            <p class="pd-option mb-0">
                                                                                {{ $detail->productVariant->product->name }}
                                                                            </p>
                                                                            <p class="pd-variant mb-0">Phân loại hàng: {{$detail->productVariant->variant_text}}</p>
                                                                            <p class="mb-0">{{ number_format($detail->productVariant->unit_price, 0, ',', '.') }}đ x {{$detail->amount}}</p>
                                                                        </div>
                                                                        @php
                                                                            $totalItem = $detail->productVariant->unit_price * $detail->amount
                                                                        @endphp
                                                                        <div class="col-2">
                                                                            <span class="pd-price float-right">{{ number_format($totalItem, 0, ',', '.') }}đ</span>
                                                                        </div>
                                                                    </div>
                                                                    <hr>
                                                                @endforeach
                                                                <div class="row">
                                                                    <div class="col-12">
                                                                        <h5 class="text-uppercase font-weight-bold float-left">Tổng số tiền</h5>
                                                                        <h5 class="price-total float-right font-weight-bold">{{ number_format($order->price_total, 0, ',', '.') }}đ</h5>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                @else
                                                    <div class="card mt-2" style="min-height: 200px;">
                                                        <div class="card-body">
                                                            <div style="height: 200px;" class="d-flex align-items-center justify-content-center">
                                                                <h4 class="text-center">Chưa có đơn hàng</h4>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                            @endif
                                            @if ($status == \App\Models\Order::CANCEL_STATUS)
                                                @if ($cancelOrders->isNotEmpty())
                                                    @foreach ($cancelOrders as $order)
                                                        <div class="card card-purple mt-2" style="min-height: 200px;">
                                                            <div class="card-body">
                                                                <div class="card-title clearfix">
                                                                    <div class="row">
                                                                        <div class="col-6 d-flex align-items-center">
                                                                            <h5>Mã đơn hàng: <span>{{ $order->order_code }}</span></h5>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <hr>
                                                                @foreach ($order->orderDetails as $detail)
                                                                    <div class="row">
                                                                        <div class="col-2">
                                                                            <img src="{{ $detail->productVariant->product->feature_image_path }}" alt="">
                                                                        </div>
                                                                        <div class="col-8">
                                                                            <p class="pd-option mb-0">
                                                                                {{ $detail->productVariant->product->name }}
                                                                            </p>
                                                                            <p class="pd-variant mb-0">Phân loại hàng: {{$detail->productVariant->variant_text}}</p>
                                                                            <p class="mb-0">{{ number_format($detail->productVariant->unit_price, 0, ',', '.') }}đ x {{$detail->amount}}</p>
                                                                        </div>
                                                                        @php
                                                                            $totalItem = $detail->productVariant->unit_price * $detail->amount
                                                                        @endphp
                                                                        <div class="col-2">
                                                                            <span class="pd-price float-right">{{ number_format($totalItem, 0, ',', '.') }}đ</span>
                                                                        </div>
                                                                    </div>
                                                                    <hr>
                                                                @endforeach
                                                                <div class="row">
                                                                    <div class="col-12">
                                                                        <h5 class="text-uppercase font-weight-bold float-left">Tổng số tiền</h5>
                                                                        <h5 class="price-total float-right font-weight-bold">{{ number_format($order->price_total, 0, ',', '.') }}đ</h5>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                @else
                                                    <div class="card mt-2" style="min-height: 200px;">
                                                        <div class="card-body">
                                                            <div style="height: 200px;" class="d-flex align-items-center justify-content-center">
                                                                <h4 class="text-center">Chưa có đơn hàng</h4>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                            @endif
                                        </div>
                                    </div>
                                        {{-- @foreach ($orders as $order)
                                            <div class="card">
                                                <div class="card-body">
                                                    @if ($status == $order['order_status'])
                                                        @foreach ($order['order_details'] as $detail)

                                                        @endforeach
                                                    @else
                                                        <h4>Chưa có đơn hàng</h4>
                                                    @endif
                                                </div>
                                            </div>
                                        @endforeach --}}
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</section>
@endsection
@section('custom-js')
    <script src="{{ asset('adminlte/plugins/sweetalert2/sweetalert2.all.min.js') }}"></script>
    <script>
        $(function() {
            $('.btn-cancel').click(function (e) {
                e.preventDefault();
                let url = $(this).attr('data-url');
                Swal.fire({
                    title: 'Bạn chắc chắn muốn hủy đơn hàng?',
                    // text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCloseButton: true,
                    showCancelButton: true,
                    confirmButtonColor: '#42c119',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Xác nhận hủy',
                    cancelButtonText: 'Hủy'
                })
                .then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = url;
                    }
                })
            });
        });
    </script>
@endsection
