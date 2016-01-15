<?php

use Gravel\Controller;

class pagesController extends Controller
{
    public function home($page = 1)
    {
        if (count($_POST) > 0) {
            $user = User::create();
            if ($user->validate($_POST)) {
                $user->save();
                header("Location: /");
                exit;
            }
        }

        $users = User::all();

        $users->paginate(5, $page);
        $pagination = $users->generatePaginationLinks('/page/', $page);
        $this->loadView('home', compact('users', 'pagination'));
    }
}