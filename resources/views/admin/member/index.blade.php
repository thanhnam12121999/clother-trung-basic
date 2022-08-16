@extends('admin.layouts.master')
@section('custom-css')
    @include('admin.components.css.datatables')
@endsection
@section('active-members', 'active')
@section('breadcrumb', 'Danh sách Thành Viên')
@section('contents')
{{-- <div class="breadcrumb">
    <div class="btn-add">
        <a id="btn-form-add" class="btn btn-primary btn-sm" role="button">
            <span class="glyphicon glyphicon-plus"></span>Thêm Mới
        </a>
    </div>
</div> --}}
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
                                                <th class="text-center">Tên thành viên</th>
                                                <th class="text-center">Địa Chỉ</th>
                                                <th class="text-center">Email</th>
                                                <th class="text-center">Số điện thoại</th>
                                                <th class="text-center">Giới tính</th>
                                                <th class="text-center">Ngày sinh</th>
                                                <th class="text-center">Thời gian tạo tài khoản</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($members as $member)
                                            <tr>
                                                <td class="text-center">{{ $member->id }}</td>
                                                <td class="text-center">{{ $member->account->name ?? '' }}</td>
                                                <td class="text-center">{{ $member->address }}</td>
                                                <td class="text-center">{{ $member->account->email ?? '' }}</td>
                                                <td class="text-center">{{ $member->account->phone_number ?? '' }}</td>
                                                <td class="text-center">
                                                    {{ $member->account && $member->account->gender == 0 ? 'Nam' : 'Nữ' }}
                                                </td>
                                                <td class="text-center">{{ $member->account && \Carbon\Carbon::parse($member->account->date_of_birth)->format('d-m-Y') }}</td>
                                                <td class="text-center">{{ $member->account && \Carbon\Carbon::parse($member->account->created_at)->format('d-m-Y H:i:s') }}</td>
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
