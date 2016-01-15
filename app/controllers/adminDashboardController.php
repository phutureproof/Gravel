<?php

class adminDashboardController extends authController
{
	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$this->loadView('admin/dashboard');
	}
}