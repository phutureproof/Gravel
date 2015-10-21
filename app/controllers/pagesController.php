<?php

use Gravel\Controller;

class pagesController extends Controller
{
    public function home()
    {
	    $this->loadView('home');
    }
}