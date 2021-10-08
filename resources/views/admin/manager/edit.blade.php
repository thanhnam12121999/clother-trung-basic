@extends('admin.layouts.master')
@section('breadcrumb', 'Chỉnh Sửa nhân viên')
@section('active-manager', 'active')
@section('contents')
<form action="{{ route('admin.managers.update', $account->id) }}" enctype="multipart/form-data" method="POST" accept-charset="utf-8">
    @csrf
    @method('PUT')
    <section class="content-header">
        <div class="breadcrumb">
            <button type = "submit" class="btn btn-primary btn-sm mr-3">
                <span class="glyphicon glyphicon-floppy-save"></span>
                Lưu[Cập nhật]
            </button>
            <a href="" class="btn btn-primary btn-sm" href="admin/product" role="button">
                <span class="glyphicon glyphicon-remove do_nos"></span> Thoát
            </a>
        </div>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box" id="view">
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Tên người dùng <span class = "text-danger">(*)</span></label>
                                    <input type="text" class="form-control" name="name" style="width:100%" value="{{ $account->name }}">
                                </div>
                                @error('name')
                                <p class="text-danger">{{ $message }}</p> 
                                @enderror
                                <div class="form-group">
                                    <label>Email<span class = "text-danger">(*)</span></label>
                                    <input type="text" class="form-control" name="email" style="width:100%"  value="{{ $account->email }}">
                                </div>
                                @error('email')
                                <p class="text-danger">{{ $message }}</p> 
                                @enderror
                                <div class="form-group">
                                    <label>Tài khoản<span class = "text-danger">(*)</span></label>
                                    <input type="text" class="form-control" name="username" style="width:100%"  value="{{ $account->username }}">
                                </div>
                                @error('username')
                                <p class="text-danger">{{ $message }}</p> 
                                @enderror
                                <div class="form-group">
                                    <label>Số điện thoại<span class = "text-danger">(*)</span></label>
                                    <input type="text" class="form-control" name="number_phone" style="width:100%"  value="{{ $account->phone_number }}">
                                </div>
                                @error('number_phone')
                                <p class="text-danger">{{ $message }}</p> 
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="feature-image">Ảnh đại diện</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="avatar" name="avatar">
                                            <label class="custom-file-label">Chọn ảnh đại diện</label>
                                        </div>
                                    </div>
                                    @error('avatar')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                @error('avatar')
                                <p class="text-danger">{{ $message }}</p> 
                                @enderror
                                <div class="form-group">
                                    <label>Quyền</label>
                                    <select name="status" class="form-control">
                                        @foreach ($managers as $manage){{ $account->name }}
                                        @if ($manage->role == $account->accountable->role)
                                            <option value="{{$manage->id}}">{{$manage->role}}</option>
                                        @else
                                            <option value="{{$manage->id}}">{{$manage->role}}</option>
                                        @endif
                                        @endforeach   
                                    </select>
                                </div>
                                @error('role')
                                <p class="text-danger">{{ $message }}</p> 
                                @enderror
                                <div class="form-group">
                                    <label>Giới tính</label>
                                    <select name="gender" class="form-control">
                                        <option value="0">Nam</option>
                                        <option value="1">Nữ</option>
                                        @error('gender')
                                        <p class="text-danger">{{ $message }}</p> 
                                        @enderror
                                    </select>
                                </div>
                                @error('gender')
                                <p class="text-danger">{{ $message }}</p> 
                                @enderror
                                <div class="form-group">
                                    <label>Ngày sinh<span class = "text-danger">(*)</span></label>
                                    <input type="date" class="form-control" name="date_of_birth" style="width:100%"  value="{{$account->date_of_birth}}">
                                </div>
                                @error('date_of_birth')
                                <p class="text-danger">{{ $message }}</p> 
                                @enderror
                            </div>
                        </div>
                    </div>
                </div><!-- /.box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
</form>
@endsection
@section('custom-script')
<script src="{{ asset('adminlte/plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
@endsection