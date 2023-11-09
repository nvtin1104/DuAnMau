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
                        <h3 class="text-center">Thay đổi email</h3>
                        <form action="handle_change_email" method="post">
                            <?php echo form_error('token', '<span style="color:red;">', '</span>'); ?>

                            <div class="default-form-box">
                                <label for="value">Mã xác nhận email cũ<span>*</span></label>
                                <input type="text" name="token" placeholder="Nhập mã xác nhận...">
                            </div>
                            <?php echo form_error('email', '<span style="color:red;">', '</span>'); ?>

                            <div class="default-form-box">
                                <label for="value">Email mới<span>*</span></label>
                                <input type="text" name="email" value="<?php echo $data['email'] ?>">
                                <input type="hidden" name="id" value="<?php echo $data['id'] ?>">
                            </div>
                            <div class="login_submit">
                                <button class="btn btn-md btn-black-default-hover mb-4" type="submit">Thay đổi email</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>