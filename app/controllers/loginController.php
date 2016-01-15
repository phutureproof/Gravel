<?php

use Gravel\TemplateEngine;

class loginController extends \Gravel\Controller
{
	public function index()
	{
		TemplateEngine::setPageTitle('Admin Login');
		$this->loadView('admin/login');
	}

	public function login()
	{
		if (isset($_POST['email'], $_POST['password'])) {
			$user = User::findOneBy(['email' => $_POST['email'], 'password' => sha1($_POST['password'])]);
			if ($user) {
				$_SESSION['is-admin'] = true;
				$_SESSION['admin-username'] = $user->username;
				header("Location: /admin/dashboard");
				exit;
			}
		}
		$this->index();
	}

	public function logout()
	{
		if (isset($_SESSION['is-admin'])) {
			unset($_SESSION['is-admin']);
		}
		header("Location: /admin");
		exit;
	}
}