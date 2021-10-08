@extends('admin.layouts.master')
@section('custom-css')
    @include('admin.components.css.datatables')
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endsection
@section('active-products', 'active')
@section('breadcrumb', 'Thêm Sản Phẩm Mới')
@section('contents')
    <form action="{{ route('admin.products.create') }}" enctype="multipart/form-data" method="POST"
        accept-charset="utf-8">
        @csrf
        <section class="content-header">
            <div class="breadcrumb">
                <button name="add_product" type="submit" class="btn btn-primary btn-sm mr-3">
                    <span class="glyphicon glyphicon-floppy-save"></span>
                    Lưu[Thêm]
                </button>
                <a class="btn btn-default btn-sm" href="{{ route('admin.products.index') }}" role="button">
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
                                <input type="text" class="form-control" name="name" placeholder="Tên sản phẩm"
                                    value="{{ old('name') }}">
                                @error('name')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Loại sản phẩm <span class="text-danger">*</span></label>
                                <select name="category_id" class="form-control">
                                    <option value="">[--Chọn loại sản phẩm--]</option>
                                    @foreach ($categories as $cate)
                                        <option value="{{ $cate->id }}">{{ $cate->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Tóm Lược <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="summary" placeholder="Tóm Lược"
                                    value="{{ old('summary') }}">
                                @error('summary')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="feature-image">Ảnh đại diện sản phẩm <span
                                        class="text-danger">*</span></label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="feature-image"
                                            name="feature_image">
                                        <label class="custom-file-label" for="feature-image">Chọn ảnh đại diện</label>
                                    </div>
                                </div>
                                @error('feature_image')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="image-list">Ảnh sản phẩm <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="image-list" name="image_list[]"
                                            multiple>
                                        <label class="custom-file-label" for="image-list">Chọn ảnh sản phẩm</label>
                                    </div>
                                </div>
                                @error('image_list')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Mô tả</label>
                                <textarea name="description" class="form-control">{{ old('description') }}</textarea>
                            </div>
                            <div class="form-group">
                                <label>Chi tiết sản phẩm</label>
                                <textarea name="detail" id="detail" class="form-control">{{ old('detail') }}</textarea>
                            </div>
                            <div class="form-group">
                                <label>Trạng thái</label>
                                <select name="status" class="form-control">
                                    <option value="1">Còn hàng</option>
                                    <option value="0">Hết hàng</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Thuộc tính sản phẩm</label>
                                <select class="select2" multiple="multiple" name="attribute_product[]" data-placeholder="Chọn thuộc tính sản phẩm" style="width: 100%;">
                                    <option value="">[--Chọn thuộc tính--]</option>
                                    @foreach ($attributeValues as $attrValue)
                                        <option value="{{ $attrValue->id }}">{{ $attrValue->attribute->name . ' - ' . $attrValue->name }}</option>
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
                                    @if (session()->has('failed_validate'))
                                        <div class="alert alert-danger">
                                            <strong>{{ session('failed_validate') }}</strong>
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
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
                                                                @foreach ($attr->attributeValues as $key => $attrValue)
                                                                    @if ($key == count($attr->attributeValues) - 1)
                                                                        <span>{{ $attrValue->name }}</span>
                                                                    @else
                                                                        <span>{{ $attrValue->name }},</span>
                                                                    @endif
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
            </div>
        </section>
    </form>
    @include('admin.product.components.attribute-modal')
    @include('admin.product.components.attribute-modal-update')
@endsection
@section('custom-script')
    @include('admin.components.js.datatables')
    <script src="{{ asset('adminlte/plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
    <script src="{{ asset('adminlte/plugins/select2/js/select2.full.min.js') }}"></script>
    {{-- <script src="{{ asset('adminlte/plugins/jquery-validation/jquery.validate.min.js') }}"></script> --}}
@endsection
@section('my-script')
    <script src="{{ asset('admin/products/create/script.js') }}"></script>
@endsection
