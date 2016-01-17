<?php

use Gravel\TemplateEngine;

class blogAdminController extends authController
{

	use crudTrait;

	protected $model = 'Blog';
	protected $table = 'blog_posts';
	protected $url = '/admin/blog';
	protected $perPage = 5;

	public function __construct()
	{
		parent::__construct();
		TemplateEngine::extendPageTitle(' :: Blog');
	}
}