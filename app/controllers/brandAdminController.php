<?php

class brandAdminController extends authController
{
	use crudTrait;

	protected $table = 'brands';
	protected $model = 'Brand';
	protected $url = '/admin/brands';
	protected $perPage = 5;

	public function __construct()
	{
		parent::__construct();
	}

}