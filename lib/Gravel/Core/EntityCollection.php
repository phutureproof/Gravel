<?php

namespace Gravel\Core;

class EntityCollection extends Collection
{
	public $data = [];
	public $pages = 1;
	public $perPage = 0;
	private $_dataStore = [];

	public function __construct($data)
	{
		parent::__construct($data);
		$this->_dataStore = $this->data = $data;
		$this->pages = 1;
		$this->perPage = count($this->_dataStore);
	}

	public function __toString()
	{
		$string = [];
		foreach ($this->data as $k => $v) {
			if (is_object($v)) {
				$string[] = $v;
			}
		}
		return '[' . implode(',', $string) . ']';
	}

	public function paginate($limit, $page = 1)
	{
		if ($page > 0) {
			$page -= 1;
		}
		$this->data = array_slice($this->_dataStore, ($page * $limit), $limit);
		$this->pages = ceil(count($this->_dataStore) / $limit);
		$this->perPage = $limit;
	}

	public function generatePaginationLinks($url, $currentPage)
	{
		$url = rtrim($url, '/') . '/';
		$toReturn = [];
		for ($i = 1; $i <= $this->pages; ++$i) {
			$class = ($currentPage == $i) ? 'active' : null;
			$string = "<li class=\"{$class}\"><a href=\"{$url}{$i}\">" . $i . "</a></li>";
			array_push($toReturn, $string);
		}
		return "<ul class=\"pagination\">" . implode('', $toReturn) . "</ul>";
	}

	public function filter(\Closure $function)
	{
		$this->data = array_values(array_filter($this->data, $function));
		$this->_dataStore = array_values(array_filter($this->_dataStore, $function));
	}
}