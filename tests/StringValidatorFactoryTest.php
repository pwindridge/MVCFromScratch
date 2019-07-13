<?php


use Core\Validation\ValidatorFactory;
use PHPUnit\Framework\TestCase;

class StringValidatorFactoryTest extends TestCase {

    public function testStringNotRequiredNoValueNoError()
    {
        $val = ValidatorFactory::make('string', ['']);

        $this->assertFalse($val->hasError());
        $this->assertEquals('', $val->getError());
    }

    public function testStringRequiredNoValueErrorWithMessage()
    {
        $val = ValidatorFactory::make('string', ['', 0, 500, 'required']);

        $this->assertTrue($val->hasError());
        $this->assertEquals('This is a required field.', $val->getError());
    }

    public function testStringMin2Max3NotRequiredNoError()
    {
        $val1 = ValidatorFactory::make('string', ['te', 2, 3]);
        $val2 = ValidatorFactory::make('string', ['tes', 2, 3]);
        $val3 = ValidatorFactory::make('string', ['', 2, 3]); //Not required = false

        $this->assertFalse($val1->hasError());
        $this->assertFalse($val2->hasError());
        $this->assertFalse($val3->hasError());
    }

    public function testStringMin2Max3Error()
    {
        $val1 = ValidatorFactory::make('string', ['t', 2, 3]);
        $val2 = ValidatorFactory::make('string', ['test', 2, 3]);

        $this->assertTrue($val1->hasError());
        $this->assertTrue($val2->hasError());
    }
}
