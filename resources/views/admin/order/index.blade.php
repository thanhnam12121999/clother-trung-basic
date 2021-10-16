@extends('admin.layouts.master')
@section('custom-css')
    @include('admin.components.css.datatables')
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/sweetalert2/sweetalert2.min.css') }}">
@endsection
@section('active-orders', 'active')
@section('breadcrumb', 'Quản Lý Đơn Hàng')
@section('contents')
{{-- <div class="breadcrumb">
	<a class="btn btn-primary btn-sm" href="admin/orders/recyclebin" role="button">
		<span class="glyphicon glyphicon-trash"></span> Đơn Hàng Đã Lưu (10)
	</a>
</div> --}}
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
											<th class="text-center">Mã đơn hàng</th>
											<th class="text-center">Khách hàng</th>
                                            <th class="text-center">Địa chỉ</th>
                                            <th class="text-center">Điện thoại</th>
											<th class="text-center">Tổng tiền</th>
                                            <th class="text-center">Trạng thái</th>
                                            <th class="text-center">Ghi chú</th>
                                            <th class="text-center">Phương thúc thanh toán</th>
                                            <th class="text-center">Ngày tạo hóa đơn</th>
                                            <th class="text-center">Thao tác</th>
										</tr>
									</thead>
									<tbody>
                                        @if (!empty($orders))
                                        @foreach ($orders as $order)
                                            <tr>
                                                <td class="text-center">{{ $order->order_code }}</td>
                                                <td class="text-center">
                                                    {{ $order->name }}
                                                </td>
                                                <td class="text-center">{{ $order->address }}</td>
                                                <td class="text-center">{{ $order->phone_number  }}</td>
                                                <td class="text-center">{{ number_format($order->price_total, 0, ',', '.') }}đ</td>
                                                <td class="text-center">
                                                    @php
                                                        $selectedConfirmed = '';
                                                        $disabledConfirmed = '';
                                                        $selectedDelivered = '';
                                                        $disabledDelivered = '';
                                                        if ($order->order_status == \App\Models\Order::WAITING_CONFIRM_STATUS ) {
                                                            $disabledDelivered = 'disabled';
                                                        }
                                                        if ($order->order_status == \App\Models\Order::CONFIRMED_DELIVERY_STATUS) {
                                                            $selectedConfirmed = 'selected';
                                                            $disabledDelivered = 'disabled';
                                                        }
                                                        if ($order->order_status == \App\Models\Order::DELIVERED_STATUS) {
                                                            $selectedDelivered = 'selected';
                                                            $disabledConfirmed = 'disabled';
                                                        }
                                                        if ($order->order_status == \App\Models\Order::CANCEL_STATUS) {
                                                            $disabledConfirmed = 'disabled';
                                                            $disabledDelivered = 'disabled';
                                                        }
                                                    @endphp
                                                    <select class="form-control" name="order_status" id="order-status">
                                                        <option value="0" {{$order->order_status == \App\Models\Order::WAITING_CONFIRM_STATUS ? 'selected' : 'disabled'}}>Chờ xác nhận giao hàng</option>
                                                        <option value="1" data-order-id="{{$order->id}}" {{$selectedConfirmed}} {{$disabledConfirmed}}>Đang giao hàng</option>
                                                        <option value="2" {{$selectedDelivered}} {{$disabledDelivered}}>Đã giao</option>
                                                        <option value="3" {{$order->order_status == \App\Models\Order::CANCEL_STATUS ? 'selected' : 'disabled'}}>Đã hủy</option>
                                                    </select>
                                                </td>
                                                <td class="text-center">
                                                    {{ $order->note }}
                                                </td>
                                                <td class="text-center">
                                                    @if ($order->payment_method == 'cod')
                                                        Thanh toán khi nhận hàng
                                                    @else
                                                        Thanh toán ATM
                                                    @endif
                                                </td>
                                                <td class="text-center">
                                                    {{ $order->created_at }}
                                                </td>
                                                <td class="text-center">
                                                    <!-- /Xem -->
                                                    @if ($order->order_status == \App\Models\Order::WAITING_CONFIRM_STATUS)
                                                    <button data-url="{{ route('admin.orders.update-status', ['order' => $order->id, 'order_status' => 3]) }}" type="button" class="btn btn-danger btn-xs btn-cancel">Hủy đơn</button>
                                                    @endif
                                                    <a class="btn btn-info btn-xs" href="{{ route('admin.orders.detail', ['order' => $order->id]) }}" role = "button">
                                                        <span class="glyphicon glyphicon-eye-open"></span><i class="fa fa-eye" aria-hidden="true"></i> Chi tiết
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                        @endif
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
    <script src="{{ asset('adminlte/plugins/sweetalert2/sweetalert2.all.min.js') }}"></script>
@endsection
@section('my-script')
    <script>
        $(function() {
            $('#order-list').DataTable({
                "paging": true,
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
                window.location.href = `${BASE_URL}admin/orders/${orderId}/update-status?order_status=${valueSelected}`;
            })
            $('.btn-cancel').click(function (e) {
                e.preventDefault();
                let url = $(this).attr('data-url');
                Swal.fire({
                    title: 'Bạn chắc chắn muốn hủy đơn hàng?',
                    // text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCloseButton: true,
                    showCancelButton: true,
                    confirmButtonColor: '#42c119',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Xác nhận hủy',
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
