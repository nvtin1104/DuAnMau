<div class="app-content pt-3 p-md-3 p-lg-4">
    <div class="container-xl">
        <h1 class="app-page-title">Hủy đơn hàng</h1>
        <hr class="mb-4">
        <div class="row g-4 settings-section">
            <div class="col-12 col-md-4">
                <h3 class="section-title">Mã đơn: <span>{{$infor_order['order_code']}}</span></h3>
                <div class="section-intro">
                    <?php if (!empty($mess)) {
                        echo '<span style="color:green;">' . $mess . '</span>';
                    } ?>
                    <br>
                    Ngày tạo: <span>{{$infor_order['create_at']}}</span>
                    <br>
                    Tổng tiền: <span><?php echo number_format($infor_order['total_price'], 0) . ' VND'; ?></span>
                    <br>
                    Trạng thái: <?php
                                if ($infor_order['status'] == '1') {
                                    echo '<span class="badge bg-info">Chờ xác nhận</span>';
                                } elseif ($infor_order['status'] == '2') {
                                    echo '<span class="badge bg-warning">Đang giao</span>';
                                } elseif ($infor_order['status'] == '3') {
                                    echo '<span class="badge bg-success">Giao thành công</span>';
                                } elseif ($infor_order['status'] == '4') {
                                    echo '<span class="badge bg-success">Hoàn thành</span>';
                                } elseif ($infor_order['status'] == '0') {
                                    echo '<span class="badge bg-danger">Hủy</span>';
                                }
                                ?>
                    <br>

                    Ghi chú: <span>{{$infor_order['note']}}</span>
                </div>
            </div>
            <div class="col-12 col-md-8">
                <div class="app-card app-card-settings shadow-sm p-4">

                    <div class="app-card-body">
                        <form class="settings-form" action="<?php echo _WEB_ROOT . '/admin/order/handleCancelOrder' ?>" method="post">
                            <div class="mb-3">
                                <label for="setting-input-1" class="form-label">Lí do hủy:<span class="ms-2" data-bs-container="body" data-bs-toggle="popover" data-bs-trigger="hover focus" data-bs-placement="top" data-bs-content="This is a Bootstrap popover example. You can use popover to provide extra info."><svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-info-circle" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                            <path d="M8.93 6.588l-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588z" />
                                            <circle cx="8" cy="4.5" r="1" />
                                        </svg></span></label>
                                <input type="text" class="form-control" name="reason" id="setting-input-1">
                                <?php echo form_error('reason', '<span style="color:red;">', '</span>'); ?>
                                <input type="hidden" name="order_id" value="<?php echo $infor_order['id'] ?>">
                                <input type="hidden" name="agent" value="admin">

                            </div>
                            <button type="submit" class="btn app-btn-primary">Lưu Thay Đổi</button>
                        </form>
                    </div><!--//app-card-body-->

                </div><!--//app-card-->
            </div>
        </div><!--//row-->
    </div><!--//container-fluid-->
</div><!--//app-content-->