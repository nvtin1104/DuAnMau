<header class="header-section d-none d-xl-block">
    <?php
    // var_dump($data['group_other']);
    if (!empty($user_infor)) {
        $cart = $user_infor['cart'];
        $wishlist = $user_infor['wishlist'];
    }
    ?>
    <div class="header-wrapper">
        <div class="header-bottom header-bottom-color--golden section-fluid sticky-header sticky-color--golden">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 d-flex align-items-center justify-content-between">
                        <!-- Start Header Logo -->
                        <div class="header-logo">
                            <div class="logo">
                                <a href=" <?php echo _WEB_ROOT ?>"><img src=" <?php echo _WEB_ROOT ?>/public/assets/client/images/logo/logo_black.png" alt=""></a>
                            </div>
                        </div>
                        <!-- End Header Logo -->

                        <!-- Start Header Main Menu -->
                        <div class="main-menu menu-color--black menu-hover-color--golden">
                            <nav>
                                <ul>
                                    <li class="">
                                        <a class="active main-menu-link" href=" <?php echo _WEB_ROOT ?>/home">Trang chủ</a>
                                        <!-- Sub Menu -->
                                    </li>
                                    <li class="has-dropdown has-megaitem">
                                        <a href=" <?php echo _WEB_ROOT ?>/product/book_product">SÁCH<i class="fa fa-angle-down"></i></a>
                                        <!-- Mega Menu -->
                                        <div class="mega-menu">
                                            <ul class="mega-menu-inner">
                                                <?php
                                                foreach ($group_book as $item) {
                                                ?>
                                                    <li class="mega-menu-item">
                                                        <a href="#" class="mega-menu-item-title"> <?php echo $item['group_name'] ?></a>
                                                        <ul class="mega-menu-sub">

                                                            <?php
                                                            foreach ($label_list as $itemLabel) {
                                                                if ($itemLabel['id_group'] == $item['id']) {
                                                            ?>
                                                                    <li><a href="<?php echo _WEB_ROOT . '/product/label?id=' . $itemLabel['id'] ?>"> <?php echo $itemLabel['label_name'] ?></a></li>
                                                            <?php
                                                                }
                                                            }
                                                            ?>
                                                        </ul>
                                                    </li>
                                                <?php
                                                }
                                                ?>
                                                <!-- Mega Menu Sub Link -->

                                            </ul>
                                            <div class="menu-banner">
                                                <a href="#" class="menu-banner-link">
                                                    <img class="menu-banner-img" src=" <?php echo _WEB_ROOT ?>/public/assets/client/images/banner/banner-menu.jpg" alt="">
                                                </a>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="has-dropdown has-megaitem">
                                        <a href=" <?php echo _WEB_ROOT ?>/product/other_product">Sản phẩm khác <i class="fa fa-angle-down"></i></a>
                                        <!-- Mega Menu -->
                                        <div class="mega-menu">
                                            <ul class="mega-menu-inner">
                                                <!-- Mega Menu Sub Link -->
                                                <?php
                                                foreach ($group_other as $item) {
                                                ?>
                                                    <li class="mega-menu-item">
                                                        <a href="#" class="mega-menu-item-title"> <?php echo $item['group_name'] ?></a>
                                                        <ul class="mega-menu-sub">

                                                            <?php
                                                            foreach ($label_list as $itemLabel) {
                                                                if ($itemLabel['id_group'] == $item['id']) {
                                                            ?>
                                                                    <li><a href="<?php echo _WEB_ROOT . '/product/label?id=' . $itemLabel['id'] ?>"> <?php echo $itemLabel['label_name'] ?></a></li>
                                                            <?php
                                                                }
                                                            }
                                                            ?>
                                                        </ul>
                                                    </li>
                                                <?php
                                                }
                                                ?>
                                            </ul>
                                            <div class="menu-banner">
                                                <a href="#" class="menu-banner-link">
                                                    <img class="menu-banner-img" src=" <?php echo _WEB_ROOT ?>/public/assets/client/images/banner/banner-menu.jpg" alt="">
                                                </a>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="has-dropdown">
                                        <a href=" <?php echo _WEB_ROOT ?>/blogs">Bài Viết </a>
                                        <!-- Sub Menu -->
                                    </li>
                                    <li>
                                        <a href=" <?php echo _WEB_ROOT ?>/home/contact_us">Liên hệ</a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                        <!-- End Header Main Menu Start -->

                        <!-- Start Header Action Link -->
                        <ul class="header-action-link action-color--black action-hover-color--golden">
                            <li>
                                <a href="#offcanvas-wishlish" class="offcanvas-toggle">
                                    <i class="icon-heart"></i>
                                    <span class="item-count">
                                        <?php
                                        if (!empty($wishlist)) {
                                            $total = count($wishlist);
                                            echo $total;
                                        } else {
                                            echo 0;
                                        }
                                        ?>
                                    </span>
                                </a>
                            </li>
                            <li>
                                <a href="#offcanvas-add-cart" class="offcanvas-toggle">
                                    <i class="icon-bag"></i>
                                    <span class="item-count">
                                        <?php
                                        if (!empty($cart)) {
                                            $total = count($cart);
                                            echo $total;
                                        } else {
                                            echo 0;
                                        }
                                        ?>
                                    </span>
                                </a>
                            </li>
                            <li>
                                <a href="#search">
                                    <i class="icon-magnifier"></i>
                                </a>
                            </li>
                            <li>
                                <a href="#offcanvas-about" class="offacnvas offside-about offcanvas-toggle">
                                    <i class="icon-menu"></i>
                                </a>
                            </li>
                        </ul>
                        <!-- End Header Action Link -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- Start Header Area -->

