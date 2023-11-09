<div class="breadcrumb-section breadcrumb-bg-color--golden">
    <div class="breadcrumb-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h3 class="breadcrumb-title"> <?php  echo $title ?></h3>
                    <div class="breadcrumb-nav breadcrumb-nav-color--black breadcrumb-nav-hover-color--golden">
                        <nav aria-label="breadcrumb">
                            <ul>
                                <li><a href=" <?php  echo _WEB_ROOT ?>">Trang chủ</a></li>
                                <li class="active" aria-current="page"> <?php  echo $title ?></li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> <!-- ...:::: End Breadcrumb Section:::... -->
 <?php 
if ($page_name == 'book_product') {
    $label_group = $group_book;
} elseif ($page_name == 'other_product') {
    $label_group = $group_other;
};

?>
<!-- ...:::: Start Shop Section:::... -->
<div class="shop-section">
    <div class="container">
        <div class="row flex-column-reverse flex-lg-row">
            <div class="col-lg-3">
                <!-- Start Sidebar Area -->
                <div class="siderbar-section" data-aos="fade-up" data-aos-delay="0">

                    <!-- Start Single Sidebar Widget -->
                    <div class="sidebar-single-widget">
                        <h6 class="sidebar-title">PHÂN LOẠI</h6>
                        <div class="sidebar-content">
                            <ul class="sidebar-menu">
                                <li>
                                    <ul class="sidebar-menu-collapse">
                                        <!-- Start Single Menu Collapse List -->
                                         <?php 
                                        foreach ($label_group as $key => $item) {
                                        ?>
                                            <li class="sidebar-menu-collapse-list">

                                                <a href="#" class="accordion-title collapsed" data-bs-toggle="collapse" data-bs-target="#men-fashion-<?php  echo $key ?>" aria-expanded="false"> <?php  echo $item['group_name'] ?> <i class="ion-ios-arrow-right"></i></a>
                                                <div id="men-fashion-<?php  echo $key ?>" class="collapse">
                                                    <ul class="accordion-category-list">
                                                         <?php 
                                                        foreach ($label_list as $itemLabel) {
                                                            if ($itemLabel['id_group'] == $item['id']) {
                                                        ?>
                                                                <li><a href="<?php echo _WEB_ROOT . '/product/label?id=' . $itemLabel['id'] ?>"> <?php  echo $itemLabel['label_name'] ?></a></li>
                                                         <?php 
                                                            }
                                                        }
                                                        ?>
                                                    </ul>
                                                </div>
                                            </li>
                                         <?php 
                                        }
                                        ?>
                                        <!-- End Single Menu Collapse List -->
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div> <!-- End Single Sidebar Widget -->

                    <!-- Start Single Sidebar Widget -->
                    <div class="sidebar-single-widget">
                        <h6 class="sidebar-title">LỰA CHỌN MỨC GIÁ</h6>
                        <div class="sidebar-content">
                            <div id="slider-range"></div>
                            <div class="filter-type-price">
                                <label for="amount">Giá:</label>
                                <input type="text" class="float-right" id="amount">
                            </div>
                        </div>
                    </div> <!-- End Single Sidebar Widget -->

                    <!-- Start Single Sidebar Widget -->

                    <!-- Start Single Sidebar Widget -->
                    <div class="sidebar-single-widget">
                        <h6 class="sidebar-title">CHỌN NHÀ SẢN XUẤT</h6>
                        <div class="sidebar-content">
                            <div class="filter-type-select">
                                <ul>
                                    <li>
                                        <label class="checkbox-default" for="black">
                                            <input type="checkbox" id="black">
                                            <span>Nhà xuất bản giáo dục</span>
                                        </label>
                                    </li>
                                    <li>
                                        <label class="checkbox-default" for="blue">
                                            <input type="checkbox" id="blue">
                                            <span>Thiên Long</span>
                                        </label>
                                    </li>
                                    <li>
                                        <label class="checkbox-default" for="brown">
                                            <input type="checkbox" id="brown">
                                            <span>Cánh Diều</span>
                                        </label>
                                    </li>
                                    <li>
                                        <label class="checkbox-default" for="Green">
                                            <input type="checkbox" id="Green">
                                            <span>NXB Hồ Chí Minh</span>
                                        </label>
                                    </li>
                                    <li>
                                        <label class="checkbox-default" for="pink">
                                            <input type="checkbox" id="pink">
                                            <span>Nhà Xuất Bản Hà Nội</span>
                                        </label>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div> <!-- End Single Sidebar Widget -->

                    <!-- Start Single Sidebar Widget -->
                    <div class="sidebar-single-widget">
                        <h6 class="sidebar-title">Nhãn</h6>
                        <div class="sidebar-content">
                            <div class="tag-link">
                                <a href="#">Hot</a>
                                <a href="#">Sale</a>
                                <a href="#">Sách giáo khoa</a>
                                <a href="#">Truyện tranh</a>
                                <a href="#">Cặp sách</a>
                                <a href="#">Sách tiếng anh</a>
                                <a href="#">Dụng cụ học sinh</a>
                            </div>
                        </div>
                    </div> <!-- End Single Sidebar Widget -->

                    <!-- Start Single Sidebar Widget -->
                    <div class="sidebar-single-widget">
                        <div class="sidebar-content">
                            <a href="product-details-default.html" class="sidebar-banner img-hover-zoom">
                                <img class="img-fluid" src=" <?php  echo _WEB_ROOT ?>/public/assets/client/images/banner/side-banner.jpg" alt="">
                            </a>
                        </div>
                    </div> <!-- End Single Sidebar Widget -->

                </div> <!-- End Sidebar Area -->
            </div>
            <div class="col-lg-9">
                <!-- Start Shop Product Sorting Section -->
                <div class="shop-sort-section">
                    <div class="container">
                        <div class="row">
                            <!-- Start Sort Wrapper Box -->
                            <div class="sort-box d-flex justify-content-between align-items-md-center align-items-start flex-md-row flex-column" data-aos="fade-up" data-aos-delay="0">
                                <!-- Start Sort tab Button -->
                                <div class="sort-tablist d-flex align-items-center">
                                    <ul class="tablist nav sort-tab-btn">
                                        <li><a class="nav-link active" data-bs-toggle="tab" href="#layout-3-grid"><img src=" <?php  echo _WEB_ROOT ?>/public/assets/client/images/icons/bkg_grid.png" alt=""></a></li>
                                        <li><a class="nav-link" data-bs-toggle="tab" href="#layout-list"><img src=" <?php  echo _WEB_ROOT ?>/public/assets/client/images/icons/bkg_list.png" alt=""></a></li>
                                    </ul>

                                    <!-- Start Page Amount -->
                                    <div class="page-amount ml-2">
                                        <span>Bố cục</span>
                                    </div> <!-- End Page Amount -->
                                </div> <!-- End Sort tab Button -->

                                <!-- Start Sort Select Option -->
                                <div class="sort-select-list d-flex align-items-center">
                                    <label class="mr-2">Sắp xếp:</label>

                                    <fieldset>
                                        <select name="speed" id="speed">
                                            <option selected="selected">Sort by newness</option>
                                            <option><a href=" <?php  echo _WEB_ROOT . '/product/' . $page_name . '?sortBy=priceMin' ?>">Giá từ thấp đến cao</a></option>
                                            <option>Sort by popularity</option>
                                            <option>Sort by price: low to high</option>
                                            <option>Sort by price: high to low</option>
                                            <option>Product Name: Z</option>
                                        </select>
                                    </fieldset>

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
                                <div class="tab-content tab-animate-zoom">
                                    <!-- Start Grid View Product -->
                                    <div class="tab-pane active show sort-layout-single" id="layout-3-grid">
                                        <div class="row">

                                             <?php  if (!empty($products)) {
                                                foreach ($products as $item) { ?>
                                                    <div class="col-xl-4 col-sm-6 col-12">
                                                        <!-- Start Product Default Single Item -->
                                                        <div class="product-default-single-item product-color--golden" data-aos="fade-up" data-aos-delay="0">
                                                            <div class="image-box">
                                                                <a href=" <?php  echo _WEB_ROOT . '/product/detail?id=' . $item['id'] ?>" class="image-link">
                                                                    <img src=" <?php  echo _WEB_ROOT . $item['img-0'] ?>" alt="">
                                                                    <img src=" <?php  echo _WEB_ROOT . $item['img-1'] ?>" alt="">
                                                                </a>
                                                                <div class="action-link">
                                                                    <div class="action-link-left">
                                                                        <a href=" <?php  echo _WEB_ROOT . '/product/detail?id=' . $item['id'] ?>">Xem thêm</a>
                                                                    </div>
                                                                    <div class="action-link-right">
                                                                        <button class="text-white addToWishlist" data-path=" <?php  echo _WEB_ROOT ?>" data-id=" <?php  echo $item['id'] ?>"><i class="icon-heart"></i></button>
                                                                        <button class="text-white addToCart" data-path=" <?php  echo _WEB_ROOT ?>" data-id=" <?php  echo $item['id'] ?>"><i class="fa-solid fa-cart-shopping"></i></button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="content">
                                                                <div class="content-left">
                                                                    <h6 class="title"><a href=" <?php  echo _WEB_ROOT . '/product/detail?id=' . $item['id'] ?>"> <?php  echo strlen($item['product_name']) > 21 ? substr($item['product_name'], 0, 21) . ' ...' : $item['product_name']; ?></a></h6>
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
                                                                    <span class="price"> <?php  echo number_format($item['price'], 0) . ' VND'; ?></span>

                                                                </div>

                                                            </div>
                                                        </div>
                                                        <!-- End Product Default Single Item -->
                                                    </div>
                                             <?php  }
                                            } ?>
                                        </div>
                                    </div> <!-- End Grid View Product -->
                                    <!-- Start List View Product -->
                                    <div class="tab-pane sort-layout-single" id="layout-list">
                                        <div class="row">

                                             <?php  if (!empty($products)) {
                                                foreach ($products as $item) { ?>
                                                    <div class="col-12">
                                                        <!-- Start Product Defautlt Single -->
                                                        <div class="product-list-single product-color--golden">
                                                            <a href=" <?php  echo _WEB_ROOT . '/product/detail?id=' . $item['id'] ?>" class="product-list-img-link">
                                                                <img class="img-fluid" src=" <?php  echo _WEB_ROOT . $item['img-0'] ?>" alt="">
                                                                <img class="img-fluid" src=" <?php  echo _WEB_ROOT . $item['img-1'] ?>" alt="">
                                                            </a>
                                                            <div class="product-list-content">
                                                                <h5 class="product-list-link"><a href=" <?php  echo _WEB_ROOT . '/product/detail?id=' . $item['id'] ?>"> <?php  echo strlen($item['product_name']) > 40 ? substr($item['product_name'], 0, 40) . ' ...' : $item['product_name']; ?></a></h5>

                                                                <ul class="review-star">
                                                                    <li class="fill"><i class="ion-android-star"></i></li>
                                                                    <li class="fill"><i class="ion-android-star"></i></li>
                                                                    <li class="fill"><i class="ion-android-star"></i></li>
                                                                    <li class="fill"><i class="ion-android-star"></i></li>
                                                                    <li class="empty"><i class="ion-android-star"></i></li>
                                                                </ul>
                                                                <span class="product-list-price"><del> <?php  echo number_format($item['price'], 0) . ' VND'; ?></del>
                                                                     <?php  echo number_format($item['price'], 0) . ' VND'; ?></span>
                                                                <p> <?php  echo htmlentities($item['short_description']) ?></p>
                                                                <div class="product-action-icon-link-list">
                                                                    <a href=" <?php  echo _WEB_ROOT . '/product/detail?id=' . $item['id'] ?>" class="btn btn-lg btn-black-default-hover">Xem thêm</a>
                                                                    <button href="#" class=" addToCart btn btn-lg btn-black-default-hover" data-path=" <?php  echo _WEB_ROOT ?>" data-id=" <?php  echo $item['id'] ?>"><i class="fa-solid fa-cart-shopping"></i></button>
                                                                    <button href="wishlist.html" class=" addToWishlist btn btn-lg btn-black-default-hover" data-path=" <?php  echo _WEB_ROOT ?>" data-id=" <?php  echo $item['id'] ?>"><i class="icon-heart"></i></button>
                                                                    <a href="compare.html" class="btn btn-lg btn-black-default-hover"><i class="icon-shuffle"></i></a>
                                                                </div>
                                                            </div>
                                                        </div> <!-- End Product Defautlt Single -->
                                                    </div>
                                             <?php  }
                                            } ?>
                                        </div>
                                    </div> <!-- End List View Product -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div> <!-- End Tab Wrapper -->
                 <?php 
                $next = $page + 1;
                $pre = $page - 1;
                ?>
                <!-- Start Pagination -->
                <div class="page-pagination text-center" data-aos="fade-up" data-aos-delay="0">
                    <ul>

                        <li><a class="" href=" <?php  echo _WEB_ROOT . '/product/' . $page_name . '?page=' . 1 ?>"><i class="fa-solid fa-backward-step"></i></a></li>
                        <li  <?php 
                            if ($pre == 0) {
                                echo 'style="display:none"';
                            }
                            ?>>
                            <a href=" <?php  echo _WEB_ROOT . '/product/' . $page_name . '?page=' . $pre ?>"> <?php  echo $pre ?></a>
                        </li>
                        <li>
                            <a class="active" href=" <?php  echo _WEB_ROOT . '/product/' . $page_name . '?page=' . $page ?>"> <?php  echo $page ?></a>
                        </li>
                        <li  <?php 
                            if ($next > $maxPage) {
                                echo 'style="display:none"';
                            }
                            ?>>
                            <a class="" href=" <?php  echo _WEB_ROOT . '/product/' . $page_name . '?page=' . $next ?>"> <?php  echo $next ?></a>
                        </li>
                        <li><a class="" href=" <?php  echo _WEB_ROOT . '/product/' . $page_name . '?page=' . $maxPage ?>"><i class="fa-solid fa-forward-step"></i></a></li>

                    </ul>
                </div> <!-- End Pagination -->
            </div>
        </div>
    </div>
</div> <!-- ...:::: End Shop Section:::... -->