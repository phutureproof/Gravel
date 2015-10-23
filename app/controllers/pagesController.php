<?php

use Gravel\Controller;

class pagesController extends Controller
{
    public function home()
    {
	    $this->loadView('home');
    }

	public function dev()
	{
		// handle post data
		if (count($_POST)) {

		}

		$this->loadView('add-post');
	}
}