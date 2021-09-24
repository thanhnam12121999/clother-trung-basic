@extends('admin.layouts.master')
@section('custom-css')
    @include('admin.components.css.datatables')
@endsection
@section('breadcrumb', 'Quản Lý Đơn Hàng')
@section('contents')
<div class="breadcrumb">
	<a class="btn btn-primary btn-sm" href="admin/orders/recyclebin" role="button">
		<span class="glyphicon glyphicon-trash"></span> Đơn Hàng Đã Lưu (10)
	</a>
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
											<th class="text-center">Mã Đơn Hàng</th>
											<th>Khách Hàng</th>
											<th>Điện Thoại</th>
											<th>Tổng Tiền</th>
											<th>Ngày Tạo Hóa Đơn</th>
											<th class="text-center">Trạng Thái</th>
											<th class="text-center">Xử Lý Đơn</th>
											<th class="text-center">Thao Tác</th>
										</tr>
									</thead>
									<tbody>
											{{-- foreach ($list as $val): --}}
											<tr>
												<td class="text-center">ordercode</td>
												<td>fullname</td>
												<td>phone</td>
												<td>100₫</td>
												<td>order date</td>
												<td style="text-align: center;">
													Đang Chờ Duyệt
													{{-- switch ($val['status']) {
														case '0':
														echo 'Đang chờ duyệt';
														break;
														case '1':
														echo 'Đang giao hàng';
														break;
														case '2':
														echo 'Đã giao';
														break;
														case '3':
														echo 'Khách hàng đã hủy';
														break;
														case '4':
														echo 'Nhân viên đã hủy';
														break;
													}
													?>  --}}
												</td>
												<td style="text-align: center;">
													{{-- if($val['status']==1) --}}
														<a class="btn btn-success btn-xs" href="admin/orders/status/"role = "button">
															<i class="fa  fa-thumbs-o-up"></i> Xác Nhận Thanh Toán
														</a>
														{{-- ($val['status']==0) --}}
														<a class="btn btn-default btn-xs" href="admin/orders/status"   role = "button">
															<i class="fa fa-check-square-o"></i> Duyệt Đơn Đặt Hàng
														</a>						
														{{-- if($val['status'] ==0 || $val['status'] ==1) --}}
														<a class="btn btn-danger btn-xs" href="admin/orders/cancelorder/" role = "button">
															<i class="fa fa-save"></i> Hủy Đơn
														</a>
												</td>
												<td class="text-center">
													<!-- /Xem -->
													<a class="btn btn-info btn-xs" href="admin/orders/detail" role = "button">
														<span class="glyphicon glyphicon-eye-open"></span> Xem 
													</a>
													<!-- /Xóa -->
													<a class="btn bg-olive btn-xs" href="admin/orders/trash/"  role = "button">
														<i class="fa fa-save"></i> Lưu Đơn
													</a>
													<a class="btn btn-primary btn-sm" href="/admin/orders/update/" role="button">
														Ghi Chú 
												</td>
											</tr>
										{{-- php endforeach;  --}}
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
            //   $("#example1").DataTable({
            //     "responsive": true, "lengthChange": false, "autoWidth": false,
            //     "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            //   }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
            $('#order-list').DataTable({
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