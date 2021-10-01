@extends('admin.layouts.master')
@section('custom-css')
    @include('admin.components.css.datatables')
    <script src="{{ asset('adminlte/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/sweetalert2/sweetalert2.min.css') }}">
@endsection
@section('breadcrumb', 'Sản Phẩm')
@section('contents')
<div class="breadcrumb">
    <div class="btn-add">
        <a id="" href="{{ route('admin.products.form_create') }}" class="btn btn-primary btn-sm" role="button">
            <span class="glyphicon glyphicon-plus"></span>Thêm Mới
        </a>
    </div>
</div>
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box" id="view">
                <div class="box-header with-border">
                    <div class="box-body">
                        <div class="row row-table"  data-url="list">
                            <div id="render-list-product" style="width: 98%;margin: auto;">
                                <div id="table-responsive1" class="table-responsive">
                                    <table id="product-list" class="table table-hover table-bordered table-content">
                                        <thead>
                                            <tr>
                                                <th class="text-center">ID</th>
                                                <th class="text-center">Hình Ảnh</th>
                                                <th class="text-center">Tên</th>
                                                <th class="text-center">Danh Mục</th>
                                                <th class="text-center">Mã Sản Phẩm</th>
                                                <th class="text-center">Trạng Thái</th>
                                                <th class="text-center">Thao Tác</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($products as $product)
                                            <tr id="id-product">
                                                @php
                                                    $isUrl = filter_var($product->feature_image, FILTER_VALIDATE_URL);
                                                @endphp
                                                <td class="text-center">{{$product->id}}</td>
                                                <td class="text-center">
                                                    <img style="height: 50px;width: 70px;" src="{{ $isUrl ? $product->feature_image : asset("admin/products/images/$product->feature_image") }}">
                                                </td>
                                                <td style="font-size: 16px;">{{$product->name}}</td>
                                                <td class="text-center">{{$product->category->name}}</td>
                                                <td class="text-center">{{$product->code}}</td>
                                                <td class="text-center">
                                                    @if ($product->status == 1)
                                                    <i style="color: green" class="fa fa-check" aria-hidden="true"></i>
                                                    @else
                                                    <i style="color: red" class="fa fa-times" aria-hidden="true"></i>
                                                    @endif
                                                </td>
                                                <td class="text-center">
                                                    <a href="{{ route('admin.products.show', $product->id) }}" type="button" class="btn btn-info btn-xs"><i class="fa fa-eye" aria-hidden="true"></i>Xem</a>
                                                    <a href="{{ route('admin.products.edit', $product->id) }}" type="button"
                                                    class="btn btn-success btn-xs btn-edit-product"><i class="fa fa-plus"
                                                        aria-hidden="true"></i>Sửa</a>
                                                    <button data-url="{{ route('admin.products.delete', $product->id) }}" class="btn btn-danger btn-xs btn-delete"><i class="fa fa-trash" aria-hidden="true"></i>
                                                    Xóa</button>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('custom-script')
    @include('admin.components.js.datatables')
    <script src="{{ asset('adminlte/plugins/sweetalert2/sweetalert2.all.min.js') }}"></script>
@endsection
@section('my-script')
    <script>
        $(function() {
            $('#product-list').DataTable({
                "paging": true,
                // "lengthChange": false,
                // "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
        });
        $(document).ready(function () {
            $('.btn-delete').click(function (e) {
                e.preventDefault();
                let url = $(this).attr('data-url');
                Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = url;
                        // Swal.fire(
                        // 'Deleted!',
                        // 'Your file has been deleted.',
                        // 'success'
                        // )
                    }
                })
            });
        });
    </script>
@endsection
