<?php
class Product extends Controller
{
    public $data, $product_model, $request, $response, $session;
    public  function __construct()
    {
        $this->product_model = $this->model('ProductModel');
        $this->request = new Request();
        $this->response = new Response();
        $this->session = new Session();
    }
    public function book_product()
    {
        if ($this->request->isGet()) {
            $countRow = $this->product_model->getCount('products');
            $limit = 21;
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
            $product_list = $this->product_model->getListLimitView('book_product', $limit, $offset);
        }

        $this->data['sub_content']['products'] = $product_list;
        // $this->data['sub_content']['products']  = $product->getProductList();
        $this->data['page_title'] = 'Sản phẩm';
        $this->data['sub_content']['title'] = 'Sách';
        $this->data['sub_content']['page_name'] = 'book_product';
        $this->data['content'] = 'products/list';
        $this->data['sub_content']['page'] = $page;
        $this->data['sub_content']['maxPage'] = $maxPage;
        $this->render('layout/client_layout', $this->data);
    }
    public function other_product()
    {
        if ($this->request->isGet()) {
            $countRow = $this->product_model->getCount('products');
            $limit = 21;
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
            $product_list = $this->product_model->getListLimitView('other_product', $limit, $offset);
        }

        $this->data['sub_content']['products'] = $product_list;
        // $this->data['sub_content']['products']  = $product->getProductList();
        $this->data['page_title'] = 'Sản phẩm';
        $this->data['sub_content']['title'] = 'Sản phẩm khác';
        $this->data['sub_content']['page_name'] = 'other_product';
        $this->data['content'] = 'products/list';
        $this->data['sub_content']['page'] = $page;
        $this->data['sub_content']['maxPage'] = $maxPage;
        $this->render('layout/client_layout', $this->data);
    }
    public function search()
    {
        $data = $this->request->getFields();
        if ($this->request->isPost()) {
            if (!empty($data)) {
                $searchValue = trim($data['search']);
                $countRow = $this->product_model->getCountSearch($searchValue);
                $limit = 20;
                $maxPage = ceil($countRow / $limit);
                $page = 1;
                if ($page > $maxPage) {
                    $page = 1;
                }
                $offset = ($page - 1) * $limit;
                $product_list = $this->product_model->getSearch($searchValue, $limit, $offset);
                $this->data['sub_content']['value'] = $searchValue;
            } else {
                $this->response->redirect('product/book_product');
            }
        } else {
            $searchValue = trim($data['value']);
            $countRow = $this->product_model->getCountSearch($searchValue);
            $limit = 20;
            $maxPage = ceil($countRow / $limit);
            if (!empty($data)) {
                $page = $data['page'];
                if ($page > $maxPage) {
                    $page = 1;
                }
                $offset = ($page - 1) * $limit;
            } else {
                $page = 1;
                $offset = 0;
            }
            $product_list = $this->product_model->getSearch($searchValue, $limit, $offset);
        }
        $this->data['sub_content']['value'] = $searchValue;
        $this->data['sub_content']['products'] = $product_list;
        $this->data['page_title'] = 'Tìm kiếm';
        $this->data['sub_content']['title'] = 'Tìm kiếm';
        $this->data['content'] = 'products/search';
        $this->data['sub_content']['page'] = $page;
        $this->data['sub_content']['maxPage'] = $maxPage;
        $this->render('layout/client_layout', $this->data);
    }

    public function label()
    {
        $data = $this->request->getFields();
        if ($this->request->isGet()) {
            if (!empty($data)) {
                $countRow = $this->product_model->getCountLabel($data['id']);
                $limit = 20;
                $maxPage = ceil($countRow / $limit);
                if (!empty($data['page'])) {
                    $page = $data['page'];
                    if ($page > $maxPage) {
                        $page = 1;
                    }
                    $offset = ($page - 1) * $limit;
                } else {
                    $page = 1;
                    $offset = 0;
                }
                $product_list = $this->product_model->getListProductLabel($data['id'], $limit, $offset);
            } else {
                $this->response->redirect('product/book_product');
            }
        } else {
            $this->response->redirect('product/book_product');
        }
        $this->data['sub_content']['id'] = $data['id'];
        $this->data['sub_content']['products'] = $product_list;
        $this->data['page_title'] = 'Nhãn sản phẩm';
        $this->data['sub_content']['title'] = 'Nhãn sản phẩm';
        $this->data['content'] = 'products/label';
        $this->data['sub_content']['page'] = $page;
        $this->data['sub_content']['maxPage'] = $maxPage;
        $this->render('layout/client_layout', $this->data);
    }
    public function detail()
    {
        if ($this->request->isGet()) {
            $product_id = $this->request->getFields();
            $productReleted = $this->product_model->getListLimit(8, 0);
            foreach ($productReleted as $key => $item) {
                $imgList = $this->db->table('product_img')->where('product_id', '=', $item['id'])->get();
                $productReleted[$key]['imgList'] = $imgList;
            }
            $productData = $this->product_model->getDetail($product_id['id']);
            $imgList = $this->db->table('product_img')->where('product_id', '=', $productData['id'])->get();
            $this->data['sub_content']['product_infor'] = $productData;
            $this->data['sub_content']['product_releted'] = $productReleted;
            $this->data['sub_content']['product_img'] = $imgList;
            $this->data['content'] = 'products/detail';
            $this->data['page_title'] = $productData['product_name'];
            $this->render('layout/client_layout', $this->data);
        }
    }
}
?>