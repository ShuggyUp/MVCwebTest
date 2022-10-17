<?php

abstract class RequestHandler {

    protected $table;

    public function getTableName() {
        return $this->table;
    }

    public function getList($selectColumn, $modificators = null) {
        return SingletonDB::getInstance()->querySelect($selectColumn, $this->table, $modificators);
    }

    public function insert($selectColumn, $values) {
        SingletonDB::getInstance()->queryInsert($this->table, $selectColumn, $values);
    }

    public function update($selectColumn, $values) {
        SingletonDB::getInstance()->queryUpdate($this->table, $selectColumn, $values);
    }

    public function deleteData($id) {
        SingletonDB::getInstance()->queryDelete($this->table, $id);
    }
}
