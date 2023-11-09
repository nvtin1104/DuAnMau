<?php
class SettingModel extends Model
{
    protected $table = 'website';

    function tableFill()
    {
        return 'website';
    }
    function fieldFill()
    {
        return '*';
    }
    function primaryKey()
    {
        return 'id';
    }
    public function updateWebsite($data){
        foreach($data as $key => $value){
            $dataUpdate['value'] = $value;
            $result = $this->db->query("UPDATE `website` SET `value` = '$value' WHERE `name` = '$key'");
        }
        return $result;
    }
    public function getInforWebsite(){
        $result = $this->db->table('website')->get();
        return $result;
    }
}
?>