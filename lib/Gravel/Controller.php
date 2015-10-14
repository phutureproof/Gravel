<?php

namespace Gravel;

class Controller
{
    public function __construct()
    {

    }

    public function view($data)
    {

    }

    public function load($file)
    {
        $file = preg_replace('!\.php$!', '', $file) . '.php';

        if ( file_exists(APP_DIR . "/views/$file")) {
            echo file_get_contents(APP_DIR . "/views/$file");
        }
    }
}