<?php

use Gravel\Controller;

class pagesController extends Controller
{
    public function home()
    {
	    $user = User::find(1);
	    $user->firstname = 'Dale';
	    $user->lastname = 'Paget';
	    $user->email = 'dale.paget@outlook.com';
	    $user->password = sha1('password');
	    $user->save();

	    echo User::all();
    }

}