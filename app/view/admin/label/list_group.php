<div class="app-content pt-3 p-md-3 p-lg-4">
    <div class="container mt-5">
        <form method="post" action=" <?php  echo _WEB_ROOT ?>/admin/label/add_group">
            <div class="mb-3">
                <label for="label_group" class="form-label">Tên nhóm sản phẩm:</label>
                <input type="text" class="form-control" id="label_group" name="group_name" placeholder="Tên nhóm sản phẩm">
                 <?php  echo form_error('group_name', '<span style="color:red;">', '</span>'); ?>
            </div>
            <div class="mb-3">
                <select name="category_group" class="form-select" id="category_group">
                    <option value="orther_product">Sản phẩm khác</option>
                    <option value="book_product">Sách</option>
                    <option value="sale">Sale</option>
                </select>
                 <?php  echo form_error('group_name', '<span style="color:red;">', '</span>'); ?>
                 <?php  if (!empty($success)) {
                    echo '<span style="color:green;">' . $success . '</span>';
                } ?>
            </div>
            <button type="submit" class="btn btn-primary">Thêm nhóm</button>
        </form>
    </div>
    <div class="container-xl">

        <div class="row g-3 mb-4 align-items-center justify-content-between">
            <div class="col-auto">
                <h1 class="app-page-title mb-0">Danh sách nhóm sản phẩm</h1>
            </div>
            <div class="col-auto">
                <div class="page-utilities">
                    <div class="row g-2 justify-content-start justify-content-md-end align-items-center">
                        <div class="col-auto">
                            <form class="table-search-form row gx-1 align-items-center">
                                <div class="col-auto">
                                    <input type="text" id="search-orders" name="searchorders" class="form-control  search-orders" placeholder="Tìm gì đó...">
                                </div>
                                <div class="col-auto">
                                    <button type="submit" class="btn app-btn-secondary"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                            <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                                        </svg></button>
                                </div>
                            </form>

                        </div><!--//col-->
                        <div class="col-auto">

                            <select class="form-select w-auto">
                                <option selected value="option-1">All</option>
                                <option value="option-2">This week</option>
                                <option value="option-3">This month</option>
                                <option value="option-4">Last 3 months</option>

                            </select>
                        </div>
                        <div class="col-auto">
                            <a class="btn app-btn-secondary" href=" <?php  echo _WEB_ROOT ?>/admin/label/add">
                                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-download me-1" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z" />
                                    <path fill-rule="evenodd" d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z" />
                                </svg>
                                Thêm Label
                            </a>
                        </div>
                    </div><!--//row-->
                </div><!--//table-utilities-->
            </div><!--//col-auto-->
        </div><!--//row-->

        <div class="tab-content" id="orders-table-tab-content">
            <div class="tab-pane fade show active" id="orders-all" role="tabpanel" aria-labelledby="orders-all-tab">
                <div class="app-card app-card-orders-table shadow-sm mb-5">
                    <div class="app-card-body">
                        <div class="table-responsive">
                            <table class="table app-table-hover mb-0 text-left">
                                <thead>
                                    <tr>
                                        <th class="cell">Id</th>
                                        <th class="cell">Tên nhóm</th>
                                        <th class="cell">Phân loại</th>
                                        <th class="cell">Create At</th>
                                        <th class="cell"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                     <?php 
                                    if (!empty($list)) {
                                        foreach ($list as $item) { ?>
                                            <tr>
                                                <td class="cell"> <?php  echo $item['id'] ?></td>
                                                <td class="cell"><span class="truncate"> <?php  echo $item['group_name'] ?></span></td>
                                                <td class="cell"><span class="truncate"> <?php  echo $item['category_group'] ?></span></td>
                                                <td class="cell"> <?php  echo $item['create_at'] ?></td>
                                                <td class="cell">
                                                    <a class="btn btn-sm btn-secondary app-btn-secondary" href=" <?php  echo _WEB_ROOT . '/admin/label/edit_label_group?id=' . $item['id']; ?>">Edit</a>
                                                    <a class="btn btn-sm btn-secondary app-btn-secondary" href=" <?php  echo _WEB_ROOT . '/admin/label/deleteLabelGrup?id=' . $item['id']; ?>">Delete</a>
                                                </td>
                                            </tr>
                                     <?php  }
                                    } ?>
                                </tbody>
                            </table>
                        </div><!--//table-responsive-->

                    </div><!--//app-card-body-->
                </div><!--//app-card-->
                 <?php 
                $next = $page + 1;
                $pre = $page - 1;
                ?>
                <nav class="app-pagination">
                    <ul class="pagination justify-content-center">
                        <li class="page-item  <?php 
                                                if ($page == 1) {
                                                    echo 'disabled';
                                                }
                                                ?>">
                            <a class="page-link" href=" <?php  echo _WEB_ROOT . '/admin/label/label_group?page=1' ?>" tabindex="-1" aria-disabled="true">Đầu</a>
                        </li>
                        <li class="page-item  <?php 
                                                if ($pre == 0) {
                                                    echo 'disabled';
                                                }
                                                ?>">
                            <a class="page-link" href=" <?php  echo _WEB_ROOT . '/admin/label/label_group?page=' . $pre ?>" tabindex="-1" aria-disabled="true">Trước</a>
                        </li>
                        <li class="page-item active"><a class="page-link" href=" <?php  echo _WEB_ROOT . '/admin/label/label_group?page=' . $page ?>"> <?php  echo $page ?></a></li>
                        <li class="page-item">
                            <a class="page-link  <?php 
                                                if ($page == $maxPage) {
                                                    echo 'disabled';
                                                }
                                                ?>" href=" <?php  echo _WEB_ROOT . '/admin/label/label_group?page=' . $next ?>">Tiếp</a>
                        </li>
                        <li class="page-item">
                            <a class="page-link  <?php 
                                                if ($page == $maxPage) {
                                                    echo 'disabled';
                                                }
                                                ?>" href=" <?php  echo _WEB_ROOT . '/admin/label/label_group?page=' . $maxPage ?>">Cuối</a>
                        </li>
                    </ul>
                </nav><!--//app-pagination-->
            </div><!--//tab-pane-->
        </div><!--//tab-content-->
    </div><!--//container-fluid-->
</div><!--//app-content-->