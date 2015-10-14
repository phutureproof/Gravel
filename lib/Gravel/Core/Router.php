<?php

namespace Gravel\Core;

use Gravel\Gravel;

class Router
{
    public $routes = [];

    public function __construct()
    {
        $this->routes = require_once(APP_DIR .'/routes.php');
    }

    public function matchRoute()
    {
        $uri = Gravel::$request->uri;
        $type = Gravel::$request->type;
        $toCheck = $this->routes[$type];
        if(array_key_exists($uri, $toCheck)) {
            list($controller, $method) = explode('::', $this->routes[$type][$uri]);
            require_once(APP_DIR . "/controllers/{$controller}.php");
            $controller = new $controller();
            call_user_func_array([$controller, $method], []);
        } else {
            Gravel::show404();
        }
    }


}