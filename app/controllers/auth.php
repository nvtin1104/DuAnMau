<?php
class Auth extends Controller
{
    public $model_Auth, $data, $request, $response, $session;
    public function __construct()
    {
        $this->model_Auth = $this->model('AuthModel');
        $this->request = new Request();
        $this->response = new Response();
        $this->session = new Session();
    }
    function index()
    {
        $isLogin = $this->session->data('isLogin');
        if ($isLogin) {
            $this->response->redirect(_WEB_ROOT . '/home');
        } else {
            $this->data['page_title'] = 'Đăng nhập';
            $this->data['sub_content'] = [];
            $this->data['content'] = 'auth/index';
            $this->render('layout/client_layout', $this->data);
        }
    }
    function reset_password()
    {
        $isLogin = $this->session->data('isLogin');
        if ($isLogin) {
            $this->response->redirect(_WEB_ROOT . '/home');
        } else {
            $this->data['page_title'] = 'Quên mật khẩu';
            $this->data['sub_content']['title'] = 'Quên mật khẩu';
            $this->data['content'] = 'auth/reset_pass';
            $this->render('layout/client_layout', $this->data);
        }
    }
    function handle_reset_password()
    {
        $responsiveJson = [];

        if ($this->request->isPost()) {
            $data = $this->request->getFields();
            if (!empty($data['value'])) {
                if (filter_var($data['value'], FILTER_VALIDATE_EMAIL)) {
                    $value['email'] = $data['value'];
                    $this->request->rules(
                        [
                            'email' => 'notunique:user:email',
                        ]
                    );
                    $this->request->messages([
                        'email.notunique' => 'Email không tồn tại!',
                    ]);
                } else {
                    $value['username'] = $data['value'];
                    $this->request->rules(
                        [
                            'username' => 'notunique:user:username',
                        ]
                    );
                    $this->request->messages([
                        'username.notunique' => 'Tên đăng nhập không tồn tại!',
                    ]);
                }
            } else {
                $responsiveJson["error"] = 'Mail hoặc tên đăng nhập không được để trống!';
            }
            $statusCheck = $this->request->valides($value);
            if ($statusCheck) {
                if (!empty($value['email'])) {
                    $email = $value['email'];
                    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                    $newPass = substr(str_shuffle($characters), 0, 10);
                    $newPassword = password_hash($newPass, PASSWORD_DEFAULT);
                    $dataUpdate['password'] = $newPassword;
                    $inforUser = $this->model_Auth->getOne('user', 'email', $email);

                    $statusUpdate = $this->model_Auth->updateUser($dataUpdate, $inforUser['id']);
                    if ($statusUpdate) {
                        $mail = $this->model('SendMailModel');
                        $date = new DateTime();
                        $date = $date->format('Y-m-d H:i:s');
                        $body = $this->formMailReset($newPass, $date, $inforUser['username']);
                        $sendMailStatus = $mail->sendMail($email, $inforUser['fullname'], 'Đặt lại mật khẩu thành công!', $body);
                        if ($sendMailStatus) {
                            $responsiveJson["success"] =   "Đặt lại mật khẩu thành công! Vui lòng kiểm tra email";
                        } else {
                            $responsiveJson["error"] =   "Đặt lại mật khẩu thất bại! Vui lòng liên hệ quản trị!";
                        }
                    }
                } else {
                    $username = $value['username'];
                    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                    $newPass = substr(str_shuffle($characters), 0, 10);
                    $newPassword = password_hash($newPass, PASSWORD_DEFAULT);
                    $dataUpdate['password'] = $newPassword;
                    $inforUser = $this->model_Auth->getOne('user', 'username', $username);

                    $statusUpdate = $this->model_Auth->updateUser($dataUpdate, $inforUser['id']);
                    if ($statusUpdate) {
                        $mail = $this->model('SendMailModel');
                        $date = new DateTime();
                        $date = $date->format('Y-m-d H:i:s');
                        $body = $this->formMailReset($newPass, $date, $username);
                        $sendMailStatus = $mail->sendMail($inforUser['email'], $inforUser['fullname'], 'Đặt lại mật khẩu thành công!', $body);
                        if ($sendMailStatus) {
                            $responsiveJson["success"] =   "Đặt lại mật khẩu thành công! Vui lòng kiểm tra email";
                        } else {
                            $responsiveJson["error"] =   "Đặt lại mật khẩu thất bại! Vui lòng liên hệ quản trị!";
                        }
                    }
                }

                // $statusInsert = $this->model_profile->updateUser($data, $data['id']);
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
    function login()
    {
        $responsiveJson = [];
        if ($this->request->isPost()) {
            $data = $this->request->getFields();
            $this->request->rules(
                [
                    'username' => 'required|confirm:user:username',
                    'password' => 'required',
                ]

            );
            $this->request->messages([
                'username.required' => 'Tên đăng nhập không được để trống',
                'password.required' => 'Mật khẩu không được để trống',
                'username.confirm' => 'Tên đăng nhập không tồn tại',
            ]);

            $this->request->valides();
            if ($this->request->valides()) {
                $status = $this->model_Auth->checkPassword($data['password'], $data['username']);
                if ($status) {
                    $statusUser = $this->model_Auth->getUserStatus($data['username']);
                    if ($statusUser['status'] == 'active') {
                        $role = $this->model_Auth->getRole('username', $data['username']);
                        if ($role['role'] == 'admin' || $role['role'] == 'adminroot') {
                            $this->session->data('role', 'admin');
                        } else {
                            $this->session->data('role', 'user');
                        }
                        $responsiveJson["success"] = 'Đăng nhập thành công';
                        $responsiveJson["location"] = true;
                        $this->session->data('isLogin', true);
                        $this->session->data('user_name', $data['username']);
                    } else {
                        $responsiveJson["error"] = 'Tài khoản bị cấm';
                    }
                } else $responsiveJson["error"] = 'Sai mật khẩu';
            } else {
                $sessionKey = Session::isInvalid();
                $errors = Session::flash($sessionKey . '_errors');
                $error = reset($errors);
                $responsiveJson["error"] = $error;
            }
            echo json_encode($responsiveJson);
        } else {
            $this->response->redirect(_WEB_ROOT . '/auth');
        }
    }
    function register()
    {
        $responsiveJson = [];
        if ($this->request->isPost()) {
            $data = $this->request->getFields();

            $this->request->rules(
                [
                    'username' => 'required|min:4|max:20|unique:user:username',
                    'email' => 'required|min:4|max:150|email|unique:user:email',
                    'password' => 'required|min:4|max:60',
                ]

            );
            $this->request->messages([
                'username.required' => 'Tên đăng nhập không được để trống',
                'password.required' => 'Mật khẩu không được để trống',
                'username.unique' => 'Username tồn tại',
                'email.unique' => 'Email tồn tại',
                'username.min' => 'Tên đăng nhập phải trên 4 kí tự',
                'username.max' => 'Tên đăng nhập phải dưới 20 kí tự',
                'email.required' => 'Email không được để trống',
                'email.email' => 'Email không đúng định dạng',
                'email.min' => 'Email phải trên 4 kí tự',
                'email.max' => 'Email phải dưới 150 kí tự',
                'password.min' => 'Password phải trên 4 kí tự',
                'password.max' => 'Password phải dưới 32 kí tự',
            ]);

            $this->request->valides();

            if ($this->request->valides()) {
                $hashedPassword = password_hash($data['password'], PASSWORD_DEFAULT);
                // Thay đổi mật khẩu trong mảng thành mật khẩu đã mã hóa
                $data['password'] = $hashedPassword;
                $statusInsert = $this->model_Auth->insertUser($data);
                if ($statusInsert) {
                    $responsiveJson["success"] = 'Đăng ký thành công';
                    $responsiveJson["location"] = true;
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
    function logout()
    {
        if ($this->request->isGet()) {
            $this->session->delete('isLogin');
            $this->session->delete('role');
            $this->response->redirect(_WEB_ROOT . '/home');
        } else {
            $this->response->redirect(_WEB_ROOT . '/auth');
        }
    }
    function formMailReset($data, $date, $username)
    {
        return '<!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Thông báo yêu cầu đổi mới mật khẩu</title>
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
                <h1>Yêu cầu reset mật khẩu</h1>
                <p>Bạn đã yêu cầu lấy lại mật khẩu vào lúc ' . $date . '</p>
                <p>Mật khẩu mới của bạn là:</p>
                <ul>
                <li><strong>Tài khoản:</strong> ' . $username . '</li>

                    <li><strong>Mật khẩu:</strong> ' . $data . '</li>
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