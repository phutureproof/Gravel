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
	    $key = $this->_idColumn;

        // saving as a new record
        if (empty($this->_data[$this->_idColumn])) {
            $columns = array_keys($this->_data);
            $values = array_values($this->_data);
            $columnsInsert = implode(", ", $columns);
            $valuesInsert = implode(", ", array_pad([], count($values), '?'));
            $sql = "INSERT INTO {$this->_table} ({$columnsInsert}) VALUES ({$valuesInsert});";
        } else {
            // or saving an update
            // for an update we remove the primary key
            // and use it at the end for the where clause
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

        foreach ($this->_validationRules as $ruleName => list($label, $rule)) {
            if (isset($data[$ruleName])) {

                // required
                if (stripos($rule, 'required') !== false && empty($data[$ruleName])) {
                    array_push(Gravel::$formErrors, $label . ' is required.');
                    continue;
                }

                // email
                if (stripos($rule, 'email') !== false && !filter_var($data[$ruleName], FILTER_VALIDATE_EMAIL)) {
                    array_push(Gravel::$formErrors, $label . ' should be a valid email address.');
                    continue;
                }

                // min_length[n]
                if (preg_match("!min_length\[(?<n>\d+)\]!", $rule, $matches)) {
                    if (strlen($data[$ruleName]) < $matches['n']) {
                        $matches['n'] = number_format($matches['n'], 0);
                        array_push(Gravel::$formErrors, $label . ' should be at least ' . $matches['n'] . ' characters long.');
                        continue;
                    }
                }

                // max_length[n]
                if (preg_match("!max_length\[(?<n>\d+)\]!", $rule, $matches)) {
                    if (strlen($data[$ruleName]) > $matches['n']) {
                        $matches['n'] = number_format($matches['n'], 0);
                        array_push(Gravel::$formErrors, $label . ' should be under ' . $matches['n'] . ' characters long.');
                        continue;
                    }
                }
            }
        }

        if (count(Gravel::$formErrors) > 0) {
            return false;
        }

        foreach ($this->_data as $k => $v) {
            if (isset($data[$k])) {
                $this->_data[$k] = $data[$k];
            }
        }

        return true;
    }
}