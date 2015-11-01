<?php

use Gravel\Controller;

class pagesController extends Controller
{
    public function home()
    {
        if (count($_POST) > 0) {
            $user = User::create();
            $user->validate($_POST);
            var_dump($user);
        }

        $offset = (isset($_GET['page'])) ? $_GET['page'] : 0;
        $users = User::all();
        $users->paginate(3, $offset);
        $pagination = $users->generatePaginationLinks();

        $this->loadView('home', compact('users', 'pagination'));
    }
}