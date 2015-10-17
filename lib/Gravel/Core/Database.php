<?php

namespace Gravel\Core;

class Database
{
    private static $_instance;
    private $_con;

    /**
     * private constructor allows singleton pattern
     */
    private function __construct()
    {
        $config = parse_ini_file(BASE_DIR . '/app.config.ini');

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

    /**
     * @param $value
     *
     * @return string
     */
    public function quote($value)
    {
        if (is_numeric($value) && !preg_match('!^0\d+!', $value)) {
            return $value;
        } else {
            return $this->_con->quote($value);
        }
    }
}