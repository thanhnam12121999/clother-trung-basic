@extends('admin.layouts.master')
@section('custom-css')
@include('admin.components.css.datatables')
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endsection
@section('active-products', 'active')
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
            <a href="{{ route('admin.products.index') }}" class="btn btn-default btn-sm" href="admin/product" role="button">
                <span class="glyphicon glyphicon-remove do_nos"></span> Thoát
            </a>
        </div>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Tên sản phẩm <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="name" value="{{$product->name ?? old('name')}}">
                            @error('name')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Loại sản phẩm<span class="text-danger">*</span></label>
                            <select name="category_id" class="form-control">
                                <option value = "">[--Chọn loại sản phẩm--]</option>
                                @foreach ($categories as $cate)
                                    @if ($cate->id == $product->category->id)
                                        <option selected value="{{$cate->id}}">
                                            {{ Str::ucfirst($cate->name) }}
                                        </option>
                                    @else
                                        <option value = "{{$cate->id}}">
                                            {{ Str::ucfirst($cate->name) }}
                                        </option>
                                    @endif
                                @endforeach
                            </select>
                            @error('category_id')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Tóm lược <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="summary" value="{{$product->summary ?? old('summary')}}">
                            @error('summary')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="feature-image">Ảnh đại diện sản phẩm</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="feature-image" name="feature_image">
                                    <label class="custom-file-label" for="feature-image">Chọn ảnh đại diện</label>
                                </div>
                            </div>
                            @error('feature_image')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="image-list">Ảnh sản phẩm</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="image-list" name="image_list[]" multiple>
                                    <label class="custom-file-label" for="image-list">Chọn ảnh sản phẩm</label>
                                </div>
                            </div>
                            @error('image_list')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Mô tả</label>
                            <textarea name="description" class="form-control" >{{$product->description ?? old('description')}}</textarea>
                        </div>
                        <div class="form-group">
                            <label>Chi tiết sản phẩm</label>
                            <textarea name="detail" id="detail" class="form-control">{{$product->detail ?? old('detail')}}</textarea>
                        </div>
                        <div class="form-group">
                            <label>Trạng thái</label>
                            <select name="status" class="form-control">
                                <option value="1" @if ($product->status == 1) selected @endif>Còn hàng</option>
                                <option value="0" @if ($product->status == 2) selected @endif>Hết hàng</option>
                                @error('status')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        {{-- <div class="form-group">
                            <label>Giá bán(Cần add bảng order)</label>
                            <input name="price" class="form-control" type="number" value="1000000" min="0" step="10000" max="1000000000">
                            <div class="error" id="password_error"></div>
                        </div> --}}
                        {{-- <div class="form-group">
                            <label>Số lượng tồn kho</label>
                            <input name="number" class="form-control" type="number" value="" min="1" step="1" max="1000" disabled>
                        </div>
                        <div class="form-group">
                            <label>Số lượng đã bán</label>
                            <input name="number" class="form-control" type="number" value="" min="1" step="1" max="1000" disabled>
                        </div> --}}
                        <div class="form-group">
                            <label>Thuộc tính sản phẩm</label>
                            <select class="select2" multiple="multiple" name="attribute_product[]" data-placeholder="Chọn thuộc tính sản phẩm" style="width: 100%;">
                                <option value="">[--Chọn thuộc tính--]</option>
                                @foreach ($attributeValues as $attrValue)
                                    @if (in_array($attrValue->id, $product->attributes->pluck('id')->toArray()))
                                        <option selected value="{{ $attrValue->id }}">{{ Str::ucfirst($attrValue->attribute->name) . ' - ' . Str::ucfirst($attrValue->name) }}</option>
                                    @else
                                        <option value="{{ $attrValue->id }}">{{ Str::ucfirst($attrValue->attribute->name) . ' - ' . Str::ucfirst($attrValue->name) }}</option>
                                    @endif
                                @endforeach
                            </select>
                            @error('attribute_product')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Danh sách thuộc tính sản phẩm</h3>
                              </div>
                            <div class="card-body">
                                <button type="button" data-toggle="modal" data-target="#attributeModal" class="btn btn-primary btn-sm mb-2">
                                    <span class="glyphicon glyphicon-floppy-save"></span>
                                    Thêm thuộc tính
                                </button>
                                @if ($errors->any())
                                    <div class="alert alert-danger mb-2">
                                        <ul class="mb-0">
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                <div id="table-responsive1" class="table-responsive">
                                    <table id="attribute-list" class="table table-hover table-bordered table-content">
                                        <thead>
                                            <tr>
                                                <th>Tên thuộc tính</th>
                                                <th>Giá trị thuộc tính</th>
                                                <th>Thao tác</th>
                                            </tr>
                                        </thead>
                                        <tbody class="attr-content">
                                            @if ($attributes->isNotEmpty())
                                                @foreach ($attributes as $attr)
                                                    <tr>
                                                        <td>
                                                            {{ $attr->name }}
                                                        </td>
                                                        <td>
                                                            @foreach ($attr->attributeValues as $attrValue)
                                                                <span>{{ Str::ucfirst($attrValue->name) }}</span>
                                                            @endforeach
                                                        </td>
                                                        <td>
                                                            <button type="button" class="btn btn-warning btn-xs btn-edit-attr" data-attr="{{ $attr }}">Sửa</button>
                                                            <a href="" class="btn btn-danger btn-xs">Xóa</a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
</form>
@include('admin.product.components.attribute-modal')
@include('admin.product.components.attribute-modal-update')
@endsection
@section('custom-script')
    @include('admin.components.js.datatables')
    <script src="{{ asset('adminlte/plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
    <script src="{{ asset('adminlte/plugins/select2/js/select2.full.min.js') }}"></script>
@endsection
@section('my-script')
    <script src="{{ asset('admin/products/create/script.js') }}"></script>
@endsection
