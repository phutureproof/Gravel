<?php

class Blog extends Gravel\Model
{
	protected static $table = 'blog_posts';
	protected static $hidden = ['id', 'user_id'];
	protected static $validation = [
		'title'   => ['Title', 'required'],
		'content' => ['Content', 'required']
	];
}