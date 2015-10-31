<?php

class User extends \Gravel\Model
{
	protected static $table = 'users';
	protected static $hidden = ['id', 'password'];

	protected static $validation = [
		[
			'field' => 'firstname',
			'label' => 'First Name',
			'rules' => 'required'
		],
		[
			'field' => 'lastname',
			'label' => 'Last Name',
			'rules' => 'required'
		],
		[
			'field' => 'email',
			'label' => 'Email',
			'rules' => 'required|email'
		],
		[
			'field' => 'password',
			'label' => 'Password',
			'rules' => 'required|min_length[8]'
		]
	];
}