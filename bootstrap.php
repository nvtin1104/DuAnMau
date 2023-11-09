<?php
define('__DIR_ROOT__', __DIR__);
// xử lý web root
if (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') {
    $web_root = 'https://' . $_SERVER['HTTP_HOST'];
} else {
    $web_root = 'http://' . $_SERVER['HTTP_HOST'];
}
$document_root = str_replace('\\', '/', $_SERVER['DOCUMENT_ROOT']);

$folder = str_replace(strtolower($document_root), '', strtolower(str_replace('\\', '/', __DIR_ROOT__)));
$web_root = $web_root . $folder;

define('_WEB_ROOT', $web_root);
$config_dir = scandir('configs');
if (!empty($config_dir)) {
    foreach ($config_dir  as $item) {
        if ($item != '.' && $item != '..' && file_exists('configs/' . $item)) {
            require_once 'configs/' . $item;
        }
    }
}
if (!empty($config['app']['services'])) {
    $allServices = $config['app']['services'];
    if (!empty($allServices)) {
        foreach ($allServices as $serviceName) {
            if (file_exists('app/core/' . $serviceName . '.php')) {
                require_once 'app/core/' . $serviceName . '.php';
            }
        }
    }
}

require_once 'core/ServiceProvider.php';

require_once 'core/View.php';

require_once 'core/Load.php';

require_once 'core/Middlewares.php';

require_once 'core/Routes.php';

require_once 'core/Session.php';

if (!empty($config['database'])) {
    $db_config = array_filter($config['database']);
    if (!empty($db_config)) {
        require_once 'core/Connection.php';
        require_once 'core/QueryBuilder.php';
        require_once 'core/Database.php';
        require_once 'core/DB.php';
    }
}
require_once 'core/Helper.php';
$allHelper = scandir('app/helper');
if (!empty($allHelper)) {
    foreach ($allHelper  as $item) {
        if ($item != '.' && $item != '..' && file_exists('app/helper/' . $item)) {
            require_once 'app/helper/' . $item;
        }
    }
}


require_once 'app/App.php';

require_once 'core/Model.php';

require_once 'core/Template.php';

require_once 'core/Controller.php';

require_once 'core/Request.php';

require_once 'core/Response.php';


// print_r($config);
?>