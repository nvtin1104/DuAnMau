<?php
class LabelModel extends Model
{
    function tableFill()
    {
        return 'labels';
    }
    function fieldFill()
    {
        return '*';
    }
    function primaryKey()
    {
        return 'id';
    }
    public function getList($table)
    {
        $result = $this->db->table($table)->get();
        return $result;
    }
    public function getListLabel($limit, $offset = 0)
    {
        $result = $this->db->table('labels')->limit($limit, $offset)->get();
        return $result;
    }
    public function getLabelFlowGroup($id)
    {
        $result = $this->db->table('labels')->where('id_group', '=', $id)->get();
        return $result;
    }
    public function getOne($table, $id)
    {
        $result = $this->db->table($table)->where('id', '=', $id)->firt();
        return $result;
    }
    public function getListGroup($limit, $offset = 0)
    {
        $result = $this->db->table('label_group')->limit($limit, $offset)->get();
        return $result;
    }
    public function getCount($field)
    {
        $result = $this->db->query("SELECT * FROM $field ")->rowCount();
        return $result;
    }
    public function insertLabel($data)
    {
        $statusInsert = $this->db->table('labels')->insert($data);
        return $statusInsert;
    }
    public function insertLabelGroup($data)
    {
        $statusInsert = $this->db->table('label_group')->insert($data);
        return $statusInsert;
    }
    public function updateLabel($data, $table, $id)
    {
        $statusInsert = $this->db->table($table)->where('id', '=', $id)->update($data);
        return $statusInsert;
    }
    public function deleteLabel($table, $id)
    {
        $statusDelete = $this->db->table($table)->where('id', '=', $id)->delete();
        return $statusDelete;
    }
}
?>