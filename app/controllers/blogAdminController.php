<?php

class blogAdminController extends authController implements crudInterface
{

	public function __construct()
	{
		parent::__construct();
	}

	public function create()
	{
		if (count($_POST) > 0) {
			$post = Blog::create();
			if ($post->validate($_POST)) {
				$post->save();
				header("Location: /admin/blog");
				exit;
			}
		}
		$this->loadView('admin/blog/create');
	}

	public function read()
	{
		$posts = Blog::all();
		$this->loadView('admin/blog/list', compact('posts'));
	}

	public function update($id = null)
	{
		$post = Blog::find($id);
		$id = $id;

		if (count($_POST) > 0) {
			if ($post->validate($_POST)) {
				$post->save();
				header("Location: {$_SERVER['HTTP_REFERER']}");
				exit;
			}
		}

		$this->loadView('admin/blog/edit', compact('post', 'id'));
	}

	public function delete($id = null)
	{
		Blog::delete($id);
		header("Location: {$_SERVER['HTTP_REFERER']}");
		exit;
	}
}