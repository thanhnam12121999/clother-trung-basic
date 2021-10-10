@extends('user.layouts.master')
@section('title', 'Hồ Sơ')
@section('my-css')
    <style>
        .bg-profile-cus {
            background-color: #e6e6e6;;
        }
    </style>
@endsection
@section('breadcrumb')
<!-- Breadcrumb Section Begin -->
<div class="breacrumb-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb-text">
                    <a href="{{ route('home') }}"><i class="fa fa-home"></i> Trang chủ</a>
                    <span>Hồ Sơ</span>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Breadcrumb Section Begin -->
@endsection
@section('content')
<div class="container profile-background mt-3">
    <section class="content">
        <div class="container-fluid">
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
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-body">
                            <ul class="nav flex-column">
                                <li class="nav-item bg-profile-cus mb-3">
                                  <a class="nav-link active text-dark" href="{{ route('profile') }}"><i class="fa fa-user"></i>&nbsp;Tài khoản của tôi</a>
                                </li>
                                <li class="nav-item bg-profile-cus mb-3">
                                  <a class="nav-link text-dark" href="#"><i class="fa fa-user"></i>&nbsp;Đơn mua</a>
                                </li>
                                <li class="nav-item bg-profile-cus mb-3">
                                  <a class="nav-link text-dark" href="#"><i class="fa fa-user"></i>&nbsp;Thông báo</a>
                                </li>
                              </ul>
                        </div>
                    </div>
                </div>
                <!-- /.col -->
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header p-2">
                                <h4>Hồ Sơ Của Tôi</h4>
                            </div><!-- /.card-header -->
                            <div class="card-body">
                                <div class="form-horizontal">
                                    <div class="form-group row">
                                        <label for="inputName" class="col-sm-2 col-form-label">Tên</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="name" id="inputName" value="{{$infoUser->name}}" placeholder="Tên">
                                            @error('name')
                                            <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                                        <div class="col-sm-10">
                                            <input type="email" class="form-control" name="email" id="inputEmail" value="{{$infoUser->email}}" placeholder="Email">
                                            @error('email')
                                            <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Điện thoại</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="phone_number" class="form-control" value="{{$infoUser->phone_number}}"  placeholder="Số điện thoại">
                                            @error('phone_number')
                                            <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Tài khoản</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="username" class="form-control" value="{{$infoUser->username}}"  placeholder="Tài khoản">
                                            @error('username')
                                            <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Ngày sinh</label>
                                        <div class="col-sm-10">
                                            <input type="date" name="date_of_birth" class="form-control" value="{{$infoUser->date_of_birth}}"  placeholder="Ngày Sinh">
                                            @error('date_of_birth')
                                            <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Địa chỉ</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="address" class="form-control" value="{{$infoUser['address']}}"  placeholder="Tỉnh/ Thành phố, Quận/Huyện, Phường/Xã">
                                            @error('address')
                                            <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="offset-sm-2 col-sm-10">
                                            <button type="submit" class="btn btn-danger">Lưu</button>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                    <div class="col-md-3">
                        <!-- Profile Image -->
                        <div class="card card-primary card-outline">
                            <div class="card-body box-profile">
                                <div class="text-center">
                                    <img class="profile-user-img img-fluid img-circle" style="width: 100px;height: 100px;border-radius: 50%"
                                        src="{{ asset('storage/images/accounts/'.$infoUser->avatar) }}"
                                        alt="User profile picture">
                                </div>
                                <h3 class="profile-username text-center">{{$infoUser->name}}</h3>
                                <p class="text-muted text-center">Member</p>
                                <label class="btn btn-primary btn-block">
                                    Chọn Ảnh <input name="avatar" type="file" hidden>
                                </label>
                                @error('avatar')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <!-- /.card-body -->
                        </div>
                    </div>
                </div>
            </form>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
@endsection
