<?php

namespace Gravel;

use Gravel\Core\Request;
use Gravel\Core\Response;
use Gravel\Core\Router;

abstract class Gravel
{
    /** @var \Gravel\Core\Request */
    public static $request;

    /** @var \Gravel\Core\Response */
    public static $response;

    /** @var \Gravel\Core\Router */
    public static $router;

    /** @var bool */
    public static $initialized = false;

    public static function init()
    {
        if (!self::$initialized) {
            self::$initialized = true;
            self::$request = new Request();
            self::$response = new Response();
            self::$router = new Router();
        }

        self::$router->matchRoute();
    }

    public static function show404()
    {
        $controller = new Controller();
        $controller->load('errors/404');
    }
}