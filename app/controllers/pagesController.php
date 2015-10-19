<?php

use Gravel\Controller;

class pagesController extends Controller
{
    public function home()
    {
	    $this->load('home');
    }

    public function about()
    {
        $this->load('about');
    }
}