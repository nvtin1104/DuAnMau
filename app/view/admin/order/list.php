<div class="app-content pt-3 p-md-3 p-lg-4 m-0">
	<div class="container-xl">

		<div class="row g-3 mb-4 align-items-center justify-content-between">
			<div class="col-auto">
				<h1 class="app-page-title mb-0">Đơn hàng</h1>
			</div>
			<div class="col-auto">
				<div class="page-utilities">
					<div class="row g-2 justify-content-start justify-content-md-end align-items-center">
						<div class="col-auto">
							<select class="form-select w-auto">
								<option selected value="option-1">All</option>
								<option value="option-2">This week</option>
								<option value="option-3">This month</option>
								<option value="option-4">Last 3 months</option>

							</select>
						</div>
						<div class="col-auto">
							<a class="btn app-btn-secondary" href="#">
								<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-download me-1" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
									<path fill-rule="evenodd" d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z" />
									<path fill-rule="evenodd" d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z" />
								</svg>
								Download CSV
							</a>
						</div>
					</div><!--//row-->
				</div><!--//table-utilities-->
			</div><!--//col-auto-->
		</div><!--//row-->


		<nav id="orders-table-tab" class="orders-table-tab app-nav-tabs nav shadow-sm flex-column flex-sm-row mb-4">
			<a class="flex-sm-fill text-sm-center nav-link active" id="orders-all-tab" data-bs-toggle="tab" href="#orders-all" role="tab" aria-controls="orders-all" aria-selected="true">All</a>
			<a class="flex-sm-fill text-sm-center nav-link" id="orders-paid-tab" data-bs-toggle="tab" href="#orders-paid" role="tab" aria-controls="orders-paid" aria-selected="false">Hoàn thành</a>
			<a class="flex-sm-fill text-sm-center nav-link" id="orders-pending-tab" data-bs-toggle="tab" href="#orders-pending" role="tab" aria-controls="orders-pending" aria-selected="false">Đang xử lý</a>
			<a class="flex-sm-fill text-sm-center nav-link" id="orders-cancelled-tab" data-bs-toggle="tab" href="#orders-cancelled" role="tab" aria-controls="orders-cancelled" aria-selected="false">Hủy</a>
		</nav>


		<div class="tab-content" id="orders-table-tab-content">
			<div class="tab-pane fade show active" id="orders-all" role="tabpanel" aria-labelledby="orders-all-tab">
				<div class="app-card app-card-orders-table shadow-sm mb-5">
					<div class="app-card-body">
						<div class="table-responsive">
							<table class="table app-table-hover mb-0 text-left">
								<thead>
									<tr>
										<th class="cell">Code</th>
										<th class="cell">Địa chỉ</th>
										<th class="cell">Họ và tên</th>
										<th class="cell">Ngày</th>
										<th class="cell">Trạng thái</th>
										<th class="cell">Giá</th>
										<th class="cell"></th>
									</tr>
								</thead>
								<tbody>
									 <?php 
									foreach ($data_order as $order_item) {
									?>
										<tr>
											<td class="cell">{{$order_item['order_code']}}</td>
											<td class="cell"><span class="truncate">{{$order_item['address']}}</span></td>
											<td class="cell">{{$order_item['fullname']}}</td>
											<td class="cell"><span class="cell-data">16 Oct</span><span class="note">01:16 AM</span></td>
											<td class="cell">
												 <?php 
												if ($order_item['status'] == '1') {
													echo '<span class="badge bg-info">Chờ xác nhận</span>';
												} elseif ($order_item['status'] == '2') {
													echo '<span class="badge bg-warning">Đang giao</span>';
												} elseif ($order_item['status'] == '3') {
													echo '<span class="badge bg-success">Giao thành công</span>';
												} elseif ($order_item['status'] == '4') {
													echo '<span class="badge bg-success">Hoàn thành</span>';
												} elseif ($order_item['status'] == '0') {
													echo '<span class="badge bg-danger">Hủy</span>';
												}
												?>

											</td>
											<td class="cell"> <?php  echo number_format($order_item['total_price'], 0) . ' VND'; ?></td>
											<td class="cell"><a class="btn-sm app-btn-secondary" href=" <?php  echo _WEB_ROOT . '/admin/order/view?id=' . $order_item['id'] ?>">Xem</a></td>
										</tr>
									 <?php 
									}
									?>


								</tbody>
							</table>
						</div><!--//table-responsive-->

					</div><!--//app-card-body-->
				</div><!--//app-card-->
				 <?php 
				// echo '<pre>';
				// print_r($maxPage);
				// echo '</pre>';
				$next = $page + 1;
				$pre = $page - 1;
				?>
				<nav class="app-pagination">
					<ul class="pagination justify-content-center">
						<li class="page-item  <?php 
												if ($page == 1) {
													echo 'disabled';
												}
												?>">
							<a class="page-link" href=" <?php  echo _WEB_ROOT . '/admin/order/list?page=1' ?>" tabindex="-1" aria-disabled="true">Đầu</a>
						</li>
						<li class="page-item  <?php 
												if ($pre == 0) {
													echo 'disabled';
												}
												?>">
							<a class="page-link" href=" <?php  echo _WEB_ROOT . '/admin/order/list?page=' . $pre ?>" tabindex="-1" aria-disabled="true">Trước</a>
						</li>
						<li class="page-item active"><a class="page-link" href=" <?php  echo _WEB_ROOT . '/admin/order/list?page=' . $page ?>"> <?php  echo $page ?></a></li>
						<li class="page-item">
							<a class="page-link  <?php 
												if ($page == $maxPage) {
													echo 'disabled';
												}
												?>" href=" <?php  echo _WEB_ROOT . '/admin/order/list?page=' . $next ?>">Tiếp</a>
						</li>
						<li class="page-item">
							<a class="page-link  <?php 
												if ($page == $maxPage) {
													echo 'disabled';
												}
												?>" href=" <?php  echo _WEB_ROOT . '/admin/order/list?page=' . $maxPage ?>">Cuối</a>
						</li>
					</ul>
				</nav><!--//app-pagination-->

			</div><!--//tab-pane-->

			<div class="tab-pane fade" id="orders-paid" role="tabpanel" aria-labelledby="orders-paid-tab">
				<div class="app-card app-card-orders-table mb-5">
					<div class="app-card-body">
						<div class="table-responsive">
							<table class="table  mb-0 text-left">
								<thead>
									<tr>
										<th class="cell">Code</th>
										<th class="cell">Địa chỉ</th>
										<th class="cell">Họ và tên</th>
										<th class="cell">Ngày</th>
										<th class="cell">Trạng thái</th>
										<th class="cell">Giá</th>
										<th class="cell"></th>
									</tr>
								</thead>
								<tbody>
									 <?php 
									foreach ($data_order as $order_item) {
										if ($order_item['status'] == '4') {
									?>
											<tr>
												<td class="cell">{{$order_item['order_code']}}</td>
												<td class="cell"><span class="truncate">{{$order_item['address']}}</span></td>
												<td class="cell">{{$order_item['fullname']}}</td>
												<td class="cell"><span class="cell-data">16 Oct</span><span class="note">01:16 AM</span></td>
												<td class="cell">
													 <?php 
													echo '<span class="badge bg-success">Hoàn thành</span>';
													?>

												</td>
												<td class="cell"> <?php  echo number_format($order_item['total_price'], 0) . ' VND'; ?></td>
												<td class="cell"><a class="btn-sm app-btn-secondary" href=" <?php  echo _WEB_ROOT . '/admin/order/view?id=' . $order_item['id'] ?>">Xem</a></td>
											</tr>
									 <?php 
										} 
									}
									?>


								</tbody>
							</table>
						</div><!--//table-responsive-->
					</div><!--//app-card-body-->
				</div><!--//app-card-->
			</div><!--//tab-pane-->

			<div class="tab-pane fade" id="orders-pending" role="tabpanel" aria-labelledby="orders-pending-tab">
				<div class="app-card app-card-orders-table mb-5">
					<div class="app-card-body">
						<div class="table-responsive">
							<table class="table mb-0 text-left">
								<thead>
									<tr>
										<th class="cell">Code</th>
										<th class="cell">Địa chỉ</th>
										<th class="cell">Họ và tên</th>
										<th class="cell">Ngày</th>
										<th class="cell">Trạng thái</th>
										<th class="cell">Giá</th>
										<th class="cell"></th>
									</tr>
								</thead>
								<tbody>
									 <?php 
									foreach ($data_order as $order_item) {
										if ($order_item['status'] == '1' || $order_item['status'] == '2' || $order_item['status'] == '3') {
									?>
											<tr>
												<td class="cell">{{$order_item['order_code']}}</td>
												<td class="cell"><span class="truncate">{{$order_item['address']}}</span></td>
												<td class="cell">{{$order_item['fullname']}}</td>
												<td class="cell"><span class="cell-data">16 Oct</span><span class="note">01:16 AM</span></td>
												<td class="cell">
													 <?php 
													if ($order_item['status'] == '1') {
														echo '<span class="badge bg-info">Chờ xác nhận</span>';
													} elseif ($order_item['status'] == '2') {
														echo '<span class="badge bg-warning">Đang giao</span>';
													} elseif ($order_item['status'] == '3') {
														echo '<span class="badge bg-success">Giao thành công</span>';
													}
													?>

												</td>
												<td class="cell"> <?php  echo number_format($order_item['total_price'], 0) . ' VND'; ?></td>
												<td class="cell"><a class="btn-sm app-btn-secondary" href=" <?php  echo _WEB_ROOT . '/admin/order/view?id=' . $order_item['id'] ?>">Xem</a></td>
											</tr>
									 <?php 
										} 
									}
									?>


								</tbody>
							</table>
						</div><!--//table-responsive-->
					</div><!--//app-card-body-->
				</div><!--//app-card-->
			</div><!--//tab-pane-->
			<div class="tab-pane fade" id="orders-cancelled" role="tabpanel" aria-labelledby="orders-cancelled-tab">
				<div class="app-card app-card-orders-table mb-5">
					<div class="app-card-body">
						<div class="table-responsive">
							<table class="table mb-0 text-left">
								<thead>
									<tr>
										<th class="cell">Code</th>
										<th class="cell">Địa chỉ</th>
										<th class="cell">Họ và tên</th>
										<th class="cell">Ngày</th>
										<th class="cell">Trạng thái</th>
										<th class="cell">Giá</th>
										<th class="cell"></th>
									</tr>
								</thead>
								<tbody>
									 <?php 
									foreach ($data_order as $order_item) {
										if ($order_item['status'] == '0') {
									?>
											<tr>
												<td class="cell">{{$order_item['order_code']}}</td>
												<td class="cell"><span class="truncate">{{$order_item['address']}}</span></td>
												<td class="cell">{{$order_item['fullname']}}</td>
												<td class="cell"><span class="cell-data">16 Oct</span><span class="note">01:16 AM</span></td>
												<td class="cell">
													 <?php 
													echo '<span class="badge bg-danger">Hủy</span>';
													?>

												</td>
												<td class="cell"> <?php  echo number_format($order_item['total_price'], 0) . ' VND'; ?></td>
												<td class="cell"><a class="btn-sm app-btn-secondary" href=" <?php  echo _WEB_ROOT . '/admin/order/view?id=' . $order_item['id'] ?>">Xem</a></td>
											</tr>
									 <?php 
										}
									}
									?>


								</tbody>
							</table>
						</div><!--//table-responsive-->
					</div><!--//table-responsive-->
				</div><!--//app-card-body-->
			</div><!--//app-card-->
		</div><!--//tab-pane-->
	</div><!--//tab-content-->
</div><!--//container-fluid-->
</div><!--//app-content-->