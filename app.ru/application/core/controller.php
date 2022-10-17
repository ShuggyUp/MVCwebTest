<?php
require_once __DIR__ . '/../models/FilterAndValidateData.php';

class Controller {

    public $model;
    public $view;

    function __construct() {
        $this->view = new View();
    }
}
