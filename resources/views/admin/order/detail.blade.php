@extends('admin.layouts.master')
@section('custom-css')
    @include('admin.components.css.datatables')
@endsection
@section('active-orders', 'active')
@section('breadcrumb', 'Chi Tiết Đơn Hàng')
@section('contents')
<div class="breadcrumb">
	<h5 class="mb-0">Tổng đơn hàng: {{ number_format($order->price_total, 0, ',', '.') }}đ</h5>
</div>
<section class="content">
	<div class="row">
		<div class="col-md-12">
			<div class="box" id="view">
				<div class="box-header with-border">
					<!-- /.box-header -->
					<div class="box-body">
						<div class="row" style='padding:0px; margin:0px;'>
							<div class="table-responsive">
								<table id="order-list" class="table table-hover table-bordered">
									<thead>
										<tr>
											<th class="text-center">Tên sản phẩm</th>
                                            <th class="text-center">Ảnh sản phẩm</th>
                                            <th class="text-center">Danh mục</th>
											<th class="text-center">Phân loại hàng</th>
                                            <th class="text-center">Đơn giá</th>
                                            <th class="text-center">Số lượng</th>
											<th class="text-center">Tổng tiền</th>
										</tr>
									</thead>
									<tbody>
                                        @foreach ($orderDetails as $detail)
                                            @php
                                                $totalItem = $detail->productVariant->unit_price * $detail->amount;
                                            @endphp
                                            <tr>
                                                <td class="text-center">{{ $detail->productVariant->product->name }}</td>
                                                <td class="text-center">
                                                    <img src="{{ $detail->productVariant->product->feature_image_path }}" alt="Feature image" style="max-height: 200px; width: 100px;">
                                                </td>
                                                <td class="text-center">{{ $detail->productVariant->product->category->name }}</td>
                                                <td class="text-center">{{ $detail->productVariant->variant_text }}</td>
                                                <td class="text-center">{{ number_format($detail->productVariant->unit_price, 0, ',', '.') }}đ</td>
                                                <td class="text-center">{{ $detail->amount }}</td>
                                                <td class="text-center">{{ number_format($totalItem, 0, ',', '.') }}đ</td>
                                            </tr>
                                        @endforeach
									</tbody>
								</table>
							</div>
							<!-- /.ND -->
						</div>
					</div><!-- ./box-body -->
				</div><!-- /.box -->
			</div>
			<!-- /.col -->
		</div>
		<!-- /.row -->
	</section>
@endsection
@section('custom-script')
    @include('admin.components.js.datatables')
@endsection
@section('my-script')
    <script>
        $(function() {
            $('#order-list').DataTable({
                "paging": false,
                // "lengthChange": false,
                // "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
            $(document).on('change', '#order-status', function () {
                const BASE_URL = $('base').attr('href')
                const optionSelected = $("option:selected", this);
                const valueSelected = this.value;
                const orderId = optionSelected.data('order-id')
                window.location.href = `${BASE_URL}admin/orders/${orderId}?order_status=${valueSelected}`;
            })
        });
    </script>
@endsection
