<?php

use Gravel\TemplateEngine;

class authController extends \Gravel\Controller
{
	public function __construct()
	{
		if (!isset($_SESSION['is-admin'])) {
			header("Location: /admin");
			exit;
		}

		TemplateEngine::setPageTitle('Dashboard');
	}
}