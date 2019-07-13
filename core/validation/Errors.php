<?php


namespace Core\Validation;


use ArrayAccess;
use ArrayIterator;
use Exception;
use IteratorAggregate;
use Traversable;


/**
 * Class Errors
 * @package Toolkit\Validation
 */
class Errors implements IteratorAggregate, ArrayAccess {


    private $validators = [];

    /**
     * @param $validator
     * @param null $key
     * @throws \Exception
     */
    public function add(Validator $validator, $key = null)
    {
        if ($this->exists($key)) {
            throw new Exception("'{$key}' has already been set");
        }

        if ($key) {
            $this->validators[$key] = $validator;
        } else {
            $this->validators[] = $validator;
        }
    }

    public function addMany(array $validators)
    {
        foreach ($validators as $key => $validator) {
            $this->add($validator, $key);
        }
    }

    public function get($key)
    {
        if (! $this->exists($key)) {
            throw new Exception("'{$key}' is not associated with a validator");
        }

        return $this->validators[$key];
    }

    public function remove($key)
    {
        if (! $this->exists($key)) {
            throw new Exception("'{$key}' is not associated with a validator");
        }

        unset($this->validators[$key]);
    }

    public function keys()
    {
        return array_keys($this->validators);
    }

    public function exists($key)
    {
        return array_key_exists($key, $this->validators);
    }

    public function length()
    {
        return count($this->validators);
    }

    /**
     * @return array
     */
    public function getErrors() : array
    {
        return array_map(function ($validator) {
            return $validator->getError();
        }, $this->validators);
    }

    public function hasErrors()
    {
        foreach ($this->validators as $validator) {
            if ($validator->hasError()) {
                return true;
            }
        }
        return false;
    }

    public function getIterator()
    {
        return new ArrayIterator($this->validators);
    }

    public function offsetExists($offset)
    {
        return $this->exists($offset);
    }

    public function offsetGet($offset)
    {
        return $this->get($offset);
    }

    public function offsetSet($offset, $value)
    {
        $this->add($value, $offset);
    }

    public function offsetUnset($offset)
    {
        $this->remove($offset);
    }
}