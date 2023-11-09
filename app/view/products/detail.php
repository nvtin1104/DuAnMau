<div class="breadcrumb-section breadcrumb-bg-color--golden">
    <div class="breadcrumb-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h3 class="breadcrumb-title">Chi tiết sản phẩm</h3>
                    <div class="breadcrumb-nav breadcrumb-nav-color--black breadcrumb-nav-hover-color--golden">
                        <nav aria-label="breadcrumb">
                            <ul>
                                <li><a href="index.html">Trang chủ</a></li>
                                <li><a href="shop-grid-sidebar-left.html">Sản phẩm</a></li>
                                <li class="active" aria-current="page"><?php  echo $product_infor['product_name'] ?></li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> <!-- ...:::: End Breadcrumb Section:::... -->

<!-- Start Product Details Section -->
<?php 
if (!empty($product_infor)) {
    foreach ($product_img as $itemImg) {
        $filePath = $itemImg['img_dir'];
        $imgDir = substr($filePath, 1);
        $imgArr[] =    $imgDir;
    }
?>
    <div class="product-details-section">
        <div class="container">
            <div class="row">
                <div class="col-xl-5 col-lg-6">
                    <div class="product-details-gallery-area" data-aos="fade-up" data-aos-delay="0">
                        <!-- Start Large Image -->
                        <div class="product-large-image product-large-image-horaizontal swiper-container">
                            <div class="swiper-wrapper">
                                <?php 
                                foreach ($imgArr as $value) {
                                    // var_dump($value);
                                ?>
                                    <div class="product-image-large-image swiper-slide zoom-image-hover img-responsive">
                                        <img src="<?php  echo _WEB_ROOT . $value ?>" alt="">
                                    </div>
                                <?php  }
                                ?>
                            </div>
                        </div>
                        <!-- Start Thumbnail Image -->
                        <div class="product-image-thumb product-image-thumb-horizontal swiper-container pos-relative mt-5">
                            <div class="swiper-wrapper">
                                <?php 
                                foreach ($imgArr as $value) {
                                    // var_dump($value);
                                ?>
                                    <div class="product-image-thumb-single swiper-slide">
                                        <img class="img-fluid" src="<?php  echo _WEB_ROOT . $value ?>" alt="">
                                    </div>
                                <?php  }
                                ?>
                            </div>
                            <!-- Add Arrows -->
                            <div class="gallery-thumb-arrow swiper-button-next"></div>
                            <div class="gallery-thumb-arrow swiper-button-prev"></div>
                        </div>
                        <!-- End Thumbnail Image -->
                    </div>
                </div>
                <div class="col-xl-7 col-lg-6">
                    <div class="product-details-content-area product-details--golden" data-aos="fade-up" data-aos-delay="200">
                        <!-- Start  Product Details Text Area-->
                        <div class="product-details-text">
                            <h4 class="title"><?php  echo $product_infor['product_name'] ?></h4>
                            <div class="d-flex align-items-center">
                                <ul class="review-star">
                                    <li class="fill"><i class="ion-android-star"></i></li>
                                    <li class="fill"><i class="ion-android-star"></i></li>
                                    <li class="fill"><i class="ion-android-star"></i></li>
                                    <li class="fill"><i class="ion-android-star"></i></li>
                                    <li class="empty"><i class="ion-android-star"></i></li>
                                </ul>
                                <a href="#" class="customer-review ml-2">(Đánh giá)</a>
                            </div>
                            <div class="price"><?php  echo number_format($product_infor['price'], 0) . ' VND'; ?></div>
                            <p><?php  echo $product_infor['short_description'] ?></p>
                        </div> <!-- End  Product Details Text Area-->
                        <!-- Start Product Variable Area -->
                        <div class="product-details-variable">
                            <h4 class="title">Tùy chọn có sẵn:</h4>
                            <!-- Product Variable Single Item -->
                            <div class="variable-single-item">
                                <div class="product-stock"> <span class="product-stock-in"><i class="ion-checkmark-circled"></i></span> <?php  echo $product_infor['quantity']; ?> SẢN PHẨM</div>
                            </div>
                            <!-- Product Variable Single Item -->
                            <div class="d-flex align-items-center ">
                                <form>
                                    <div class="variable-single-item ">
                                        <span>Số lượng</span>
                                        <div class="product-variable-quantity">
                                            <input id="quantity" name="quantity" min="1" value="1" type="number">
                                        </div>
                                    </div>
                                    <input id="product_id" type="hidden" name="product_id" value="<?php  echo $product_infor['id'] ?>">
                                    <input id="path" type="hidden" name="path" value="<?php  echo _WEB_ROOT ?>">
                                    <div class="product-add-to-cart-btn">
                                        <button class="btn btn-block btn-lg btn-black-default-hover" id="addToCart">+ Thêm vào giỏ hàng</button>

                                        <!-- <a href="#" class="btn btn-block btn-lg btn-black-default-hover" data-bs-toggle="modal" data-bs-target="#modalAddcart">+ Thêm vào giỏ hàng</a> -->
                                    </div>
                                </form>
                            </div>
                            <!-- Start  Product Details Meta Area-->
                            <div class="product-details-meta mb-20">
                                <span><label for="addToWishlist"><i class="fa-regular fa-heart"></i></label></span><button class="addToWishlist" id="addToWishlist" data-path="<?php  echo _WEB_ROOT ?>" data-id="<?php  echo $product_infor['id'] ?>">Thêm vào yêu thích</button>
                            </div> <!-- End  Product Details Meta Area-->
                        </div> <!-- End Product Variable Area -->

                        <!-- Start  Product Details Catagories Area-->
                        <div class="product-details-catagory mb-2">
                            <span class="title">Nhãn:</span>
                            <ul>
                                <li><a href="#">BAR STOOL</a></li>
                                <li><a href="#">KITCHEN UTENSILS</a></li>
                                <li><a href="#">TENNIS</a></li>
                            </ul>
                        </div> <!-- End  Product Details Catagories Area-->
                        <!-- Start  Product Details Social Area-->
                        <div class="product-details-social">
                            <span class="title">Chia sẻ:</span>
                            <ul>
                                <li><a href="#"><i class="fa-brands fa-facebook"></i></a></li>
                                <li><a href="#"><i class="fa-brands  fa-twitter"></i></a></li>
                                <li><a href="#"><i class="fa-brands  fa-pinterest"></i></a></li>
                                <li><a href="#"><i class="fa-brands  fa-google-plus"></i></a></li>
                                <li><a href="#"><i class="fa-brands  fa-linkedin"></i></a></li>
                            </ul>
                        </div> <!-- End  Product Details Social Area-->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="product-details-content-tab-section section-top-gap-100">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="product-details-content-tab-wrapper" data-aos="fade-up" data-aos-delay="0">

                        <!-- Start Product Details Tab Button -->
                        <ul class="nav tablist product-details-content-tab-btn d-flex justify-content-center">
                            <li><a class="nav-link active" data-bs-toggle="tab" href="#description">
                                    Mô tả
                                </a></li>
                            <li><a class="nav-link" data-bs-toggle="tab" href="#specification">
                                    Chi tiết
                                </a></li>
                            <li><a class="nav-link" data-bs-toggle="tab" href="#review">
                                    Nhận xét
                                </a></li>
                        </ul> <!-- End Product Details Tab Button -->

                        <!-- Start Product Details Tab Content -->
                        <div class="product-details-content-tab">
                            <div class="tab-content">
                                <!-- Start Product Details Tab Content Singel -->
                                <div class="tab-pane active show" id="description">
                                    <div class="single-tab-content-item">
                                        <?php 
                                        echo $product_infor['description'];
                                        ?>
                                    </div>
                                </div> <!-- End Product Details Tab Content Singel -->
                                <!-- Start Product Details Tab Content Singel -->
                                <div class="tab-pane" id="specification">
                                    <div class="single-tab-content-item">
                                        <table class="table table-bordered mb-20">
                                            <tbody>
                                                <tr>
                                                    <th scope="row">Tác giả:</th>
                                                    <td> <?php 
                                                            echo $product_infor['author'];
                                                            ?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Nhà sản xuất:</th>
                                                    <td> <?php 
                                                            echo $product_infor['made_in'];
                                                            ?></td>
                                                <tr>
                                                    <th scope="row">Kiểu dáng:</th>
                                                    <td> <?php 
                                                            echo $product_infor['form'];
                                                            ?></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <p> <?php 
                                            echo $product_infor['specification'];
                                            ?></p>
                                    </div>
                                </div> <!-- End Product Details Tab Content Singel -->
                                <!-- Start Product Details Tab Content Singel -->
                                <div class="tab-pane" id="review">
                                    <div class="single-tab-content-item">
                                        <!-- Start - Review Comment -->
                                        <ul class="comment">
                                            <!-- Start - Review Comment list-->
                                            <li class="comment-list">
                                                <div class="comment-wrapper">
                                                    <div class="comment-img">
                                                        <img src="assets/images/user/image-1.png" alt="">
                                                    </div>
                                                    <div class="comment-content">
                                                        <div class="comment-content-top">
                                                            <div class="comment-content-left">
                                                                <h6 class="comment-name">Kaedyn Fraser</h6>
                                                                <ul class="review-star">
                                                                    <li class="fill"><i class="ion-android-star"></i>
                                                                    </li>
                                                                    <li class="fill"><i class="ion-android-star"></i>
                                                                    </li>
                                                                    <li class="fill"><i class="ion-android-star"></i>
                                                                    </li>
                                                                    <li class="fill"><i class="ion-android-star"></i>
                                                                    </li>
                                                                    <li class="empty"><i class="ion-android-star"></i>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                            <div class="comment-content-right">
                                                                <a href="#"><i class="fa fa-reply"></i>Reply</a>
                                                            </div>
                                                        </div>

                                                        <div class="para-content">
                                                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                                                                Tempora inventore dolorem a unde modi iste odio amet,
                                                                fugit fuga aliquam, voluptatem maiores animi dolor nulla
                                                                magnam ea! Dignissimos aspernatur cumque nam quod sint
                                                                provident modi alias culpa, inventore deserunt
                                                                accusantium amet earum soluta consequatur quasi eum eius
                                                                laboriosam, maiores praesentium explicabo enim dolores
                                                                quaerat! Voluptas ad ullam quia odio sint sunt. Ipsam
                                                                officia, saepe repellat. </p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- Start - Review Comment Reply-->
                                                <ul class="comment-reply">
                                                    <li class="comment-reply-list">
                                                        <div class="comment-wrapper">
                                                            <div class="comment-img">
                                                                <img src="assets/images/user/image-2.png" alt="">
                                                            </div>
                                                            <div class="comment-content">
                                                                <div class="comment-content-top">
                                                                    <div class="comment-content-left">
                                                                        <h6 class="comment-name">Oaklee Odom</h6>
                                                                    </div>
                                                                    <div class="comment-content-right">
                                                                        <a href="#"><i class="fa fa-reply"></i>Reply</a>
                                                                    </div>
                                                                </div>

                                                                <div class="para-content">
                                                                    <p>Lorem ipsum dolor sit amet, consectetur
                                                                        adipisicing elit. Tempora inventore dolorem a
                                                                        unde modi iste odio amet, fugit fuga aliquam,
                                                                        voluptatem maiores animi dolor nulla magnam ea!
                                                                        Dignissimos aspernatur cumque nam quod sint
                                                                        provident modi alias culpa, inventore deserunt
                                                                        accusantium amet earum soluta consequatur quasi
                                                                        eum eius laboriosam, maiores praesentium
                                                                        explicabo enim dolores quaerat! Voluptas ad
                                                                        ullam quia odio sint sunt. Ipsam officia, saepe
                                                                        repellat. </p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </li>
                                                </ul> <!-- End - Review Comment Reply-->
                                            </li> <!-- End - Review Comment list-->
                                            <!-- Start - Review Comment list-->
                                            <li class="comment-list">
                                                <div class="comment-wrapper">
                                                    <div class="comment-img">
                                                        <img src="assets/images/user/image-3.png" alt="">
                                                    </div>
                                                    <div class="comment-content">
                                                        <div class="comment-content-top">
                                                            <div class="comment-content-left">
                                                                <h6 class="comment-name">Jaydin Jones</h6>
                                                                <ul class="review-star">
                                                                    <li class="fill"><i class="ion-android-star"></i>
                                                                    </li>
                                                                    <li class="fill"><i class="ion-android-star"></i>
                                                                    </li>
                                                                    <li class="fill"><i class="ion-android-star"></i>
                                                                    </li>
                                                                    <li class="fill"><i class="ion-android-star"></i>
                                                                    </li>
                                                                    <li class="empty"><i class="ion-android-star"></i>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                            <div class="comment-content-right">
                                                                <a href="#"><i class="fa fa-reply"></i>Reply</a>
                                                            </div>
                                                        </div>

                                                        <div class="para-content">
                                                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                                                                Tempora inventore dolorem a unde modi iste odio amet,
                                                                fugit fuga aliquam, voluptatem maiores animi dolor nulla
                                                                magnam ea! Dignissimos aspernatur cumque nam quod sint
                                                                provident modi alias culpa, inventore deserunt
                                                                accusantium amet earum soluta consequatur quasi eum eius
                                                                laboriosam, maiores praesentium explicabo enim dolores
                                                                quaerat! Voluptas ad ullam quia odio sint sunt. Ipsam
                                                                officia, saepe repellat. </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li> <!-- End - Review Comment list-->
                                        </ul> <!-- End - Review Comment -->
                                        <div class="review-form">
                                            <div class="review-form-text-top">
                                                <h5>THÊM BÌNH LUẬN</h5>
                                                <p>Địa chỉ email của bạn sẽ không được công bố. Các trường bắt buộc được đánh dấu
                                                    *</p>
                                            </div>

                                            <form action="#" method="post">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="default-form-box">
                                                            <label for="comment-name">Tên của bận: <span>*</span></label>
                                                            <input id="comment-name" type="text" placeholder="Enter Tên của bận:" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="default-form-box">
                                                            <label for="comment-email">Email của bạn: <span>*</span></label>
                                                            <input id="comment-email" type="email" placeholder="Enter Email của bạn:" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="default-form-box">
                                                            <label for="comment-review-text">Đánh giá:
                                                                <span>*</span></label>
                                                            <textarea id="comment-review-text" placeholder="Write a review" required></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <button class="btn btn-md btn-black-default-hover" type="submit">Gửi</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div> <!-- End Product Details Tab Content Singel -->
                            </div>
                        </div> <!-- End Product Details Tab Content -->

                    </div>
                </div>
            </div>
        </div>
    </div>
<?php 
}
?>
<!-- End Product Details Section -->

