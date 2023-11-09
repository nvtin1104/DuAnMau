<div class="breadcrumb-section breadcrumb-bg-color--golden">
    <div class="breadcrumb-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h3 class="breadcrumb-title">Tài khoản của tôi</h3>
                    <div class="breadcrumb-nav breadcrumb-nav-color--black breadcrumb-nav-hover-color--golden">
                        <nav aria-label="breadcrumb">
                            <ul>
                                <li><a href="index.html">Trang chủ</a></li>
                                <li><a href="shop-grid-sidebar-left.html">Cửa hàng</a></li>
                                <li class="active" aria-current="page">Tài khoản của tôi
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> <!-- ...:::: End Breadcrumb Section:::... -->
<input type="hidden" id="path" value=" <?php  echo _WEB_ROOT ?>">

<!-- ...:::: Start Account Dashboard Section:::... -->
<div class="account-dashboard">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-md-3 col-lg-3">
                <!-- Nav tabs -->
                <div class="dashboard_tab_button" data-aos="fade-up" data-aos-delay="0">
                    <ul role="tablist" class="nav flex-column dashboard-list">
                        <li><a href="#dashboard" data-bs-toggle="tab" class="nav-link btn btn-block btn-md btn-black-default-hover active">Bảng điều khiển</a>
                        </li>
                        <li> <a href="#orders" data-bs-toggle="tab" class="nav-link btn btn-block btn-md btn-black-default-hover">Đơn đặt hàng</a></li>
                        <li><a href="#downloads" data-bs-toggle="tab" class="nav-link btn btn-block btn-md btn-black-default-hover">Mã giảm giá</a></li>
                        <li><a href="#address" data-bs-toggle="tab" class="nav-link btn btn-block btn-md btn-black-default-hover">Địa chỉ</a></li>
                        <li><a href="#account-details" data-bs-toggle="tab" class="nav-link btn btn-block btn-md btn-black-default-hover">Chi tiết tài khoản</a>
                        </li>
                        <li><a href="auth/logout" class="nav-link btn btn-block btn-md btn-black-default-hover">Đăng xuất</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-sm-12 col-md-9 col-lg-9">
                <!-- Tab panes -->
                <div class="tab-content dashboard_content" data-aos="fade-up" data-aos-delay="200">
                    <div class="tab-pane fade show active" id="dashboard">
                        <h4>Bảng điều khiển </h4>
                        <p>Từ bảng điều khiển tài khoản của bạn. bạn có thể dễ dàng kiểm tra &amp; Xem <a href="#"> đơn hàng
                                gần đây</a>,quản lý của bạn <a href="#">địa chỉ giao hàng và thanh toán</a> và<a href="#">Chỉnh sửa mật khẩu và chi tiết tài khoản của bạn.</a></p>
                    </div>
                    <div class="tab-pane fade" id="orders">
                        <h4>Đơn hàng</h4>
                        <div class="table_page table-responsive">
                            <table>
                                <thead>
                                    <tr>
                                        <th>Đặt hàng</th>
                                        <th>Ngày</th>
                                        <th>Trạng thái</th>
                                        <th>Tổng cộng</th>
                                        <th>Hành động</th>
                                    </tr>
                                </thead>
                                <tbody>
                                     <?php  if (!empty($data_order)) :
                                        foreach ($data_order as $value) { ?>
                                            <tr>
                                                <td>{{$value['order_code']}}</td>
                                                <td>{{$value['create_at']}}</td>
                                                <td><span class="success"> <?php  if ($value['status'] ==  1) {
                                                                                echo 'Chờ xác nhận';
                                                                            } elseif ($value['status'] ==  2) {
                                                                                echo 'Đang giao';
                                                                            } elseif ($value['status'] ==  3) {
                                                                                echo 'Đã Nhận Hàng';
                                                                            } elseif ($value['status'] ==  4) {
                                                                                echo 'Hoàn thành';
                                                                            } elseif ($value['status'] ==  0) {
                                                                                echo 'Hủy';
                                                                            } ?></span></td>
                                                <td> <?php  echo number_format($value['total_price'], 0) . ' VND'; ?></td>
                                                <td><a href=" <?php  echo _WEB_ROOT . '/profile/view_order?id=' . $value['id'] ?>" class="view">Xem</a></td>
                                            </tr>
                                         <?php  }
                                    else : ?>
                                        <tr>
                                            <td colspan="5">Trống</td>
                                        </tr>
                                     <?php  endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="downloads">
                        <h4>Mã giảm giá</h4>
                        <div class="table_page table-responsive">
                            <table>
                                <thead>
                                    <tr>
                                        <th>Mã Code</th>
                                        <th>Tên Mã</th>
                                        <th>Điều kiện</th>
                                        <th>Hết hạn</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td colspan="4">Trống</td>
                                    </tr>
                                    <!-- <tr>
                                        <td>Kho sách miễn phí</td>
                                        <td>Ngày 8 tháng 10 năm 2023</td>
                                        <td><span class="danger">Hết hạn</span></td>
                                        <td><a href="#" class="view">Bấm vào đây để tải xuống tập tin của bạn</a></td>
                                    </tr>
                                    <tr>
                                        <td>Không phải trả tiền</td>
                                        <td>Ngày 11 tháng 9 năm 2022</td>
                                        <td>Không bao giờ</td>
                                        <td><a href="#" class="view">Bấm vào đây để tải xuống tập tin của bạn</a></td>
                                    </tr> -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane" id="address">
                        <h3>Thông tin tài khoản:</h3>
                        <div class="login">
                            <div class="login_form_container">
                                <div class="account_login_form">
                                     <?php 
                                    if (!empty($user_infor)) { ?>
                                        <form>
                                            <div class="default-form-box mb-20">
                                                <label>Địa chỉ:</label>
                                                <input type="text" id="addressValue" value=" <?php  echo $user_infor['address'] ?>" placeholder="Địa chỉ...">
                                            </div>
                                            <div class="default-form-box mb-20">
                                                <label>Số điện thoại:</label>
                                                <input type="text" id="phone" value=" <?php  echo $user_infor['phone'] ?>" placeholder="Số điện thoại..,">
                                            </div>
                                            <div class="default-form-box mb-20">
                                                <label>Create At:</label>
                                                <input type="text" name="create_at" id="create_at" disabled value=" <?php  echo $user_infor['create_at'] ?>">
                                            </div>
                                            <input type="hidden" name="id" id="user_id" value=" <?php  echo $user_infor['id'] ?>">
                                            <div class="save_button mt-3">
                                                <button class="btn btn-md btn-black-default-hover" id="editAddressBtn" type="submit">Lưu</button>
                                            </div>
                                        </form>
                                     <?php  } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="account-details">
                        <h3>Thông tin tài khoản:</h3>
                        <div class="login">
                            <div class="login_form_container">
                                <div class="account_login_form">
                                     <?php 
                                    if (!empty($user_infor)) { ?>
                                        <form>
                                            <div class="default-form-box mb-20">
                                                <label>Tên đăng nhập:</label>
                                                <input type="text" id="username" disabled value=" <?php  echo $user_infor['username'] ?>">
                                            </div>
                                            <div class="default-form-box mb-20">
                                                <label>Họ và tên:</label>
                                                <input type="text" id="fullname" name="fullname" value=" <?php  echo $user_infor['fullname'] ?>" placeholder="Họ và tên..,">
                                            </div>
                                            <div class="default-form-box mb-20">
                                                <label>Email</label>
                                                <input type="text" name="email" disabled value=" <?php  echo $user_infor['email'] ?>">
                                            </div>
                                            <div class="input-radio" id="sex">
                                                <span class="custom-radio"><input type="radio" value="Nam"  <?php  if ($user_infor['sex'] == "Nam") echo "checked"; ?> name="sex"> Mr.</span>
                                                <span class="custom-radio"><input type="radio" value="Nữ"  <?php  if ($user_infor['sex'] == "Nữ") echo "checked"; ?> name="sex"> Mrs.</span>
                                                <span class="custom-radio"><input type="radio" value="Khác"  <?php  if ($user_infor['sex'] == "Khác") echo "checked"; ?> name="sex"> Khác</span>
                                            </div>
                                            <div class="default-form-box mb-20">
                                                <label>Birthdate</label>
                                                <input type="date" name="birthday" id="birthday" value=" <?php  echo $user_infor['birthday'] ?>">
                                            </div>
                                            <div class="default-form-box mb-20">
                                                <label>Create At:</label>
                                                <input type="text" name="create_at" id="create_at" disabled value=" <?php  echo $user_infor['create_at'] ?>">
                                            </div>
                                            <input type="hidden" name="id" id="user_id" value=" <?php  echo $user_infor['id'] ?>">
                                            <div class="save_button mt-3">
                                                <button class="btn btn-md btn-black-default-hover" id="editBtn" type="submit">Lưu</button>
                                                <a href="profile/change_email?id= <?php  echo $user_infor['id'] ?>&email= <?php  echo $user_infor['email'] ?>" class="btn btn-md btn-black-default-hover">Thay đổi email</a>
                                                <a href="profile/change_password?id= <?php  echo $user_infor['id'] ?>" class="btn btn-md btn-black-default-hover">Thay đổi mật khẩu</a>
                                            </div>
                                        </form>
                                     <?php  } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>