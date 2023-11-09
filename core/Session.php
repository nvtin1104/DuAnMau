<?php 
class Session
{
    
    static public function data($key = '', $value = '')
    {
        $sessionKey = self::isInvalid();
        if (!empty($value)) {
            if (!empty($key)) {
                $_SESSION[$sessionKey][$key] = $value;
                return true;
            }
            return false;
        } else {
            if (empty($key)) {
                if (isset($_SESSION[$sessionKey])) {
                    return $_SESSION[$sessionKey];
                }
            }
            if (isset($_SESSION[$sessionKey][$key])) {
                return $_SESSION[$sessionKey][$key];
            }
        }
    }
    static public function showError($message)
    {
        $data['message'] = $message;
        App::$app->loadError('exception', $data);
    }
    static public   function flash($key = '', $value = '')
    {
        $dataFlash = self::data($key, $value);
        if (empty($value)) {
            self::delete($key);
        }
        return $dataFlash;
    }
    static public function delete($key = '')
    {
        $sessionKey = self::isInvalid();
        if (!empty($key)) {
            if (isset($_SESSION[$sessionKey][$key])) {
                unset($_SESSION[$sessionKey][$key]);
                return true;
            }
            return false;
        } else {
            unset($_SESSION[$sessionKey]);
            return true;
        }
        return false;
    }
    static function isInvalid()
    {
        global $config;
        if (!empty($config['session'])) {
            $sessionConfig = $config['session'];
            if (!empty($sessionConfig['session_key'])) {
                $sessionKey = $sessionConfig['session_key'];
                return $sessionKey;
            } else {
                self::showError('Thiếu cấu hình config session');
            }
        } else {
            self::showError('Thiếu cấu hình config session');
        }
    }
}
?>