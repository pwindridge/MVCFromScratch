<?php


namespace Core\Validation;


class EmailValidator extends Validator {


    protected function validate()
    {
        if (! filter_var($this->value,
            FILTER_VALIDATE_EMAIL)) {
            $this->errorMessage =
                "Value must be a valid email address.";
        }
    }
}