<!-- Start Mobile Header -->
<div class="mobile-header mobile-header-bg-color--golden section-fluid d-lg-block d-xl-none">
    <div class="container">
        <div class="row">
            <div class="col-12 d-flex align-items-center justify-content-between">
                <!-- Start Mobile Left Side -->
                <div class="mobile-header-left">
                    <ul class="mobile-menu-logo">
                        <li>
                            <a href=" <?php echo _WEB_ROOT ?>">
                                <div class="logo">
                                    <img src=" <?php echo _WEB_ROOT ?>/public/assets/client/images/logo/logo_black.png" alt="">
                                </div>
                            </a>
                        </li>
                    </ul>
                </div>
                <!-- End Mobile Left Side -->

                <!-- Start Mobile Right Side -->
                <div class="mobile-right-side">
                    <ul class="header-action-link action-color--black action-hover-color--golden">
                        <li>
                            <a href="#search">
                                <i class="icon-magnifier"></i>
                            </a>
                        </li>
                        <li>
                            <a href="#offcanvas-wishlish" class="offcanvas-toggle">
                                <i class="icon-heart"></i>
                                <span class="item-count">
                                    <?php
                                    if (!empty($wishlist)) {
                                        $total = count($wishlist);
                                        echo $total;
                                    } else {
                                        echo 0;
                                    }
                                    ?>
                                </span>
                            </a>
                        </li>
                        <li>
                            <a href="#offcanvas-add-cart" class="offcanvas-toggle">
                                <i class="icon-bag"></i>
                                <span class="item-count">
                                    <?php
                                    if (!empty($cart)) {
                                        $total = count($cart);
                                        echo $total;
                                    } else {
                                        echo 0;
                                    }
                                    ?>
                                </span>
                            </a>
                        </li>
                        <li>
                            <a href="#mobile-menu-offcanvas" class="offcanvas-toggle offside-menu">
                                <i class="icon-menu"></i>
                            </a>
                        </li>
                    </ul>
                </div>
                <!-- End Mobile Right Side -->
            </div>
        </div>
    </div>
</div>
<!-- End Mobile Header -->

