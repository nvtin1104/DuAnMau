<div class="app-content pt-3 p-md-3 p-lg-4">
    <div class="container-xl">

        <h1 class="app-page-title">Sản phẩm</h1>
        <div class="row gy-4">
            <div class="col-12 col-lg-6">
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
                                <?php  if (!empty($success)) {
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
                        <div class="item border-bottom py-3">
                            <div class="row justify-content-between align-items-center">
                                <div class="col-auto">
                                    <div class="item-label mb-2"><strong>Ảnh</strong></div>
                                    <div class="d-flex">
                                        <?php 
                                        foreach ($img_product as $imgItem) {
                                            $filePath = $imgItem['img_dir'];
                                            $cleanedPath = substr($filePath, 2);
                                        ?>
                                            <div class="item-data"><img class="profile-image m-1" src="<?php  echo _WEB_ROOT . '/' . $cleanedPath ?>" alt=""></div>
                                        <?php 
                                        }
                                        ?>
                                    </div>
                                </div><!--//col-->
                            </div><!--//row-->
                        </div><!--//item-->
                        <form action="<?php  echo _WEB_ROOT ?>/admin/product/edit" method="post">
                            <form class="settings-form" action="<?php  echo _WEB_ROOT ?>/admin/product/add_product" method="post" enctype="multipart/form-data">
                                <div class="mb-3 form-floating">
                                    <input type="text" class="form-control" name="product_name" id="product_name" placeholder="Tên sản phẩm" value="<?php  echo $product_infor['product_name']; ?>">
                                    <label for="product_name" class="form-label">Tên sản phẩm</label>
                                    <?php  echo form_error('product_name', '<span style="color:red;">', '</span>'); ?>
                                </div>
                                <div class="mb-3 form-floating">
                                    <input type="text" class="form-control" name="made_in" id="made_in" placeholder="Nhà sản xuất..." value="<?php  echo $product_infor['made_in']; ?>">
                                    <label for="made_in" class="form-label">Nhà sản xuất</label>
                                    <?php  echo form_error('made_in', '<span style="color:red;">', '</span>'); ?>
                                </div>

                                <div class="mb-3 form-floating">
                                    <input type="text" class="form-control" name="form" id="form" placeholder="Kiểu dáng" value="<?php  echo $product_infor['form']; ?>">
                                    <label for="form" class="form-label">Kiểu dáng</label>
                                    <?php  echo form_error('form', '<span style="color:red;">', '</span>'); ?>
                                </div>
                                <div class="mb-3 form-floating">
                                    <input type="text" name="author" class="form-control" id="author" placeholder="Tác giả..." value="<?php  echo $product_infor['author']; ?>">
                                    <label for="author" class="form-label">Tác giả</label>
                                    <?php  echo form_error('author', '<span style="color:red;">', '</span>'); ?>
                                </div>
                                <div class="mb-3 form-floating">
                                    <input type="number" class="form-control" name="quantity" id="quantity" placeholder="Số lượng..." value="<?php  echo $product_infor['quantity']; ?>">
                                    <label for="quantity" class="form-label">Số lượng</label>
                                    <?php  echo form_error('quantity', '<span style="color:red;">', '</span>'); ?>

                                </div>
                                <div class="mb-3 form-floating">
                                    <input type="number" name="price" class="form-control" id="price" placeholder="Giá..." value="<?php  echo $product_infor['price']; ?>">
                                    <label for="price" class="form-label">Giá</label>
                                    <?php  echo form_error('price', '<span style="color:red;">', '</span>'); ?>
                                </div>
                                <div class="mb-3">
                                    <label for="policy" class="form-label">Cho phép đổi trả</label>
                                    <select name="policy" class="form-select" id="policy">
                                        <option value="true">Cho phép</option>
                                        <option value="false">Không</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="category" class="form-label">Phân loại:</label>
                                    <select name="category" class="form-select" id="category">
                                        <option value="<?php  echo $product_infor['category'] ?>">Mặc định</option>
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
                                    <textarea style="height: 200px;" type="text" name="description" class="form-control" id="description" placeholder="Mô tả..."><?php  echo $product_infor['description']; ?></textarea>
                                    <label for="description" class="form-label">Mô tả:</label>
                                    <?php  echo form_error('description', '<span style="color:red;">', '</span>'); ?>
                                </div>
                                <div class="mb-3 form-floating">
                                    <textarea style="height: 200px;" type="text" name="short_description" class="form-control" id="short_description" placeholder="Mô tả ngắn..."><?php  echo $product_infor['short_description']; ?></textarea>
                                    <label for="short_description" class="form-label">Mô tả ngắn:</label>
                                    <?php  echo form_error('short_description', '<span style="color:red;">', '</span>'); ?>
                                </div>
                                <div class="mb-3 form-floating">
                                    <textarea style="height: 200px;" type="text" name="specification" class="form-control" id="specification" placeholder="Chi tiết..."><?php  echo $product_infor['specification']; ?></textarea>
                                    <label for="specification" class="form-label">Chi tiết:</label>
                                    <?php  echo form_error('specification', '<span style="color:red;">', '</span>'); ?>
                                </div>
                                <input type="hidden" name="id" value="<?php  echo $product_infor['id']; ?>">
                                <button type="submit" class="btn btn-info text-white mb-2">Lưu</button>
                            </form>
                        </form>
                    </div><!--//app-card-body-->
                </div><!--//app-card-->
            </div><!--//col-->
            <div class="col-12 col-lg-6">
                <div class="app-card app-card-account shadow-sm d-flex flex-column align-items-start">
                    <div class="app-card-header p-3 border-bottom-0">
                        <div class="row align-items-center gx-3">
                            <div class="col-auto">
                                <div class="app-icon-holder">
                                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-sliders" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" d="M11.5 2a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3zM9.05 3a2.5 2.5 0 0 1 4.9 0H16v1h-2.05a2.5 2.5 0 0 1-4.9 0H0V3h9.05zM4.5 7a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3zM2.05 8a2.5 2.5 0 0 1 4.9 0H16v1H6.95a2.5 2.5 0 0 1-4.9 0H0V8h2.05zm9.45 4a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3zm-2.45 1a2.5 2.5 0 0 1 4.9 0H16v1h-2.05a2.5 2.5 0 0 1-4.9 0H0v-1h9.05z" />
                                    </svg>
                                </div><!--//icon-holder-->

                            </div><!--//col-->
                            <div class="col-auto">
                                <h4 class="app-card-title">Ảnh</h4>
                            </div><!--//col-->
                        </div><!--//row-->
                    </div><!--//app-card-header-->
                    <div class="app-card-body px-4 w-100">
                        <?php 
                        foreach ($img_product as $imgItem) {
                            $filePath = $imgItem['img_dir'];
                            $cleanedPath = substr($filePath, 2);
                        ?>
                            <div class="row justify-content-between align-items-center">
                                <div class="col-auto">
                                    <div class="item-data"><img class="profile-image " style="height: 60px; width: 60px;" src="<?php  echo _WEB_ROOT . '/' . $cleanedPath ?>" alt=""></div>
                                </div><!--//col-->
                                <div class="col text-end">
                                    <a class="btn-sm app-btn-secondary p-2" href="<?php  echo _WEB_ROOT . '/admin/product/edit_img?id=' . $imgItem['id'] ?>">Cập nhật</a>
                                </div><!--//col-->
                            </div><!--//row-->
                        <?php 
                        }
                        ?>
                    </div><!--//app-card-body-->
                    <div class="app-card-header p-3 border-bottom-0">
                        <div class="row align-items-center gx-3">
                            <div class="col-auto">
                                <div class="app-icon-holder">
                                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-sliders" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" d="M11.5 2a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3zM9.05 3a2.5 2.5 0 0 1 4.9 0H16v1h-2.05a2.5 2.5 0 0 1-4.9 0H0V3h9.05zM4.5 7a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3zM2.05 8a2.5 2.5 0 0 1 4.9 0H16v1H6.95a2.5 2.5 0 0 1-4.9 0H0V8h2.05zm9.45 4a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3zm-2.45 1a2.5 2.5 0 0 1 4.9 0H16v1h-2.05a2.5 2.5 0 0 1-4.9 0H0v-1h9.05z" />
                                    </svg>
                                </div><!--//icon-holder-->

                            </div><!--//col-->
                            <div class="col-auto">
                                <h4 class="app-card-title">Nhãn sản phẩm</h4>
                            </div><!--//col-->
                        </div><!--//row-->
                    </div><!--//app-card-header-->

                    <div class="app-card-body px-4 w-100">
                        <div class="item border-bottom py-3">
                            <div class="row justify-content-between align-items-center">
                                <div class="col-auto">
                                    <!-- <div class="item-data"><?php  echo $product_infor['label']; ?></div> -->
                                </div><!--//col-->
                            </div><!--//row-->
                        </div><!--//item-->
                        <form action="<?php  echo _WEB_ROOT . '/admin/product/edit_label' ?>" method="post">
                            <div class="accordion accordion-flush" id="accordionFlushExample">
                                <?php 
                                if (!empty($label_group)) {
                                    foreach ($label_group as $item) { ?>
                                        <div class="accordion-item">
                                            <h2 class="accordion-header">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse<?php  echo $item['id'] ?>" aria-expanded="false" aria-controls="flush-collapse<?php  echo $item['id'] ?>">
                                                    <?php  echo $item['group_name'] ?>
                                                </button>
                                            </h2>
                                            <div id="flush-collapse<?php  echo $item['id'] ?>" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                                                <?php 
                                                foreach ($label as $item_label) {
                                                    if ($item_label['id_group'] == $item['id']) { ?>
                                                        <div class="form-check m-4">
                                                            <input class="form-check-input" name="label[]" value="<?php  echo $item_label['id'] ?>" type="checkbox" id="label<?php  echo $item_label['id'] ?>">
                                                            <label class="form-check-label" for="label<?php  echo $item_label['id'] ?>">
                                                                <?php  echo $item_label['label_name'] ?>
                                                            </label>
                                                        </div>
                                                <?php  }
                                                }
                                                ?>
                                            </div>
                                        </div>
                                <?php  }
                                } ?>
                            </div>
                            <input type="hidden" name="id" value="<?php  echo $product_infor['id'] ?>">
                            <button type="submit" class="btn btn-info text-white m-2">Cập nhật</button>
                        </form>
                    </div><!--//app-card-body-->
                </div><!--//app-card-->

            </div><!--//col-->
        </div><!--//row-->

    </div><!--//container-fluid-->
</div><!--//app-content-->