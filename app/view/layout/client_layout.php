<!DOCTYPE html>
<html lang="zxx">


<meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>

        <?php
        if (!empty($page_title)) {
            echo $page_title;
        } else {
            echo 'BookShop';
        }
        ?>
    </title>

    <!-- ::::::::::::::Favicon icon::::::::::::::-->
    <link rel="shortcut icon" href="<?php echo _WEB_ROOT ?>/public/assets/client/images/favicon.ico" type="image/png">


    <!-- Use the minified version files listed below for better performance and remove the files listed above -->
    <link rel="stylesheet" href="<?php echo _WEB_ROOT ?>/public/assets/client/css/vendor/vendor.min.css">
    <link rel="stylesheet" href="<?php echo _WEB_ROOT ?>/public/assets/client/css/plugins/plugins.min.css">
    <link rel="stylesheet" href="<?php echo _WEB_ROOT ?>/public/assets/client/css/style.min.css">
    <link rel="stylesheet" href="<?php echo _WEB_ROOT ?>/public/assets/client/css/custom.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <div id="bg_loading">
        <div class="load-div one"></div>
        <div class="load-div two"></div>
        <div class="load-div three"></div>
        <div class="load-div four"></div>
        <div class="load-div five"></div>
    </div>
    <?php
    if (!empty($user_infor)) {
        $this->render('blocks/header', $user_infor);
    } else  $this->render('blocks/header');
    $this->render($content, $sub_content);
    $this->render('blocks/footer');
    ?>
    <button class="material-scrolltop" type="button"></button>

    <!-- Start Modal Add cart -->
    <div class="modal fade" id="modalAddcart" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog  modal-dialog-centered modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col text-right">
                                <button type="button" class="close modal-close" data-bs-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true"> <i class="fa fa-times"></i></span>
                                </button>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-7">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="modal-add-cart-product-img">
                                            <img class="img-fluid" src="<?php echo _WEB_ROOT ?>/public/assets/client/images/product/default/home-1/default-1.jpg" alt="">
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="modal-add-cart-info"><i class="fa fa-check-square"></i>Added to cart
                                            successfully!</div>
                                        <div class="modal-add-cart-product-cart-buttons">
                                            <a href="cart.html">View Cart</a>
                                            <a href="checkout.html">Checkout</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-5 modal-border">
                                <ul class="modal-add-cart-product-shipping-info">
                                    <li> <strong><i class="icon-shopping-cart"></i> There Are 5 Items In Your
                                            Cart.</strong></li>
                                    <li> <strong>TOTAL PRICE: </strong> <span>$187.00</span></li>
                                    <li class="modal-continue-button"><a href="#" data-bs-dismiss="modal">CONTINUE
                                            SHOPPING</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- End Modal Add cart -->

    <!-- Start Modal Quickview cart -->

    <!-- End Modal Quickview cart -->
    <!-- Use the minified version files listed below for better performance and remove the files listed above -->
    <script src="<?php echo _WEB_ROOT ?>/public/assets/client/js/vendor/vendor.min.js"></script>
    <script src="<?php echo _WEB_ROOT ?>/public/assets/client/js/plugins/plugins.min.js"></script>
    <!-- Main JS -->
    <script src="<?php echo _WEB_ROOT ?>/public/assets/client/js/main.js"></script>
    <!-- <script src="<?php echo _WEB_ROOT ?>/public/lib/node_modules/jquery/dist/jquery.min.js"></script> -->
    <script>
        $(document).ready(function() {
            $('#bg_loading').hide();
            $("#registerBtn").click(function(event) {
                event.preventDefault();
                var username = $("#username").val();
                var password = $("#password").val();
                var email = $("#email").val();

                $.ajax({
                    type: "POST",
                    url: "<?php echo _WEB_ROOT ?>/auth/register",
                    data: {
                        username: username,
                        password: password,
                        email: email
                    },
                    dataType: "json", // Loại dữ liệu mà bạn mong đợi từ máy chủ
                    beforeSend: function() {
                        // Thêm hiệu ứng loading tại đây (ví dụ: hiển thị một biểu tượng loading)
                        $("#bg_loading").show();
                    },
                    success: function(response) {
                        $("#bg_loading").hide();
                        if (response.error) {
                            // Hiển thị thông báo lỗi
                            alert(response.error);
                        } else if (response.success) {
                            // Hiển thị thông báo thành công
                            alert(response.success);
                        }
                    },
                    error: function(xhr, status, error) {
                        $("#bg_loading").hide();
                        // Xử lý lỗi AJAX (nếu có)
                        console.error("Lỗi AJAX: " + status + " - " + error);
                    }
                });
            });
            $("#loginBtn").click(function(event) {
                event.preventDefault();
                var username = $("#username-login").val();
                var password = $("#password-login").val();

                $.ajax({
                    type: "POST",
                    url: "<?php echo _WEB_ROOT ?>/auth/login",
                    data: {
                        username: username,
                        password: password
                    },
                    dataType: "json", // Loại dữ liệu mà bạn mong đợi từ máy chủ
                    beforeSend: function() {
                        // Thêm hiệu ứng loading tại đây (ví dụ: hiển thị một biểu tượng loading)
                        $("#bg_loading").show();
                    },
                    success: function(response) {
                        $("#bg_loading").hide();
                        if (response.error) {
                            // Hiển thị thông báo lỗi
                            alert(response.error);
                        } else if (response.success) {
                            // Hiển thị thông báo thành công
                            alert(response.success);
                            window.location.href = "<?php echo _WEB_ROOT ?>/home";
                        } else if (response.log) {
                            // Hiển thị thông báo thành công
                            console.log(response.log);
                        }
                    },
                    error: function(xhr, status, error) {
                        $("#bg_loading").hide();
                        // Xử lý lỗi AJAX (nếu có)
                        console.error("Lỗi AJAX: " + status + " - " + error);
                    }
                });
            });
            $("#cfMail").click(function(event) {
                event.preventDefault();
                var token = $("#token").val();
                var email = $("#email").val();
                var path = $("#path").val();
                var id = $("#user_id").val();
                $.ajax({
                    type: "POST",
                    url: "<?php echo _WEB_ROOT ?>/Profile/cf_change_email",
                    data: {
                        token: token,
                        user_id: id,
                        email: email
                    },
                    dataType: "json", // Loại dữ liệu mà bạn mong đợi từ máy chủ
                    beforeSend: function () {
                        // Thêm hiệu ứng loading tại đây (ví dụ: hiển thị một biểu tượng loading)
                        $("#bg_loading").show();
                    },
                    success: function (response) {
                        $("#bg_loading").hide();
                        if (response.error) {
                            // Hiển thị thông báo lỗi
                            alert(response.error);
                        } else if (response.success) {
                            // Hiển thị thông báo thành công
                            alert(response.success);
                            window.location.href = "<?php echo _WEB_ROOT ?>/quan-ly-tai-khoan";
                        } else if (response.log) {
                            // Hiển thị thông báo thành công
                            console.log(response.log);
                        }
                    },
                    error: function (xhr, status, error) {
                        $("#bg_loading").hide();
                        // Xử lý lỗi AJAX (nếu có)
                        console.error("Lỗi AJAX: " + status + " - " + error);
                    }
                });
            });
        });
        // Toast function
    </script>
    <?php
    if ($content == 'products/detail') {
        echo '<script src="' . _WEB_ROOT . '/public/assets/client/js/product.js"></script>';
    } elseif ($content == 'cart/checkout') {
        echo '<script src="' . _WEB_ROOT . '/public/assets/client/js/checkout.js"></script>';
    } else {
        echo '<script src="' . _WEB_ROOT . '/public/assets/client/js/cart.js"></script>';
    };

    ?>
    <script type="text/javascript" src="<?php echo _WEB_ROOT ?>/public/assets/client/js/account.js"></script>


</body>

</html>