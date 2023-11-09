<?php
class Account extends Controller
{
    public $account_model, $data, $request, $session, $response;
    public function __construct()
    {
        $this->account_model = $this->model('AuthModel');
        $this->request = new Request();
        $this->session = new Session();
        $this->response = new Response();
    }
    function index()
    {

        if ($this->request->isGet()) {
            $result = $this->request->getFields();
            if (empty($result)) {
                $result['page'] = 1;
            }
            $rowCount = $this->account_model->getCount();
            $limit = 10;
            $maxPage = ceil($rowCount / $limit);
            if ($maxPage == 0) {
                $maxPage = 1;
            }
            if (!empty($result)) {
                $offset = ($result['page'] - 1) * $limit;
            } else {
                $offset = 0;
            }
        }
        $list = $this->account_model->getListAccount($limit, $offset);
        $this->data['sub_content']['maxPage'] = $maxPage;
        $this->data['sub_content']['list'] = $list;
        $this->data['sub_content']['page'] = $result['page'];
        $this->data['content'] = 'admin/user/list';
        $this->render('layout/admin_layout', $this->data);
    }
    function view()
    {
        if (!empty($this->request->isGet())) {
            $data = $this->request->getFields();
            $data_user = $this->account_model->getOne('user', 'id', $data['id']);
            $error = $this->session->flash('error_update_user');
            $success = $this->session->flash('success_update_user');
            $total_order = $this->account_model->getSum('total_price','orders', 'user_id', $data['id']);
            $quatity_order = $this->account_model->count('orders', 'user_id', $data['id']);
            $day = new DateTime;
            $exp_account = $data_user['create_at'];
            $exp_account = new DateTime($exp_account);
            $interval = $day->diff($exp_account);
            $days_difference = $interval->days;
        }
        $this->data['sub_content']['error'] = $error;
        $this->data['sub_content']['quatity_order'] = $quatity_order;
        $this->data['sub_content']['exp_account'] = $days_difference;
        $this->data['sub_content']['total_order'] = $total_order['sum'];
        $this->data['sub_content']['success'] = $success;
        $this->data['sub_content']['data_user'] = $data_user;
        $this->data['content'] = 'admin/user/view';
        $this->render('layout/admin_layout', $this->data);
    }
    function list_ban()
    {
        if ($this->request->isGet()) {
            $result = $this->request->getFields();
            if (empty($result)) {
                $result['page'] = 1;
            }
            $rowCount = $this->account_model->getCount('true');
            $limit = 4;
            $maxPage = $rowCount % $limit;
            if ($maxPage != 0) {
                $maxPage = floor($rowCount / $limit) + 1;
            } else {
                $maxPage = floor($rowCount / $limit);
            }

            if ($maxPage == 0) {
                $maxPage = 1;
            }
            if (!empty($result)) {
                $offset = ($result['page'] - 1) * $limit;
            } else {
                $offset = 0;
            }
        }
        $list = $this->account_model->getListAccount($limit, $offset,'ban');
        $this->data['sub_content']['maxPage'] = $maxPage;
        $this->data['sub_content']['list'] = $list;
        $this->data['sub_content']['page'] = $result['page'] || 1;
        $this->data['content'] = 'admin/user/list_ban';
        $this->render('layout/admin_layout', $this->data);
    }
    function handleUpdattUser()
    {
        if (!empty($this->request->isGet())) {
            $data = $this->request->getFields();
            $id = $data['id'];
            unset($data['id']);
            $username = $this->session->data('user_name');
            $role = $this->account_model->getRole('username', $username);
            if ($role['role'] === 'adminroot') {
                $result = $this->account_model->updateUser($data, $id);
                if ($result) {
                    $this->session->data('success_update_user', 'Cập nhật thành công');
                    $this->response->redirect('admin/account/view?id=' . $id);
                } else {
                    $this->session->data('error_update_user', 'Cập nhật thất bại');
                    $this->response->redirect('admin/account/view?id=' . $id);
                }
            }
            else {
                $this->session->data('error_update_user', 'Bạn không có quyền kích hoạt!Vui lòng liên hệ quản trị viên!');
                $this->response->redirect('admin/account/view?id=' . $id);
            }
        }
        else {
            $this->response->redirect('admin/dashboard');
        }
    }
    function profile()
    {
        $this->data['content'] = 'admin/profile/index';
        $this->render('layout/admin_layout', $this->data);
    }
}
?>