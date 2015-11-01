<?php

class User extends \Gravel\Model
{
    protected static $table = 'users';
    protected static $hidden = ['id', 'password'];

    protected static $validation = [
        'firstname' => ['First Name', 'required'],
        'lastname'  => ['Last Name', 'required'],
        'email'     => ['Email', 'required|email'],
        'password'  => ['Password', 'required|min_length[6]']
    ];
}