<?php

class usersAdminController extends authController
{
	public function __construct()
	{
		parent::__construct();
	}

	public function read()
	{
		$users = User::all();
		$this->loadView('admin/users/list', compact('users'));
	}

	public function create()
	{
		if (count($_POST) > 0) {
			$user = User::create();
			if ($user->validate($_POST)) {
				$user->save();
				header("Location: /admin/users");
				exit;
			}
		}
		$this->loadView('admin/users/create');
	}

	public function update($id)
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

	public function delete($id)
	{
		User::delete($id);
		header("Location: {$_SERVER['HTTP_REFERER']}");
		exit;
	}
}