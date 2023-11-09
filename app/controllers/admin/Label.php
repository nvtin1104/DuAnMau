<?php
class Label extends Controller
{
    public $Label_model, $data, $data_label, $session,  $response, $request;
    public function __construct()
    {
        $this->Label_model = $this->model('LabelModel');
        $this->session = new Session();
        $this->response = new Response();
        $this->request = new Request();
    }
    function index()
    {
        if ($this->request->isGet()) {
            $countRow = $this->Label_model->getCount('labels');
            $limit = 10;
            $maxPage = ceil($countRow / $limit);
            $result = $this->request->getFields();
            if (!empty($result)) {
                $page = $result['page'];
                if ($page > $maxPage) {
                    $page = 1;
                }
                $offset = ($page - 1) * $limit;
            } else {
                $page = 1;
                $offset = 0;
            }
            $label_list = $this->Label_model->getListLabel($limit, $offset);
        }

        $label_group = $this->Label_model->getList('label_group');
        $success = $this->session->flash('success');
        if (!empty($success)) {
            $this->data['sub_content']['success'] = $success;
        }
        $this->data['sub_content']['page'] = $page;
        $this->data['sub_content']['list'] = $label_list;
        $this->data['sub_content']['maxPage'] = $maxPage;
        $this->data['sub_content']['label_group'] = $label_group;
        $this->data['content'] = 'admin/label/list';
        $this->render('layout/admin_layout', $this->data);
    }
    function label_group()
    {
        if ($this->request->isGet()) {
            $countRow = $this->Label_model->getCount('label_group');
            $limit = 10;
            $maxPage = ceil($countRow / $limit);
            $result = $this->request->getFields();
            if (!empty($result)) {
                $page = $result['page'];
                if ($page > $maxPage) {
                    $page = 1;
                }
                $offset = ($page - 1) * $limit;
            } else {
                $page = 1;
                $offset = 0;
            }
            $list = $this->Label_model->getListGroup($limit, $offset);
        }

        $success = $this->session->flash('success');
        $this->data['sub_content']['maxPage'] = $maxPage;
        $this->data['sub_content']['page'] = $page;
        $this->data['sub_content']['list'] = $list;
        if (!empty($success)) {
            $this->data['sub_content']['success'] = $success;
        }
        $this->data['content'] = 'admin/label/list_group';
        $this->render('layout/admin_layout', $this->data);
    }
    function add()
    {
        if ($this->request->isPost()) {
            $this->data_label = $this->request->getFields();
            $labels = $this->request->getFields();
            $this->request->rules(
                ['label_name' => 'required|min:2|max:45']
            );
            $this->request->messages([
                'label_name.required' => 'Nhãn sản phẩm không được để trống',
                'label_name.min' => 'Nhãn sản phẩm tối thiểu 2 kí tự',
                'label_name.max' => 'Nhãn sản phẩm không quá 45 kí tự',
            ]);
            $this->request->valides();
            if ($this->request->valides()) {
                $result = $this->Label_model->insertLabel($labels);
                $this->session->flash('success', 'Thêm thành công');
            }
            $this->response->redirect('admin/label');
        }
    }
    function add_group()
    {
        if ($this->request->isPost()) {
            $group_name = $this->request->getFields();
            $this->request->rules(
                ['group_name' => 'required|min:4|max:45|unique:label_group:group_name'],
            );
            $this->request->messages(
                [
                    'group_name.required' => 'Nhóm sản phẩm không được để trống',
                    'group_name.min' => 'Nhóm sản phẩm tối thiểu 4 kí tự',
                    'group_name.max' => 'Nhóm sản phẩm không quá 45 kí tự',
                    'group_name.unique' => 'Nhóm sản phẩm không được trùng',
                ]
            );
            $this->request->valides();
            if ($this->request->valides()) {
                $result = $this->Label_model->insertLabelGroup($group_name);
                $this->session->flash('success', 'Thêm thành công');
            }
            $this->response->redirect('admin/label/label_group');
        }
    }
    function edit_label_group()
    {
        if ($this->request->isGet()) {
            $data = $this->request->getFields();
            $id = $data['id'];
            //laays dữ liệu dựa vào id 
            $result = $this->Label_model->getOne('label_group', $id);
            $listLabel = $this->Label_model->getLabelFlowGroup($id);
            $this->data['sub_content']['group_data'] = $result;
            $this->data['sub_content']['list_label'] = $listLabel;

            //taoj biến dữ liệu của group label truyền vào render
            $this->data['content'] = 'admin/label/edit_group';
            $this->render('layout/admin_layout', $this->data);
        }
    }
    function handle_edit_group()
    {
        if ($this->request->isPost()) {
            $data = $this->request->getFields();
            $this->request->rules(
                ['group_name' => 'required|min:4|max:45|unique:label_group:group_name'],
            );
            $this->request->messages(
                [
                    'group_name.required' => 'Nhóm sản phẩm không được để trống',
                    'group_name.min' => 'Nhóm sản phẩm tối thiểu 4 kí tự',
                    'group_name.max' => 'Nhóm sản phẩm không quá 45 kí tự',
                    'group_name.unique' => 'Nhóm sản phẩm không được trùng',
                ]
            );
            $this->request->valides();
            $updateData['group_name'] = $data['group_name'];
            if ($this->request->valides()) {
                $result = $this->Label_model->updateLabel($updateData, 'label_group', $data['id']);
                if ($result) {
                    $this->session->flash('success', 'Sửa thành công');
                }
            }
            $this->response->redirect('admin/label/label_group');
        } else {
            $this->response->redirect('admin/label/label_group');
        }
    }

