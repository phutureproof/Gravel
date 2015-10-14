<?php

session_start();

define('BASE_DIR', __DIR__);
define('APP_DIR', BASE_DIR . '/app');
define('MODEL_DIR', APP_DIR . '/models');
define('LIB_DIR', BASE_DIR . '/lib');

spl_autoload_register(function ($classname) {

    $file = str_replace(['\\', '_'], '/', $classname);

    if (file_exists(MODEL_DIR . "/{$file}.php")) {
        require_once(MODEL_DIR . "/{$file}.php");
        return;
    }

    if (file_exists(LIB_DIR . "/{$file}.php")) {
        require_once(LIB_DIR . "/{$file}.php");
        return;
    }

});