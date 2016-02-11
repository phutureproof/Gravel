<?php

trait crudTrait
{
	public function create()
	{
		$table = \Gravel\Gravel::$config['database']['table_prefix'].$this->table;
		if (count($_POST) > 0) {

			// csrf protection
			if(\Gravel\Gravel::$config['gravel']['csrf_tokens'])
			{
				if (!isset($_POST['csrf_token']) || ($_POST['csrf_token'] !== $_SESSION['csrf_token']))
				{
					(new \Gravel\Controller())->loadView('admin/core/csrf');
					exit;
				}
			}

			$model = $this->model;
			$model = $model::create();
			if ($model->validate($_POST)) {
				$model->save();
				header("Location: {$this->url}/");
				exit;
			}
		}
		$form = \Gravel\Scaffolding::createInsertForm($table, $this->model);
		$this->loadView('admin/core/genericCreate', compact('form'));
	}

	public function read($page = 1)
	{
		$model = $this->model;
		$records = $model::all();
		$tableHeaders = [];
		$url = $this->url;
		if (count($records) > 0) {
			$tableHeaders = $records->data[0]->getColumns();
		}
		$pagination = null;
		if ($this->perPage > 0) {
			$records->paginate($this->perPage, $page);
			$pagination = $records->generatePaginationLinks($this->url, $page);
		}
		$this->loadView('admin/core/genericRead', compact('records', 'pagination', 'tableHeaders', 'url', 'model'));
	}

	public function update($id = null)
	{
		$table = \Gravel\Gravel::$config['database']['table_prefix'].$this->table;
		$model = $this->model;
		$id = $id;

		if (count($_POST) > 0) {
			$record = $model::find($id);
			if ($record->validate($_POST)) {
				$record->save();
				header("Location: {$this->url}/");
				exit;
			}
		}

		$form = \Gravel\Scaffolding::createEditForm($table, $this->model, $id);
		$this->loadView('admin/core/genericUpdate', compact('form'));
	}

	public function delete($id = null)
	{
		$model = $this->model;
		$model::delete($id);
		header("Location: {$this->url}/");
		exit;
	}


}