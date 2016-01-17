<?php

class testAdminController extends authController
{
	use crudTrait;

	protected $url = '/admin/tests';
	protected $table = 'test';
	protected $model = 'Test';
	protected $perPage = 5;

	public function __construct()
	{
		parent::__construct();
	}
}