<!--  Start Offcanvas Mobile Menu Section -->
<div id="mobile-menu-offcanvas" class="offcanvas offcanvas-rightside offcanvas-mobile-menu-section">
    <!-- Start Offcanvas Header -->
    <div class="offcanvas-header text-right">
        <button class="offcanvas-close"><i class="ion-android-close"></i></button>
    </div> <!-- End Offcanvas Header -->
    <!-- Start Offcanvas Mobile Menu Wrapper -->
    <div class="offcanvas-mobile-menu-wrapper">
        <!-- Start Mobile Menu  -->
        <div class="mobile-menu-bottom">
            <!-- Start Mobile Menu Nav -->
            <div class="offcanvas-menu">
                <ul>
                    <li>
                        <a href=" <?php echo _WEB_ROOT ?>/home"><span>Trang chủ</span></a>
                    </li>
                    <li>
                        <a href=" <?php echo _WEB_ROOT ?>/product/book_product"><span>Sách / VPP</span></a>
                        <ul class="mobile-sub-menu">
                            <?php
                            foreach ($group_book as $item) {
                            ?>
                                <li class="mega-menu-item">
                                    <a href="#"> <?php echo $item['group_name'] ?></a>
                                    <ul class="mega-menu-sub">
                                        <?php
                                        foreach ($label_list as $itemLabel) {
                                            if ($itemLabel['id_group'] == $item['id']) {
                                        ?>
                                                <li><a href="<?php echo _WEB_ROOT . '/product/label?id=' . $itemLabel['id'] ?>"> <?php echo $itemLabel['label_name'] ?></a></li>
                                        <?php
                                            }
                                        }
                                        ?>
                                    </ul>
                                </li>
                            <?php
                            }
                            ?>
                        </ul>
                    <li>
                        <a href=" <?php echo _WEB_ROOT ?>/product/other_product"><span>Sản phẩm khác</span></a>
                        <ul class="mobile-sub-menu">
                            <?php
                            foreach ($group_other as $item) {
                            ?>
                                <li class="mega-menu-item">
                                    <a href="#"> <?php echo $item['group_name'] ?></a>
                                    <ul class="mega-menu-sub">

                                        <?php
                                        foreach ($label_list as $itemLabel) {
                                            if ($itemLabel['id_group'] == $item['id']) {
                                        ?>
                                                <li><a href="<?php echo _WEB_ROOT . '/product/label?id=' . $itemLabel['id'] ?>"> <?php echo $itemLabel['label_name'] ?></a></li>
                                        <?php
                                            }
                                        }
                                        ?>
                                    </ul>
                                </li>
                            <?php
                            }
                            ?>
                        </ul>

                    </li>
                    <li>
                        <a href=" <?php echo _WEB_ROOT ?>/blogs"><span>Bài viết</span></a>
                    </li>
                    <li><a href=" <?php echo _WEB_ROOT ?>/home/contact_us">Liên hệ</a></li>
                </ul>
            </div> <!-- End Mobile Menu Nav -->
        </div> <!-- End Mobile Menu -->

        <!-- Start Mobile contact Info -->
        <div class="mobile-contact-info">
            <?php
            if (!empty($user_infor)) { ?>
                <ul class="offcanvas-cart-action-button">
                    <li><a href=" <?php echo _WEB_ROOT ?>/quan-ly-tai-khoan" class="text-white">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-circle mr-2" viewBox="0 0 16 16">
                                <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z" />
                                <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z" />
                            </svg>
                            <p class=" d-inline"> Xin chào, <?php echo $user_infor['username'] ?></p>
                        </a></li>
                    <li><a href=" <?php echo _WEB_ROOT ?>/quan-ly-tai-khoan" class=" btn btn-block btn-golden mt-5">Quản lý tài khoản</a></li>
                    <li><a href=" <?php echo _WEB_ROOT ?>/auth/logout" class=" btn btn-block btn-golden mt-5">Đăng xuất</a></li>
                </ul>
            <?php
            } else {
            ?>
                <ul class="offcanvas-cart-action-button">
                    <li><a href=" <?php echo _WEB_ROOT ?>/auth/" class="btn btn-block btn-golden">Đăng nhập</a></li>
                    <li><a href=" <?php echo _WEB_ROOT ?>/auth/" class=" btn btn-block btn-golden mt-5">Đăng ký</a></li>
                </ul>
            <?php  }; ?>
            <div class="logo mt-5">
                <a href="index.html"><img src=" <?php echo _WEB_ROOT ?>/public/assets/client/images/logo/logo_white.png" alt=""></a>
            </div>

            <address class="address">
                <span>Địa chỉ:<?php echo $inforWebsite['address'] ?></span>
                <span>Số điện thoại:<?php echo $inforWebsite['phone'] ?></span>
                <span>Email:<?php echo $inforWebsite['email'] ?></span>
            </address>

            <ul class="social-link">
                <li><a href="#"><i class="fa-brands fa-facebook"></i></a></li>
                <li><a href="#"><i class="fa-brands fa-instagram"></i></a></li>
                <li><a href="#"><i class="fa-brands fa-twitter"></i></a></li>
                <li><a href="#"><i class="fa-brands fa-linkedin"></i></a></li>
            </ul>

            <ul class="user-link">
                <li><a href="wishlist.html">Wishlist</a></li>
                <li><a href="cart.html">Cart</a></li>
                <li><a href="checkout.html">Checkout</a></li>
            </ul>
        </div>
        <!-- End Mobile contact Info -->

    </div> <!-- End Offcanvas Mobile Menu Wrapper -->
