<?php

class User extends \Gravel\Model
{
	protected static $table = 'users';
	protected static $hidden = ['id', 'password'];
}