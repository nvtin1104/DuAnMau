<?php
class ProductModel extends Model
{
    function tableFill()
    {
        return 'products';
    }
    function fieldFill()
    {
        return '*';
    }
    function primaryKey()
    {
        return 'id';
    }
    public function insertProduct($data)
    {
        $statusInsert = $this->db->table('products')->insert($data);
        return $statusInsert;
    }
    public function insertImgProduct($data)
    {
        $statusInsert = $this->db->table('product_img')->insert($data);
        return $statusInsert;
    }
    public function insertLabel($data)
    {
        $statusInsert = $this->db->query("INSERT INTO product_label (product_id, label_id) VALUES ('" . $data['product_id'] . "', '" . $data['label_id'] . "')");
        return $statusInsert;
    }
    public function getList($table)
    {
        $result = $this->db->table($table)->get();
        return $result;
    }
    public function getListLimit($limit, $offset = 0)
    {
        $result = $this->db->table('products')->limit($limit, $offset)->get();
        return $result;
    }
    public function getListLimitView($category, $limit, $offset = 0)
    {
        $result = $this->db->table('products')->where('category', '=', $category)->limit($limit, $offset)->get();
        foreach ($result as $key => $row) {
            $img = $this->db->select('img_dir')->table('product_img')->where('product_id', '=', $row['id'])->get();
            $result[$key]['img-0'] = substr($img[0]['img_dir'], 1);
            $result[$key]['img-1'] = substr($img[1]['img_dir'], 1);
        }
        return $result;
    }
    public function getDetail($id)
    {
        $result = $this->db->table('products')->where('id', '=', $id)->firt();
        return $result;
    }
    public function getOne($table, $id)
    {
        $result = $this->db->table($table)->where('id', '=', $id)->firt();
        return $result;
    }
    public function getLastId()
    {
        $result = $this->db->table('products')->select('MAX(id) as id')->firt();
        return $result;
    }
    public function getListGroup()
    {
        $result = $this->db->table('label_group')->get();
        return $result;
    }
    public function getListLabel()
    {
        $result = $this->db->table('labels')->get();
        return $result;
    }
    public function getImg($id)
    {
        $result = $this->db->table('product_img')->where('product_id', '=', $id)->get();
        return $result;
    }
    public function getOneImg($id)
    {
        $result = $this->db->table('product_img')->where('id', '=', $id)->firt();
        return $result;
    }
    public function getCount($field)
    {
        $result = $this->db->query("SELECT * FROM $field ")->rowCount();
        return $result;
    }
    public function getCountLabel($id)
    {
        $result = $this->db->query("SELECT * FROM products INNER JOIN product_label ON products.id = product_label.product_id WHERE product_label.label_id = $id")->rowCount();
        return $result;
    }
    public function getListProductLabel($id, $limit, $offset)
    {
        $query = $this->db->query("SELECT * FROM products INNER JOIN product_label ON products.id = product_label.product_id WHERE product_label.label_id = $id LIMIT $limit OFFSET $offset");
        if (!empty($query)) {
            $result = $query->fetchAll(PDO::FETCH_ASSOC);
            foreach ($result as $key => $row) {
                $img = $this->db->select('img_dir')->table('product_img')->where('product_id', '=', $row['product_id'])->get();
                $result[$key]['img-0'] = substr($img[0]['img_dir'], 1);
                $result[$key]['img-1'] = substr($img[1]['img_dir'], 1);
            }
            return $result;
        }
        else{
            return false;
        }
    }
    public function getCountSearch($value)
    {
        $result = $this->db->query("SELECT * FROM products WHERE product_name LIKE '%$value%'")->rowCount();
        return $result;
    }
    public function getSearch($value, $limit, $offset)
    {
        $result = $this->db->table('products')->whereLike('product_name', $value)->limit($limit, $offset)->get();
        foreach ($result as $key => $row) {
            $img = $this->db->select('img_dir')->table('product_img')->where('product_id', '=', $row['id'])->get();
            $result[$key]['img-0'] = substr($img[0]['img_dir'], 1);
            $result[$key]['img-1'] = substr($img[1]['img_dir'], 1);
        }
        return $result;
    }
    public function deleteTable($table, $field, $value)
    {
        $result = $this->db->table($table)->where($field, '=', $value)->delete();
        return $result;
    }
    public function deleteProduct($id)
    {
        $result = $this->db->table('products')->where('id', '=', $id)->delete();
        return $result;
    }
    public function updateProduct($table, $id, $data)
    {
        $statusUpdate = $this->db->table($table)->where('id', '=', $id)->update($data);
        return $statusUpdate;
    }
    public function upload($files)
    {
        $session = new Session();
        $target_dir = './uploads/';
        // Thư mục lưu trữ tệp
        $dirArr = [];
        foreach ($files as $inputName => $file) {
            if (isset($file["error"]) && $file["error"] == UPLOAD_ERR_NO_FILE) {
                $session->data('upload_file_erorr', 'File ' . $inputName . ' trống');
            } elseif ($file["error"] == UPLOAD_ERR_OK) {
                // Tiếp tục xử lý tệp tin đã được tải lên
                $target_file = $target_dir . basename($file["name"]);
                $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
                // Kiểm tra định dạng hợp lệ và xử lý tiếp
                if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
                    $session->flash('upload_file_erorr', 'Chỉ chấp nhận các tệp JPG, JPEG, PNG. Tại file ' . $inputName . '');
                } else {
                    if (file_exists($target_file)) {
                        $fileName = pathinfo($file['name'], PATHINFO_FILENAME);
                        $newFileName = $fileName . '-Copy';
                        $target_file = $target_dir . $newFileName . '.' . $imageFileType;
                        $cnt = 1;
                        while (file_exists($target_file)) {
                            $fileName = pathinfo($file['name'], PATHINFO_FILENAME);
                            $newFileName = $fileName . '-Copy(' . $cnt . ')';
                            $target_file = $target_dir . $newFileName . '.' . $imageFileType;
                            $cnt++;
                        }
                    }
                    if (move_uploaded_file($file["tmp_name"], $target_file)) {
                        // Lưu thông tin sản phẩm vào cơ sở dữ liệu
                        $dirArr[$inputName] = $target_file;
                    } else {
                        $session->flash('upload_file_erorr', 'Lỗi khi tải file ' . $inputName . '');
                    }
                }
            }
        }
        $error = $session->flash('upload_file_erorr');
        if (!empty($error)) {
            return false;
        } else {
            $session->flash('dirArr', $dirArr);
            return  true;
        }
    }
}
?>