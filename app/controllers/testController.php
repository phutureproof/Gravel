<?php

use Gravel\TemplateEngine;

class testController extends \Gravel\Controller
{
	public function __construct()
	{
		TemplateEngine::setPageTitle("Gravel Tests");
	}

	public function index()
	{
		$post = Blog::find(4);
		$user = $post->fetchRelation('user_id');
		echo $post;
		echo $user;
	}
}