<?php

use Gravel\TemplateEngine;

class adminDashboardController extends authController
{
	public function __construct()
	{
		parent::__construct();
		TemplateEngine::setPageTitle('Dashboard');
	}

	public function index()
	{
		$this->loadView('admin/dashboard');
	}
}