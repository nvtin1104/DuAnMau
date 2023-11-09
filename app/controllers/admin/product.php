<?php
class Product extends Controller
{
    public $product_model, $data, $request, $response, $session;
    public function __construct()
    {
        $this->product_model = $this->model('ProductModel');
        $this->request = new Request();
        $this->response = new Response();
        $this->session = new Session();
    }
    function index()
    {
        if ($this->request->isGet()) {
            $limit = 10;
            $result = $this->request->getFields();
            if (!empty($result)) {
                $page = $result['page'];
                $offset = ($page - 1) * $limit;
            } else {
                $page = 1;
                $offset = 0;
            }
            $countRow = $this->product_model->getCount('products');
            $maxPage = ceil($countRow / $limit);
            $list = $this->product_model->getListLimit($limit, $offset);
        }
        $this->data['sub_content']['img_product'] = $this->product_model->getList('product_img');
        $this->data['sub_content']['delete_error'] = $this->session->flash('delete_error');
        $this->data['sub_content']['delete_success'] = $this->session->flash('delete_success');;
        $this->data['sub_content']['page'] = $page;
        $this->data['sub_content']['maxPage'] = $maxPage;
        $this->data['sub_content']['list'] = $list;
        $this->data['content'] = 'admin/products/list';
        $this->render('layout/admin_layout', $this->data);
    }
    function add()
    {
        $this->data['sub_content']['label'] = $this->product_model->getListLabel();
        $this->data['sub_content']['label_group'] = $this->product_model->getListGroup();
        $this->data['sub_content']['error_upload'] = $this->session->flash('upload_file_erorr');
        $this->data['sub_content']['error'] = $this->session->flash('insert_error');
        $this->data['sub_content']['success'] = $this->session->flash('insert_success');
        $this->data['content'] = 'admin/products/add';
        $this->render('layout/admin_layout', $this->data);
    }
    function add_product()
    {
        if ($this->request->isPost()) {
            $data = $this->request->getFields();
            if ($data['label'] == null) {
                $data['label_check'] = ''; // Nếu mảng label không tồn tại hoặc không phải là mảng
            } else {
                $data['label_check'] = 'true';
            }
            $statusUpload = $this->product_model->upload($_FILES);

            $this->request->rules([
                'product_name' => 'required|min:4|max:150',
                'made_in' => 'required|min:4|max:100',
                'label_check' => 'required',
                'form' => 'required|min:4|max:20',
                'author' => 'required|min:4|max:50',
                'description' => 'required|min:4|callback_check_word500',
                'short_description' => 'required|min:4|callback_check_word150',
                'specification' => 'required|min:4|callback_check_word150',
                'quantity' => 'required|number|positiveNumber',
                'price' => 'required|number|positiveNumber',
            ]);
            $this->request->messages([
                'product_name.required' => 'Tên sản phẩm không được để trống',
                'product_name.min' => 'Tên sản phẩm tối thiểu 4 kí tự',
                'product_name.max' => 'Tên sản phẩm tối đa 150 kí tự',
                'quantity.required' => 'Số lượng không được để trống',
                'quantity.number' => 'Số lượng phải là số',
                'quantity.positiveNumber' => 'Số phải dương',
                'price.required' => 'Giá không được để trống',
                'label_check.required' => 'Nhãn không được để trống',
                'price.number' => 'Giá phải là số',
                'price.positiveNumber' => 'Giá phải dương',
                'made_in.required' => 'Nhà sản xuất không được để trống',
                'made_in.min' => 'Nhà sản xuất tối thiểu 4 kí tự',
                'made_in.max' => 'Nhà sản xuất tối đa 100 kí tự',
                'form.required' => 'Kiểu dáng không được để trống',
                'form.min' => 'Kiểu dáng tối thiểu 4 kí tự',
                'form.max' => 'Kiểu dáng tối đa 20 kí tự',
                'author.required' => 'Tác giả không được để trống',
                'author.min' => 'Tác giả tối thiểu 4 kí tự',
                'author.max' => 'Tác giả tối đa 50 kí tự',
                'description.required' => 'Mô tả xuất không được để trống',
                'description.min' => 'Mô tả xuất tối thiểu 4 kí tự',
                'description.callback_check_word500' => 'Mô tả xuất tối đa 500 từ',
                'short_description.required' => 'Mô tả ngắn xuất không được để trống',
                'short_description.min' => 'Mô tả ngắn xuất tối thiểu 4 kí tự',
                'short_description.callback_check_word150' => 'Mô tả ngắn xuất tối đa 150 từ',
                'specification.required' => 'Chi tiết xuất không được để trống',
                'specification.min' => 'Chi tiết xuất tối thiểu 4 kí tự',
                'specification.callback_check_word500' => 'Chi tiết xuất tối đa 500 từ',
            ]);
            $statusValides = $this->request->valides($data);

            if ($statusUpload && $statusValides) {
                if (isset($data['label']) && is_array($data['label'])) {
                    $label = $data['label'];
                    unset($data['label']);
                }
                unset($data['label_check']);
                $statusInsert = $this->product_model->insertProduct($data);
                if ($statusInsert) {
                    // get id 
                    $id = $this->product_model->getLastId();
                    // xử lý up label
                  
                    foreach ($label as $item) {
                        $dataLabel['label_id'] = $item;
                        $dataLabel['product_id'] =  $id['id'];
                        $statusInsert = $this->product_model->insertLabel($dataLabel);
                    }
                    if ($statusInsert) {
                        $dirArr = $this->session->flash('dirArr');
                        if (!empty($dirArr)) {
                            foreach ($dirArr as $dirItem) {
                                $imgData = [];
                                $imgData['img_dir'] = $dirItem;
                                $imgData['product_id'] = $id['id'];
                                $statusInsert = $this->product_model->insertImgProduct($imgData);
                            }
                            if ($statusInsert) {
                                $this->session->flash('insert_success', 'Thêm sản phẩm thành công!');
                                $this->response->redirect(_WEB_ROOT . '/admin/product/add');
                            } else {
                                $this->session->flash('insert_error', 'Thêm sản phẩm thất bại!');
                                $this->response->redirect(_WEB_ROOT . '/admin/product/add');
                            }
                        }
                    } else {
                        $this->session->flash('insert_error', 'Thêm sản phẩm thất bại!');
                        $this->response->redirect(_WEB_ROOT . '/admin/product/add');
                    }
                    // xử lý upanh
                }
            } else {
                $this->session->flash('insert_error', 'Lỗi kiểm tra dữ liệu');
                $this->response->redirect(_WEB_ROOT . '/admin/product/add');
            }
        } else {
            $this->response->redirect(_WEB_ROOT . '/admin/product/add');
        }
    }
    function edit()
    {
        if ($this->request->isPost()) {
            $data = $this->request->getFields();
            $id = $data["id"];
            unset($data["id"]);
            $date = new DateTime();
            $data['update_at'] = $date->format('Y-m-d H:i:s');
            $this->request->rules([
                'product_name' => 'required|min:4|max:150',
                'made_in' => 'required|min:4|max:100',
                'form' => 'required|min:4|max:20',
                'author' => 'required|min:4|max:50',
                'description' => 'required|min:4|callback_check_word500',
                'short_description' => 'required|min:4|callback_check_word150',
                'specification' => 'required|min:4|callback_check_word150',
                'quantity' => 'required|number|positiveNumber',
                'price' => 'required|number|positiveNumber',
            ]);
            $this->request->messages([
                'product_name.required' => 'Tên sản phẩm không được để trống',
                'product_name.min' => 'Tên sản phẩm tối thiểu 4 kí tự',
                'product_name.max' => 'Tên sản phẩm tối đa 150 kí tự',
                'quantity.required' => 'Số lượng không được để trống',
                'quantity.number' => 'Số lượng phải là số',
                'quantity.positiveNumber' => 'Số phải dương',
                'price.required' => 'Giá không được để trống',
                'price.number' => 'Giá phải là số',
                'price.positiveNumber' => 'Giá phải dương',
                'made_in.required' => 'Nhà sản xuất không được để trống',
                'made_in.min' => 'Nhà sản xuất tối thiểu 4 kí tự',
                'made_in.max' => 'Nhà sản xuất tối đa 100 kí tự',
                'form.required' => 'Kiểu dáng không được để trống',
                'form.min' => 'Kiểu dáng tối thiểu 4 kí tự',
                'form.max' => 'Kiểu dáng tối đa 20 kí tự',
                'author.required' => 'Tác giả không được để trống',
                'author.min' => 'Tác giả tối thiểu 4 kí tự',
                'author.max' => 'Tác giả tối đa 50 kí tự',
                'description.required' => 'Mô tả xuất không được để trống',
                'description.min' => 'Mô tả xuất tối thiểu 4 kí tự',
                'description.callback_check_word500' => 'Mô tả xuất tối đa 500 từ',
                'short_description.required' => 'Mô tả ngắn xuất không được để trống',
                'short_description.min' => 'Mô tả ngắn xuất tối thiểu 4 kí tự',
                'short_description.callback_check_word150' => 'Mô tả ngắn xuất tối đa 150 từ',
                'specification.required' => 'Chi tiết xuất không được để trống',
                'specification.min' => 'Chi tiết xuất tối thiểu 4 kí tự',
                'specification.callback_check_word150' => 'Chi tiết xuất tối đa 150 từ',
            ]);
            $statusValides = $this->request->valides();
            if ($statusValides) {
                $statusInsert = $this->product_model->updateProduct('products', $id, $data);
                if ($statusInsert) {
                    $this->session->flash('edit_success', 'Sửa sản phẩm thành công');
                    $this->response->redirect(_WEB_ROOT . '/admin/product/view?id=' . $id);
                }
            } else {
                $this->session->flash('edit_error', 'Lỗi kiểm tra dữ liệu');
                $this->response->redirect(_WEB_ROOT . '/admin/product/view?id=' . $id);
            }
        } else {
            $this->response->redirect(_WEB_ROOT . '/admin/product/');
        }
    }
    function edit_label()
    {
        if ($this->request->isPost()) {
            $data = $this->request->getFields();
            $id = $data['id'];
            unset($data['id']);
            if (isset($data['label']) && is_array($data['label'])) {
                $label = $data['label'];
                unset($data['label']);
                $this->product_model->deleteTable('product_label', 'product_id', $id);
                foreach ($label as $item) {
                    $dataLabel['label_id'] = $item;
                    $dataLabel['product_id'] =  $id;
                    $statusInsert = $this->product_model->insertLabel($dataLabel);
                }
                if ($statusInsert) {
                    $this->session->flash('edit_success', 'Sửa nhãn sản phẩm thành công');
                    $this->response->redirect(_WEB_ROOT . '/admin/product/view?id=' . $id);
                }
            } else {
                $this->session->flash('edit_error', 'Nhãn không được trống');
                $this->response->redirect(_WEB_ROOT . '/admin/product/view?id=' . $id); // Nếu mảng label không tồn tại hoặc không phải là mảng
            }
        }
    }
    function edit_img()
    {
        if ($this->request->isGet()) {
            $id = $this->request->getFields();
            $this->data['sub_content']['error'] = $this->session->flash('edit_error');
            $this->data['sub_content']['success'] = $this->session->flash('edit_success');
            $this->data['sub_content']['img_product'] = $this->product_model->getOneImg($id['id']);
            $this->data['sub_content']['product_infor'] = $this->product_model->getOne('products', $id['id']);
            $this->data['content'] = 'admin/products/edit_img';
            $this->render('layout/admin_layout', $this->data);
        }
    }
    function handle_edit_img()
    {
        if ($this->request->isPost()) {
            $data = $this->request->getFields();
            $id = $data['id'];
            unset($data['id']);
            $product_id = $data['product_id'];
            unset($data['product_id']);
            $statusUpload = $this->product_model->upload($_FILES);
            $this->request->rules([
                'alt' => 'required|min:4|max:150',
                'link' => 'required|min:4|max:100',
            ]);
            $this->request->messages([
                'alt.required' => 'Alt không được để trống',
                'alt.min' => 'Alt tối thiểu 4 kí tự',
                'alt.max' => 'Alt tối đa 150 kí tự',
                'link.required' => 'Link không được để trống',
                'link.min' => 'Link tối thiểu 4 kí tự',
                'link.max' => 'Link tối đa 100 kí tự',
            ]);
            $statusValides = $this->request->valides();
            if ($statusUpload && $statusValides) {
                $dirImg = $this->session->flash('dirArr');
                $data['img_dir'] = $dirImg['img'];
                $statusUpdate = $this->product_model->updateProduct('product_img', $id, $data);
                if ($statusUpdate) {
                    $this->session->flash('edit_success', 'Cập nhật sản phẩm thành công');
                    $this->response->redirect(_WEB_ROOT . '/admin/product/view?id=' . $product_id);
                }
            }
            else{
                $this->response->redirect(_WEB_ROOT . '/admin/product/edit_img?id=' . $id);
            }
        }
    }
    function view()
    {
        if ($this->request->isGet()) {
            $id = $this->request->getFields();
            $this->data['sub_content']['error'] = $this->session->flash('edit_error');
            $this->data['sub_content']['success'] = $this->session->flash('edit_success');
            $this->data['sub_content']['label'] = $this->product_model->getListLabel();
            $this->data['sub_content']['label_group'] = $this->product_model->getListGroup();
            $this->data['sub_content']['img_product'] = $this->product_model->getImg($id['id']);
            $this->data['sub_content']['product_infor'] = $this->product_model->getOne('products', $id['id']);
            $this->data['content'] = 'admin/products/edit';
            $this->render('layout/admin_layout', $this->data);
        }
    }
    function delete()
    {
        if ($this->request->isGet()) {
            $id = $this->request->getFields();
            $deleteStatus = $this->product_model->deleteProduct($id['id']);
            if ($deleteStatus) {
                $this->session->flash('delete_success', 'Xóa sản phẩm thành công');
                $this->response->redirect(_WEB_ROOT . '/admin/product?page=1');
            } else {
                $this->session->flash('delete_error', 'Xóa sản phẩm thất bại');
                $this->response->redirect(_WEB_ROOT . '/admin/product?page=1');
            }
        }
    }
    function warehouse()
    {
        $this->data['content'] = 'admin/products/warehouse';
        $this->render('layout/admin_layout', $this->data);
    }
    function statistical()
    {
        $this->data['content'] = 'admin/products/statistical';
        $this->render('layout/admin_layout', $this->data);
    }
    public function check_word500($string)
    {
        $countWord = str_word_count($string);
        if ($countWord < 500) {
            return false;
        } else {
            return true;
        }
    }
    public function check_word150($string)
    {
        $countWord = str_word_count($string);
        if ($countWord < 150) {
            return false;
        } else {
            return true;
        }
    }
}
?>