</div> <!-- ...:::: End Offcanvas Mobile Menu Section:::... -->

<!-- Start Offcanvas Mobile Menu Section -->
<div id="offcanvas-about" class="offcanvas offcanvas-rightside offcanvas-mobile-about-section">
    <!-- Start Offcanvas Header -->
    <div class="offcanvas-header text-right">
        <button class="offcanvas-close"><i class="ion-android-close"></i></button>
    </div> <!-- End Offcanvas Header -->
    <!-- Start Offcanvas Mobile Menu Wrapper -->
    <!-- Start Mobile contact Info -->
    <div class="mobile-contact-info">
        <?php
        if (!empty($user_infor)) { ?>
            <ul class="offcanvas-cart-action-button">
                <li><a href=" <?php echo _WEB_ROOT ?>/quan-ly-tai-khoan" class="text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-circle mr-2" viewBox="0 0 16 16">
                            <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z" />
                            <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z" />
                        </svg>
                        <p class=" d-inline"> Xin chào, <?php echo $user_infor['username'] ?></p>
                    </a></li>
                <li><a href=" <?php echo _WEB_ROOT ?>/quan-ly-tai-khoan" class=" btn btn-block btn-golden mt-5">Quản lý tài khoản</a></li>
                <li><a href=" <?php echo _WEB_ROOT ?>/auth/logout" class=" btn btn-block btn-golden mt-5">Đăng xuất</a></li>
            </ul>
        <?php
        } else {
        ?>
            <ul class="offcanvas-cart-action-button">
                <li><a href=" <?php echo _WEB_ROOT ?>/auth/" class="btn btn-block btn-golden">Đăng nhập</a></li>
                <li><a href=" <?php echo _WEB_ROOT ?>/auth/" class=" btn btn-block btn-golden mt-5">Đăng ký</a></li>
            </ul>
        <?php  } ?>
        <div class="logo mt-5">
            <a href="index.html"><img src=" <?php echo _WEB_ROOT ?>/public/assets/client/images/logo/logo_white.png" alt=""></a>
        </div>

        <address class="address">
            <span>Địa chỉ:<?php echo $inforWebsite['address'] ?></span>
            <span>Số điện thoại:</span>
            <span>Email:<?php echo $inforWebsite['email'] ?></span>
        </address>

        <ul class="social-link">
            <li><a href="#"><i class="fa-brands fa-facebook"></i></a></li>
            <li><a href="#"><i class="fa-brands fa-instagram"></i></a></li>
            <li><a href="#"><i class="fa-brands fa-twitter"></i></a></li>
            <li><a href="#"><i class="fa-brands fa-linkedin"></i></a></li>
        </ul>

        <ul class="user-link">
            <li><a href=" <?php echo _WEB_ROOT ?>/home/about_us">Về chúng tôi</a></li>
        </ul>
    </div>
    <!-- End Mobile contact Info -->
