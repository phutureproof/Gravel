<?php

use Gravel\Model;

class UserExample extends Model
{
	protected static $table = 'users';
	protected static $hidden = ['id', 'password'];
}