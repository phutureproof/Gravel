<?php

namespace Gravel;

use Gravel\Core\Request;
use Gravel\Core\Response;
use Gravel\Core\Router;
use Gravel\Core\Permissions;

abstract class Gravel
{
	/** @var string */
	public static $version = '1.00.00';

	/**@var \Gravel\Core\Request */
	public static $request;

	/** @var \Gravel\Core\Response */
	public static $response;

	/** @var \Gravel\Core\Router */
	public static $router;

	/** @var \Gravel\Core\Permissions */
	public static $permissions;

	/** @var bool */
	public static $initialized = false;

	/** @var integer */
	public static $startTime;

	/** @var array */
	public static $formErrors = [];

	/** @var array */
	public static $config = [];

	/**
	 * init
	 *
	 */
	public static function init()
	{
		if (!self::$initialized) {
			self::$startTime = microtime(true);
			self::$initialized = true;
			self::$request = new Request();
			self::$response = new Response();
			self::$router = new Router();

			self::configure();

			self::$permissions = new Permissions();
		}
		if (!self::$router->matchRoute()) {
			self::show404();
		}
	}

	/**
	 * show404
	 */
	public static function show404()
	{
		$controller = new Controller();
		$controller->loadView('utilities/404');
	}

	/**
	 * configure
	 */
	public static function configure()
	{
		self::$config = parse_ini_file(APP_DIR . '/app.config.ini', true);
		// front maintenance mode
		if (self::$config['gravel']['front_maintenance_mode'] && stripos(self::$request->uri, 'admin') == false) {
			(new Controller())->loadView('utilities/maintenance');
			exit;
		}

		// admin maintenance mode
		if (self::$config['gravel']['admin_maintenance_mode'] && stripos(self::$request->uri, 'admin') == true) {
			(new Controller())->loadView('utilities/maintenance');
			exit;
		}

		foreach (self::$config['php'] as $k => $v) {
			ini_set($k, $v);
		}
	}
}