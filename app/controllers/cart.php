<?php
class Cart extends Controller
{
    public $cart_model, $data, $request, $response, $session, $home;
    public function __construct()
    {
        $this->cart_model = $this->model('CartModel');
        $this->request = new Request();
        $this->response = new Response();
        $this->session = new Session();
        $this->home = _WEB_ROOT . '/home';
    }
    function cart()
    {
        if ($this->request->isGet()) {
            if ($this->session->data('isLogin')) {
                $currentUser = $this->session->data('user_name');
                $dataUser = $this->cart_model->getUser($currentUser);
                $cartData = $this->cart_model->getCart('cart_items', $dataUser['id']);
            } else {
                $cartData = '';
            }
            $this->data['sub_content']['error'] =  $this->session->flash('error_remove_cart');
            $this->data['sub_content']['success'] =  $this->session->flash('success_remove_cart');
            $this->data['sub_content']['cart'] =  $cartData;
            $this->data['page_title'] = 'Giỏ hàng';
            $this->data['content'] = 'cart/index';
            $this->render('layout/client_layout', $this->data);
        }
    }
    function wishlist()
    {
        if ($this->session->data('isLogin')) {
            $currentUser = $this->session->data('user_name');
            $dataUser = $this->cart_model->getUser($currentUser);
            $cartData = $this->cart_model->getCart('wishlist', $dataUser['id']);
        } else {
            $cartData = '';
        }
        $this->data['sub_content']['wishlist'] =  $cartData;
        $this->data['page_title'] = 'Danh sách yêu thích';
        $this->data['content'] = 'cart/wishlist';
        $this->render('layout/client_layout', $this->data);
    }
    function checkout()
    {
        if ($this->request->isPost()) {
            $data = $this->request->getFields();
            if (!empty($data)) {
                foreach ($data['ids'] as $key) {
                    $cartItems = $this->cart_model->getOne('cart_items', 'id', $key);
                    $cartItem = $this->cart_model->getName($cartItems['product_id']);
                    $cartItems['product_name'] = $cartItem['product_name'];
                    $cart[] = $cartItems;
                }
                $sumTotal = 0;
                foreach ($cart as $item) {
                    $sumTotal += $item['total_price'];
                }
                if ($sumTotal != 0) {
                    $this->data['sub_content']['cart'] =  $cart;
                    $this->data['sub_content']['total_price'] =  $sumTotal;
                    $this->data['page_title'] = 'Thanh toán';
                    $this->data['content'] = 'cart/checkout';
                    $this->render('layout/client_layout', $this->data);
                } else {
                    $this->session->data('error_remove_cart',  'Sản phẩm không tồn tại.');
                    $this->response->redirect(_WEB_ROOT . '/cart/cart');
                }
            } else {
                $this->session->data('error_remove_cart',  'Chưa chọn sản phẩm.');
                $this->response->redirect(_WEB_ROOT . '/cart/cart');
            }
        } else {
            $this->response->redirect(_WEB_ROOT . '/cart/cart');
        }
    }
    function handleAddToCart()
    {
        if ($this->request->isPost()) {
            $responsiveJson = [];
            $isLogin = $this->session->data('isLogin');
            $currentUser = $this->session->data('user_name');
            $formData = $this->request->getFields();
            $productData = $this->cart_model->getProduct($formData['product_id']);
            $price = $productData['price'];
            if ($isLogin) {
                $dataUser = $this->cart_model->getUser($currentUser);
                $id = $dataUser['id'];

                if (intval($formData['quantity']) > 0) {
                    $checkExist = $this->cart_model->checkExist('cart_items', $id, $formData['product_id']);
                    if ($checkExist) {
                        $cartQuantity = $checkExist['quantity'];
                        $newQuantity = $cartQuantity + $formData['quantity'];
                        $newPrice = $newQuantity * $price;
                        $dataUpdate = [];
                        $dataUpdate['total_price'] = $newPrice;
                        $dataUpdate['quantity'] = $newQuantity;
                        $statusUpdate = $this->cart_model->updateCart('cart_items', $checkExist['id'], $dataUpdate);
                        if ($statusUpdate) {
                            $responsiveJson["success"] = 'Thêm vào giỏ hàng thành công.';
                        } else $responsiveJson["error"] = 'Thêm vào giỏ hàng thất bại';
                    } else {
                        $formData['total_price'] = $formData['quantity'] * $price;
                        $formData['user_id'] = $id;
                        $statusInsert = $this->cart_model->insertCart('cart_items', $formData);
                        if ($statusInsert) {
                            $responsiveJson["success"] = 'Thêm vào giỏ hàng thành công.';
                        } else $responsiveJson["error"] = 'Thêm vào giỏ hàng thất bại';
                    }
                } else {
                    $responsiveJson["error"] = 'Vui lòng chọn đúng số lượng!';
                }
            } else {
                $responsiveJson["error"] = 'Chưa đăng nhập';
            }
            echo json_encode($responsiveJson);
        } else {
            $this->response->redirect($this->home);
        }
    }
    function handleUpdateCart()
    {
        if ($this->request->isPost()) {
            $responsiveJson = [];
            $formData = $this->request->getFields();
            $id = $formData['id'];
            unset($formData['id']);
            $product_id = $formData['product_id'];
            unset($formData['product_id']);
            $dataCart =  $this->cart_model->getOne('products', 'id', $product_id);
            $price = $dataCart['price'];
            $formData['total_price'] = $price * $formData['quantity'];
            $responsiveJson["success"] = $formData['total_price'];
            if (intval($formData['quantity']) > 0) {
                $statusUpdate = $this->cart_model->updateCart('cart_items', $id, $formData);
                if ($statusUpdate) {
                    $responsiveJson["success"] = 'Cập nhật giỏ hàng thành công';
                } else {
                    $responsiveJson["error"] = 'Cập nhật giỏ hàng thất bại';
                }
            } else {
                $responsiveJson["error"] = 'Vui lòng chọn đúng số lượng!';
            }

            echo json_encode($responsiveJson);
        } else {
            $this->response->redirect($this->home);
        }
    }
    function handleAddToWishlist()
    {
        if ($this->request->isPost()) {
            $responsiveJson = [];
            $isLogin = $this->session->data('isLogin');
            $currentUser = $this->session->data('user_name');
            $formData = $this->request->getFields();
            $productData = $this->cart_model->getProduct($formData['product_id']);
            $price = $productData['price'];
            if ($isLogin) {
                $dataUser = $this->cart_model->getUser($currentUser);
                $id = $dataUser['id'];
                $checkExist = $this->cart_model->checkExist('wishlist', $id, $formData['product_id']);
                if ($checkExist) {
                    $responsiveJson["success"] = 'Sản phẩm đã có trong danh sách yêu thích.';
                } else {
                    $formData['total_price'] = $formData['quantity'] * $price;
                    $formData['user_id'] = $id;
                    $statusInsert = $this->cart_model->insertCart('wishlist', $formData);
                    if ($statusInsert) {
                        $responsiveJson["success"] = 'Thêm vào danh sách yêu thích thành công.';
                    } else $responsiveJson["error"] = 'Thêm vào danh sách yêu thích thất bại';
                }
            } else {
                $responsiveJson["error"] = 'Chua dang nhap';
            }
            echo json_encode($responsiveJson);
        } else {
            $this->response->redirect($this->home);
        }
    }
    function handleRemoveCart()
    {
        if ($this->request->isPost()) {
            $id = $this->request->getFields();
            $id = $id['id'];
            $statusRemove = $this->cart_model->removeCart('cart_items', $id);
            if ($statusRemove) {
                $responsiveJson["success"] = 'Xóa sản phẩm thành công.';
            } else {
                $responsiveJson["error"] = 'Xóa sản phẩm thất bại';
            }
            echo json_encode($responsiveJson);
        } else {
            $this->response->redirect($this->home);
        }
    }
    function handleRemoveArr()
    {
        if ($this->request->isPost()) {
            $data = $this->request->getFields();
            if (!empty($data)) {
                $data = $data['ids'];
                $statusRemove = $this->cart_model->removeCartQuery($data);
                if ($statusRemove) {
                    $this->session->data('success_remove_cart',  'Xóa sản phẩm thành công.');
                    $this->response->redirect(_WEB_ROOT . '/cart/cart');
                } else {
                    $this->session->data('error_remove_cart',  'Xóa sản phẩm thất bại.');
                    $this->response->redirect(_WEB_ROOT . '/cart/cart');
                }
            } else {
                $this->session->data('error_remove_cart', 'Chưa chọn sản phẩm!');
                $this->response->redirect(_WEB_ROOT . '/cart/cart');
            }
        } else {
            $this->response->redirect(_WEB_ROOT . '/cart/cart');
        }
    }
    function handleRemoveAll()
    {
        if ($this->request->isPost()) {
            $isLogin = $this->session->data('isLogin');
            $currentUser = $this->session->data('user_name');
            if ($isLogin) {
                $dataUser = $this->cart_model->getUser($currentUser);
                $id = $dataUser['id'];

                $statusRemove = $this->cart_model->removeAll('cart_items', $id);
                if ($statusRemove) {
                    $this->response->redirect(_WEB_ROOT . '/cart/cart');
                } else {
                    $this->session->data('error_remove_cart',  'Xóa sản phẩm thất bại.');
                    $this->response->redirect(_WEB_ROOT . '/cart/cart');
                }
            } else {
                $this->response->redirect(_WEB_ROOT . '/cart/cart');
            }
        } else {
            $this->response->redirect(_WEB_ROOT . '/cart/cart');
        }
    }
    function handleRemoveWishlist()
    {
        if ($this->request->isPost()) {
            $id = $this->request->getFields();
            $id = $id['id'];
            $statusRemove = $this->cart_model->removeCart('wishlist', $id);
            if ($statusRemove) {
                $responsiveJson["success"] = 'Xóa sản phẩm thành công.';
            } else {
                $responsiveJson["error"] = 'Xóa sản phẩm thất bại';
            }
            echo json_encode($responsiveJson);
        } else {
            $this->response->redirect($this->home);
        }
    }
    function handleCfShip()
    {
        if ($this->request->isGet()) {
            $data = $this->request->getFields();
            $data['status'] = 3;
            $statusUpdate = $this->cart_model->updateCart('orders', $data['id'], $data);
            if ($statusUpdate) {
                $this->session->data('cf_order', 'Cập nhật thành công');
                $this->response->redirect(_WEB_ROOT . '//profile/view_order?id=' . $data['id']);
            }
        }
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
                    $cancelStatus = $this->cart_model->updateCart('orders', $data['order_id'], $dataUpdate);
                    if ($cancelStatus) {
                        $this->cart_model->insertCart('orders_cancel', $data);
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
    }
    function handleCheckout()
    {
        if ($this->request->isPost()) {
            $data = $this->request->getFields();
            $cart_id = $data['cart_id'];
            unset($data['cart_id']);
            $this->request->rules([
                'phone' => 'required|phone|max:10',
                'fullname' => 'required|min:4|max:100',
                'address' => 'required|min:10|max:150',
                'email' => 'required|min:4|max:100|email',
                'note' => 'max:500',
            ]);
            $this->request->messages([
                'fullname.required' => 'Họ và tên không được để trống',
                'fullname.min' => 'Họ và tên tối thiểu 4 kí tự',
                'fullname.max' => 'Họ và tên tối đa 100 kí tự',
                'phone.required' => 'SDT không được để trống',
                'phone.phone' => 'SDT không đúng định dạng',
                'phone.max' => 'SDT không đúng định dạng',
                'address.required' => 'Địa chỉ không được để trống',
                'address.min' => 'Địa chỉ tối thiểu 10 kí tự',
                'address.max' => 'Địa chỉ tối đa 150 kí tự',
                'email.required' => 'Mail không được để trống',
                'email.min' => 'Mail tối thiểu 4 kí tự',
                'email.max' => 'Mail tối đa 100 kí tự',
                'email.email' => 'Mail không đúng định dạng',
                'note.max' => 'Ghi chú tối đa 500 kí tự',
            ]);
            $statusValidate = $this->request->valides();
            if ($statusValidate) {
                $provine = $data['country'];
                unset($data['country']);
                $data['address'] = '(' . $provine . ') - ' . $data['address'];
                $currentDate = date("Y-m-d H:i:s");
                $currentDate = str_replace("-", "",  str_replace(":", "",  str_replace(" ", "", $currentDate)));
                $data['order_code'] = '#OD' . $currentDate;
                $statusInsert = $this->cart_model->insertCart('orders', $data);
                if ($statusInsert) {
                    $orderStatusCheck = true;
                    $order_id = $this->cart_model->getLastId('orders');
                    foreach ($cart_id as $item) {
                        $statusGet = $this->cart_model->getItemOrder($item);
                        $product_infor = $this->cart_model->getProduct($statusGet['product_id']);

                        if ($statusGet) {
                            $orderList = $statusGet;
                            $orderList['order_id'] = $order_id['id'];
                            $statusOrder = $this->cart_model->insertCart('order_list', $orderList);
                            if (intval($statusGet['quantity']) > intval($product_infor['quantity'])) {
                                $orderStatusCheck = false;
                            }
                        }
                    }
                    if ($statusOrder && $orderStatusCheck) {
                        $statusRemove = $this->cart_model->removeCartQuery($cart_id);
                        if ($statusRemove) {
                            $responsiveJson['success'] = 'Đặt hàng thành công!';
                        } else {
                            $responsiveJson['error'] = 'Đặt hàng thất bại!';
                        }
                    } else {
                        $responsiveJson['error'] = 'Đặt hàng thất bại! Quá số lượng tồn hàng!';
                    }
                }
            } else {
                $sessionKey = Session::isInvalid();
                $error =   Session::flash($sessionKey . '_errors');
                $responsiveJson['error'] = reset($error);
            }
            echo json_encode($responsiveJson);
        }
    }
}
?>