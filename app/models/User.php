<?php

class User extends \Gravel\Model
{
    public static $table = 'users';
    public static $hidden = ['id', 'password'];
}