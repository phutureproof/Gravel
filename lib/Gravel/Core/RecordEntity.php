<?php

namespace Gravel\Core;

use Gravel\Gravel;

class RecordEntity
{
    private $_data = [];
    private $_hiddenColumns = [];
    private $_table;
    private $_idColumn = '';
    private $_validationRules = [];

    public function __construct($data = [], $hiddenColumns = [], $table = '', $idColumn = '', $validationRules = [])
    {
        foreach ($data as $k => $v) {
            $this->_data[$k] = $v;
        }

        foreach ($hiddenColumns as $column) {
            $this->_hiddenColumns[] = $column;
        }

        $this->_table = $table;
        $this->_idColumn = $idColumn;
        $this->_validationRules = $validationRules;
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

        // saving as a new record
        if (empty($this->_data[$this->_idColumn])) {
            $columns = array_keys($this->_data);
            $values = array_values($this->_data);
            $columnsInsert = implode(", ", $columns);
            $valuesInsert = implode(", ", array_pad([], count($values), '?'));
            $sql = "INSERT INTO {$this->_table} ({$columnsInsert}) VALUES ({$valuesInsert});";
        } else {
            // or saving an update
            $columns = array_diff_key($data, [$key => $key]);
            $values = array_values($columns);
            $updates = [];
            foreach ($columns as $k => $v) {
                $updates[] = "{$k} = ?";
            }
            $updates = implode(', ', $updates);
            $sql = "UPDATE {$this->_table} SET {$updates} WHERE {$key} = {$data[$key]}";
        }

        $statement = $db->prepare($sql);
        return $statement->execute($values);

    }

    public function validate($data = [])
    {
        // no rules to validate so return true
        if (count($this->_validationRules) === 0) {
            return true;
        }

        foreach (array_keys($this->_validationRules) as $rule) {
            if (!isset($data[$rule])) {
                Gravel::$formErrors[] = 'Missing data for ' . $this->_validationRules[$rule][0];
            }
        }

        if (!Gravel::$formErrors) {
            foreach (array_keys($this->_validationRules) as $rule) {
                $this->$rule = $data[$rule];
            }
        }

        return false;
    }
}