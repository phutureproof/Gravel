<?php

use Gravel\TemplateEngine;

class usersAdminController extends authController
{
	use crudTrait;

	protected $table = 'users';
	protected $model = 'User';
	protected $url = '/admin/users';
	protected $perPage = 5;

	public function __construct()
	{
		parent::__construct();
		TemplateEngine::extendPageTitle(' :: Users');
	}

	public function update($id = null)
	{
		$id = $id;
		$user = User::find($id);

		if (count($_POST) > 0) {
			$password = $user->password;
			if ($user->validate($_POST)) {
				if ($password !== $user->password) {
					$user->password = sha1($user->password);
				}
				$user->save();
				header("Location: {$_SERVER['HTTP_REFERER']}");
				exit;
			}
		}

		$form = \Gravel\Scaffolding::createEditForm($this->table, $this->model, $id);
		$this->loadView('utilities/genericUpdate', compact('id', 'user', 'form'));
	}
}