@extends('admin.layouts.master')
@section('custom-css')
    @include('admin.components.css.datatables')
@endsection
@section('breadcrumb', 'Danh Mục Sản Phẩm')
@section('contents')
<div class="breadcrumb">
    <div class="">
        <a id="btn-form-add" class="btn btn-primary btn-sm" role="button">
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
                        <div class="row row-table">
                            <div id="render-list-product" style="width: 98%;margin: auto;">
                                <div id="table-responsive1" class="table-responsive">
                                    <table id="category-list" class="table table-hover table-bordered table-content">
                                        <thead>
                                            <tr>
                                                <th class="text-center">ID</th>
                                                <th lass="text-center">Tên Danh Mục</th>
                                                <th lass="text-center">Danh Mục Cha</th>
                                                <th class="text-center">Mô Tả</th>
                                                <th class="text-center">Trạng Thái</th>
                                                <th class="text-center">Thao Tác</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <form id="" action="">
                                                {{-- @foreach ($students as $student) --}}
                                                <tr id="id-product">
                                                    <td class="text-center">id</td>
                                                    <td style="font-size: 16px;">name_student</td>
                                                    <td style="font-size: 16px;">name </td>
                                                    <td class="text-center">instructorsname</td>
                                                    <td class="text-center">
                                                        {{-- @if ($student->status == 1) --}}
                                                        <i style="color: green" class="fa fa-check" aria-hidden="true"></i>
                                                        {{-- @else
                                                        <i style="color: red" class="fa fa-times" aria-hidden="true"></i>
                                                        @endif --}}
                                                    </td>
                                                    <td class="text-center">
                                                        <button type="button" url-update="update"
                                                            data-url="up"
                                                            class="btn btn-success btn-xs btn-edit-product"><i class="fa fa-plus"
                                                                aria-hidden="true"></i>Sửa</button>                   
                                                        <button type="button" data-url="delete"
                                                        class="btn btn-danger btn-xs  btn-delete"><i class="fa fa-trash" aria-hidden="true"></i>
                                                        Xóa</button>        
                                                    </td>
                                                </tr>
                                                {{-- @endforeach --}}
                                            </form>
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
@endsection
@section('my-script')
    <script>
        $(function() {
            //   $("#example1").DataTable({
            //     "responsive": true, "lengthChange": false, "autoWidth": false,
            //     "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            //   }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
            $('#category-list').DataTable({
                "paging": true,
                // "lengthChange": false,
                // "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
        });
    </script>
@endsection