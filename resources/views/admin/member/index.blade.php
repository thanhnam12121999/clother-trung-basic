@extends('admin.layouts.master')
@section('custom-css')
    @include('admin.components.css.datatables')
@endsection
@section('breadcrumb', 'Quản Lý Thành Viên')
@section('contents')
<div class="breadcrumb">
    <div class="btn-add">
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
                        <div class="row row-table"  data-url="list">
                            <div id="render-list-product" style="width: 98%;margin: auto;">
                                <div id="table-responsive1" class="table-responsive">
                                    <table id="member-list" class="table table-hover table-bordered table-content">
                                        <thead>
                                            <tr>
                                                <th class="text-center">ID</th>
                                                <th class="text-center">Hình Ảnh</th>
                                                <th class="text-center">Họ Và Tên</th>
                                                <th class="text-center">Địa Chỉ</th>
                                                <th class="text-center">Email</th>
                                                <th class="text-center">Phone</th>
                                                <th class="text-center">Trạng Thái</th>
                                                <th class="text-center">Thao Tác</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <form id="fixx" action="">
                                                {{-- @foreach ($students as $student) --}}
                                                <tr id="id-product">
                                                    <td class="text-center">id</td>
                                                    <td style="font-size: 16px;">name_student</td>
                                                    <td style="font-size: 16px;">name </td>
                                                    <td style="font-size: 16px;">test </td>
                                                    <td style="font-size: 16px;">test </td>
                                                    <td class="text-center">instructors</td>
                                                    <td class="text-center">
                                                        {{-- @if ($student->status == 1) --}}
                                                        <i style="color: green" class="fa fa-check" aria-hidden="true"></i>
                                                        {{-- @else
                                                        <i style="color: red" class="fa fa-times" aria-hidden="true"></i>
                                                        @endif --}}
                                                    </td>
                                                    <td class="text-center">
                                                        <button type="button" url-update="update"
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
            $('#member-list').DataTable({
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