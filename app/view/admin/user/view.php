<div class="app-content pt-3 p-md-3 p-lg-4">
    <div class="container-xl">
        <h1 class="app-page-title">Thông tin người dùng</h1>
        <hr class="mb-4">
        <div class="row g-4 settings-section">
            <div class="col-12 col-md-4">
                <h3 class="section-title">Tên đăng nhập: <span>{{$data_user['username']}}</span></h3>
                <br>
                <?php if (!empty($success)) {
                    echo '<span style="color:green;">' . $success . '</span>';
                } 
                if (!empty($error)) {
                    echo '<span style="color:red;">' . $error . '</span>';
                } 
                ?>
                <div class="section-intro">
                    <?php if (!empty($mess)) {
                        echo '<span style="color:green;">' . $mess . '</span>';
                    } ?>
                    <br>
                    Ngày tạo: <span>{{$data_user['create_at']}}</span>
                    <br>
                    Email: <span>{{$data_user['email']}}</span>
                    <br>
                    Họ và tên: <span>{{$data_user['fullname']}}</span>
                    <br>
                    Trạng thái: <?php
                                if ($data_user['status'] == 'active') {
                                    echo '<span class="badge bg-success">Hoạt động</span>';
                                } elseif ($data_user['status'] == 'ban') {
                                    echo '<span class="badge bg-danger">Bị cấm</span>';
                                }
                                ?>
                    <br>
                    Vai trò: <span><?php
                                    if ($data_user['role'] == 'admin') {
                                        echo '<span class="badge bg-success">Quản lý</span>';
                                    } elseif ($data_user['role'] == 'user') {
                                        echo '<span class="badge bg-success">Người dùng</span>';
                                    }
                                    ?></span>
                    <br>
                    <?php
                    if ($data_user['status'] == 'active') {
                        echo '<a  href=' . _WEB_ROOT . '/admin/account/handleUpdattUser?status=ban&id=' . $data_user['id'] . ' class="btn app-btn-danger mt-5">Cấm</a>';
                    } elseif ($data_user['status'] == 'ban') {
                        echo '<a  href=' . _WEB_ROOT . '/admin/account/handleUpdattUser?status=active&id=' . $data_user['id'] . ' class="btn app-btn-primary mt-5">Kích Hoạt</a>';
                    }
                    if ($data_user['role'] == 'user') {
                        echo '<a  href=' . _WEB_ROOT . '/admin/account/handleUpdattUser?role=admin&id=' . $data_user['id'] . ' style="margin-left: 16px;" class="btn app-btn-infor mt-5">Kích Hoạt Quyền Admin</a>';
                    } elseif ($data_user['role'] == 'admin') {
                        echo '<a  href=' . _WEB_ROOT . '/admin/account/handleUpdattUser?role=user&id=' . $data_user['id'] . ' style="margin-left: 16px;" class="btn app-btn-danger mt-5">Gỡ Quyền</a>';
                    }
                    ?>
                </div>
            </div>
            <div class="col-12 col-md-8">

                <div class="app-card app-card-settings shadow-sm p-4">
                    <div class="app-card-body">
                        <!-- <form class="settings-form"> -->
                        <div class="row g-4 mb-4">
                            <div class="col-6 col-lg-4">
                                <div class="app-card app-card-stat shadow-sm h-100">
                                    <div class="app-card-body p-3 p-lg-4">
                                        <h4 class="stats-type mb-1">Chi tiêu</h4>
                                       
                                        <div class="stats-figure"><?php  echo number_format($total_order, 0) . ' VND'; ?></div>
                                        <!-- <div class="stats-meta text-success">
                                            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-arrow-up" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" d="M8 15a.5.5 0 0 0 .5-.5V2.707l3.146 3.147a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 1 0 .708.708L7.5 2.707V14.5a.5.5 0 0 0 .5.5z" />
                                            </svg> 20%
                                        </div> -->
                                    </div><!--//app-card-body-->
                                    <a class="app-card-link-mask" href="#"></a>
                                </div><!--//app-card-->
                            </div><!--//col-->

                            <div class="col-6 col-lg-4">
                                <div class="app-card app-card-stat shadow-sm h-100">
                                    <div class="app-card-body p-3 p-lg-4">
                                        <h4 class="stats-type mb-1">Đơn hàng</h4>
                                        <div class="stats-figure"><?php echo $quatity_order; ?></div>
                                        <div class="stats-meta text-success">
                                            <!-- <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-arrow-down" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" d="M8 1a.5.5 0 0 1 .5.5v11.793l3.146-3.147a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 .708-.708L7.5 13.293V1.5A.5.5 0 0 1 8 1z" />
                                            </svg> 5% -->
                                        </div>
                                    </div><!--//app-card-body-->
                                    <a class="app-card-link-mask" href="#"></a>
                                </div><!--//app-card-->
                            </div><!--//col-->
                            <div class="col-12 col-lg-4">
                                <div class="app-card app-card-stat shadow-sm h-100">
                                    <div class="app-card-body p-3 p-lg-4">
                                        <h4 class="stats-type mb-1">Thời Gian Tài Khoản</h4>
                                        <div class="stats-figure"><?php echo $exp_account; ?></div>
                                    </div><!--//app-card-body-->
                                    <a class="app-card-link-mask" href="#"></a>
                                </div><!--//app-card-->
                            </div><!--//col-->
                        </div>
                        <!-- </form> -->
                    </div><!--//app-card-body-->

                </div><!--//app-card-->
            </div>
        </div><!--//row-->
    </div><!--//container-fluid-->
</div><!--//app-content-->