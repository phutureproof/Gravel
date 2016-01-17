<?php

class Test extends \Gravel\Model
{
	protected static $table = 'test';
	protected static $hidden = ['id'];
	protected static $validation = [
		'title'   => ['Title', 'required'],
		'content' => ['Content', 'required']
	];
}