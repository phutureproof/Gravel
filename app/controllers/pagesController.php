<?php

use Gravel\Controller;

class pagesController extends Controller
{
    public function home()
    {
	    $offset = (isset($_GET['page'])) ? $_GET['page'] : 0;
	    $users = User::all();
	    $users->paginate(3, $offset);
	    $pagination = $users->generatePaginationLinks();

	    $this->loadView('home', compact('users', 'pagination'));
    }
}