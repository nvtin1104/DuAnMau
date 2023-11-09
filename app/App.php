<?php
class App
{
    private $__controller, $__action, $__params, $__roustes, $__db;
    static public $app;

    function __construct()
    {
        global $routes, $config;
        self::$app = $this;
        $this->__roustes = new Routes();
        if (!empty($routes)) {
            $this->__controller = $routes['default_controller'];
        }
        $this->__action = 'index';
        $this->__params = [];
        if (class_exists('DB')) {
            $dbOject = new DB();
            $this->__db = $dbOject->db;
        }

        $this->handleUrl();
    }
    static function getUrl()
    {
        if (!empty($_SERVER['PATH_INFO'])) {
            $url = $_SERVER['PATH_INFO'];
        } else {
            $url = '/';
        }
        return $url;
    }
    public function handleUrl()
    {
        $url = $this->getUrl();
        $url = $this->__roustes->handleRoutes($url);
        $this->handleGlobalMiddleware($this->__db);
        $this->handleRouteMiddleware($this->__roustes->getUri(), $this->__db);
        $this->handleAppServiceProvider($this->__db);

        $urlArr = array_filter(explode('/', $url));
        $urlArr = array_values($urlArr);

        $urlCheck = '';
        if (!empty($urlArr)) {
            foreach ($urlArr as $key => $item) {
                $urlCheck .= $item . '/';
                $fileCheck = rtrim($urlCheck, '/');
                $fileArr = explode('/', $fileCheck);
                $fileArr[count($fileArr) - 1] = ucfirst($fileArr[count($fileArr) - 1]);
                $fileCheck = implode('/', $fileArr);
                if (!empty($urlArr[$key - 1])) {
                    unset($urlArr[$key - 1]);
                }
                if (file_exists('app/controllers/' . ($fileCheck) . '.php')) {
                    $urlCheck = $fileCheck;
                    break;
                }
            }
            $urlArr = array_values($urlArr);
        }
        if (!empty($urlArr[0])) {
            $this->__controller = ucfirst($urlArr[0]);
        } else {
            $this->__controller = ucfirst($this->__controller);
        }
        if (empty($urlCheck)) {
            $urlCheck = $this->__controller;
        }
        if (file_exists('app/controllers/' . ($urlCheck) . '.php')) {
            require_once 'controllers/' . ($urlCheck) . '.php';
            // kieerm tra class this controller tồn tại
            if (class_exists($this->__controller)) {
                $this->__controller = new $this->__controller();
                unset($urlArr[0]);
                if (!empty($this->__db)) {
                    $this->__controller->db = $this->__db;
                }
            } else {
                $this->loadError();
            }
        } else {
            $this->loadError();
        }
        if (!empty($urlArr[1])) {
            $this->__action = ucfirst($urlArr[1]);
            unset($urlArr[1]);
        }
        $this->__params = array_values($urlArr);
        // kieerm tra method tồn tại 
        if (method_exists($this->__controller, $this->__action)) {
            call_user_func_array([$this->__controller, $this->__action], $this->__params);
        } else {
            $this->loadError();
        }
    }
    public function getController()
    {
        return $this->__controller;
    }
    public function loadError($name = '404', $data = [])
    {
        extract($data);
        require_once 'errors/' . $name . '.php';
    }
    public function handleRouteMiddleware($keyRoute, $db)
    {
        global $config;
        if (!empty($config['app']['routeMiddleware'])) {
            $routeMiddleware = $config['app']['routeMiddleware'];
            $keyRoute = trim($keyRoute);
            if (!empty($routeMiddleware)) {
                foreach ($routeMiddleware as $key => $routeMiddlewareItem) {
                    if ($keyRoute == $key && file_exists('app/middlewares/' . $routeMiddlewareItem . '.php')) {
                        require_once 'app/middlewares/' . $routeMiddlewareItem . '.php';
                        if (class_exists($routeMiddlewareItem)) {
                            $middlewareOject = new $routeMiddlewareItem;
                            if (!empty($db)) {
                                $middlewareOject->db = $db;
                            }
                            $middlewareOject->handle();
                        }
                    }
                }
            }
        }
    }
    public function handleGlobalMiddleware($db)
    {
        global $config;
        if (!empty($config['app']['globalMiddleware'])) {
            $globalMiddleware = $config['app']['globalMiddleware'];
            if (!empty($globalMiddleware)) {
                foreach ($globalMiddleware as $key => $globalMiddlewareItem) {
                    if (file_exists('app/middlewares/' . $globalMiddlewareItem . '.php')) {
                        require_once 'app/middlewares/' . $globalMiddlewareItem . '.php';
                        if (class_exists($globalMiddlewareItem)) {
                            $middlewareOject = new $globalMiddlewareItem;
                            if (!empty($db)) {
                                $middlewareOject->db = $db;
                            }
                            $middlewareOject->handle();
                        }
                    }
                }
            }
        }
    }
    public function handleAppServiceProvider($db)
    {
        global $config;
        if (!empty($config['app']['boot'])) {
            $serviceProvider = $config['app']['boot'];
            if (!empty($serviceProvider)) {
                foreach ($serviceProvider as $serviceName) {
                    if (file_exists('app/core/' . $serviceName . '.php')) {
                        require_once 'app/core/' . $serviceName . '.php';
                        if (class_exists($serviceName)) {
                            $serviceOject = new $serviceName;
                            if (!empty($db)) {
                                $serviceOject->db = $db;
                            }
                            $serviceOject->boot();
                        }
                    }
                }
            }
        }
    }
}
?>