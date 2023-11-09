<?php 
class Request
{
    private $rules = [], $messages = [], $errors = [];
    public $db;
    function __construct()
    {
        $this->db = new Database();
    }
    public function getMethod()
    {
        return strtolower($_SERVER['REQUEST_METHOD']);
    }
    public function isPost()
    {
        if ($this->getMethod() == 'post') {
            return true;
        }
        return false;
    }
    public function isGet()
    {
        if ($this->getMethod() == 'get') {
            return true;
        }
        return false;
    }
    public function getFields()
    {
        $dataFields = [];
        if ($this->isGet()) {
            if (!empty($_GET)) {
                foreach ($_GET as $key => $value) {
                    if (is_array($value)) {
                        $dataFields[$key] = filter_input(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS, FILTER_REQUIRE_ARRAY);
                    } else {
                        $dataFields[$key] = filter_input(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS);
                    }
                }
            }
        }
        if ($this->isPost()) {
            if (!empty($_POST)) {
                foreach ($_POST as $key => $value) {
                    if (is_array($value)) {
                        $dataFields[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS, FILTER_REQUIRE_ARRAY);
                    } else {
                        $dataFields[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS);
                    }
                }
            }
        }
        return $dataFields;
    }
    public function rules($rules = [])
    {
        $this->rules = $rules;
    }
    public function messages($messages = [])
    {
        $this->messages = $messages;
    }
    public function valides($data = null)
    {
        $this->rules = array_filter($this->rules);
        $checkValidate = true;
        if (!empty($this->rules)) {
            if(empty($data)){
                $dataFields = $this->getFields();
            }
            else{
                $dataFields = $data;
            }
            foreach ($this->rules as $fieldName => $ruleItem) {
                $ruleItemArr = explode('|', $ruleItem);

                foreach ($ruleItemArr as $rules) {

                    $ruleName = null;
                    $ruleValue = null;

                    $rulesArr = explode(':', $rules);
                    $ruleName = reset($rulesArr);
                    if (count($rulesArr) > 1) {
                        $ruleValue = end($rulesArr);
                    }
                    if ($ruleName == 'required') {
                        if (empty(trim($dataFields[$fieldName]))) {
                            $this->setError($fieldName, $ruleName);
                            $checkValidate = false;
                        }
                    }
                    if ($ruleName == 'number') {
                        if (!is_numeric(trim($dataFields[$fieldName]))) {
                            $this->setError($fieldName, $ruleName);
                            $checkValidate = false;
                        }
                    }
                    if ($ruleName == 'positiveNumber') {
                        if (trim($dataFields[$fieldName]) <= 0) {
                            $this->setError($fieldName, $ruleName);
                            $checkValidate = false;
                        }
                    }
                    if ($ruleName == 'min') {
                        if (strlen(trim($dataFields[$fieldName])) < $ruleValue) {
                            $this->setError($fieldName, $ruleName);
                            $checkValidate = false;
                        }
                    }

                    if ($ruleName == 'max') {
                        if (strlen(trim($dataFields[$fieldName])) > $ruleValue) {
                            $this->setError($fieldName, $ruleName);
                            $checkValidate = false;
                        }
                    }
                    if ($ruleName == 'phone') {
                        $phoneRegex = '/^[0-9]{10,15}$/';
                        if (!preg_match($phoneRegex, $dataFields[$fieldName])) {
                            $this->setError($fieldName, $ruleName);
                            $checkValidate = false;
                        }
                    }
                    if ($ruleName == 'email') {
                        if (!filter_var($dataFields[$fieldName], FILTER_VALIDATE_EMAIL)) {
                            $this->setError($fieldName, $ruleName);
                            $checkValidate = false;
                        }
                    }
                    if ($ruleName == 'macth') {
                        if (trim($dataFields[$fieldName]) != trim($dataFields[$ruleValue])) {
                            $this->setError($fieldName, $ruleName);
                            $checkValidate = false;
                        }
                    }
                    if ($ruleName == 'unique') {
                        $tableName = null;
                        $fieldCheck = null;
                        if (!empty($rulesArr[1])) {
                            $tableName = $rulesArr[1];
                        }
                        if (!empty($rulesArr[2])) {
                            $fieldCheck = $rulesArr[2];
                        }
                        if (!empty($tableName) && !empty($fieldCheck)) {
                            if (count($rulesArr) == 3) {
                                $checkExist = $this->db->query("SELECT $fieldCheck FROM $tableName WHERE $fieldCheck = '$dataFields[$fieldName]'")->rowCount();
                            } elseif (count($rulesArr) == 4) {
                                if (!empty($rulesArr[3]) && preg_match('~.+?~is', $rulesArr[3])) {
                                    $conditionWhere = $rulesArr[3];
                                    $conditionWhere = str_replace('=', '<>', $conditionWhere);
                                    $checkExist = $this->db->query("SELECT $fieldCheck FROM $tableName WHERE $fieldCheck = '$dataFields[$fieldName]' AND $conditionWhere")->rowCount();
                                }
                            }
                            if (!empty($checkExist)) {
                                $this->setError($fieldName, $ruleName);
                                $checkValidate = false;
                            }
                        }
                    }
                    if ($ruleName == 'notunique') {
                        $tableName = null;
                        $fieldCheck = null;
                        if (!empty($rulesArr[1])) {
                            $tableName = $rulesArr[1];
                        }
                        if (!empty($rulesArr[2])) {
                            $fieldCheck = $rulesArr[2];
                        }
                        if (!empty($tableName) && !empty($fieldCheck)) {
                            if (count($rulesArr) == 3) {
                                $checkExist = $this->db->query("SELECT $fieldCheck FROM $tableName WHERE $fieldCheck = '$dataFields[$fieldName]'")->rowCount();
                            } elseif (count($rulesArr) == 4) {
                                if (!empty($rulesArr[3]) && preg_match('~.+?~is', $rulesArr[3])) {
                                    $conditionWhere = $rulesArr[3];
                                    $conditionWhere = str_replace('=', '<>', $conditionWhere);
                                    $checkExist = $this->db->query("SELECT $fieldCheck FROM $tableName WHERE $fieldCheck = '$dataFields[$fieldName]' AND $conditionWhere")->rowCount();
                                }
                            }
                            if (empty($checkExist)) {
                                $this->setError($fieldName, $ruleName);
                                $checkValidate = false;
                            }
                        }
                    }
                    if ($ruleName == 'confirm') {
                        $tableName = null;
                        $fieldCheck = null;
                        if (!empty($rulesArr[1])) {
                            $tableName = $rulesArr[1];
                        }
                        if (!empty($rulesArr[2])) {
                            $fieldCheck = $rulesArr[2];
                        }
                        if (!empty($tableName) && !empty($fieldCheck)) {
                            if (count($rulesArr) == 3) {
                                $checkExist = $this->db->query("SELECT $fieldCheck FROM $tableName WHERE $fieldCheck = '$dataFields[$fieldName]'")->rowCount();
                            } elseif (count($rulesArr) == 4) {
                                if (!empty($rulesArr[3]) && preg_match('~.+?~is', $rulesArr[3])) {
                                    $conditionWhere = $rulesArr[3];
                                    $conditionWhere = str_replace('=', '<>', $conditionWhere);
                                    $checkExist = $this->db->query("SELECT $fieldCheck FROM $tableName WHERE $fieldCheck = '$dataFields[$fieldName]' AND $conditionWhere")->rowCount();
                                }
                            }
                            if (empty($checkExist)) {
                                $this->setError($fieldName, $ruleName);
                                $checkValidate = false;
                            }
                        }
                    }
                    if (preg_match('~^callback_(.+)~is', $ruleName, $callbackArr)) {
                        if (!empty($callbackArr[1])) {
                            $callbackName = $callbackArr[1];
                            $controller = App::$app->getController();
                            if (method_exists($controller, $callbackName)) {
                                $checkCallback = call_user_func_array([$controller, $callbackName], [trim($dataFields[$fieldName])]);
                                if (!empty($checkCallback)) {
                                    $this->setError($fieldName, $ruleName);
                                    $checkValidate = false;
                                }
                            }
                        }
                    }
                }
            }
        }
        $sessionKey = Session::isInvalid();
        Session::flash($sessionKey . '_errors', $this->errors());
        Session::flash($sessionKey . '_old', $this->getFields());
        return $checkValidate;
    }
    public function errors($fieldName = '')
    {
        if (!empty($this->errors)) {
            if (empty($fieldName)) {
                $errorsArr = [];
                foreach ($this->errors as $key => $error) {
                    $errorsArr[$key] = reset($error);
                }
                return $errorsArr;
            }
            return reset($this->errors[$fieldName]);
        }
        return false;
    }
    public function setError($fieldName, $ruleName)
    {
        $this->errors[$fieldName][$ruleName] = $this->messages[$fieldName . '.' . $ruleName];
    }
}
?>