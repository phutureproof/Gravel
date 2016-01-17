<?php

trait crudTrait
{
	public function create()
	{
		if (count($_POST) > 0) {
			$model = $this->model;
			$model = $model::create();
			if ($model->validate($_POST)) {
				$model->save();
				header("Location: {$this->url}");
				exit;
			}
		}
		$form = \Gravel\Scaffolding::createInsertForm($this->table, $this->model);
		$this->loadView('utilities/genericCreate', compact('form'));
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
		$this->loadView('utilities/genericList', compact('records', 'pagination', 'tableHeaders', 'url', 'model'));
	}

	public function update($id = null)
	{
		$model = $this->model;
		$id = $id;

		if (count($_POST) > 0) {
			$record = $model::find($id);
			if ($record->validate($_POST)) {
				$record->save();
				header("Location: {$this->url}");
				exit;
			}
		}

		$form = \Gravel\Scaffolding::createEditForm($this->table, $this->model, $id);
		$this->loadView('utilities/genericUpdate', compact('form'));
	}

	public function delete($id = null)
	{
		$model = $this->model;
		$model::delete($id);
		header("Location: {$this->url}");
		exit;
	}
}