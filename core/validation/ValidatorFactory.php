<?php


namespace Core\Validation;


class ValidatorFactory {

    /**
     * @param string $validator
     * @param mixed[] $parameters value, min, max, required
     * @return Validator
     */
    public static function make(string $validator, $parameters)
    {
        switch ($validator) {
            case 'string' :
                return new StringValidator(...$parameters);

            case 'integer':
                break;
            default:
                break;
        }
    }
}