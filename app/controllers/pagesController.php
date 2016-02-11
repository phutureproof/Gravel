<?php

use Gravel\Controller;

class pagesController extends Controller
{
    public function home($page = 1)
    {
        $this->loadView('home');
    }

	public function info()
	{
		phpinfo();
	}
}