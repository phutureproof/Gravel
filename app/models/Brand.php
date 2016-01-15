<?php

class Brand extends \Gravel\Model
{
	protected static $table = 'brands';
	protected static $hidden = ['id'];

	protected static $validation = [
		'title' => ['Title', 'required']
	];
}