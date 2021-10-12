@extends('admin.layouts.master')
@section('breadcrumb', 'Thêm slide')
@section('active-slide', 'active')
@section('contents')
<form action="{{ route('admin.slides.create') }}" enctype="multipart/form-data" method="POST" accept-charset="utf-8">
    @csrf
    @method('POST')
    <section class="content-header">
        <div class="breadcrumb">
            <button href="" type = "submit" class="btn btn-primary btn-sm mr-3">
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
                                    <label>Tiêu đề<span class = "text-danger">(*)</span></label>
                                    <input type="text" class="form-control" name="title" style="width:100%">
                                </div>
                                @error('title')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                                <div class="form-group">
                                    <label>Nội dung slide</label>
                                    <textarea name="content" class="form-control"></textarea>
                                </div>
                                @error('content')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Ảnh slide</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" name="image">
                                            <label class="custom-file-label">Chọn ảnh slide</label>
                                        </div>
                                    </div>
                                </div>
                                @error('image')
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
@section('my-script')
    <script>
        bsCustomFileInput.init();
        $(function () {
            CKEDITOR.replace('content');
        })
    </script>
@endsection
