<?php

namespace Gravel\Core;

use Gravel\Gravel;

class Permissions
{
	public $permissions = [];

	public function __construct()
	{
		if(isset($_SESSION['admin-role']))
		{
			$db = Database::getInstance();
			$sql = "
				SELECT
					t1.title
				FROM role_permissions t2
				  JOIN user_permissions t1 ON t2.permission_id = t1.id
				WHERE t2.role_id = ?
			";
			$statement = $db->prepare($sql);
			$statement->execute([$_SESSION['admin-role']]);
			foreach($statement->fetchAll(\PDO::FETCH_ASSOC) as $permission)
			{
				$this->permissions[$permission['title']] = true;
			}
		}
	}

	public function hasPermission($permission)
	{
		if(isset($_SESSION['admin-role']) && in_array($_SESSION['admin-role'], [1,2])){
			return true;
		}
		$permission = preg_replace("!(/admin/|/\d+$)!", "", $permission);
		return (isset($this->permissions[$permission]));
	}
}