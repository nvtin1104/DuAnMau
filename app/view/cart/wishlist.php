<div class="breadcrumb-section breadcrumb-bg-color--golden">
    <div class="breadcrumb-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h3 class="breadcrumb-title">Danh sách yêu thích</h3>
                    </h3>
                    <div class="breadcrumb-nav breadcrumb-nav-color--black breadcrumb-nav-hover-color--golden">
                        <nav aria-label="breadcrumb">
                            <ul>
                                <li><a href="index.html">Trang chủ</a></li>
                                <li><a href="shop-grid-sidebar-left.html">Sản phẩm</a></li>
                                <li class="active" aria-current="page">Danh sách yêu thích</li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> <!-- ...:::: End Breadcrumb Section:::... -->

<!-- ...:::: Start Wishlist Section:::... -->
 <?php 
if (!empty($wishlist)) { ?>
    <div class="wishlist-section">
        <!-- Start Cart Table -->
        <div class="wishlish-table-wrapper" data-aos="fade-up" data-aos-delay="0">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="table_desc">
                            <div class="table_page table-responsive">
                                <table>
                                    <!-- Start Wishlist Table Head -->
                                    <thead>
                                        <tr>
                                            <th class="product_remove">Hàng động</th>
                                            <th class="product_thumb">Hình ảnh</th>
                                            <th class="product_name">Tên sản phẩm</th>
                                            <th class="product-price">Giá</th>
                                            <th class="product_addcart">Hành động</th>
                                        </tr>
                                    </thead> <!-- End Cart Table Head -->
                                    <tbody>
                                         <?php 
                                        foreach ($wishlist as $item) {
                                        ?>
                                            <tr>
                                                <td class="product_remove">
                                                    <a class=" removeWishlist" data-path=" <?php  echo _WEB_ROOT ?>" data-id=" <?php  echo $item['id'] ?>"><i class="fa fa-trash-o"></button>
                                                </td>
                                                <td class="product_thumb"><a href="product-details-default.html"><img src=" <?php  echo _WEB_ROOT . $item['imgDir'] ?>" alt=""></a></td>
                                                <td class="product_name"><a href="product-details-default.html"> <?php  echo $item['product_name'] ?></a></td>
                                                <td class="product-price"> <?php  echo $item['price'] ?></td>
                                                <td class="product_addcart"><a class="btn btn-md btn-golden addToCart" data-path=" <?php  echo _WEB_ROOT ?>" data-id=" <?php  echo $item['product_id'] ?>">Thêm giỏ hàng</a></td>
                                            </tr>
                                         <?php  } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
 <?php  } else {
?><div class="empty-cart-section section-fluid">
        <div class="emptycart-wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-md-10 offset-md-1 col-xl-6 offset-xl-3">
                        <div class="emptycart-content text-center">
                            <div class="image">
                                <img class="img-fluid" src=" <?php  echo _WEB_ROOT ?>/public/assets/client/images/emprt-cart/empty-cart.png" alt="">
                            </div>
                            <h4 class="title">Danh sách yêu thích của bạn trống trơn</h4>
                            <h6 class="sub-title">Xin lỗi bạn đời... Không tìm thấy mặt hàng nào trong danh sách yêu thích  của bạn!</h6>
                            <a href="shop-grid-sidebar-left.html" class="btn btn-lg btn-golden">Tiếp tục mua sắm</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> <?php 
        }
            ?>