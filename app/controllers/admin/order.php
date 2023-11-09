<?php
class Order extends Controller
{
    public $order_model, $data, $data_label, $session,  $response, $request;

    public function __construct()
    {
        $this->order_model = $this->model('OrderModel');
        $this->session = new Session();
        $this->response = new Response();
        $this->request = new Request();
    }
    function list()
    {
        if ($this->request->isGet()) {
            $countRow = $this->order_model->getCount('orders');
            $limit = 20;
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
            $order_list = $this->order_model->getListOrder($limit, $offset);
        }
        $this->data['sub_content']['maxPage'] = $maxPage;
        $this->data['sub_content']['page'] = $page;
        $this->data['sub_content']['data_order'] = $order_list;
        $this->data['content'] = 'admin/order/list';
        $this->render('layout/admin_layout', $this->data);
    }
    function view()
    {
        if ($this->request->isGet()) {
            $data = $this->request->getFields();
            $data_order = $this->order_model->getInforOrder($data['id']);
            $order_list = $this->order_model->getFullOrder($data_order['id']);
            $mess = $this->session->flash('order_status');
            if ($data_order['status'] == 0) {
                $reason = $this->order_model->getReasonCancel($data_order['id']);
                $this->data['sub_content']['reason'] = $reason;
            }
        }
        $this->data['sub_content']['mess'] = $mess;
        $this->data['sub_content']['infor_order'] = $data_order;
        $this->data['sub_content']['list_order'] = $order_list;
        $this->data['content'] = 'admin/order/view';
        $this->render('layout/admin_layout', $this->data);
    }
    function cancel_order()
    {
        if ($this->request->isGet()) {
            $data = $this->request->getFields();
            $data_order = $this->order_model->getInforOrder($data['id']);
        }
        $this->data['sub_content']['infor_order'] = $data_order;
        $this->data['content'] = 'admin/order/cancel';
        $this->render('layout/admin_layout', $this->data);
    }
    function handleCancelOrder()
    {
        if ($this->request->isPost()) {
            $data = $this->request->getFields();
            $dataUpdate['status'] = 0;
            if ($data) {
                $this->request->rules(
                    ['reason' => 'required|min:10']
                );
                $this->request->messages([
                    'reason.required' => 'Lí do hủy không được để trống',
                    'reason.min' => 'Lí do hủy tối thiểu 10 kí tự',
                ]);
                $this->request->valides();
                if ($this->request->valides()) {
                    $cancelStatus = $this->order_model->updateCart('orders', $data['order_id'], $dataUpdate);
                    if ($cancelStatus) {
                        $this->order_model->insertCart('orders_cancel', $data);
                        $this->session->flash('order_status', 'Cập nhật thành công');
                        $this->response->redirect('admin/order/view?id=' . $data['order_id']);
                    }
                } else {
                    $this->response->redirect('admin/order/cancel_order?id=' . $data['order_id']);
                }
            }
        }
    }
    function handleChangeStatus()
    {
        if ($this->request->isGet()) {
            $data = $this->request->getFields();
            $id = $data['id'];
            unset($data['id']);
            $mail = $this->model('SendMailModel');
            $infor_order = $this->order_model->getInforOrder($id);
            if (!empty($id)) {
                $result = $this->order_model->updateCart('orders', $id, $data);
                if ($result) {
                    if ($data['status'] == '2') {
                        $body = $this->formMailSuccess($infor_order);
                        $sendMailStatus = $mail->sendMail($infor_order['email'], $infor_order['fullname'], 'Đặt hàng thành công!', $body);
                        if ($sendMailStatus) {
                            $this->session->data('order_status', 'Cập nhật thành công!');
                            $this->response->redirect(_WEB_ROOT . '/admin/order/view?id=' . $id);
                        } else {
                            $this->session->data('order_status', 'Có lỗi xảy ra!');
                            $this->response->redirect(_WEB_ROOT . '/admin/order/view?id=' . $id);
                        }
                    } elseif ($data['status'] == '4') {
                        $body = $this->formMailComplete($infor_order);
                        $sendMailStatus = $mail->sendMail($infor_order['email'], $infor_order['fullname'], 'Đơn hàng hoàn thành!', $body);
                        if ($sendMailStatus) {
                            $this->session->data('order_status', 'Cập nhật thành công!');
                            $this->response->redirect(_WEB_ROOT . '/admin/order/view?id=' . $id);
                        } else {
                            $this->session->data('order_status', 'Có lỗi xảy ra!');
                            $this->response->redirect(_WEB_ROOT . '/admin/order/view?id=' . $id);
                        }
                    } else {
                        $this->session->data('order_status', 'Cập nhật thành công!');
                        $this->response->redirect(_WEB_ROOT . '/admin/order/view?id=' . $id);
                    }
                } else {
                    $this->session->data('order_status', 'Có lỗi xảy ra!');
                    $this->response->redirect(_WEB_ROOT . '/admin/order/view?id=' . $id);
                }
            }
        }
    }
    function formMailSuccess($data)
    {
        return '<!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Thông Báo Đặt Hàng Thành Công</title>
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
                <h1>Đặt Hàng Thành Công</h1>
                <p>Cảm ơn bạn đã đặt hàng! Đơn hàng của bạn đã được xác nhận và đang được xử lý.</p>
                <p>Thông tin đơn hàng:</p>
                <ul>
                    <li><strong>Mã Đơn Hàng:</strong> ' . $data['order_code'] . '</li>
                    <li><strong>Tổng Tiền:</strong> ' . number_format($data['total_price'], 0) . ' VND </li>
                    <!-- Thêm thông tin khác của đơn hàng nếu cần -->
                </ul>
                <p>Xin vui lòng liên hệ chúng tôi nếu bạn có bất kỳ câu hỏi hoặc cần hỗ trợ thêm.</p>
                <p>Cảm ơn bạn đã mua sắm tại cửa hàng của chúng tôi!</p>
                <hr>
                <p>Trân trọng,</p>
                <p>Đội ngũ cửa hàng BookShop</p>
            </div>
        </body>
        </html>
        ';
    }
    function formMailComplete($data)
    {
        return '<!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Thông Báo Đơn Hàng Hoàng Thành</title>
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
                <h1>Đơn Hàng Thực Hiện Thành Công</h1>
                <p>Cảm ơn bạn đã mua hàng! Đơn hàng của bạn đã được giao tới tay.</p>
                <p>Thông tin đơn hàng:</p>
                <ul>
                    <li><strong>Mã Đơn Hàng:</strong> ' . $data['order_code'] . '</li>
                    <li><strong>Tổng Tiền:</strong> ' . number_format($data['total_price'], 0) . ' VND </li>
                    <!-- Thêm thông tin khác của đơn hàng nếu cần -->
                </ul>
                <p>Xin vui lòng liên hệ chúng tôi nếu bạn có bất kỳ câu hỏi hoặc cần hỗ trợ thêm.</p>
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