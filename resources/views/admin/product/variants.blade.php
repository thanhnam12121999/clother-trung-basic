@extends('admin.layouts.master')
@section('custom-css')
    @include('admin.components.css.datatables')
@endsection
@section('active-products', 'active')
@section('breadcrumb', 'Cập nhật biến thể sản phẩm')
@section('contents')
<form action="{{ route('admin.products.variants.update', $product->id) }}" method="POST">
    @csrf
    @method('PUT')
    <section class="content-header">
        <div class="breadcrumb">
            <button type="submit" class="btn btn-primary btn-sm">
                <span class="glyphicon glyphicon-floppy-save"></span>
                Lưu[Cập nhật]
            </button>
        </div>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="row row-table"  data-url="list">
                    <div id="render-list-product" style="width: 98%;margin: auto;">
                        <div id="table-responsive1" class="table-responsive">
                            <table id="product-list" class="table table-hover table-bordered table-content">
                                <thead>
                                    <tr>
                                        <th class="text-center">Giá trị biến thể</th>
                                        <th class="text-center">Số lượng biến thể</th>
                                        <th class="text-center">Giá biến thể</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($variants as $variantId => $variant)
                                        <tr>
                                            <td class="text-center">{{ implode(" - ", $variant['variant']) }}</td>
                                            <td class="text-center">
                                                <input type="number" class="form-control" name="amount[{{ $variantId }}]" value="{{ !empty($variant['amount']) ? $variant['amount'] : '' }}">
                                            </td>
                                            <td class="text-center">
                                                <input type="number" class="form-control" name="unit_price[{{ $variantId }}]" value="{{ !empty($variant['unit_price']) ? $variant['unit_price'] : '' }}">
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
    </section>
</form>
@endsection
@section('custom-script')
    @include('admin.components.js.datatables')
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
            $('.btn-delete').click(function (e) {
                e.preventDefault();
                let url = $(this).attr('data-url');
                Swal.fire({
                    title: 'Bạn chắc chắn muốn xóa sản phẩm này?',
                    // text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCloseButton: true,
                    showCancelButton: true,
                    confirmButtonColor: '#42c119',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Xóa',
                    cancelButtonText: 'Hủy'
                })
                .then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = url;
                    }
                })
            });
        });
    </script>
@endsection
