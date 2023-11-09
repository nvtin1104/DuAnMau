<h4> Chỉnh sửa nhóm nhãn</h4>
<form method="post" action="<?php echo _WEB_ROOT; ?>/admin/label/edit_label">
    <!-- Display validation errors, if any -->
    <div class="form-group">
        <label for="group_name">Tên nhãn:</label>
        <input type="text" id="label_name" name="label_name" value="<?php echo $group_data['label_name']; ?>" class="form-control" required>
        <input type="hidden" name="id" value="<?php echo $group_data['id']; ?>">
        <div class="mb-3">
                <label for="id_group" class="form-label">Nhóm:</label>
                <select name="id_group" class="form-select" id="id_group">
                    <?php
                    foreach ($label_group as $item) { ?>
                        <option value="<?php echo $item['id'] ?>"><?php echo $item['group_name'] ?></option>
                    <?php } ?>
                </select>
            </div>
    </div>
    <div class="form-group">
        <button type="submit" class="btn btn-primary">Lưu thông tin</button>
    </div>
</form>