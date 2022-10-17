<?php

class FilterData {

    public static function filterInput($inputData) {
        $inputData = trim($inputData);
        $inputData = stripslashes($inputData);
        $inputData = htmlspecialchars($inputData);
        return $inputData;
    }
}

interface ValidatorInterface {

    public static function isValid($value);
}

abstract class Validator implements ValidatorInterface {

    abstract static public function isValid($value);
}

class ValidateLoginAndPassword extends Validator {

    public static function isValid($value) {
        if (!preg_match("/^[a-zA-Z][a-zA-Z\d]{4,20}$/u", $value)) {
            return false;
        }
        return true;
    }
}

class CheckEmptyInput extends Validator {

    public static function isValid($value) {
        if (empty($value)) {
            return false;
        }
        return true;
    }
}
