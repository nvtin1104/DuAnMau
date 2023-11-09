<div class="app-content pt-3 p-md-3 p-lg-4">
    <div class="container-xl">

        <h1 class="app-page-title">Sản phẩm</h1>
        <div class="row gy-4">
            <div class="col-12">
                <div class="app-card app-card-account shadow-sm d-flex flex-column align-items-start">
                    <div class="app-card-header p-3 border-bottom-0">
                        <div class="row align-items-center gx-3">
                            <div class="col-auto">
                                <div class="app-icon-holder">
                                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-person" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" d="M10 5a2 2 0 1 1-4 0 2 2 0 0 1 4 0zM8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm6 5c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z" />
                                    </svg>
                                </div><!--//icon-holder-->

                            </div><!--//col-->
                            <div class="col-auto">
                                <h4 class="app-card-title">Thông tin sản phẩm</h4>
                                <?php if (!empty($success)) {
                                    echo '<span style="color:green;">' . $success . '</span>';
                                }
                                if (!empty($error)) {
                                    echo '<span style="color:red;">' . $error . '</span>';
                                }
                                ?>
                            </div><!--//col-->
                        </div><!--//row-->
                    </div><!--//app-card-header-->

                    <div class="app-card-body px-4 w-100">
                        <div class="item py-3">
                            <div class="row justify-content-between align-items-center">
                                <div class="col-auto">
                                    <div class="item-label mb-2"><strong>Ảnh</strong></div>
                                    <div class="d-flex">
                                        <?
                                        $filePath = $img_product['img_dir'];
                                        $cleanedPath = substr($filePath, 2);
                                        ?>
                                        <div class="item-data"><img class="profile-image m-1" src="<?php echo _WEB_ROOT . '/' . $cleanedPath ?>" alt=""></div>
                                    </div>
                                </div><!--//col-->
                            </div><!--//row-->
                        </div><!--//item-->
                        <form class="settings-form" action="<?php echo _WEB_ROOT ?>/admin/product/handle_edit_img" method="post" enctype="multipart/form-data">
                            <div class="mb-3 form-floating">
                                <input type="text" class="form-control" name="alt" id="alt" placeholder="Alt" value="<?php echo $img_product['alt']; ?>">
                                <label for="alt" class="form-label">Alt</label>
                                <?php echo form_error('alt', '<span style="color:red;">', '</span>'); ?>
                            </div>
                            <div class="mb-3 form-floating">
                                <input type="text" class="form-control" name="link" id="link" placeholder="Link..." value="<?php echo $img_product['link']; ?>">
                                <label for="link" class="form-label">Link</label>
                                <?php echo form_error('link', '<span style="color:red;">', '</span>'); ?>
                            </div>
                            <input type="file" name="img" class="form-control">
                            <input type="hidden" name="id" value="<?php echo $img_product['id']; ?>">
                            <input type="hidden" name="product_id" value="<?php echo $img_product['product_id']; ?>">
                            <button type="submit" class="btn btn-info text-white mb-2">Lưu</button>
                        </form>
                    </div><!--//app-card-body-->
                </div><!--//app-card-->
            </div><!--//col-->
        </div><!--//row-->

    </div><!--//container-fluid-->
</div><!--//app-content-->