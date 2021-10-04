@extends('admin.layouts.master')
@section('custom-css')
    @include('admin.components.css.datatables')
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/sweetalert2/sweetalert2.min.css') }}">
@endsection
@section('active-categories', 'active')
@section('breadcrumb', 'Danh Mục Sản Phẩm')
@section('contents')
    <div class="breadcrumb">
        <div class="">
        <a id=" btn-form-add" href="{{ route('admin.categories.create') }}"
            class="btn btn-primary btn-sm" role="button">
            <span class="glyphicon glyphicon-plus"></span>Thêm Mới
            </a>
        </div>
    </div>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="row row-table">
                    <div id="render-list-category" style="width: 98%;margin: auto;">
                        <div id="table-responsive1" class="table-responsive">
                            <table id="category-list" class="table table-hover table-bordered table-content">
                                <thead>
                                    <tr>
                                        <th class="text-center" width="5%">ID</th>
                                        <th class="text-center" width="15%">Tên Danh Mục</th>
                                        <th class="text-center" width="15%">Ảnh danh mục</th>
                                        <th class="text-center" width="20%">Mô Tả</th>
                                        <th class="text-center" width="15%">Thời gian tạo</th>
                                        <th class="text-center" width="20%">Thời gian chỉnh sửa gần nhất</th>
                                        <th class="text-center" width="10%">Thao Tác</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (!empty($categories))
                                        @foreach ($categories as $category)
                                            <tr>
                                                <td class="text-center">
                                                    {{ $category->id }}
                                                </td>
                                                <td class="text-center">
                                                    {{ $category->name }}
                                                </td>
                                                <td class="text-center">
                                                    <img style="width: 100px; max-height: 200px;"
                                                        src="{{ asset("storage/images/categories/{$category->image}") }}"
                                                        alt="{{ $category->image }}" />
                                                </td>
                                                <td class="text-center">
                                                    {{ $category->description }}
                                                </td>
                                                <td class="text-center">
                                                    {{ $category->created_at }}
                                                </td>
                                                <td class="text-center">
                                                    {{ $category->updated_at }}
                                                </td>
                                                <td class="text-center">
                                                    <a href="{{ route('admin.categories.edit', $category->id) }}"
                                                        type="button" class="btn btn-warning btn-xs btn-edit-product">
                                                        <i class="fa fa-plus" aria-hidden="true"></i>Sửa
                                                    </a>
                                                    <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button
                                                            type="submit"
                                                            data-url="{{ route('admin.categories.destroy', $category->id) }}"
                                                            class="btn btn-danger btn-xs btn-delete">
                                                            <i class="fa fa-trash" aria-hidden="true"></i>Xóa
                                                        </button>
                                                    </form>
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
    </section>
@endsection
@section('custom-script')
    @include('admin.components.js.datatables')
    <script src="{{ asset('adminlte/plugins/sweetalert2/sweetalert2.all.min.js') }}"></script>
@endsection
@section('my-script')
    <script>
        $(function() {
            $('#category-list').DataTable({
                "paging": true,
                // "lengthChange": false,
                // "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });

            $('.btn-delete').click(function(e) {
                e.preventDefault();
                let url = $(this).attr('data-url');
                Swal.fire({
                    title: 'Bạn chắc chắn muốn xóa danh mục này?',
                    // text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCloseButton: true,
                    showCancelButton: true,
                    confirmButtonColor: '#42c119',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Xóa',
                    cancelButtonText: 'Hủy'
                }).then((result) => {
                    $(this).parent().submit()
                })
            });
        });
    </script>
@endsection
