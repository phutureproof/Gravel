<?php

namespace Gravel;

use Gravel\Core\Database;

class Scaffolding
{
	public static function createInsertForm($table)
	{
		$db = Database::getInstance();
		$sql = "SHOW COLUMNS FROM `{$table}`";
		$statement = $db->prepare($sql);
		$statement->execute();
		$columns = $statement->fetchAll(\PDO::FETCH_ASSOC);

		$output = self::generateFormOpenTag();
		foreach ($columns as $column) {
			$output .= self::generateFormGroup($column);
		}
		$output .= self::generateButtons();
		$output .= self::generateFormCloseTag();

		return $output;
	}

	public static function createEditForm($table, $model, $id)
	{
		$db = Database::getInstance();
		$sql = "SHOW COLUMNS FROM `{$table}`";
		$statement = $db->prepare($sql);
		$statement->execute();
		$columns = $statement->fetchAll(\PDO::FETCH_ASSOC);

		$recordData = $model::find($id);

		$output = self::generateFormOpenTag();
		foreach ($columns as $column) {
			$property = $column['Field'];
			$output .= self::generateFormGroup($column, $recordData->$property);
		}
		$output .= self::generateButtons();
		$output .= self::generateFormCloseTag();

		return $output;
	}

	public static function generateLabel($columnData)
	{
		return "
				<label for=\"{$columnData['Field']}\">{$columnData['Field']}</label>";
	}

	public static function generateInput($columnData, $defaultValue = null)
	{
		$column = $columnData['Field'];
		$type = strtolower($columnData['Type']);
		$default = $columnData['Default'];

		// text fields (single line input)
		if (preg_match('/tinyint|smallint|mediumint|int|bigint|varchar/', $type)) {
			$oldPost = isset($_POST[$column]) ? $_POST[$column] : $defaultValue;
			$output = "
				<input type=\"text\" id=\"{$column}\" name=\"{$column}\" class=\"form-control\" placeholder=\"{$default}\" value=\"{$oldPost}\" />";
		}

		// text areas (multiline input)
		if (preg_match('/smalltext|mediumtext|largetext|text/', $type)) {
			$defaultValue = isset($_POST[$column]) ? $_POST[$column] : $defaultValue;
			$output = "
				<textarea id=\"{$column}\" name=\"{$column}\" class=\"form-control\" placeholder=\"{$default}\" rows=\"10\">{$defaultValue}</textarea>";
		}
		return $output;
	}

	public static function generateFormGroup($columnData, $defaultValue = null)
	{
		$output /** @lang HTML */ = '
			<div class="form-group">';
		$output .= self::generateLabel($columnData);
		$output .= self::generateInput($columnData, $defaultValue);

		$output .= '
			</div>';

		return $output;
	}

	public static function generateFormOpenTag()
	{
		return "
			<form action=\"{$_SERVER['REQUEST_URI']}\" method=\"post\" accept-charset=\"utf-8\">";
	}

	public static function generateFormCloseTag()
	{
		return "
			</form>
		";
	}

	public static function generateButtons()
	{
		return /** @lang HTML */
			<<<EOT
		   			<div class="form-group">
				<button type="submit" class="btn btn-sm btn-primary">Save</button>
				<button type="reset" class="btn btn-sm btn-warning">Reset</button>
			</div>
EOT;
	}
}