@extends('admin.layouts.master')
@section('custom-css')
    @include('admin.components.css.datatables')
@endsection
@section('breadcrumb', 'Quản Lý Nhân Viên')
@section('contents')
<div class="breadcrumb">
    <div class="btn-add">
        <a href="{{ route('admin.managers.form_create') }}" id="btn-form-add" class="btn btn-primary btn-sm" role="button">
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
                                    <table id="manager-list" class="table table-hover table-bordered table-content">
                                        <thead>
                                            <tr>
                                                <th class="text-center">ID</th>
                                                <th class="text-center">Hình Ảnh</th>
                                                <th class="text-center">Họ Và Tên</th>
                                                <th class="text-center">Quyền</th>
                                                <th class="text-center">Email</th>
                                                <th class="text-center">Phone</th>
                                                <th class="text-center">Thao Tác</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <form id="fixx" action="">
                                                @foreach ($listStaffs as $staff)
                                                @if (!empty($staff->accountable) && $staff->accountable->role == \App\Models\Manager::NAME_ROLE_STAFF)
                                                <tr id="id-product">
                                                    <td class="text-center">{{$staff->id}}</td>
                                                    <td class="text-center">
                                                        <img style="height: 50px;width: 70px;" src="{{ asset('admin/accounts/images/'.$staff->avatar) }}" alt="">
                                                    </td>
                                                    <td class="text-center">{{$staff->name}} </td>
                                                    <td class="text-center">{{$staff->accountable->role}}</td>
                                                    <td class="text-center">{{$staff->email}}</td>
                                                    <td class="text-center">{{$staff->phone_number}}</td>
                                                    <td class="text-center">
                                                        <a href="{{ route('admin.managers.edit', $staff->id) }}" type="button" url-update="update"
                                                            class="btn btn-success btn-xs btn-edit-product"><i class="fa fa-plus"
                                                                aria-hidden="true"></i>Sửa</a>                                           
                                                        @if (getAccountInfo()->role == (\App\Models\Manager::NAME_ROLE_ADMIN))
                                                        <a href="{{ route('admin.managers.delete', $staff->id) }}" type="button" data-url="delete"
                                                            class="btn btn-danger btn-xs  btn-delete"><i class="fa fa-trash" aria-hidden="true"></i>
                                                            Xóa</a>
                                                        @endif
                                                    </td>
                                                </tr>
                                                @endif
                                                @endforeach
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
            $('#manager-list').DataTable({
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