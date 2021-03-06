<?php

namespace Gravel;

use Gravel\Gravel;
use Gravel\Core\Database;
use Gravel\Core\EntityCollection;
use Gravel\Core\RecordEntity;

class Model
{
	protected static $table = '';
	protected static $idColumn = 'id';
	protected static $hidden = [];
	protected static $validation = [];
	protected static $relations = [];

	public static function find($id)
	{
		$db = Database::getInstance();
		$table = Gravel::$config['database']['table_prefix'].static::$table;
		$idColumn = static::$idColumn;
		$id = intval($id);
		$sql = "SELECT * FROM `{$table}` WHERE `{$idColumn}` = ?";
		$statement = $db->prepare($sql);
		$statement->execute([$id]);
		$data = $statement->fetch(\PDO::FETCH_ASSOC);
		return ($data) ? static::generateRecordEntity($data) : false;
	}

	public static function findAllBy($data)
	{
		$db = Database::getInstance();
		$table = Gravel::$config['database']['table_prefix'].static::$table;
		foreach ($data as $k => $v) {
			$data[$k] = '%' . $v . '%';
		}
		$where = [];
		foreach ($data as $k => $v) {
			$where[] = "{$k} LIKE ?";
		}
		$where = implode(', ', $where);
		$statement = $db->prepare("SELECT * FROM {$table} WHERE {$where}");
		$statement->execute(array_values($data));
		$data = $statement->fetchAll(\PDO::FETCH_CLASS);
		$toReturn = [];
		foreach ($data as $newObject) {
			array_push($toReturn, static::generateRecordEntity($newObject));
		}
		return new EntityCollection($toReturn);
	}

	public static function findOneBy($data = [])
	{
		$db = Database::getInstance();
		$table = Gravel::$config['database']['table_prefix'].static::$table;
		foreach ($data as $k => $v) {
			$data[$k] = '%' . $v . '%';
		}
		$where = [];
		foreach (array_keys($data) as $column) {
			$where[] = "{$column} LIKE ?";
		}
		$where = implode(' AND ', $where);
		$statement = $db->prepare("SELECT * FROM {$table} WHERE {$where} LIMIT 1");
		$statement->execute(array_values($data));
		$data = $statement->fetch(\PDO::FETCH_ASSOC);
		return ($data) ? static::generateRecordEntity($data) : false;
	}

	public static function create()
	{
		$db = Database::getInstance();
		$table = Gravel::$config['database']['table_prefix'].static::$table;
		$data = $db->query("SHOW COLUMNS FROM {$table}")->fetchAll(\PDO::FETCH_ASSOC);
		$columns = [];
		foreach ($data as $k => $v) {
			$columns[$v['Field']] = '';
		}
		return static::generateRecordEntity($columns);
	}

	public static function all()
	{
		$db = Database::getInstance();
		$table = Gravel::$config['database']['table_prefix'].static::$table;
		$result = $db->query("SELECT * FROM `{$table}`")->fetchAll(\PDO::FETCH_ASSOC);
		$toReturn = [];
		foreach ($result as $existingRecordData) {
			array_push($toReturn, static::generateRecordEntity($existingRecordData));
		}
		return new EntityCollection($toReturn);
	}

	public static function delete($id)
	{
		$db = Database::getInstance();
		$table = Gravel::$config['database']['table_prefix'].static::$table;
		$idColumn = static::$idColumn;
		$sql = "DELETE FROM {$table} WHERE {$idColumn} = ?;";
		$statement = $db->prepare($sql);
		return $statement->execute([$id]);
	}

	protected static function generateRecordEntity($data)
	{
		return new RecordEntity(
			$data,
			static::$hidden,
			static::$table,
			static::$idColumn,
			static::$validation,
			static::$relations
		);
	}
}