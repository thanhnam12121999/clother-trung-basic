@extends('admin.layouts.master')
@section('custom-css')
    
@endsection
@section('breadcrumb', 'Chỉnh Sửa Sản Phẩm')
@section('contents')
<form action="{{ route('admin.products.update', $product->id) }}" enctype="multipart/form-data" method="POST" accept-charset="utf-8">
    @csrf
    @method('PUT')
    <section class="content-header">
        <div class="breadcrumb">
            <button type = "submit" class="btn btn-primary btn-sm mr-3">
                <span class="glyphicon glyphicon-floppy-save"></span>
                Lưu[Cập nhật]
            </button>
            <a href="{{ route('admin.products.index') }}" class="btn btn-primary btn-sm" href="admin/product" role="button">
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
                            <div class="col-md-9">
                                <div class="form-group">
                                    <label>Tên sản phẩm <span class = "maudo">(*)</span></label>
                                    <input type="text" class="form-control" name="name" style="width:100%" value="{{$product->name}}">
                                    <div class="error" id="password_error"></div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="col-md-6" style="padding-left: 0px;">
                                            <div class="form-group">
                                                <label>Loại sản phẩm<span class = "maudo">(*)</span></label>
                                                <select name="cate_id" class="form-control">
                                                    <option value = "">[--Chọn loại sản phẩm--]</option>
                                                    @foreach ($categories as $cate)
                                                    @if ($cate->id == $product->category->id)
                                                    <option selected value = "{{$cate->id}}">{{$cate->name}}</option>    
                                                    @else
                                                    <option value = "{{$cate->id}}">{{$cate->name}}</option>   
                                                    @endif
                                                    @endforeach
                                                </select>
                                                <div class="error" id="password_error"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Tóm lược<span class = "maudo">(*)</span></label>
                                    <input type="text" class="form-control" name="summary" style="width:100%"  value="{{$product->summary}}">
                                </div>
                                <div class="form-group">
                                    <label>Mô tả</label>
                                    <textarea name="description" class="form-control" >{{$product->description}}</textarea>
                                </div>
                                <div class="form-group">
                                    <label>Chi tiết sản phẩm</label>
                                    <textarea name="detail" id="detail" class="form-control">{{$product->detail}}</textarea>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Giá bán(Cần add bảng order)</label>
                                    <input name="price" class="form-control" type="number" value="1000000" min="0" step="10000" max="1000000000">
                                    <div class="error" id="password_error"></div>
                                </div>
                                {{-- <div class="form-group">
                                    <label>Số lượng tồn kho</label>
                                    <input name="number" class="form-control" type="number" value="" min="1" step="1" max="1000" disabled>
                                </div>
                                <div class="form-group">
                                    <label>Số lượng đã bán</label>
                                    <input name="number" class="form-control" type="number" value="" min="1" step="1" max="1000" disabled>
                                </div> --}}
                                <div class="form-group">
                                    <label>Thay hình đại diện</label>
                                    <input type="file"  name="feature_image" style="width: 100%">
                                </div>
                                <div class="form-group">
                                    <label>Thay hình ảnh sản phẩm</label>
                                    <input type="file"  name="image_list[]" multiple>
                                </div>
                                <div class="form-group">
                                    <label>Trạng thái</label>
                                    <select name="status" class="form-control">
                                        <option value="1" @php if($product->status == 1) {echo 'selected';} @endphp>Đang kinh doanh</option>
                                        <option value="0" @php if($product->status == 0) {echo 'selected';} @endphp>Ngừng kinh doanh</option>
                                    </select>
                                </div>
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
@section('my-script')
    <script>CKEDITOR.replace('detail');</script>
    <script>CKEDITOR.replace('description');</script>
@endsection
