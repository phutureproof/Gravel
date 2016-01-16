<?php

use Gravel\TemplateEngine;

class usersAdminController extends authController implements crudInterface
{
	public function __construct()
	{
		parent::__construct();
		TemplateEngine::extendPageTitle(' :: Users');
	}

	public function read($page = 1)
	{
		$users = User::all();
		$users->paginate(5, $page);
		$pagination = $users->generatePaginationLinks("/admin/users/", $page);
		$this->loadView('admin/users/list', compact('users', 'pagination'));
	}

	public function create()
	{
		if (count($_POST) > 0) {
			$user = User::create();
			if ($user->validate($_POST)) {
				$user->password = sha1($user->password); // hash password
				$user->save();
				header("Location: /admin/users");
				exit;
			}
		}
		$this->loadView('admin/users/create');
	}

	public function update($id = null)
	{
		$id = $id;
		$user = User::find($id);
		if (count($_POST) > 0) {
			if ($user->validate($_POST)) {
				$user->save();
				header("Location: {$_SERVER['HTTP_REFERER']}");
				exit;
			}
		}

		$this->loadView('admin/users/edit', compact('user', 'id'));
	}

	public function delete($id = null)
	{
		User::delete($id);
		header("Location: {$_SERVER['HTTP_REFERER']}");
		exit;
	}
}