<?php

session_start();

define('BASE_DIR', __DIR__);
define('APP_DIR', BASE_DIR . '/app');
define('CONTROLLER_DIR', APP_DIR . '/controllers');
define('MODEL_DIR', APP_DIR . '/models');
define('LIB_DIR', BASE_DIR . '/lib');

spl_autoload_register(function ($classname) {

	$file = str_replace(['\\', '_'], '/', $classname . '.php');

	if (file_exists(CONTROLLER_DIR . "/{$file}")) {
		require_once(CONTROLLER_DIR . "/{$file}");
		return;
	}

	if (file_exists(MODEL_DIR . "/{$file}")) {
		require_once(MODEL_DIR . "/{$file}");
		return;
	}

	if (file_exists(LIB_DIR . "/{$file}")) {
		require_once(LIB_DIR . "/{$file}");
		return;
	}

});