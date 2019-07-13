<?php


namespace Core\Validation;


class StringValidator extends Validator {

    private $max;
    private $min;

    public function __construct(string $value,
                                int $minLength = 0,
                                int $maxLength = 500,
                                bool $required = false)
    {
        $this->min = $minLength;
        $this->max = $maxLength;
        parent::__construct($value, $required);
    }

    protected function validate()
    {
        if (strlen($this->value) < $this->min
            || strlen($this->value) > $this->max
            || is_numeric($this->value)) {

            $this->errorMessage = "Value should be a string " .
                "of between {$this->min} and {$this->max} " .
                "characters.";
        }
    }
}