    function edit_label()
    {
        if ($this->request->isPost()) {
            $data = $this->request->getFields();
            $id = $data['id'];
            unset($data['id']);
            $this->request->rules(
                ['label_name' => 'required|min:4|max:45|unique:labels:label_name'],
            );
        }
        $this->request->messages(
            [
                'label_name.required' => 'Nhóm sản phẩm không được để trống',
                'label_name.min' => 'Nhóm sản phẩm tối thiểu 4 kí tự',
                'label_name.max' => 'Nhóm sản phẩm không quá 45 kí tự',
                'label_name.unique' => 'Nhóm sản phẩm không được trùng',
            ]
        );
        $this->request->valides();
        if ($this->request->valides()) {
            $result = $this->Label_model->updateLabel($data, 'labels', $id);
            if ($result) {
                $this->session->flash('success', 'Sửa thành công');
            }
            $this->response->redirect('admin/label?page=1');
        } else {
            $this->response->redirect('admin/label');
        }
    }
    function view_edit_labels()
    {
        if ($this->request->isGet()) {
            $data = $this->request->getFields();
            $id = $data['id'];
            $result = $this->Label_model->getOne('labels', $id);
            $label_group =  $this->Label_model->getList('label_group');
            $this->data['sub_content']['group_data'] = $result;
            $this->data['sub_content']['label_group'] = $label_group;
            $this->data['content'] = 'admin/label/edit_labels';
            $this->render('layout/admin_layout', $this->data);
        }

    }
    public function deleteLabel()
    {
        if ($this->request->isGet()) {
            $data = $this->request->getFields();
            if (isset($data['id'])) {
                $id = $data['id'];
                $deleteStatus = $this->Label_model->deleteLabel('labels', $id);
                if ($deleteStatus) {
                    $this->session->flash('success', 'Xóa thành công');
                } else {
                    $this->session->flash('error', 'Xóa không thành công');
                }
            } else {
                $this->session->flash('error', 'Không tìm thấy ID để xóa');
            }
            $this->response->redirect('admin/label');
        }
        else{
            $this->response->redirect('admin/label');
        }
    }
    public function deleteLabelGrup()
    {
        if ($this->request->isGet()) {
            $data = $this->request->getFields();
            if (isset($data['id'])) {
                $id = $data['id'];
                $deleteStatus = $this->Label_model->deleteLabel('label_group', $id);
                if ($deleteStatus) {
                    $this->session->flash('success', 'Xóa thành công');
                } else {
                    $this->session->flash('error', 'Xóa không thành công');
                }
            } else {
                $this->session->flash('error', 'Không tìm thấy ID để xóa');
            }
            $this->response->redirect('admin/label/label_group');
        }
    }
}
?>