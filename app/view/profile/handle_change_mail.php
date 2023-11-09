<div class="breadcrumb-section breadcrumb-bg-color--golden">
    <div class="breadcrumb-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h3 class="breadcrumb-title">Thay đổi email</h3>
                    <div class="breadcrumb-nav breadcrumb-nav-color--black breadcrumb-nav-hover-color--golden">
                        <nav aria-label="breadcrumb">
                            <ul>
                                <li><a href="home">Trang chủ</a></li>
                                <li class="active" aria-current="page">Thay đổi email</li>
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
                        <h3 class="text-center">Nhập mã xác nhận:</h3>
                        <form>
                            <div class="default-form-box">
                                <label for="value">Mã xác nhận<span>*</span></label>
                                <input type="text" id="token" placeholder="Nhập mã xác nhận...">
                                <input type="hidden" id="user_id" value="<?php echo $id ?>">
                                <input type="hidden" id="email" value="<?php echo $email ?>">
                                <input type="hidden" id="path" value="<?php echo _WEB_ROOT ?>">
                            </div>
                            <div class="login_submit">
                                <button class="btn btn-md btn-black-default-hover mb-4" id="cfMail">Xác nhận thay đổi</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>