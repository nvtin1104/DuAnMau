<div class="breadcrumb-section breadcrumb-bg-color--golden">
    <div class="breadcrumb-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h3 class="breadcrumb-title">Tài khoản</h3>
                    <div class="breadcrumb-nav breadcrumb-nav-color--black breadcrumb-nav-hover-color--golden">
                        <nav aria-label="breadcrumb">
                            <ul>
                                <li><a href="<?php echo _WEB_ROOT ?>/home">Trang chủ</a></li>
                                <li class="active" aria-current="page">Tài khoản</li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> <!-- ...:::: End Breadcrumb Section:::... -->

<!-- ...:::: Start Customer Login Section :::... -->
<div class="customer-login">
    <div class="container">
        <div class="row">
            <!--login area start-->
            <div class="col-lg-6 col-md-6">
                <div class="account_form" data-aos="fade-up" data-aos-delay="0">
                    <h3>Đăng nhập</h3>
                    <form>
                        <div class="default-form-box">
                            <label for="username">Tên đăng nhập<span>*</span></label>
                            <input type="text" name="username" id="username-login" placeholder="Tên đăng nhập...">
                        </div>
                        <div class="default-form-box">
                            <label for="password">Mật khẩu<span>*</span></label>
                            <input type="password" id="password-login" name="password" placeholder="Mật khẩu...">
                        </div>
                        <div class="login_submit">
                            <button class="btn btn-md btn-black-default-hover mb-4" id="loginBtn" type="submit">Đăng nhập</button>
                            <label class="checkbox-default mb-4" for="offer">
                                <input type="checkbox" id="offer">
                                <span>Nhớ mật khẩu</span>
                            </label>
                            <a href="<?php echo _WEB_ROOT . '/auth/quen-mat-khau' ?>">Quên mật khẩu?</a>
                        </div>
                    </form>
                </div>
            </div>
            <!--login area start-->

            <!--register area start-->
            <div class="col-lg-6 col-md-6">
                <div class="account_form register" data-aos="fade-up" data-aos-delay="200">
                    <h3>Đăng ký</h3>
                    <form>
                        <div class="default-form-box">
                            <label for="username">Tên đăng nhập<span>*</span></label>
                            <input type="text" name="username" id="username" placeholder="Tên đăng nhập...">
                        </div>
                        <div class="default-form-box">
                            <label for="email">Email<span>*</span></label>
                            <input type="text" name="email" id="email" placeholder="Email...">
                        </div>
                        <div class="default-form-box">
                            <label for="password">Mật khẩu<span>*</span></label>
                            <input type="password" id="password" name="password" placeholder="Mật khẩu...">
                        </div>
                        <div class="login_submit">
                            <button class="btn btn-md btn-black-default-hover" id="registerBtn" type="submit">Đăng ký</button>
                        </div>
                    </form>
                </div>
            </div>
            <!--register area end-->
        </div>
    </div>
</div>