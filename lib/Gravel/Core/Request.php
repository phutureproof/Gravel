<?php

namespace Gravel\Core;

class Request
{
    public $data;
    public $params;
    public $uri;
    public $type;

    public function __construct()
    {
        $this->data = $_POST;
        $this->params = $_GET;
        $this->uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $this->type = strtoupper($_SERVER['REQUEST_METHOD']);
    }
}