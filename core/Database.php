<?php 
class Database
{
    private $__conn;
    use QueryBuilder;

    function __construct()
    {
        global $db_config;
        $this->__conn = Connection::getInstance($db_config);
    }
    function insertData($tableName, $data)
    {
        if (!empty($data)) {
            $fieldStr = '';
            $valueStr = '';
            foreach ($data as $key => $value) {
                $fieldStr .= $key . ',';
                $valueStr .= "'" . $value . "',";
            }
            $fieldStr = rtrim($fieldStr, ', ');
            $valueStr = rtrim($valueStr, ', ');
            $sql = "INSERT INTO $tableName($fieldStr) VALUES ($valueStr)";
            $status = $this->query($sql);
            if ($status) {
                return true;
            }
        }
        return false;
    }
    function updateData($tableName, $data, $condition = '')
    {
        if (!empty($data)) {
            $updateStr = '';
            foreach ($data as $key => $value) {
                $updateStr .= "$key = '$value',";
            }
            $updateStr = rtrim($updateStr, ', ');
            if (!empty($condition)) {

                $sql = "UPDATE $tableName SET $updateStr WHERE $condition";
            } else {
                $sql = "UPDATE $tableName SET $updateStr";
            }
            $status = $this->query($sql);
            if ($status) {
                return true;
            }
        }
        return false;
    }
    function deleteData($tableName, $condition = '')
    {
        if (!empty($condition)) {
            $sql = "DELETE FROM $tableName WHERE $condition";
        } else {
            $sql = "DELETE FROM $tableName";
        }
        $status = $this->query($sql);
        if ($status) {
            return true;
        }
        return false;
    }
    function query($sql)
    {
        try {
            $stmt = $this->__conn->prepare($sql);
            $stmt->execute();
            return $stmt;
        } catch (Exception $exception) {
            $mess = $exception->getMessage();
            $data['message'] = $mess;
            App::$app->loadError('database', $data);
            die();
        }
    }
}
?>
