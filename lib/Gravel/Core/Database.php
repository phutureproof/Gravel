<?php

namespace Gravel\Core;

use \Gravel\Gravel;

class Database
{
	private static $_instance;
	private $_con;

	/**
	 * private constructor allows singleton pattern
	 */
	private function __construct()
	{
		$config = Gravel::$config['database'];

		$this->_con = new \PDO(
			"{$config['driver']}:host={$config['hostname']};dbname={$config['database']};charset={$config['charset']}",
			$config['username'],
			$config['password']
		);
	}

	/**
	 * @return Database
	 */
	public static function getInstance()
	{
		if (!self::$_instance) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

	/**
	 * @param $sql
	 *
	 * @return \PDOStatement
	 */
	public function prepare($sql)
	{
		return $this->_con->prepare($sql);
	}

	/**
	 * @param $statement
	 *
	 * @return \PDOStatement
	 */
	public function query($statement)
	{
		return $this->_con->query($statement);
	}
}