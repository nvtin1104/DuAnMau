<div class="breadcrumb-section breadcrumb-bg-color--golden">
    <div class="breadcrumb-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h3 class="breadcrumb-title">Quản lý đơn hàng</h3>
                    <div class="breadcrumb-nav breadcrumb-nav-color--black breadcrumb-nav-hover-color--golden">
                        <nav aria-label="breadcrumb">
                            <ul>
                                <li><a href="index.html">Trang chủ</a></li>
                                <li><a href="shop-grid-sidebar-left.html">Quản lý tài khoản</a></li>
                                <li class="active" aria-current="page">Đơn hàng</li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="wishlist-section mb-5">

    <!-- Start Cart Table -->
    <div class="wishlish-table-wrapper" data-aos="fade-up" data-aos-delay="0">
        <div class="container">
            <div class="row">
                <!-- User Quick Action Form -->
                <div class="col-12">
                    <div class="user-actions accordion" data-aos="fade-up" data-aos-delay="0">
                        <div id="checkout_login" class="collapse" data-parent="#checkout_login">
                            <div class="checkout_info">
                                <p>Vui lòng cung cấp đầy đủ lý do hủy đơn</p>
                                <form>
                                    <div class="form_group default-form-box">
                                        <label>Lý do hủy đơn <span>*</span></label>
                                        <input type="text" name="reason" id="reason">
                                    </div>
                                    <input type="hidden" name="order_id" id="order_id" value="<?php echo $data_order['id'] ?>">
                                    <input type="hidden" name="agent" id="agent" value="user">
                                    <input id="path" type="hidden" name="path" value="<?php echo _WEB_ROOT ?>">
                                    <div class="form_group group_3 default-form-box">
                                        <button class="btn btn-md btn-black-default-hover" id="cancelOrder">Gửi</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- User Quick Action Form -->
            </div>
            <div class="row">

                <div class="col-12">
                    <div class="table_desc">
                        <div class="table_page table-responsive">
                            <table>
                                <!-- Start Wishlist Table Head -->
                                <thead>
                                    <tr>
                                        <th class="product_thumb">Hành động</th>
                                        <th class="product_thumb">Mã đơn hàng</th>
                                        <th class="product-price">Ngày tạo</th>
                                        <th class="product_name">Trạng thái</th>
                                        <th class="product_name">Thông báo</th>

                                    </tr>
                                </thead> <!-- End Cart Table Head -->
                                <tbody>
                                    <tr>
                                        <td class="product_remove">
                                            <?php
                                            if ($data_order['status'] ==  1) { ?>
                                                <a id="cancelOrder" data-path="<?php echo _WEB_ROOT ?>" data-id="<?php echo $item['id'] ?>" data-bs-toggle="collapse" data-bs-target="#checkout_login" aria-expanded="true"><i class="fa fa-trash-o"></button>
                                                    <?php
                                                } elseif ($data_order['status'] ==  2) {
                                                    ?>
                                                        <a class="btn btn-md btn-golden " href="<?php echo _WEB_ROOT . '/cart/handleCfShip?id=' . $data_order['id'] ?>">Đã nhận hàng!</a>
                                                    <?php
                                                } elseif ($data_order['status'] ==  4) {
                                                    ?>
                                                        <a class="btn btn-md btn-golden addToCart" data-path="<?php echo _WEB_ROOT ?>" data-id="<?php echo $item['product_id'] ?>">Đánh giá!</a>
                                                    <?php
                                                }  ?>
                                        </td>
                                        <td class="product_thumb">{{$data_order['order_code']}}</td>
                                        <td class="product_name">{{$data_order['create_at']}}</td>
                                        <td class="product-price"><?php if ($data_order['status'] ==  1) {
                                                                        echo 'Chờ xác nhận';
                                                                    } elseif ($data_order['status'] ==  2) {
                                                                        echo 'Đang giao';
                                                                    } elseif ($data_order['status'] ==  3) {
                                                                        echo 'Đã Nhận Hàng';
                                                                    } elseif ($data_order['status'] ==  4) {
                                                                        echo 'Hoàn thành';
                                                                    } elseif ($data_order['status'] ==  0) {
                                                                        echo 'Hủy';
                                                                    } ?></td>
                                        <td class="product_name"> <?php
                                                                    if (!empty($mess)) {
                                                                        echo '<span class="float-left" style="color:green;">' . $mess . '</span>';
                                                                    }
                                                                    ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="checkout-section">
    <div class="container">
        <!-- Start User Details Checkout Form -->
        <div class="checkout_form" data-aos="fade-up" data-aos-delay="400">
            <form>
                <div class="row">
                    <div class="col-lg-6 col-md-6">
                        <h3>Thông tin nhận hàng</h3>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="default-form-box">
                                    <label>Tên đăng nhập <span>*</span></label>
                                    <input type="text" disabled name='username' value="<?php echo  $user_infor['username'] ?>">
                                    <input type="hidden" id="path" value="<?php echo _WEB_ROOT ?>">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="default-form-box">
                                    <label>Số điện thoại <span>*</span></label>
                                    <input type="text" name='phone' id='phone' value="<?php echo  $data_order['phone'] ?>">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="default-form-box">
                                    <label>Họ và Tên</label>
                                    <input type="text" id="fullname" name="fullname" value="<?php echo  $data_order['fullname'] ?>">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="default-form-box">
                                    <label for="country">Tỉnh/Thành Phố <span>*</span></label>
                                    <select class="country_option nice-select wide" name="country" id="country">
                                        <option value="An Giang">An Giang</option>
                                        <option value="Bà Rịa - Vũng Tàu">Bà Rịa - Vũng Tàu</option>
                                        <option value="Bắc Giang">Bắc Giang</option>
                                        <option value="Bắc Kạn">Bắc Kạn</option>
                                        <option value="Bạc Liêu">Bạc Liêu</option>
                                        <option value="Bắc Ninh">Bắc Ninh</option>
                                        <option value="Bến Tre">Bến Tre</option>
                                        <option value="Bình Định">Bình Định</option>
                                        <option value="Bình Dương">Bình Dương</option>
                                        <option value="Bình Phước">Bình Phước</option>
                                        <option value="Bình Thuận">Bình Thuận</option>
                                        <option value="Cà Mau">Cà Mau</option>
                                        <option value="Cần Thơ">Cần Thơ</option>
                                        <option value="Cao Bằng">Cao Bằng</option>
                                        <option value="Đà Nẵng">Đà Nẵng</option>
                                        <option value="Đắk Lắk">Đắk Lắk</option>
                                        <option value="Đắk Nông">Đắk Nông</option>
                                        <option value="Điện Biên">Điện Biên</option>
                                        <option value="Đồng Nai">Đồng Nai</option>
                                        <option value="Đồng Tháp">Đồng Tháp</option>
                                        <option value="Gia Lai">Gia Lai</option>
                                        <option value="Hà Giang">Hà Giang</option>
                                        <option value="Hà Nam">Hà Nam</option>
                                        <option value="Hà Nội">Hà Nội</option>
                                        <option value="Hà Tĩnh">Hà Tĩnh</option>
                                        <option value="Hải Dương">Hải Dương</option>
                                        <option value="Hải Phòng">Hải Phòng</option>
                                        <option value="Hậu Giang">Hậu Giang</option>
                                        <option value="Hòa Bình">Hòa Bình</option>
                                        <option value="Hồ Chí Minh">Hồ Chí Minh</option>
                                        <option value="Hưng Yên">Hưng Yên</option>
                                        <option value="Khánh Hòa">Khánh Hòa</option>
                                        <option value="Kiên Giang">Kiên Giang</option>
                                        <option value="Kon Tum">Kon Tum</option>
                                        <option value="Lai Châu">Lai Châu</option>
                                        <option value="Lâm Đồng">Lâm Đồng</option>
                                        <option value="Lạng Sơn">Lạng Sơn</option>
                                        <option value="Lào Cai">Lào Cai</option>
                                        <option value="Long An">Long An</option>
                                        <option value="Nam Định">Nam Định</option>
                                        <option value="Nghệ An">Nghệ An</option>
                                        <option value="Ninh Bình">Ninh Bình</option>
                                        <option value="Ninh Thuận">Ninh Thuận</option>
                                        <option value="Phú Thọ">Phú Thọ</option>
                                        <option value="Phú Yên">Phú Yên</option>
                                        <option value="Quảng Bình">Quảng Bình</option>
                                        <option value="Quảng Nam">Quảng Nam</option>
                                        <option value="Quảng Ngãi">Quảng Ngãi</option>
                                        <option value="Quảng Ninh">Quảng Ninh</option>
                                        <option value="Quảng Trị">Quảng Trị</option>
                                        <option value="Sóc Trăng">Sóc Trăng</option>
                                        <option value="Sơn La">Sơn La</option>
                                        <option value="Tây Ninh">Tây Ninh</option>
                                        <option value="Thái Bình">Thái Bình</option>
                                        <option value="Thái Nguyên">Thái Nguyên</option>
                                        <option value="Thanh Hóa">Thanh Hóa</option>
                                        <option value="Thừa Thiên Huế">Thừa Thiên Huế</option>
                                        <option value="Tiền Giang">Tiền Giang</option>
                                        <option value="Trà Vinh">Trà Vinh</option>
                                        <option value="Tuyên Quang">Tuyên Quang</option>
                                        <option value="Vĩnh Long">Vĩnh Long</option>
                                        <option value="Vĩnh Phúc">Vĩnh Phúc</option>
                                        <option value="Yên Bái">Yên Bái</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="default-form-box">
                                    <label>Địa chỉ chi tiết <span>*</span></label>
                                    <input placeholder="Địa chỉ chi tiết" type="text" name="address" id="address" value="<?php echo $data_order['address'] ?>">
                                </div>
                            </div>



                            <div class="col-lg-6">
                                <div class="default-form-box">
                                    <label> Email <span>*</span></label>
                                    <input type="email" name="email" id="email" value="<?php echo  $data_order['email'] ?>">
                                </div>
                            </div>
                            <div class="col-12 mt-3">
                                <div class="order-notes">
                                    <label for="order_note">Ghi chú:</label>
                                    <textarea id="order_note" name="note" placeholder="Ghi chú về đơn đặt hàng của bạn, để lại lời nhắn cho người giao hàng."><?php echo $data_order['note']; ?></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">

                        <h3>Đơn hàng của bạn</h3>
                        <div class="order_table table-responsive">
                            <table>
                                <thead>
                                    <tr>
                                        <th>Sản phẩm</th>
                                        <th>Thành tiền</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?
                                    foreach ($list_order as $item) {
                                    ?>
                                        <tr>
                                            <input type="hidden" name="cart_id[]" class="cart_id" value="{{$item['id']}}">
                                            <td> {{$item['product_name']}} <strong> × {{$item['quantity']}}</strong></td>
                                            <td> <?php echo number_format($item['total_price'], 0) . ' VND'; ?></td>
                                        </tr>
                                    <?
                                    }
                                    ?>

                                </tbody>

                                <tfoot>
                                    <tr>
                                        <th>Phí</th>
                                        <td><strong><?php echo number_format(10000, 0) . ' VND'; ?></strong></td>
                                    </tr>
                                    <tr class="order_total">
                                        <th>Tổng giá:</th>
                                        <input type="hidden" id="total_price" name="total_price" value="{{$total_price + 10000}}">
                                        <td><strong><?php echo number_format($data_order['total_price'], 0) . ' VND'; ?></strong></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>

                        <div class="payment_method">
                            <div class="col-12">
                                <div class="default-form-box mb-2">
                                    <label for="payment">Hình thức thanh toán: </label>
                                    <select class="payment_option nice-select wide" name="payment" id="payment">
                                        <option value="1">Tiền mặt</option>
                                        <option value="2">Chuyển khoản</option>
                                    </select>
                                </div>
                            </div>
                            <?php
                            if ($data_order['status'] == 1) {
                            ?>
                                <div class="order_button mt-3">
                                    <button class="btn btn-md btn-black-default-hover mt-3" id="goCheckout" type="submit">Thanh toán</button>
                                </div>
                            <?php
                            }
                            ?>
                        </div>
            </form>
        </div>
    </div>
</div> <!-- Start User Details Checkout Form -->
</div>
</div>