<?php

namespace Gravel\Core;

class Collection implements \Countable, \JsonSerializable, \Iterator
{
	public $data = [];
	private $_position = 0;

	public function __construct($data)
	{
		$this->data = $data;
		$this->_position = 0;
	}
	public function count()
	{
		return count($this->data);
	}

	public function jsonSerialize()
	{
		return $this->data;
	}

	public function __toString()
	{
		return json_encode($this->data);
	}

	public function current()
	{
		return $this->data[$this->_position];
	}

	public function next()
	{
		++$this->_position;
	}

	public function key()
	{
		return key($this->data[$this->_position]);
	}

	public function valid()
	{
		return (isset($this->data[$this->_position]));
	}

	public function rewind()
	{
		$this->_position = 0;
	}
}