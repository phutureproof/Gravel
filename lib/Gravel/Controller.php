<?php

namespace Gravel;

class Controller
{
	protected $table;
	protected $model;
	protected $url;
	protected $perPage;

	public function __construct()
	{

	}

	public function loadView($file, $data = [])
	{
		$file = preg_replace('!\.php$!', '', $file) . '.php';
		if (file_exists(APP_DIR . "/views/{$file}")) {
			Gravel::$response->addOutput(APP_DIR . "/views/{$file}", $data);
		}
	}
}