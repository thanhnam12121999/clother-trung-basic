@extends('user.layouts.master')
@section('title', 'Hồ Sơ')
@section('custom-css')
    <link rel="stylesheet" href="{{ asset('user/custom-css/profile/style.css') }}">
@endsection
@section('active-profile-info', 'active')
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
                        <div class="card">
                            <div class="card-header">
                                <h5 class="text-center">Hồ Sơ Của Tôi</h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-9">
                                        <div class="form-horizontal">
                                            <div class="form-group row">
                                                <label for="inputName" class="col-md-3 col-form-label">Tên</label>
                                                <div class="col-md-9">
                                                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="inputName" value="{{$infoUser->name}}" placeholder="Tên">
                                                    @error('name')
                                                    <p class="text-danger">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-3 col-form-label">Tài khoản</label>
                                                <div class="col-md-9">
                                                    <input type="text" name="username" class="form-control @error('username') is-invalid @enderror" value="{{$infoUser->username}}"  placeholder="Tài khoản">
                                                    @error('username')
                                                    <p class="text-danger">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="inputEmail" class="col-md-3 col-form-label">Email</label>
                                                <div class="col-md-9">
                                                    <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="inputEmail" value="{{$infoUser->email}}" placeholder="Email">
                                                    @error('email')
                                                    <p class="text-danger">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-3 col-form-label">Điện thoại</label>
                                                <div class="col-md-9">
                                                    <input type="text" name="phone_number" class="form-control @error('phone_number') is-invalid @enderror" value="{{$infoUser->phone_number}}"  placeholder="Số điện thoại">
                                                    @error('phone_number')
                                                    <p class="text-danger">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-3 col-form-label">Địa chỉ</label>
                                                <div class="col-md-9">
                                                    <input type="text" name="address" class="form-control @error('address') is-invalid @enderror" value="{{$infoUser['address']}}"  placeholder="Tỉnh/ Thành phố, Quận/Huyện, Phường/Xã">
                                                    @error('address')
                                                    <p class="text-danger">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-3 col-form-label">Giới tính</label>
                                                <div class="col-md-9">
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="gender" id="male" value="0" {{ $infoUser['gender'] == 0 ? 'checked' : '' }}>
                                                        <label class="form-check-label" for="male">Nam</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="gender" id="famale" value="option2" {{ $infoUser['gender'] == 1 ? 'checked' : '' }}>
                                                        <label class="form-check-label" for="famale">Nữ</label>
                                                    </div>
                                                    @error('gender')
                                                    <p class="text-danger">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-3 col-form-label">Ngày sinh</label>
                                                <div class="col-md-9">
                                                    <input type="date" name="date_of_birth" class="form-control @error('date_of_birth') is-invalid @enderror" value="{{$infoUser->date_of_birth}}"  placeholder="Ngày Sinh">
                                                    @error('date_of_birth')
                                                    <p class="text-danger">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="box-profile">
                                            <div class="text-center">
                                                <img class="profile-user-img img-fluid img-circl"
                                                    id="avatar"
                                                    style="width: 100px;height: 100px;border-radius: 50%;cursor: pointer;"
                                                    src="{{ empty($infoUser->avatar) ? 'https://w7.pngwing.com/pngs/419/473/png-transparent-computer-icons-user-profile-login-user-heroes-sphere-black-thumbnail.png' : asset('storage/images/accounts/'.$infoUser->avatar) }}"
                                                    alt="User profile picture">
                                            </div>
                                            <h5 class="profile-username text-center mt-4">{{$infoUser->name}}</h5>
                                            <p class="text-muted text-center">Member</p>
                                            <label class="btn btn-primary btn-block">
                                                Chọn Ảnh <input id="img-file" name="avatar" type="file" hidden onchange="changeImg(this)">
                                            </label>
                                            @error('avatar')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12 d-flex justify-content-center">
                                        <button type="submit" class="btn btn-danger">Lưu</button>
                                    </div>
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
<script>
    function changeImg(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#avatar').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    $('#avatar').click(function () {
        $('#img-file').click();
    });
    // $( "#birthday" ).datepicker({ dateFormat: 'yy-mm-dd' });
</script>
@endsection