</div> <!-- ...:::: End Offcanvas Mobile Menu Section:::... -->

<!-- Start Offcanvas Addcart Section -->
<div id="offcanvas-add-cart" class="offcanvas offcanvas-rightside offcanvas-add-cart-section">
    <!-- Start Offcanvas Header -->
    <div class="offcanvas-header text-right">
        <button class="offcanvas-close"><i class="ion-android-close"></i></button>
    </div> <!-- End Offcanvas Header -->

    <!-- Start  Offcanvas Addcart Wrapper -->
    <div class="offcanvas-add-cart-wrapper">
        <h4 class="offcanvas-title">Giỏ hàng</h4>
        <ul class="offcanvas-cart">
            <?php
            if (!empty($cart)) {
                $sum = 0;
                foreach ($cart as $cartItem) {
                    $sum += $cartItem['total_price']; ?>

                    <li class="offcanvas-cart-item-single">
                        <div class="offcanvas-cart-item-block">
                            <a href="#" class="offcanvas-cart-item-image-link">
                                <img src=" <?php echo _WEB_ROOT . $cartItem['imgDir'] ?>" alt="" class="offcanvas-cart-image">
                            </a>
                            <div class="offcanvas-cart-item-content">
                                <a href="#" class="offcanvas-cart-item-link"> <?php echo strlen($cartItem['product_name']) > 21 ? substr($cartItem['product_name'], 0, 21) . ' ...' : $cartItem['product_name']; ?></a>
                                <div class="offcanvas-cart-item-details">
                                    <span class="offcanvas-cart-item-details-quantity"> <?php echo $cartItem['quantity'] ?> x</span>
                                    <span class="offcanvas-cart-item-details-price"> <?php echo number_format($cartItem['price'], 0) . ' VND'; ?></span>
                                </div>
                            </div>
                        </div>
                        <div class="offcanvas-cart-item-delete text-right">
                            <a href="#" class="offcanvas-cart-item-delete"><i class="fa fa-trash-o"></i></a>
                        </div>
                    </li> <?php

                        }
                    } else {
                            ?>
                <div class="col-12 col-md-10 offset-md-1 col-xl-6 offset-xl-3">
                    <div class="emptycart-content text-center mt-5">
                        <div class="image mt-5">
                            <img class="img-fluid" src=" <?php echo _WEB_ROOT ?>/public/assets/client/images/emprt-cart/empty-cart.png" alt="">
                        </div>
                        <h4 class="sub-title pt-2 pb-5 mb-5">Giỏ của bạn trống trơn</h4>
                    </div>
                    <br>
                    <br>
                    <br>
                </div>
            <?php
                    }
            ?>
        </ul>
        <div class="offcanvas-cart-total-price">
            <span class="offcanvas-cart-total-price-text">Tổng tiền:</span>
            <span class="offcanvas-cart-total-price-value"> <?php
                                                            if (!empty($cart)) {
                                                                echo number_format($sum, 0) . ' VND';
                                                            } else {
                                                                echo 0;
                                                            }
                                                            ?></span>
        </div>
        <ul class="offcanvas-cart-action-button">
            <li><a href=" <?php echo _WEB_ROOT ?>/cart/cart?page=1" class="btn btn-block btn-golden">Đi tới giỏ hàng</a></li>
            <li><a href=" <?php echo _WEB_ROOT ?>/cart/checkout" class=" btn btn-block btn-golden mt-5">Thanh toán</a></li>
        </ul>
    </div> <!-- End  Offcanvas Addcart Wrapper -->

