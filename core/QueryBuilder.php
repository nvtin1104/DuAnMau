<?php
trait QueryBuilder
{
    public $tableName = '';
    public $where = '';
    public $operator = '';
    public $selectField = '*';
    public $limit = '';
    public $orderBy = '';
    public $innerJoin = '';
    public function table($tableName)
    {
        $this->tableName = $tableName;
        return $this;
    }
    public function where($field, $compare, $value)
    {
        if (empty($this->where)) {
            $this->operator = 'WHERE ';
        } else {
            $this->operator = ' AND ';
        }
        $this->where .= "  $this->operator $field $compare '$value'";
        return $this;
    }
    public function orWhere($field, $compare, $value)
    {
        if (empty($this->where)) {
            $this->operator = 'WHERE ';
        } else {
            $this->operator = ' OR ';
        }
        $this->where .= "  $this->operator $field $compare '$value'";
        return $this;
    }
    public function whereLike($field, $value)
    {
        if (empty($this->where)) {
            $this->operator = 'WHERE ';
        } else {
            $this->operator = ' AND ';
        }
        $this->where .= "  $this->operator $field LIKE '%$value%'";
        return $this;
    }
    public function select($field = '*')
    {
        $this->selectField = $field;
        return $this;
    }
    public function get()
    {
        $sqlQuery = "SELECT $this->selectField FROM $this->tableName $this->innerJoin $this->where $this->orderBy $this->limit";
        $sqlQuery = trim($sqlQuery);
        $query = $this->query($sqlQuery);
        $this->resetQuery();
        if (!empty($query)) {
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } else return false;
    }
    public function firt()
    {
        $sqlQuery = "SELECT $this->selectField FROM $this->tableName $this->where $this->limit";
        $query = $this->query($sqlQuery);
        $this->resetQuery();
        if (!empty($query)) {
            return $query->fetch(PDO::FETCH_ASSOC);
        } else return false;
    }
    public function insert($data)
    {
        $tableName = $this->tableName;
        $statusInsert = $this->insertData($tableName, $data);
        return $statusInsert;
    }
    public function update($data)
    {
        $tableName = $this->tableName;
        $conditionUpdate = str_replace('WHERE', '', $this->where);
        $conditionUpdate = trim($conditionUpdate);
        $statusUpdate = $this->updateData($tableName, $data, $conditionUpdate);
        return $statusUpdate;
    }
    public function delete(){
        $tableName = $this->tableName;
        $conditionDelete = str_replace('WHERE', '', $this->where);
        $conditionDelete = trim($conditionDelete);
        $statusDelete = $this->deleteData($tableName, $conditionDelete);
        return $statusDelete;
    }
    public function limit($number, $offset = 0)
    {
        $this->limit = "LIMIT $offset, $number";
        return  $this;
    }
    public function orderBy($field, $type = 'ASC')
    {
        $fieldArr = array_filter(explode(',', $field));
        if (!empty($fieldArr) && count($fieldArr) >= 2) {
            $this->orderBy = "ORDER BY " . implode(", ", $fieldArr);
        } else {
            $this->orderBy = "ORDER BY  $field $type ";
        }
        return $this;
    }
    public function innerJoin($table, $relationship)
    {
        $this->innerJoin .= 'INNER JOIN ' . $table . ' ON ' . $relationship;
        return $this;
    }
    public function resetQuery()
    {
        $this->tableName = '';
        $this->where = '';
        $this->operator = '';
        $this->selectField = '*';
        $this->limit = '';
        $this->orderBy = '';
        $this->innerJoin = '';
    }
}
?>