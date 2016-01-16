<?php

namespace Gravel\Core;

use Gravel\Gravel;

class Router
{
	public $routes = [];

	public function __construct()
	{
		$this->routes = require_once(APP_DIR . '/routes.php');
	}

	public static function createCRUD(&$routes, $path, $controller)
	{
		$routes = array_merge_recursive($routes, [
			'GET'  => [
				$path . '/create'       => "{$controller}::create",
				$path                   => "{$controller}::read",
				$path . '/(num)'        => "{$controller}::read",
				$path . '/edit/(num)'   => "{$controller}::update",
				$path . '/delete/(num)' => "{$controller}::delete"
			],
			'POST' => [
				$path . '/create'     => "{$controller}::create",
				$path . '/edit/(num)' => "{$controller}::update"
			]
		]);
	}

	public function matchRoute()
	{
		if (strlen(Gravel::$request->uri) !== 1) {
			$uri = rtrim(Gravel::$request->uri, '/');
		} else {
			$uri = Gravel::$request->uri;
		}
		$type = Gravel::$request->type;
		$patterns = $this->routes[$type];
		$params = [];
		foreach ($patterns as $pattern => $controller) {
			$route = $pattern;
			$pattern = str_replace(['(num)', '(string)', '(any)'], ['(?<n>\d+)', '(?<s>\w+)', '(?<s>.*)'], $pattern);
			if (preg_match("!^" . $pattern . "$!", $uri, $matches)) {
				foreach ($matches as $k => $v) {
					if (!is_numeric($k)) {
						$params[] = $matches[$k];
					}
				}
				list($controller, $method) = explode('::', $this->routes[$type][$route]);
				require_once(APP_DIR . "/controllers/{$controller}.php");
				$controller = new $controller();
				call_user_func_array([$controller, $method], $params);
				return true;
			}
		}

		return false;
	}
}
