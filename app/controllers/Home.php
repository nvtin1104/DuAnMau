<?php
class Home extends Controller
{
    public $home_modal, $data;
    public function __construct()
    {
        $this->home_modal = $this->model('HomeModel');
    }
    function index()
    {
        $dataNew = $this->home_modal->getNewProduct(10, 0);
        $dataSale = $this->home_modal->getSaleProduct(10, 0);
        $this->data['sub_content']['new_product'] = $dataNew;
        $this->data['sub_content']['sale_product'] = $dataSale;
        $this->data['content'] = 'home/index';
        $this->render('layout/client_layout', $this->data);
    }
    function contact_us()
    {
        $this->data['sub_content'] = [];
        $this->data['content'] = 'home/contact';
        $this->render('layout/client_layout', $this->data);
    }
    function about_us()
    {
        $this->data['sub_content'] = [];
        $this->data['content'] = 'home/about_us';
        $this->render('layout/client_layout', $this->data);
    }
}
?>