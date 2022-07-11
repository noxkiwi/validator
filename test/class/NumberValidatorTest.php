<?php
namespace noxkiwi\validator\Validator;

use PHPUnit\Framework\TestCase;

class NumberValidatorTest extends TestCase
{
    /**
     * @return void
     * @covers \noxkiwi\validator\Validator\NumberValidator::setMinValue()
     * @covers \noxkiwi\validator\Validator\NumberValidator::getMinValue()
     * @covers \noxkiwi\validator\Validator\NumberValidator::isValidMinimum()
     * @covers \noxkiwi\validator\Validator\NumberValidator::validate()
     */
    public function testMinValue()
    {
        // SET LENGTH
        $minValue = rand(100, 4096);

        /** @var \noxkiwi\validator\Validator\NumberValidator $validator */
        $validator = NumberValidator::get();
        $validator->setMinValue($minValue);

        // Test: Setter works as expected.
        $this->assertEquals($minValue, $validator->getMinValue());

        // Test: Valid: Exact $minValue is accepted.
        $this->assertEquals(true, $validator->isValid($minValue));

        // Test: Valid: Exceeded $minValue is accepted.
        $this->assertEquals(true, $validator->isValid($minValue+.00000000001));

        // Test: Invalid: Value below $minValue is not accepted.
        $this->assertEquals(false, $validator->isValid($minValue-.00000000001));
    }

    /**
     * @return void
     * @covers \noxkiwi\validator\Validator\NumberValidator::setMaxValue()
     * @covers \noxkiwi\validator\Validator\NumberValidator::getMaxValue()
     * @covers \noxkiwi\validator\Validator\NumberValidator::isValidMaximum()
     * @covers \noxkiwi\validator\Validator\NumberValidator::validate()
     */
    public function testMaxValue()
    {
        // SET LENGTH
        $maxValue = rand(100, 4096);
        /** @var \noxkiwi\validator\Validator\NumberValidator $validator */
        $validator = NumberValidator::get();
        $validator->setMaxValue($maxValue);

        // Test: Setter works as expected.
        $this->assertEquals($maxValue, $validator->getMaxValue());

        // Test: Valid: Exact $maxValue is accepted.
        $this->assertEquals(true, $validator->isValid($maxValue));

        // Test: Valid: Undercut $maxValue is accepted.
        $this->assertEquals(true, $validator->isValid($maxValue-.00000000001));

        // Test: Invalid: Exceeded $maxValue is not accepted.
        $this->assertEquals(false, $validator->isValid($maxValue+.00000000001));
    }

    /**
     * @return void
     * @covers \noxkiwi\validator\Validator\NumberValidator::setAllowedChars()
     * @covers \noxkiwi\validator\Validator\TextNumberValidator::getAllowedChars()
     * @covers \noxkiwi\validator\Validator\NumberValidator::isValidCharacters()
     */
    public function testMaxPrecision()
    {
        $mP = 3;
        // Validate Length is exceeded
        /** @var \noxkiwi\validator\Validator\NumberValidator $validator */
        $validator = NumberValidator::get();
        $validator->setMaxPrecision($mP);


        // Test: Setter works as expected
        $this->assertEquals($mP, $validator->getMaxPrecision());

        // Test: Valid: Non-decimals are accepted
        $this->assertEquals(true, $validator->isValid(10));

        // Test: Valid: Exact count of decimals accepted
        $this->assertEquals(true, $validator->isValid(1.123));

        // Test: Valid: Exceeded count of decimals without mathematical value
        $this->assertEquals(true, $validator->isValid(1.123000000000000000));

        // Test: Valid: Exceeded count of decimals not accepted
        $this->assertEquals(false, $validator->isValid(1.1234));
    }
}
