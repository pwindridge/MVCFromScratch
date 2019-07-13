<?php


namespace Core\Validation;


/**
 * Class Validator
 * @package Toolkit\Validation
 */
abstract class Validator {

    protected $errorMessage;
    protected $value;

    /**
     * Validator constructor.
     * @param string $value
     * @param bool $required
     */
    public function __construct(string $value, bool $required = false)
    {
        if ($required && empty ($value)) {
            $this->errorMessage = "This is a required field.";
        } else {

            if (! empty ($value)) {
                $this->value = $value;
                $this->validate();
            }
        }
    }

    /**
     * @return bool
     */
    public function hasError()
    {
        $this->runErrorCheck();

        return ! empty ($this->errorMessage);
    }

    /**
     * @return string
     */
    public function getError()
    {
        $this->runErrorCheck();

        return $this->errorMessage;
    }

    private function runErrorCheck()
    {
        if (! empty ($this->errorMessage)) $this->validate();
    }

    abstract protected function validate();
}