<div class="app-content pt-3 p-md-3 p-lg-4">
    <div class="container-xl">
        <h1 class="app-page-title">Thêm sản phẩm </h1>
        <hr class="mb-4">
        <div class="row g-4 settings-section">
            <div class="col-12 col-md-9">
                <div class="app-card app-card-settings shadow-sm p-4">
                    <div class="app-card-body">
                        <form class="settings-form" action="<?php echo _WEB_ROOT ?>/admin/product/add_product" method="post" enctype="multipart/form-data">
                            <div class="mb-3 form-floating">
                                <input type="text" class="form-control" name="product_name" id="product_name" placeholder="Tên sản phẩm" value="<?php echo old_data('product_name', '') ?>">
                                <label for="product_name" class="form-label">Tên sản phẩm</label>
                                <?php echo form_error('product_name', '<span style="color:red;">', '</span>'); ?>
                            </div>
                            <div class="mb-3 form-floating">
                                <input type="text" class="form-control" name="made_in" id="made_in" placeholder="Nhà sản xuất..." value="<?php echo old_data('made_in', '') ?>">
                                <label for="made_in" class="form-label">Nhà sản xuất</label>
                                <?php echo form_error('made_in', '<span style="color:red;">', '</span>'); ?>
                            </div>

                            <div class="mb-3 form-floating">
                                <input type="text" class="form-control" name="form" id="form" placeholder="Kiểu dáng" value="<?php echo old_data('form', '') ?>">
                                <label for="form" class="form-label">Kiểu dáng</label>
                                <?php echo form_error('form', '<span style="color:red;">', '</span>'); ?>
                            </div>
                            <div class="mb-3 form-floating">
                                <input type="text" name="author" class="form-control" id="author" placeholder="Tác giả..." value="<?php echo old_data('author', '') ?>">
                                <label for="author" class="form-label">Tác giả</label>
                                <?php echo form_error('author', '<span style="color:red;">', '</span>'); ?>
                            </div>
                            <div class="accordion accordion-flush" id="accordionFlushExample">
                               
                                <label for="" class="form-label">Nhãn sản phẩm</label>
                                <br>
                                <?php echo form_error('label_check', '<span style="color:red;">', '</span>'); ?>
                                <?
                                if (!empty($label_group)) {
                                    foreach ($label_group as $item) { ?>
                                        <div class="accordion-item">
                                            <h2 class="accordion-header">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse<?php echo $item['id'] ?>" aria-expanded="false" aria-controls="flush-collapse<?php echo $item['id'] ?>">
                                                    <?php echo $item['group_name'] ?>
                                                </button>
                                            </h2>
                                            <div id="flush-collapse<?php echo $item['id'] ?>" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                                                <?
                                                foreach ($label as $item_label) {
                                                    if ($item_label['id_group'] == $item['id']) { ?>
                                                        <div class="form-check m-4">
                                                            <input class="form-check-input" name="label[]" value="<?php echo $item_label['id'] ?>" type="checkbox" id="label<?php echo $item_label['id'] ?>">
                                                            <label class="form-check-label" for="label<?php echo $item_label['id'] ?>">
                                                                <?php echo $item_label['label_name'] ?>
                                                            </label>
                                                        </div>
                                                <?php }
                                                }
                                                ?>
                                            </div>
                                        </div>
                                <?php }
                                } ?>
                            </div>
                            <div class="mb-3 form-floating">
                                <input type="number" class="form-control" name="quantity" id="quantity" placeholder="Số lượng..." value="<?php echo old_data('quantity', '') ?>">
                                <label for="quantity" class="form-label">Số lượng</label>
                                <?php echo form_error('quantity', '<span style="color:red;">', '</span>'); ?>

                            </div>
                            <div class="mb-3 form-floating">
                                <input type="number" name="price" class="form-control" id="price" placeholder="Giá..." value="<?php echo old_data('price', '') ?>">
                                <label for="price" class="form-label">Giá</label>
                                <?php echo form_error('price', '<span style="color:red;">', '</span>'); ?>
                            </div>
                            <div class="mb-3">
                                <label for="policy" class="form-label">Cho phép đổi trả</label>
                                <select name="policy" class="form-select" id="policy">
                                    <option value="true">Cho phép</option>
                                    <option value="false">Không</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="category" class="form-label">Phân loại</label>
                                <select name="category" class="form-select" id="category">
                                    <option value="book_product">Sách / VPP</option>
                                    <option value="other_product">Sản phẩm khác</option>
                                </select>
                            </div>
                            <div class="mb-3 ">
                                <label for="sale" class="form-label">Giảm giá:</label>
                                <select name="sale" class="form-select" id="sale">
                                    <option value="false">Không</option>
                                    <option value="true">Sale</option>
                                </select>
                            </div>
                            <div class="mb-3 form-floating">
                                <textarea style="height: 200px;" type="text" name="description" class="form-control" id="description" placeholder="Mô tả..."><?php echo old_data('description', '') ?></textarea>
                                <label for="description" class="form-label">Mô tả:</label>
                                <?php echo form_error('description', '<span style="color:red;">', '</span>'); ?>
                            </div>
                            <div class="mb-3 form-floating">
                                <textarea style="height: 200px;" type="text" name="short_description" class="form-control" id="short_description" placeholder="Mô tả ngắn..."><?php echo old_data('short_description', '') ?></textarea>
                                <label for="short_description" class="form-label">Mô tả ngắn:</label>
                                <?php echo form_error('short_description', '<span style="color:red;">', '</span>'); ?>
                            </div>
                            <div class="mb-3 form-floating">
                                <textarea style="height: 200px;" type="text" name="specification" class="form-control" id="specification" placeholder="Chi tiết..."><?php echo old_data('specification', '') ?></textarea>
                                <label for="specification" class="form-label">Chi tiết:</label>
                                <?php echo form_error('specification', '<span style="color:red;">', '</span>'); ?>
                            </div>
                            <div class="mb-3">

                                <div class="d-flex">
                                    <img id="preview_img_1" src="#" alt="Preview Image" style="width: 100px; height: 100px; display: none;">
                                    <img id="preview_img_2" src="#" alt="Preview Image" style="width: 100px; height: 100px; display: none;">
                                    <img id="preview_img_3" src="#" alt="Preview Image" style="width: 100px; height: 100px; display: none;">
                                    <img id="preview_img_4" src="#" alt="Preview Image" style="width: 100px; height: 100px; display: none;">
                                </div>
                                <?php if (!empty($error_upload)) {
                                    echo '<span style="color:red;">' . $error_upload . '</span>';
                                } ?>
                                <input type="file" name="img_1" class="form-control" id="img_1" accept="image/*" onchange="previewImage(this, 'preview_img_1')">

                                <input type="file" name="img_2" class="form-control" id="img_2" accept="image/*" onchange="previewImage(this, 'preview_img_2')">

                                <input type="file" name="img_3" class="form-control" id="img_3" accept="image/*" onchange="previewImage(this, 'preview_img_3')">

                                <input type="file" name="img_4" class="form-control" id="img_4" accept="image/*" onchange="previewImage(this, 'preview_img_4')">
                            </div>
                            <button type="submit" class="btn app-btn-primary">Thêm sản phẩm</button>
                        </form>
                    </div><!--//app-card-body-->

                </div><!--//app-card-->
            </div>
            <div class="col-12 col-md-3">
                <h3 class="section-title">Ghi chú:</h3>
                <div class="section-intro">Nhớ thêm đầy đủ và chi tiết nhé!<br><a href="help.html">Xem thêm</a></div>
                <div>
                    <?php if (!empty($success)) {
                        echo '<span style="color:green;">' . $success . '</span>';
                    }
                    if (!empty($error)) {
                        echo '<span style="color:red;">' . $error . '</span>';
                    }
                    ?>
                </div>
            </div>

        </div><!--//row-->
    </div>