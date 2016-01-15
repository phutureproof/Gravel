<?php

class brandAdminController extends authController implements crudInterface
{
	public function __construct()
	{
		parent::__construct();
	}

	public function create()
	{
		if (count($_POST) > 0) {
			$brand = Brand::create();
			if ($brand->validate($_POST)) {
				$brand->save();
				header("Location: /admin/brands");
				exit;
			}
		}
		$this->loadView('admin/brands/create');
	}

	public function read()
	{
		$brands = Brand::all();
		$this->loadView('admin/brands/list', compact('brands'));
	}

	public function update($id = null)
	{
		$brand = Brand::find($id);
		$id = $id;
		if (count($_POST) > 0) {
			if ($brand->validate($_POST)) {
				$brand->save();
				header("Location: {$_SERVER['HTTP_REFERER']}");
				exit;
			}
		}
		$this->loadView('admin/brands/edit', compact('brand', 'id'));
	}

	public function delete($id = null)
	{
		// TODO: Implement delete() method.
	}
}