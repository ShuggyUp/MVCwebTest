<?php

class SingletonDB {

    protected static $pdoInstance = null;
    protected static $pdoLink;

    public static function getLink() {
        if (self::$pdoInstance === null) {
            self::$pdoInstance = new self;
        }

        return self::$pdoLink;
    }

    public static function getInstance() {
        if (self::$pdoInstance === null) {
            self::$pdoInstance = new self;
        }

        return self::$pdoInstance;
    }

    private function __construct() {
        require 'config.php';
        $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
        $opt = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ];

        self::$pdoLink = new PDO($dsn, $user, $pass, $opt);
    }

    private function __clone() {
    }

    private function __wakeup() {
    }

    public function querySelect($selectColumn, $table, $modificators = null) {
        if (is_array($selectColumn)) {
            $selectColumn = implode(', ', $selectColumn);
        }
        $queryString = 'SELECT ' . $selectColumn . ' FROM ' . $table;
        if (!empty($modificators)) {
            foreach ($modificators as $key => $value) {
                if ($key == 'WHERE') {
                    array_walk($value, ['SingletonDB', 'arrayConvertToString']);
                    $queryString .= ' WHERE ' . implode(' AND ', $value);
                }
                if ($key == 'ORDER') {
                    $queryString .= ' ORDER BY ' . $value['field'] . ' ' . $value['direction'];
                }
                if ($key == 'LIMIT') {
                    $queryString .= ' LIMIT ';
                    if (isset($value['start'])) {
                        $queryString .= $value['start'] . ', ';
                    }
                    $queryString .= $value['limit'];
                }
            }
        }

        $result = self::$pdoLink->query($queryString)->fetchAll();

        return $result;
    }

    public function queryInsert($table, $selectColumn, $values) {
        if (is_array($selectColumn)) {
            $selectColumn = implode(', ', $selectColumn);
            $values       = implode(', ', array_map(['SingletonDB', 'returnStrOrInt'], $values));
        }

        $queryString = 'INSERT INTO ' . $table . ' (' . $selectColumn . ') VALUES (' . $values . ')';
        self::$pdoLink->query($queryString);
    }

    public function queryUpdate($table, $setArray, $whereArray) {
        $queryString = 'UPDATE ' . $table . ' SET ';

        foreach ($setArray as $key => $value) {
            $queryString .= $key . ' = ' . '"' . $value . '",';
        }

        $queryString = substr($queryString,0,-1);
        $queryString .= ' WHERE id = ' . '"' . $whereArray . '"';

        self::$pdoLink->query($queryString);
    }

    public function queryDelete($table, $id) {
        $queryString = 'DELETE FROM ' . $table . ' WHERE id = ' . $id;
        self::$pdoLink->query($queryString);
    }

    private function arrayConvertToString(&$value, $key) {
        if (is_array($value)) {
            $value = implode(', ', array_map(['SingletonDB', 'returnStrOrInt'], $value));
            $value = $key . ' IN (' . $value . ')';
        } else {
            $value = self::returnStrOrInt($value);
            $value = $key . ' = ' . $value;
        }
    }

    private function returnStrOrInt($value) {
        if (!filter_var($value, FILTER_VALIDATE_INT)) {
            return '"' . $value . '"';
        } else {
            return $value;
        }
    }
}
