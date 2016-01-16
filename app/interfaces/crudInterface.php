<?php

/**
 * Interface crudInterface
 *
 * Simple contract for CRUD based controller methods
 */
interface crudInterface
{
	public function create();

	public function read($page = 1);

	public function update($id = null);

	public function delete($id = null);

}