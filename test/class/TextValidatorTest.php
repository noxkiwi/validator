<?php
namespace noxkiwi\validator\Validator;

use PHPUnit\Framework\TestCase;
use function str_repeat;

class TextValidatorTest extends TestCase
{
    /**
     * @return void
     * @covers \noxkiwi\validator\Validator\TextValidator::setMaxLength()
     * @covers \noxkiwi\validator\Validator\TextTextValidator::getMaxLength()
     * @covers \noxkiwi\validator\Validator\TextValidator::isValidMaxLength()
     */
    public function testMaxLength()
    {
        // SET LENGTH
        $length = rand(100, 255);
        /** @var \noxkiwi\validator\Validator\TextValidator $validator */
        $validator = TextValidator::get();
        $validator->setMaxLength($length);
        $this->assertEquals($length, $validator->getMaxLength());

        // Validate Length EQUALS EXACTLY
        /** @var \noxkiwi\validator\Validator\TextValidator $validator */
        $validator = TextValidator::get();
        $validator->setMaxLength($length);
        $this->assertEquals(true, $validator->isValid(str_repeat('X', $length)));

        // Validate Length is undercut
        /** @var \noxkiwi\validator\Validator\TextValidator $validator */
        $validator = TextValidator::get();
        $validator->setMaxLength($length);
        $this->assertEquals(true, $validator->isValid(str_repeat('X', $length-1)));

        // Validate Length is exceeded
        /** @var \noxkiwi\validator\Validator\TextValidator $validator */
        $validator = TextValidator::get();
        $validator->setMaxLength($length);
        $this->assertEquals(false, $validator->isValid(str_repeat('X', $length+1)));
    }

    /**
     * @return void
     * @covers \noxkiwi\validator\Validator\TextValidator::setMinLength()
     * @covers \noxkiwi\validator\Validator\TextTextValidator::getMinLength()
     * @covers \noxkiwi\validator\Validator\TextValidator::isValidMinLength()
     */
    public function testMinLength()
    {
        // SET LENGTH
        $length = rand(100, 255);
        /** @var \noxkiwi\validator\Validator\TextValidator $validator */
        $validator = TextValidator::get();
        $validator->setMinLength($length);
        $this->assertEquals($length, $validator->getMinLength());

        // Validate Length EQUALS EXACTLY
        /** @var \noxkiwi\validator\Validator\TextValidator $validator */
        $validator = TextValidator::get();
        $validator->setMinLength($length);
        $this->assertEquals(true, $validator->isValid(str_repeat('X', $length)));

        // Validate Length is undercut
        /** @var \noxkiwi\validator\Validator\TextValidator $validator */
        $validator = TextValidator::get();
        $validator->setMinLength($length);
        $this->assertEquals(false, $validator->isValid(str_repeat('X', $length-1)));

        // Validate Length is exceeded
        /** @var \noxkiwi\validator\Validator\TextValidator $validator */
        $validator = TextValidator::get();
        $validator->setMinLength($length);
        $this->assertEquals(true, $validator->isValid(str_repeat('X', $length+1)));
    }

    /**
     * @return void
     * @covers \noxkiwi\validator\Validator\TextValidator::setAllowedChars()
     * @covers \noxkiwi\validator\Validator\TextTextValidator::getAllowedChars()
     * @covers \noxkiwi\validator\Validator\TextValidator::isValidCharacters()
     */
    public function testAllowedChars()
    {
        // Validate Length is exceeded
        /** @var \noxkiwi\validator\Validator\TextValidator $validator */
        $validator = TextValidator::get();
        $validator->setAllowedChars('0123456789');
        $this->assertEquals('0123456789', $validator->getAllowedChars());

        // Validate that the allowed characters are passing through valid values
        $validator = TextValidator::get();
        $validator->setAllowedChars('0123456789');
        $this->assertEquals(true, $validator->isValid('5'));

        // Validate that the allowed characters are blocking through forbidden chars
        $validator = TextValidator::get();
        $validator->setAllowedChars('0123456789');
        $this->assertEquals(false, $validator->isValid('01203110481394436758963A3476324982418'));
    }

    public function testForbiddenChars()
    {
        // Validate Length is exceeded
        /** @var \noxkiwi\validator\Validator\TextValidator $validator */
        $validator = TextValidator::get();
        $validator->setForbiddenChars('ABCDEFGHIJKLMNOPQRSTUVWXYZ');
        $this->assertEquals('ABCDEFGHIJKLMNOPQRSTUVWXYZ', $validator->getForbiddenChars());

        // Validate that the allowed characters are passing through valid values
        $validator = TextValidator::get();
        $validator->setForbiddenChars('ABCDEFGHIJKLMNOPQRSTUVWXYZ');
        $this->assertEquals(true, $validator->isValid('012031104813944367589633476324982418'));

        // Validate that the allowed characters are blocking through forbidden chars
        $validator = TextValidator::get();
        $validator->setForbiddenChars('ABCDEFGHIJKLMNOPQRSTUVWXYZ');
        $this->assertEquals(false, $validator->isValid('01203110481394436758963A3476324982418'));
    }
}
