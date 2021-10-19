@extends('user.layouts.master')
@section('title', 'Đơn mua')
@section('custom-css')
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/sweetalert2/sweetalert2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('user/custom-css/profile/style.css') }}">
@endsection
@section('active-profile-notify', 'active')
@section('breadcrumb')
<!-- Breadcrumb Section Begin -->
<div class="breacrumb-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb-text">
                    <a href="{{ route('home') }}"><i class="fa fa-home"></i> Trang chủ</a>
                    <span>Thông báo</span>
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
            <form action="{{ route('profile.update', getLoggedInUser()->id) }}"  enctype="multipart/form-data" method="POST" >
            @csrf
            @method('PUT')
                <div class="row">
                    @include('user.profile.components.sidebar')
                    <!-- /.col -->
                    <div class="col-md-9">
                        <div class="card notifications-section" style="min-height: 200px;">
                            <div class="card-header">
                                <h5 class="text-center">Thông báo</h5>
                            </div>
                            <div class="card-body p-0">
                                @if (!$memberNotifies->total())
                                <div style="height: 200px;" class="d-flex align-items-center justify-content-center">
                                    <h4 class="text-center">Không có thông báo</h4>
                                </div>
                                @else
                                <div class="list-group">
                                    @foreach ($memberNotifies as $noti)
                                    <a href="{{ $noti->link }}" data-noti-id="{{ $noti->id }}" class="list-group-item list-group-item-action py-4 read-at">
                                        <div class="d-flex w-100 justify-content-between">
                                            <h5 class="mb-1">
                                                @if (empty($noti->read_at))
                                                <span class="new-label">NEW</span>
                                                @endif
                                                {{ $noti->message }}
                                            </h4>
                                            <small>{{ $noti->time }}</small>
                                        </div>
                                        {{-- <p class="mb-1 new-label">NEW</p> --}}
                                        {{-- <small>And some small print.</small> --}}
                                    </a>
                                    @endforeach
                                </div>
                                @endif
                            </div>
                        </div>
                        <div class="d-flex justify-content-center mt-4 pagination-section">
                            {{ $memberNotifies->links('user.layouts.components.pagination') }}
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
    <script src="{{ asset('user/custom-js/profile/script.js') }}"></script>
@endsection
