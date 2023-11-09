<div class="breadcrumb-section breadcrumb-bg-color--golden">
    <div class="breadcrumb-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h3 class="breadcrumb-title">Thay đổi mật khẩu</h3>
                    <div class="breadcrumb-nav breadcrumb-nav-color--black breadcrumb-nav-hover-color--golden">
                        <nav aria-label="breadcrumb">
                            <ul>
                                <li><a href="home">Trang chủ</a></li>
                                <li class="active" aria-current="page">Thay đổi mật khẩu</li>
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
            <div class="col-lg-12 col-md-12">
                <div class="col-lg-6 col-md-6 m-auto">
                    <div class="account_form" data-aos="fade-up" data-aos-delay="0">
                        <h3 class="text-center">Thay đổi mật khẩu</h3>
                        <form>

                            <div class="default-form-box">
                                <label for="password">Mật khẩu cũ<span>*</span></label>
                                <input type="password" id="password" name="password" placeholder="Mật khẩu..." autocomplete="current-password">
                            </div>

                            <div class="default-form-box">
                                <label for="new-password">Mật khẩu mới<span>*</span></label>
                                <input type="password" id="new-password" name="new-password" placeholder="Mật khẩu mới..." autocomplete="new-password">
                            </div>

                            <div class="default-form-box">
                                <label for="cf-password">Xác nhận mật khẩu mới<span>*</span></label>
                                <input type="password" id="cf-password" name="cf-password" placeholder="Xác nhận mật khẩu..." autocomplete="new-password">
                            </div>

                            <input type="hidden" id="id" value="<?php echo $data['id'] ?>">
                            <input type="hidden" id="path" value="<?php echo _WEB_ROOT ?>">

                            <div class="login_submit">
                                <button class="btn btn-md btn-black-default-hover mb-4" id="btnChangePass">Thay đổi email</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>