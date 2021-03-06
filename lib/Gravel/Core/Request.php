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
		if (isset($_SERVER['HTTP_HOST'])) {
			$this->uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
			$this->type = strtoupper($_SERVER['REQUEST_METHOD']);
		} else {
			if (isset($_SERVER['argv'])) {
				$copy = $_SERVER['argv'];
				array_shift($copy);
				$this->uri = '/' . implode('/', $copy);
			} else {
				$this->uri = '/';
			}
			$this->type = 'GET';
		}
	}
}