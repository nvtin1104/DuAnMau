<?php
class AuthModel extends Model
{
    protected $table = 'user', $user_infor, $session;
    function tableFill()
    {
        return 'user';
    }
    function fieldFill()
    {
        return '*';
    }
    function primaryKey()
    {
        return 'id';
    }
    public function checkPassword($password, $username)
    {
        $userPass = $this->db->table('user')->where('username', '=', $username)->select('password')->firt();
        $userPass = $userPass['password'];
        if (password_verify($password, $userPass)) {
            return true;
        } else {
            // Mật khẩu không hợp lệ, thông báo lỗi
            return false;
        }
        return false;
    }
    public function getUserInfor($username)
    {
        $result = $this->db->table('user')->where('username', '=', $username)->firt();
        return $result;
    }
    public function getUserStatus($username)
    {
        $result = $this->db->table('user')->where('username', '=', $username)->select('status')->firt();
        return $result;
    }
    public function insertUser($data)
    {
        $statusInsert = $this->db->table('user')->insert($data);
        return $statusInsert;
    }
    public function insertToken($data)
    {
        $statusInsert = $this->db->table('change_email_token')->insert($data);
        return $statusInsert;
    }
    public function updateUser($data, $id)
    {
        $statusUpdate = $this->db->table('user')->where('id', '=', $id)->update($data);
        return $statusUpdate;
    }

    public function getInforOder($id)
    {
        $result = $this->db->table('orders')->where('user_id', '=', $id)->orderBy('id', 'DESC')->get();
        return $result;
    }
    public function getList($number = 10, $offset)
    {
        $statusGet = $this->db->table('user')->limit($number, $offset)->get();
        return $statusGet;
    }
    public function getListAccount($number = 10, $offset, $ban = null)
    {
        if (!empty($ban)) {
            $statusGet = $this->db->table('user')->where('status', '=', 'ban')->where('role', '!=', 'adminroot')->limit($number, $offset)->orderBy('id', 'DESC')->get();
        } else {
            $statusGet = $this->db->table('user')->where('role', '!=', 'adminroot')->limit($number, $offset)->orderBy('id', 'DESC')->get();
        }
        return $statusGet;
    }
    public function getSum($field, $table, $whereField = null, $value = null)
    {
        if(!empty($whereField) && !empty($value)){
            $result =  $this->db->select('SUM(' . $field . ') as sum')->table($table)->where($whereField, '=', $value)->firt();
        }
        else{
            $result =  $this->db->select('SUM(' . $field . ') as sum')->table($table)->firt();
        }
        return $result;
    }
    public function removeToken($id)
    {
        $result = $this->db->table('change_email_token')->where('user_id', '=', $id)->delete();
        return $result;
    }
    public function getOne($table, $field, $value)
    {
        $get = $this->db->table($table)->where($field, '=', $value)->firt();
        return $get;
    }
    public function getRole($field, $value)
    {
        $get = $this->db->table('user')->select('role')->where($field, '=', $value)->firt();
        return $get;
    }
    public function getCount($where = null)
    {
        if (!empty($where)) {
            $statusGet = $this->db->query("SELECT * FROM user WHERE status = 'ban' and role != 'adminroot'")->rowCount();
        } else {
            $statusGet = $this->db->query("SELECT * FROM user WHERE role != 'adminroot'")->rowCount();
        }
        return $statusGet;
    }
    public function count($table,$field = null, $value = null)
    {
        if (!empty($field) && !empty($value)) {
            $statusGet = $this->db->query("SELECT * FROM $table WHERE $field = $value")->rowCount();
        } else {
            $statusGet = $this->db->query("SELECT * FROM $table ")->rowCount();
        }
        return $statusGet;
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
}
?>