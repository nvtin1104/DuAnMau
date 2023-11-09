<?php
class Blogs extends Controller
{
    public $data;
    public function index()
    {
        $this->data['sub_content']['new_title'] = 'tile_Blogs';
        $this->data['sub_content']['list'] = 'tile_Blogs 2';
        $this->data['sub_content']['new_author'] = 'Tin';
        $this->data['content'] = '404';
        $this->render('layout/client_layout', $this->data);
    }
}
?>