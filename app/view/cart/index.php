<div class="breadcrumb-section breadcrumb-bg-color--golden">
    <div class="breadcrumb-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h3 class="breadcrumb-title">Giỏ hàng</h3>
                    <div class="breadcrumb-nav breadcrumb-nav-color--black breadcrumb-nav-hover-color--golden">
                        <nav aria-label="breadcrumb">
                            <ul>
                                <li><a href="index.html">Trang chủ</a></li>
                                <li><a href="shop-grid-sidebar-left.html">Sản phẩm</a></li>
                                <li class="active" aria-current="page">Giỏ hàng</li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> <!-- ...:::: End Breadcrumb Section:::... -->
<?php  if (!empty($cart)) { ?>
    <div class="cart-section">
        <div class="cart-table-wrapper" data-aos="fade-up" data-aos-delay="0">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="table_desc">
                            <form id="cartForm" method="post">
                                <div class="table_page table-responsive">
                                    <table>
                                        <thead>
                                            <tr>
                                                <th class="product_remove">Hàng động</th>
                                                <th class="product_thumb">Hình ảnh</th>
                                                <th class="product_name">Tên sản phẩm</th>
                                                <th class="product-price">Giá</th>
                                                <th class="product_quantity">Số lượng</th>
                                                <th class="product_total">Thanh tiền</th>
                                            </tr>
                                        </thead> <!-- End Cart Table Head -->
                                        <tbody>
                                            <?php 
                                            $sum = 0;
                                            foreach ($cart as $item) {
                                                $sum += $item['total_price'];
                                            ?>
                                                <tr>
                                                    <td class="product_remove">
                                                        <input type="checkbox" name="ids[]" value="<?php  echo $item['id'] ?>"><br>
                                                        <a class=" removeCart" data-path="<?php  echo _WEB_ROOT ?>" data-id="<?php  echo $item['id'] ?>"><i class="fa fa-trash-o"></button>
                                                    </td>
                                                    <td class="product_thumb"><a href="product-details-default.html"><img src="<?php  echo _WEB_ROOT . $item['imgDir'] ?>" alt=""></a></td>
                                                    <td class="product_name"><a href="product-details-default.html"><?php  echo $item['product_name'] ?></a></td>
                                                    <td class="product-price"><?php  echo $item['price'] ?></td>
                                                    <td class="product_quantity"><label>Số lượng</label> <input min="1" value="<?php  echo $item['quantity'] ?>" type="number">
                                                        <a class="updateCart" data-path="<?php  echo _WEB_ROOT ?>" data-product_id="<?php  echo $item['product_id'] ?>" data-id="<?php  echo $item['id'] ?>">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-arrow-up" viewBox="0 0 16 16">
                                                                <path d="M8 11a.5.5 0 0 0 .5-.5V6.707l1.146 1.147a.5.5 0 0 0 .708-.708l-2-2a.5.5 0 0 0-.708 0l-2 2a.5.5 0 1 0 .708.708L7.5 6.707V10.5a.5.5 0 0 0 .5.5z" />
                                                                <path d="M4 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H4zm0 1h8a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1z" />
                                                            </svg></button>
                                                    </td>
                                                    <td class="product_total"><?php  echo number_format($item['total_price'], 0) . ' VND'; ?></td>
                                                </tr>
                                            <?php 
                                            }
                                            ?>
                                        </tbody>
                                    </table>

                                </div>
                                <div class="cart_submit">
                                    <?php  if (!empty($error)) {
                                        echo '<span class="float-left" style="color:red;">' . $error . '</span>';
                                    }
                                    if (!empty($success)) {
                                        echo '<span class="float-left" style="color:green;">' . $success . '</span>';
                                    } ?>
                                    <button class="btn btn-md btn-golden" type="submit" formaction="<?php  echo _WEB_ROOT . '/cart/handleRemoveAll' ?>">Xóa Hết</button>
                                    <button class="btn btn-md btn-golden" type="submit" formaction="<?php  echo _WEB_ROOT . '/cart/handleRemoveArr' ?>">Xóa</button>
                                    <button id="btnCheckout" class="btn btn-md btn-golden d-none" type="submit" formaction="<?php  echo _WEB_ROOT . '/cart/checkout' ?>"></button>

                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- End Cart Table -->

        <!-- Start Coupon Start -->
        <div class="coupon_area">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-6">
                        <div class="coupon_code left" data-aos="fade-up" data-aos-delay="200">
                            <h3>Coupon</h3>
                            <div class="coupon_inner">
                                <p>Enter your coupon code if you have one.</p>
                                <input class="mb-2" placeholder="Coupon code" type="text">
                                <button type="submit" class="btn btn-md btn-golden">Apply coupon</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="coupon_code right" data-aos="fade-up" data-aos-delay="400">
                            <h3>Cart Totals</h3>
                            <div class="coupon_inner">
                                <div class="cart_subtotal">
                                    <p>Tổng tiền: </p>
                                    <p class="cart_amount"><?php  echo number_format($sum, 0) . ' VND'; ?></p>
                                </div>
                                <div class="cart_subtotal ">
                                    <p>Giao hàng:</p>
                                    <p class="cart_amount"><span>Tối thiểu:</span> 10.000 VND</p>
                                </div>
                                <!-- <a href="#">Calculate shipping</a> -->

                                <div class="cart_subtotal">
                                    <p>Thanh tiền:</p>
                                    <p class="cart_amount"><?php  echo number_format($sum + 10000, 0) . ' VND'; ?></p>
                                </div>
                                <div class="checkout_btn">
                                    <label for="btnCheckout" class="btn btn-md btn-golden">Đi tới thanh toán</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- End Coupon Start -->
    </div>
<?php  } else {
?><div class="empty-cart-section section-fluid">
        <div class="emptycart-wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-md-10 offset-md-1 col-xl-6 offset-xl-3">
                        <div class="emptycart-content text-center">
                            <div class="image">
                                <img class="img-fluid" src="<?php  echo _WEB_ROOT ?>/public/assets/client/images/emprt-cart/empty-cart.png" alt="">
                            </div>
                            <h4 class="title">Giỏ của bạn trống trơn</h4>
                            <h6 class="sub-title">Xin lỗi bạn đời... Không tìm thấy mặt hàng nào trong giỏ hàng của bạn!</h6>
                            <a href="shop-grid-sidebar-left.html" class="btn btn-lg btn-golden">Tiếp tục mua sắm</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div><?php 
        }
            ?>