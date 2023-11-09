<?php
class AppServiceProvider extends ServiceProvider
{

    public function boot()
    {
        $session = new Session();
        $isLogin = $session->data('isLogin');
        $user_name = $session->data('user_name');
        if (!empty($user_name) && $isLogin) {
            $result = $this->db->table('user')->where('username', '=', $user_name)->firt();

            $cart = $this->getList('cart_items', $result['id']);
            $wishlist = $this->getList('wishlist', $result['id']);

            $data['user_infor'] = $result;
            $data['user_infor']['cart'] = $cart;
            $data['user_infor']['wishlist'] = $wishlist;
        } else {
            $data['user_infor'] = '';
        }
        $inforWeb = $this->getInforWebsite();
        foreach ($inforWeb as $value) {
            $data['inforWebsite'][$value['name']] = $value['value'];
        }
        $data['group_book'] = $this->getLabelGroup('book_product');// nhận dữ liệu từ  book_product. trong bảng label_group
        $data['group_other'] = $this->getLabelGroup('orther_group');// nhận dữ liệu từ  orther_group.
        $data['label_list'] = $this->getLabelList();
        View::share($data);//chia sẻ dữ liệu với tất cả các view.
    }
    public function getList($table, $user_id)
    {
        $data =  $this->db->table($table)->where('user_id', '=', $user_id)->get();
        if (!empty($table)) {
            foreach ($data as $key => $item) {
                $imgList = $this->db->table('product_img')->where('product_id', '=', $item['product_id'])->firt();
                $filePath = $imgList['img_dir'];
                $imgDir = substr($filePath, 1);
                $price = $this->db->table('products')->where('id', '=', $item['product_id'])->select('price')->firt();
                $productname = $this->db->table('products')->where('id', '=', $item['product_id'])->select('product_name')->firt();
                $data[$key]['price'] = $price['price'];
                $data[$key]['product_name'] = $productname['product_name'];
                $data[$key]['imgDir'] = $imgDir;
            }
        }
        return $data;
    }
    public  function getLabelList()
    {
        $data =  $this->db->table('labels')->get();
        return $data;
    }
    public function getLabelGroup($category)
    {
        $data =  $this->db->table('label_group')->where('category_group', '=', $category)->get();
        return $data;
    }
    public function getInforWebsite(){
        $result = $this->db->table('website')->get();
        return $result;
    }
}
?>