</div> <!-- End  Offcanvas Addcart Section -->

<!-- Start Offcanvas Mobile Menu Section -->
<div id="offcanvas-wishlish" class="offcanvas offcanvas-rightside offcanvas-add-cart-section">
    <!-- Start Offcanvas Header -->
    <div class="offcanvas-header text-right">
        <button class="offcanvas-close"><i class="ion-android-close"></i></button>
    </div> <!-- ENd Offcanvas Header -->

    <!-- Start Offcanvas Mobile Menu Wrapper -->
    <div class="offcanvas-wishlist-wrapper">
        <h4 class="offcanvas-title">Wishlist</h4>
        <ul class="offcanvas-wishlist">
            <?php
            if (!empty($wishlist)) {
                $sum = 0;
                foreach ($wishlist as $wishlistItem) {
                    $sum += $wishlistItem['total_price']; ?>

                    <li class="offcanvas-wishlist-item-single">
                        <div class="offcanvas-wishlist-item-block">
                            <a href="#" class="offcanvas-wishlist-item-image-link">
                                <img src=" <?php echo _WEB_ROOT . $wishlistItem['imgDir'] ?>" alt="" class="offcanvas-wishlist-image">
                            </a>
                            <div class="offcanvas-wishlist-item-content">
                                <a href="#" class="offcanvas-wishlist-item-link"> <?php echo strlen($wishlistItem['product_name']) > 21 ? substr($wishlistItem['product_name'], 0, 21) . ' ...' : $wishlistItem['product_name']; ?></a>
                                <div class="offcanvas-wishlist-item-details">
                                    <span class="offcanvas-wishlist-item-details-quantity"> <?php echo $wishlistItem['quantity'] ?> x</span>
                                    <span class="offcanvas-wishlist-item-details-price"> <?php echo number_format($wishlistItem['price'], 0) . ' VND'; ?></span>
                                </div>
                            </div>
                        </div>
                        <div class="offcanvas-wishlist-item-delete text-right">
                            <a href="#" class="offcanvas-wishlist-item-delete"><i class="fa fa-trash-o"></i></a>
                        </div>
                    </li> <?php

                        }
                    } else {
                            ?>
                <div class="col-12 col-md-10 offset-md-1 col-xl-6 offset-xl-3">
                    <div class="emptycart-content text-center mt-5">
                        <div class="image mt-5">
                            <img class="img-fluid" src=" <?php echo _WEB_ROOT ?>/public/assets/client/images/emprt-cart/empty-cart.png" alt="">
                        </div>
                        <h4 class="sub-title pt-2 pb-5 mb-5">Danh sách yêu thích của bạn trống trơn</h4>
                    </div>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                </div>
            <?php
                    }
            ?>
        </ul>
        <div class="offcanvas-wishlist-total-price">
            <span class="offcanvas-wishlist-total-price-text">Tổng tiền:</span>
            <span class="offcanvas-wishlist-total-price-value"> <?php
                                                                if (!empty($wishlist)) {
                                                                    echo number_format($sum, 0) . ' VND';
                                                                } else {
                                                                    echo 0;
                                                                };
                                                                ?></span>
        </div>
        <ul class="offcanvas-wishlist-action-button">
            <li><a href=" <?php echo _WEB_ROOT ?>/cart/wishlist" class="btn btn-block btn-golden">Đi tới wishlist</a></li>
        </ul>
    </div> <!-- End Offcanvas Mobile Menu Wrapper -->

</div> <!-- End Offcanvas Mobile Menu Section -->

<!-- Start Offcanvas Search Bar Section -->
<div id="search" class="search-modal">
    <button type="button" class="close">×</button>
    <form action="<?php echo _WEB_ROOT ?>/product/search" method="post">
        <input type="search" name="search" placeholder="Viết gì đó" />
        <button type="submit" class="btn btn-lg btn-golden">Tìm kiếm</button>
    </form>
</div>
<div class="offcanvas-overlay"></div>