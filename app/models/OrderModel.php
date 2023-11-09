<?php
class OrderModel extends Model
{

    function tableFill()
    {
        return 'orders';
    }
    function fieldFill()
    {
        return '*';
    }
    function primaryKey()
    {
        return 'id';
    }
    public function getUser($username)
    {
        $result = $this->db->table('user')->where('username', '=', $username)->firt();
        return $result;
    }
    public function getLastId($table)
    {
        $result = $this->db->table($table)->select('MAX(id) as id')->firt();
        return $result;
    }
    public function getProduct($id)
    {
        $result = $this->db->table('products')->where('id', '=', $id)->firt();
        return $result;
    }
    public function checkExist($table, $user_id, $product_id)
    {
        $result = $this->db->table($table)->where('user_id', '=', $user_id)->where('product_id', '=', $product_id)->firt();
        return $result;
    }

    public function getItemOrder($id)
    {
        $result = $this->db->table('cart_items')->where('id', '=', $id)->select('product_id,quantity,total_price')->firt();
        return $result;
    }
    public function getListOrder($limit, $offset = 0)
    {
        $result = $this->db->table('orders')->orderBy('id','DESC')->limit($limit, $offset)->get();
        return $result;
    }
    public function getOne($table, $field, $value)
    {
        $result = $this->db->table($table)->where($field, '=', $value)->firt();
        return $result;
    }
    public function getInforOrder($id)
    {
        $result = $this->db->table('orders')->where('id', '=', $id)->firt();
        return $result;
    }
    public function getFullOrder($id)
    {
        $result = $this->db->table('order_list')->where('order_id', '=', $id)->get();
        foreach ($result as $key => $item) {
            $img = $this->db->select('img_dir')->table('product_img')->where('product_id', '=', $item['product_id'])->firt();
            $product_name = $this->db->select('product_name')->table('products')->where('id', '=', $item['product_id'])->firt();
            $filePath = $img['img_dir'];
            $result[$key]['img'] = substr($filePath, 1);
            $result[$key]['product_name'] = $product_name['product_name'];
        }
        return $result;
    }
    public function getCount($field)
    {
        $result = $this->db->query("SELECT * FROM $field ")->rowCount();
        return $result;
    }
    public function getCart($table, $user_id)
    {
        $result = $this->db->table($table)->where('user_id', '=', $user_id)->get();
        if (!empty($result)) {
            foreach ($result as $key => $item) {
                $imgList = $this->db->table('product_img')->where('product_id', '=', $item['product_id'])->firt();
                $filePath = $imgList['img_dir'];
                $imgDir = substr($filePath, 1);
                $price = $this->db->table('products')->where('id', '=', $item['product_id'])->select('price')->firt();
                $productname = $this->db->table('products')->where('id', '=', $item['product_id'])->select('product_name')->firt();
                $result[$key]['price'] = $price['price'];
                $result[$key]['product_name'] = $productname['product_name'];
                $result[$key]['imgDir'] = $imgDir;
            }
        }
        return $result;
    }
    public function changeStatus($id,$status){
        $result = $this->db->table('orders')->where('id', '=', $id)->update($status);
        return $result;
    }
    public function updateCart($table, $id, $data)
    {
        $result = $this->db->table($table)->where('id', '=', $id)->update($data);
        return $result;
    }
    public function insertCart($table, $data)
    {
        $result = $this->db->table($table)->insert($data);
        return $result;
    }
    public function getReasonCancel($id){
        $result = $this->db->table('orders_cancel')->where('order_id', '=', $id)->select('reason')->firt();
        return $result;
    }
    public function removeCart($table, $id)
    {
        $result = $this->db->table($table)->where('id', '=', $id)->delete();
        return $result;
    }

    public function removeCartQuery($ids)
    {
        foreach ($ids as $id) {
            $result = $this->db->query('DELETE FROM cart_items WHERE id =  ' . $id);
        }
        return $result;
    }
    public function removeAll($table, $id)
    {
        $result = $this->db->table($table)->where('user_id', '=', $id)->delete();
        return $result;
    }
}
?>