<!-- Start Product Content Tab Section -->
<!-- End Product Content Tab Section -->

<!-- Start Product Default Slider Section -->
<div class="product-default-slider-section section-top-gap-100 section-fluid">
    <!-- Start Section Content Text Area -->
    <div class="section-title-wrapper" data-aos="fade-up" data-aos-delay="0">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-content-gap">
                        <div class="secton-content">
                            <h3 class="section-title">NHỮNG SẢM PHẨM TƯƠNG TỰ</h3>
                            <p>Duyệt qua bộ sưu tập các sản phẩm liên quan của chúng tôi.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Start Section Content Text Area -->
    <div class="product-wrapper" data-aos="fade-up" data-aos-delay="0">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="product-slider-default-1row default-slider-nav-arrow">
                        <!-- Slider main container -->
                        <div class="swiper-container product-default-slider-4grid-1row">
                            <!-- Additional required wrapper -->
                            <div class="swiper-wrapper">

                                <?php 
                                foreach ($product_releted as $item) {
                                    $imgArr = [];

                                    foreach ($item['imgList'] as $itemImg) {
                                        $filePath = $itemImg['img_dir'];
                                        $imgDir = substr($filePath, 1);
                                        $imgArr[] =    $imgDir;
                                    }
                                ?>
                                    <div class="product-default-single-item product-color--golden swiper-slide">
                                        <div class="image-box">
                                            <a href="<?php  echo _WEB_ROOT . '/product/detail?id=' . $item['id'] ?>" class="image-link">
                                                <img src="<?php  echo _WEB_ROOT . $imgArr[0] ?>" alt="">
                                                <img src="<?php  echo _WEB_ROOT . $imgArr[1] ?>" alt="">
                                            </a>
                                            <div class="tag">
                                                <span>sale</span>
                                            </div>
                                            <div class="action-link">
                                                <div class="action-link-left">
                                                    <a href="#" data-bs-toggle="modal" data-bs-target="#modalAddcart">Mua ngay</a>
                                                </div>
                                                <div class="action-link-right">
                                                    <button class="text-white addToWishlist" data-path="<?php  echo _WEB_ROOT ?>" data-id="<?php  echo $item['id'] ?>"><i class="icon-heart"></i></button>
                                                    <button class="text-white addToCart" data-path="<?php  echo _WEB_ROOT ?>" data-id="<?php  echo $item['id'] ?>"><i class="fa-solid fa-cart-shopping"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="content">
                                            <div class="content-left">
                                                <h6 class="title"><a href="product-details-default.html"><?php  echo strlen($item['product_name']) > 21 ? substr($item['product_name'], 0, 21) . ' ...' : $item['product_name']; ?></a></h6>
                                                <ul class="review-star">
                                                    <li class="fill"><i class="ion-android-star"></i></li>
                                                    <li class="fill"><i class="ion-android-star"></i></li>
                                                    <li class="fill"><i class="ion-android-star"></i></li>
                                                    <li class="fill"><i class="ion-android-star"></i></li>
                                                    <li class="empty"><i class="ion-android-star"></i></li>
                                                </ul>
                                            </div>
                                            <div class="content-right">
                                                <span class="price"><?php  echo number_format($item['price'], 0) . ' VND'; ?></span>
                                            </div>

                                        </div>
                                    </div>
                                <?php 
                                }
                                ?>
                            </div>
                        </div>
                        <!-- If we need navigation buttons -->
                        <div class="swiper-button-prev"></div>
                        <div class="swiper-button-next"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>