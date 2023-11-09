<?php 
class Routes
{
    private $keyRoute = null, $uri;
    function handleRoutes($url)
    {
        global $routes;
        unset($routes['default_controller']);
        $url = trim($url, '/');
        if (empty($url)) {
            $url = '/';
        }
        $handleUrl = $url;
        if (!empty($routes)) {
            foreach ($routes as $key => $value) {
                if (preg_match('~' . $key . '~is', $url)) {
                    $handleUrl = preg_replace('~' . $key . '~is', $value, $url);
                    $this->keyRoute = $key;
                }
            }
        }
        return $handleUrl;
    }
    public function getUri()
    {
        return $this->keyRoute;
    }
    static public function getFullUrl()
    {
        $uri = App::getUrl();
        $url = _WEB_ROOT . $uri;
        return $url;
    }
}
?>