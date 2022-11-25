<?php

class Validation
{
    private $errors = [];

    public function required($input)
    {
        if (empty($input)) {
            $this->errors[] = "$input is required";
        }
    }
    public function setMin($input, $len)
    {
        if (strlen($input) > $len) {
            $this->errors[] = "$input must be less than $len";
        }
    }
    public function setMax($input, $len)
    {
        if (strlen($input) < $len) {
            $this->errors[] = "$input must be greater than $len";
        }
    }

    public function getErrors()
    {
        return $this->errors;
    }
}
