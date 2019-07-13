<?php


namespace Core\Validation;


class AgeValidator extends Validator {

    private $min;
    private $max;

    public function __construct(string $value,
                                int $minimumAge = 0,
                                int $maximumAge = 150,
                                bool $required = false)
    {
        parent::__construct($value, $required);

        $this->min = $minimumAge;
        $this->max = $maximumAge;
    }

    protected function validate()
    {
        if (! filter_var($this->value,
            FILTER_VALIDATE_INT, [
                'min_range' => $this->min,
                'max_range' => $this->max
            ])) {

            $this->errorMessage = "Value must be an integer " .
                "between {$this->min} and {$this->max} " .
                "inclusive.";
        }
    }
}