<?php


use WorawitjIdcardValidate\ThaiIdCardValidation\NewThaiIdCard;
use WorawitjIdcardValidate\ThaiIdCardValidation\NewThaiIdCardRule;

class NewThaiIdCardTest extends Orchestra\Testbench\TestCase
{

    /** @test */
    public function validate_pass()
    {
        self::assertTrue((new NewThaiIdCard)->validate('9791910872358'));
        self::assertTrue((new NewThaiIdCard)->validate('1005141246335'));
    }

    /** @test */
    public function validate_fail()
    {
        self::assertFalse((new NewThaiIdCard)->validate('9791910872359'));
    }

    /** @test */
    public function rule_pass()
    {
        self::assertTrue((new NewThaiIdCardRule)->passes('id_card', '9791910872358'));
        self::assertTrue((new NewThaiIdCardRule)->passes('id_card', 9791910872358));
        self::assertTrue((new NewThaiIdCardRule)->passes('id_card', '1005141246335'));
    }

    /** @test */
    public function rule_fail()
    {
        self::assertFalse((new NewThaiIdCardRule)->passes('id_card', '9791910872359'));
    }

}
