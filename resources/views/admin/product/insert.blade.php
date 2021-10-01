@extends('admin.layouts.master')
@section('breadcrumb', 'Thêm Sản Phẩm Mới')
@section('contents')
<form action="{{ route('admin.products.create') }}" enctype="multipart/form-data" method="POST" accept-charset="utf-8">
    @csrf
    <section class="content-header">
        <div class="breadcrumb">
            <button type = "submit" class="btn btn-primary btn-sm mr-3">
                <span class="glyphicon glyphicon-floppy-save"></span>
                Lưu[Thêm]
            </button>
            <a class="btn btn-primary btn-sm"  href="{{ route('admin.products.index') }}" role="button">
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
                                    <label>Tên sản phẩm <span class = "maudo">(*)</span></label>
                                    <input type="text" class="form-control" name="name" style="width:100%" placeholder="Tên sản phẩm">
                                    @error('name')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Loại sản phẩm<span class = "maudo">(*)</span></label>
                                    <select name="cate_id" class="form-control">
                                        <option value = "">[--Chọn loại sản phẩm--]</option>
                                        @foreach ($categories as $cate)
                                        <option value="{{ $cate->id }}">{{ Str::ucfirst($cate->name) }}</option>
                                        @endforeach
                                    </select>
                                    @error('cate_id')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Tóm Lược<span class = "maudo">(*)</span></label>
                                    <input type="text" class="form-control" name="summary" style="width:100%" placeholder="Tóm Lược">
                                </div>
                                <div class="form-group">
                                    <label>Mô tả</label>
                                    <textarea name="sort_desc" class="form-control" ></textarea>
                                </div>
                                <div class="form-group">
                                    <label>Chi tiết sản phẩm</label>
                                    <textarea name="detail" id="detail" class="form-control" ></textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                {{-- <div class="form-group">
                                    <label>Giá bán</label>
                                    <input name="price_buy" class="form-control" type="number" value="0" min="0" step="1" max="1000000000">
                                    <div class="error" id="password_error"></div>
                                </div> --}}
                                <div class="form-group">
                                    <label>Hình đại diện</label>
                                    <input type="file"  id="image_list" name="feature_image" style="width: 100%">
                                    @error('feature_image')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Hình ảnh sản phẩm</label>
                                    <input type="file"  id="image_list" name="image_list[]" multiple>
                                    @error('image_list')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Trạng thái</label>
                                    <select name="status" class="form-control">
                                        <option value="1">Kinh doanh</option>
                                        <option value="0">Chưa Kinh doanh</option>
                                    </select>
                                    @error('status')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- /.box -->
            </div>
      </div>
    </section>
</form>
@endsection
@section('my-script')
    <script>CKEDITOR.replace('sort_desc');</script>
    <script>CKEDITOR.replace('detail');</script>
@endsection
