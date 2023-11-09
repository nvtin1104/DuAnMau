<div class="app-content pt-3 p-md-3 p-lg-4">
    <div class="container mt-5 mb-5">
        <h4> Chỉnh sửa nhóm nhãn</h4>
        <form method="post" action="<?php echo _WEB_ROOT ?>/admin/label/handle_edit_group">
            <div class="mb-3">
                <label for="label_group" class="form-label">Tên nhóm sản phẩm:</label>
                <input type="text" id="group_name" name="group_name" value="<?php echo $group_data['group_name']; ?>" class="form-control  p-2" required>
                <?php echo form_error('group_name', '<span style="color:red;">', '</span>'); ?>
            </div>
            <div class="mb-3">
                <select name="category_group" class="form-select" id="category_group">
                    <option value="orther_product">Sản phẩm khác</option>
                    <option value="book_product">Sách</option>
                </select>
                <?php echo form_error('group_name', '<span style="color:red;">', '</span>'); ?>
                <?php if (!empty($success)) {
                    echo '<span style="color:green;">' . $success . '</span>';
                } ?>
            </div>
            <input type="hidden" name="id" value="<?php echo $group_data['id']; ?>">
            <button type="submit" class="btn btn-primary">Thêm nhóm</button>
        </form>
    </div>
    <div class="container-xl">
        <div class="tab-content" id="orders-table-tab-content">
            <div class="tab-pane fade show active" id="orders-all" role="tabpanel" aria-labelledby="orders-all-tab">
                <div class="app-card app-card-orders-table shadow-sm mb-5">
                    <div class="app-card-body">
                        <div class="table-responsive">
                            <table class="table app-table-hover mb-0 text-left">
                                <thead>
                                    <tr>
                                        <th class="cell">ID</th>
                                        <th class="cell">Tên Nhãn</th>
                                        <th class="cell">Nhóm</th>
                                        <th class="cell">Ngày Tạo</th>
                                        <th class="cell"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php

                                    if (!empty($list_label)) {
                                        foreach ($list_label as $item) { ?>
                                            <tr>
                                                <td class="cell"><?php echo $item['id'] ?></td>
                                                <td class="cell"><span class="truncate"><?php echo $item['label_name'] ?></span></td>
                                                <td class="cell"><?php echo $item['create_at'] ?></td>
                                                <td class="cell">
                                                    <a class="btn btn-sm btn-secondary app-btn-secondary" href="<?php echo _WEB_ROOT . '/admin/label/view_edit_labels?id=' . $item['id']; ?>">Edit</a>
                                                    <a class="btn btn-sm btn-secondary app-btn-secondary" href="<?php echo _WEB_ROOT . '/admin/label/deleteLabel?id=' . $item['id']; ?>">Delete</a>
                                                </td>
                                            </tr>
                                    <?php }
                                    } ?>


                                </tbody>
                            </table>
                        </div><!--//table-responsive-->

                    </div><!--//app-card-body-->
                </div><!--//app-card-->
            </div><!--//tab-pane-->
        </div>
    </div>
</div>