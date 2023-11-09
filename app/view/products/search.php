<!-- Offcanvas Overlay -->
<div class="offcanvas-overlay"></div>

<!-- ...:::: Start Breadcrumb Section:::... -->
<div class="breadcrumb-section breadcrumb-bg-color--golden">
    <div class="breadcrumb-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h3 class="breadcrumb-title"> <?php echo $title ?></h3>
                    <div class="breadcrumb-nav breadcrumb-nav-color--black breadcrumb-nav-hover-color--golden">
                        <nav aria-label="breadcrumb">
                            <ul>
                                <li><a href=" <?php echo _WEB_ROOT ?>">Trang chủ</a></li>
                                <li class="active" aria-current="page"> <?php echo $title ?></li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- ...:::: Start Shop Section:::... -->
<div class="shop-section">
    <div class="container">
        <?php  if (!empty($products)) { ?>
            <div class="row flex-column-reverse flex-lg-row">
                <div class="col-lg-12">
                    <!-- Start Shop Product Sorting Section -->
                    <div class="shop-sort-section">
                        <div class="container">
                            <div class="row">
                                <!-- Start Sort Wrapper Box -->
                                <div class="sort-box d-flex justify-content-between align-items-md-center align-items-start flex-md-row flex-column" data-aos="fade-up" data-aos-delay="0">
                                    <!-- Start Sort tab Button -->
                                    <div class="sort-tablist d-flex align-items-center">
                                        <!-- Start Page Amount -->
                                        <div class="page-amount ml-2">
                                            <span>Tìm kiếm cho:  <?php  echo $value; ?></span>
                                        </div> <!-- End Page Amount -->
                                    </div> <!-- End Sort tab Button -->

                                    <!-- Start Sort Select Option -->
                                    <div class="sort-select-list d-flex align-items-center">
                                        <label class="mr-2">Sort By:</label>
                                        <form action="#">
                                            <fieldset>
                                                <select name="speed" id="speed">
                                                    <option>Sort by average rating</option>
                                                    <option>Sort by popularity</option>
                                                    <option selected="selected">Sort by newness</option>
                                                    <option>Sort by price: low to high</option>
                                                    <option>Sort by price: high to low</option>
                                                    <option>Product Name: Z</option>
                                                </select>
                                            </fieldset>
                                        </form>
                                    </div> <!-- End Sort Select Option -->



                                </div> <!-- Start Sort Wrapper Box -->
                            </div>
                        </div>
                    </div> <!-- End Section Content -->

                    <!-- Start Tab Wrapper -->
                    <div class="sort-product-tab-wrapper">
                        <div class="container">
                            <div class="row">
                                <div class="col-12">
                                    <div class="tab-content">
                                        <!-- Start Grid View Product -->
                                        <div class="tab-pane active show sort-layout-single" id="layout-4-grid">
                                            <div class="row">
                                                <?php
                                                foreach ($products as $item) { ?>
                                                    <div class="col-xl-3 col-sm-6 col-12">
                                                        <!-- Start Product Default Single Item -->
                                                        <div class="product-default-single-item product-color--golden" data-aos="fade-up" data-aos-delay="0">
                                                            <div class="image-box">
                                                                <a href=" <?php echo _WEB_ROOT . '/product/detail?id=' . $item['id'] ?>" class="image-link">
                                                                    <img src=" <?php echo _WEB_ROOT . $item['img-0'] ?>" alt="">
                                                                    <img src=" <?php echo _WEB_ROOT . $item['img-1'] ?>" alt="">
                                                                </a>
                                                                <div class="action-link">
                                                                    <div class="action-link-left">
                                                                        <a href=" <?php echo _WEB_ROOT . '/product/detail?id=' . $item['id'] ?>">Xem thêm</a>
                                                                    </div>
                                                                    <div class="action-link-right">
                                                                        <button class="text-white addToWishlist" data-path=" <?php echo _WEB_ROOT ?>" data-id=" <?php echo $item['id'] ?>"><i class="icon-heart"></i></button>
                                                                        <button class="text-white addToCart" data-path=" <?php echo _WEB_ROOT ?>" data-id=" <?php echo $item['id'] ?>"><i class="fa-solid fa-cart-shopping"></i></button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="content">
                                                                <div class="content-left">
                                                                    <h6 class="title"><a href=" <?php echo _WEB_ROOT . '/product/detail?id=' . $item['id'] ?>"> <?php echo strlen($item['product_name']) > 21 ? substr($item['product_name'], 0, 21) . ' ...' : $item['product_name']; ?></a></h6>
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
                                                                <div class="content-right">
                                                                    <span class="price"> <?php echo number_format($item['price'], 0) . ' VND'; ?></span>

                                                                </div>

                                                            </div>
                                                        </div>
                                                        <!-- End Product Default Single Item -->
                                                    </div>
                                                <?php  }
                                                ?>
                                            </div>
                                        </div> <!-- End Grid View Product -->
                                        <!-- Start List View Product -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> <!-- End Tab Wrapper -->

                    <?php
                    $next = $page + 1;
                    $pre = $page - 1;
                    ?> <!-- Start Pagination -->
                    <div class="page-pagination text-center" data-aos="fade-up" data-aos-delay="0">
                        <ul>

                            <li><a class="" href=" <?php echo _WEB_ROOT . '/product/search?value=' . $value . '&page=' . 1 ?>"><i class="fa-solid fa-backward-step"></i></a></li>
                            <li <?php
                                if ($pre == 0) {
                                    echo 'style="display:none"';
                                }
                                ?>>
                                <a href=" <?php echo _WEB_ROOT . '/product/search?value=' . $value . '&page=' . $pre ?>"> <?php echo $pre ?></a>
                            </li>
                            <li>
                                <a class="active" href=" <?php echo _WEB_ROOT . '/product/search?value=' . $value . '&page=' . $page ?>"> <?php echo $page ?></a>
                            </li>
                            <li <?php
                                if ($next > $maxPage) {
                                    echo 'style="display:none"';
                                }
                                ?>>
                                <a class="" href=" <?php echo _WEB_ROOT . '/product/search?value=' . $value . '&page=' . $next ?>"> <?php echo $next ?></a>
                            </li>
                            <li><a class="" href=" <?php echo _WEB_ROOT . '/product/search?value=' . $value . '&page=' . $maxPage ?>"><i class="fa-solid fa-forward-step"></i></a></li>
                        </ul>
                    </div> <!-- End Pagination -->
                </div> <!-- End Shop Product Sorting Section  -->
            </div>
        <?php }
        else {
            ?><div class="empty-cart-section section-fluid">
                    <div class="emptycart-wrapper">
                        <div class="container">
                            <div class="row">
                                <div class="col-12 col-md-10 offset-md-1 col-xl-6 offset-xl-3">
                                    <div class="emptycart-content text-center">
                                        <div class="image">
                                            <img class="img-fluid" src="<?php  echo _WEB_ROOT ?>/public/assets/client/images/emprt-cart/empty-cart.png" alt="">
                                        </div>
                                        <h6 class="sub-title">Không tìm thấy gì hết!</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><?php 
                    }
                        ?>
    </div>
</div> <!-- ...:::: End Shop Section:::... -->

<!-- Start Footer Section -->