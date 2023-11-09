<?php
class Profile extends Controller
{
    public $model_profile, $data, $db, $request, $session, $response;
    public function __construct()
    {
        $this->model_profile = $this->model('AuthModel');
        $this->db = new Database();
        $this->request = new Request();
        $this->session  = new Session();
        $this->response = new Response();
    }
    public function index()
    {
        $username = $this->session->data('user_name');
        if (!empty($username)) {
            $data_user = $this->model_profile->getUserInfor($username);
            if (!empty($data_user)) {
                $data_order =  $this->model_profile->getInforOder($data_user['id']);
            }
        }
        $this->data['sub_content']['data_order'] = $data_order;
        $this->data['content'] = 'profile/index';
        $this->render('layout/client_layout', $this->data);
    }

    public function edit()
    {
        $responsiveJson = [];

        if ($this->request->isPost()) {
            $data = $this->request->getFields();
            $this->request->rules(
                [
                    'fullname' => 'required|min:4|max:100',
                    'birthday' => 'required',
                ]
            );
            $this->request->messages([
                'fullname.required' => 'Họ và tên không được để trống',
                'birthday.required' => 'Ngày sinh không được để trống',
                'fullname.min' => 'Họ và tên phải trên 4 kí tự',
                'fullname.max' => 'Họ và tên phải dưới 100 kí tự',
            ]);

            $this->request->valides();
            $id =  $data['id'];
            unset($data['id']);
            if ($this->request->valides()) {
                $statusInsert = $this->model_profile->updateUser($data, $id);
                if ($statusInsert) {
                    $responsiveJson["success"] = 'Cập nhật thành công';
                }
            } else {
                $sessionKey = Session::isInvalid();
                $errors = Session::flash($sessionKey . '_errors');
                $error = reset($errors);
                $responsiveJson["error"] = $error;
            }
            echo json_encode($responsiveJson);
        }
    }
    public function edit_address()
    {
        $responsiveJson = [];

        if ($this->request->isPost()) {
            $data = $this->request->getFields();
            $this->request->rules(
                [
                    'address' => 'required|min:10|max:150',
                    'phone' => 'required|phone|max:10',
                ]
            );
            $this->request->messages([
                'address.required' => 'Địa chỉ không được để trống',
                'address.min' => 'Địa chỉ tối thiểu 10 kí tự',
                'address.max' => 'Địa chỉ tối đa 150 kí tự',
                'phone.required' => 'SDT không được để trống',
                'phone.phone' => 'SDT không đúng định dạng',
                'phone.max' => 'SDT không đúng định dạng',
            ]);

            $statusValidate = $this->request->valides($data);
            $id =  $data['id'];
            unset($data['id']);
            if ($statusValidate) {
                $statusInsert = $this->model_profile->updateUser($data, $id);
                if ($statusInsert) {
                    $responsiveJson["success"] = 'Cập nhật thành công';
                }
            } else {
                $sessionKey = Session::isInvalid();
                $errors = Session::flash($sessionKey . '_errors');
                $error = reset($errors);
                $responsiveJson["error"] = $error;
            }
            echo json_encode($responsiveJson);
        }
    }
    public function view_order()
    {
        if ($this->request->isGet()) {
            $data = $this->request->getFields();
            $id = $data['id'];
            $order = $this->model_profile->getOne('orders', 'id', $id);
            $list_order = $this->model_profile->getFullOrder($id);
            $mess = $this->session->flash('cf_order');
        }
        $this->data['sub_content']['list_order'] = $list_order;
        $this->data['sub_content']['mess'] = $mess;
        $this->data['sub_content']['data_order'] = $order;
        $this->data['content'] = 'profile/order';
        $this->render('layout/client_layout', $this->data);
    }
    public function change_email()
    {
        if ($this->request->isGet()) {
            $username = $this->session->data('user_name');
            $data = $this->request->getFields();
            if (!empty($data['email']) && !empty($data['id'])) {
                $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                $token = substr(str_shuffle($characters), 0, 10);
                $dataToken['token'] = $token;
                $dataToken['user_id'] = $data['id'];
                $dataToken['email'] = $data['email'];
                $this->model_profile->removeToken($data['id']);
                $statusToken = $this->model_profile->insertToken($dataToken);
                if ($statusToken) {
                    $mail = $this->model('SendMailModel');
                    $date = new DateTime();
                    $date = $date->format('Y-m-d H:i:s');
                    $body = $this->formMailReset($token, $date, $username);
                    $sendMailStatus = $mail->sendMail($data['email'], $username, 'Yêu cầu đặt lại email!', $body);
                }
                $this->data['sub_content']['data'] = $data;
                $this->data['content'] = 'profile/change_mail';
                $this->render('layout/client_layout', $this->data);
            } else {
                $this->response->redirect('home');
            }
        }
    }
    public function handle_change_email()
    {
        $username = $this->session->data('user_name');
        $inforUser = $this->model_profile->getUserInfor($username);
        if ($this->request->isPost()) {
            $data = $this->request->getFields();
            if (!empty($data['id'])) {
                $this->request->rules(
                    [
                        'email' => 'required|min:4|max:150|email|unique:user:email',
                        'token' => 'required|notunique:change_email_token:token'
                    ]
                );
                $this->request->messages([
                    'token.notunique' => 'Mã xác nhận không tồn tại',
                    'token.required' => 'Mã xác nhận không được để trống',
                    'email.unique' => 'Email tồn tại',
                    'email.required' => 'Email không được để trống',
                    'email.email' => 'Email không đúng định dạng',
                    'email.min' => 'Email phải trên 4 kí tự',
                    'email.max' => 'Email phải dưới 150 kí tự',
                ]);
                $dataCheck['email'] = $data['email'];
                $dataCheck['token'] = $data['token'];


                if ($this->request->valides($dataCheck)) {
                    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                    $token = substr(str_shuffle($characters), 0, 10);
                    $dataToken['token'] = $token;
                    $dataToken['user_id'] = $data['id'];
                    $dataToken['email'] = $data['email'];
                    $this->model_profile->removeToken($data['id']);
                    $statusToken = $this->model_profile->insertToken($dataToken);
                    if ($statusToken) {
                        $mail = $this->model('SendMailModel');
                        $date = new DateTime();
                        $date = $date->format('Y-m-d H:i:s');
                        $body = $this->formMailReset($token, $date, $username);
                        $sendMailStatus = $mail->sendMail($data['email'], $username, 'Yêu cầu đặt lại email!', $body);
                    }
                    if ($sendMailStatus) {
                        $this->data['sub_content']['email'] = $data['email'];
                        $this->data['sub_content']['id'] = $inforUser['id'];
                        $this->data['content'] = 'profile/handle_change_mail';
                        $this->render('layout/client_layout', $this->data);
                    }
                } else {
                    $this->response->redirect('profile/change_email?id=' . $inforUser['id'] . '&email=' . $inforUser['email']);
                }
            } else {
                $this->response->redirect('home');
            }
        }
    }
    public function change_password()
    {
        if ($this->request->isGet()) {
            $data = $this->request->getFields();
            if (!empty($data['id'])) {
                $this->data['sub_content']['id'] = $data['id'];
                $this->data['content'] = 'profile/change_pass';
                $this->render('layout/client_layout', $this->data);
            } else {
                $this->response->redirect('home');
            }
        }
    }
    public function handle_change_password()
    {
        if ($this->request->isPost()) {
            $responsiveJson = [];

            $data = $this->request->getFields();
            $username = $this->session->data('user_name');
            if (!empty($data['id'])) {
                $this->request->rules(
                    [
                        'password' => 'required|min:4|max:60',
                        'newPassword' => 'required|min:4|max:60',
                        'cfPassword' => 'required|min:4|max:60|macth:newPassword',

                    ]

                );
                $this->request->messages([
                    'password.required' => 'Mật khẩu không được để trống',
                    'password.min' => 'Mật khẩu phải trên 4 kí tự',
                    'password.max' => 'Mật khẩu phải dưới 32 kí tự',
                    'newPassword.required' => 'Mật khẩu mới không được để trống',
                    'newPassword.min' => 'Mật khẩu mới phải trên 4 kí tự',
                    'newPassword.max' => 'Mật khẩu mới phải dưới 32 kí tự',
                    'cfPassword.required' => 'Mật khẩu xác nhận không được để trống',
                    'cfPassword.min' => 'Mật khẩu xác nhận phải trên 4 kí tự',
                    'cfPassword.max' => 'Mật khẩu xác nhận phải dưới 32 kí tự',
                    'cfPassword.macth' => 'Mật khẩu xác nhận phải trùng',
                ]);
                if ($this->request->valides($data)) {
                    $status = $this->model_profile->checkPassword($data['password'], $username);
                    if ($status) {
                        $dataUpdate['password'] = password_hash($data['newPassword'], PASSWORD_DEFAULT);
                        $statusUpdate = $this->model_profile->updateUser($dataUpdate, $data['id']);
                        if ($statusUpdate) {
                            $responsiveJson["success"] = 'Cập nhật thành công';
                        } else {
                            $responsiveJson["error"] = 'Có lỗi xảy ra';
                        }
                    } else {
                        $responsiveJson["error"] = 'Mật khẩu cũ không đúng';
                    }
                    // $statusInsert = $this->model_profile->updateUser($data, $id);
                    // if ($statusInsert) {
                    // }
                } else {
                    $sessionKey = Session::isInvalid();
                    $errors = Session::flash($sessionKey . '_errors');
                    $error = reset($errors);
                    $responsiveJson["error"] = $error;
                }
                echo json_encode($responsiveJson);
            }
        }
    }
    public function cf_change_email()
    {
        $responsiveJson = [];
        if ($this->request->isPost()) {
            $data = $this->request->getFields();
            if (!empty($data['user_id'])) {
                $this->request->rules(
                    [
                        'token' => 'required|notunique:change_email_token:token'
                    ]
                );
                $this->request->messages([
                    'token.notunique' => 'Mã xác nhận không tồn tại',
                    'token.required' => 'Mã xác nhận không được để trống',
                ]);
                $dataCheck['token'] = $data['token'];


                if ($this->request->valides($dataCheck)) {
                    $dataUpdate['email'] = $data['email'];
                    $statusUpdate = $this->model_profile->updateUser($dataUpdate, $data['user_id']);
                    if ($statusUpdate) {
                        $responsiveJson["success"] = 'Cập nhật thành công!';
                    } else {
                        $responsiveJson["error"] = 'Cập nhật thất  bại!';
                    }
                } else {
                    $sessionKey = Session::isInvalid();
                    $errors = Session::flash($sessionKey . '_errors');
                    $error = reset($errors);
                    $responsiveJson["error"] = $error;
                }
            } else {
                $responsiveJson["error"] = "Lõi";
            }
            echo json_encode($responsiveJson);
        }
    }
    function formMailReset($data, $date, $username)
    {
        return '<!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Thông báo yêu cầu đổi mới Mail</title>
            <style>
                body {
                    font-family: Arial, sans-serif;
                    background-color: #f4f4f4;
                    margin: 0;
                    padding: 0;
                }
                .container {
                    max-width: 600px;
                    margin: 20px auto;
                    background-color: #fff;
                    padding: 20px;
                    border-radius: 8px;
                    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                }
                h1 {
                    color: #333;
                }
                p {
                    color: #666;
                }
            </style>
        </head>
        <body>
            <div class="container">
                <h1>Yêu cầu đổi Mail</h1>
                <p>Bạn đã yêu cầu đổi mail vào lúc ' . $date . '</p>
                <p>Mail mới của bạn là:</p>
                <ul>
                <li><strong>Tài khoản:</strong> ' . $username . '</li>

                    <li><strong>Mã xác nhận:</strong> ' . $data . '</li>
                </ul>
                <p>Xin vui lòng liên hệ chúng tôi nếu bạn không thực hiện thay đổi này hoặc bạn có bất kỳ câu hỏi hoặc cần hỗ trợ thêm.</p>
                <p>Cảm ơn bạn đã mua sắm tại cửa hàng của chúng tôi!</p>
                <hr>
                <p>Trân trọng,</p>
                <p>Đội ngũ cửa hàng BookShop</p>
            </div>
        </body>
        </html>
        ';
    }
}
?>