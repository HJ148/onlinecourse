<?php

class Validator {

    public static function required($value)
    {
        return trim($value) !== "";
    }

    public static function number($value)
    {
        return is_numeric($value);
    }
}
