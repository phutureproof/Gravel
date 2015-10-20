<?php

namespace Gravel\Core;

class RecordEntity
{
	private $_data = [];
	private $_hiddenColumns = [];
	private $_table;
	private $_idColumn = '';

	public function __construct($data = [], $hiddenColumns = [], $table = '', $idColumn = '')
	{
		foreach ($data as $k => $v) {
			$this->_data[$k] = $v;
		}

		foreach ($hiddenColumns as $column) {
			$this->_hiddenColumns[] = $column;
		}

		$this->_table = $table;
		$this->_idColumn = $idColumn;
	}

	public function __get($name)
	{
		return (isset($this->_data[$name])) ? $this->_data[$name] : false;
	}

	public function __set($name, $value)
	{
		return $this->_data[$name] = $value;
	}

	public function __toString()
	{
		$returnArray = [];
		foreach ($this->_data as $k => $v) {
			if (!in_array($k, $this->_hiddenColumns)) {
				$returnArray[$k] = $v;
			}
		}
		return json_encode($returnArray);
	}

	public function save()
	{
		$db = Database::getInstance();
		$data = $this->_data;
		$key = key($this->_data);
		$columns = array_diff_key($data, [$key => $key]);
		$values = array_values($columns);
		$updates = [];
		foreach ($columns as $k => $v) {
			$updates[] = "{$k} = ?";
		}
		$updates = implode(', ', $updates);
		$sql = "UPDATE {$this->_table} SET {$updates} WHERE {$key} = {$data[$key]}";
		$statement = $db->prepare($sql);
		return $statement->execute($values);
	}

}