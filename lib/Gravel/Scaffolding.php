<?php

namespace Gravel;

use Gravel\Core\Database;

class Scaffolding
{
	public static function createInsertForm($table)
	{
		$db = Database::getInstance();
		$sql = "SHOW FULL COLUMNS FROM `{$table}`";
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
		$sql = "SHOW FULL COLUMNS FROM `{$table}`";
		$statement = $db->prepare($sql);
		$statement->execute();
		$columns = $statement->fetchAll(\PDO::FETCH_ASSOC);

		$recordData = $model::find($id);

		$output = self::generateFormOpenTag($id);
		foreach ($columns as $column) {
			$property = $column['Field'];
			$output .= self::generateFormGroup($column, $recordData->$property);
		}
		$output .= self::generateButtons();
		$output .= self::generateFormCloseTag();

		return $output;
	}

	public static function generateFormOpenTag($id = null)
	{
		$output = "
			<form action=\"{$_SERVER['REQUEST_URI']}\" method=\"post\" accept-charset=\"utf-8\">";

		if (!is_null($id)) {
			$output .= "<input type=\"hidden\" name=\"id\" value=\"{$id}\">";
		}


		return $output;

	}

	public static function generateFormGroup($columnData, $defaultValue = null)
	{
		$output = '
			<div class="form-group">';
		$output .= self::generateLabel($columnData);
		$output .= self::generateInput($columnData, $defaultValue);

		$output .= '
			</div>';

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
		$comment = $columnData['Comment'];

		// select fields (enum column)
		if (preg_match('/enum/', $type)) {
			$output = "
				<select id=\"{$column}\" name=\"{$column}\" class=\"form-control\">";

			// grab values from enum colum
			$values = str_getcsv(preg_replace('/^enum\(|\)$/', '', $type), ",", "'");

			// loop values creating options
			foreach ($values as $value) {
				$selected = ($defaultValue == $value) ? 'selected' : 'null';
				$output .= "<option value=\"{$value}\" {$selected}>{$value}</option>";
			}

			$output .= "</select>";
		}

		// text fields (single line input)
		if (preg_match('/tinyint|smallint|mediumint|int|bigint|varchar/', $type)) {
			$oldPost = isset($_POST[$column]) ? $_POST[$column] : $defaultValue;
			$output = "
				<input type=\"text\" id=\"{$column}\" name=\"{$column}\" class=\"form-control\" placeholder=\"{$default}\" value=\"{$oldPost}\" />";
		}

		// text areas (multiline input)
		if (preg_match('/smalltext|mediumtext|largetext|text/', $type)) {
			$defaultValue = isset($_POST[$column]) ? $_POST[$column] : $defaultValue;
			$wysiwygClass = (preg_match('/html/', $comment)) ? 'wysiwyg' : null;
			$output = "
				<textarea id=\"{$column}\" name=\"{$column}\" class=\"form-control {$wysiwygClass}\" placeholder=\"{$default}\" rows=\"10\">{$defaultValue}</textarea>";
		}
		return $output;
	}

	public static function generateButtons()
	{
		return /** @lang HTML */
			<<<EOT
		   			<div class="form-group">
				<div class="row">
					<div class="col-md-4">
						<button type="submit" class="btn btn-sm btn-primary btn-block">Save</button>
					</div>
					<div class="col-md-4">
						<button type="reset" class="btn btn-sm btn-warning btn-block">Reset</button>
					</div>
					<div class="col-md-4">
						<a href="{$_SERVER['HTTP_REFERER']}" class="btn btn-danger btn-block no-prompt btn-sm">Cancel</a>
					</div>
				</div>
			</div>
EOT;
	}

	public static function generateFormCloseTag()
	{
		return "
			</form>
		";
	}

}