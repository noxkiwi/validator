<?php declare(strict_types = 1);

use noxkiwi\validator\Validator;
use PHPUnit\Framework\TestCase;

/**
 * Class ValidatorTest
 *
 * @author    Jan Nox <jan.nox@pm.me>
 *
 * @version   1.0.0
 */
class ValidatorTest extends TestCase
{
    /**
     * I will [To be filled by Jan]
     *
     * @throws \noxkiwi\singleton\Exception\SingletonException
     * @covers \noxkiwi\validator\Validator::setNullAllowed()
     * @covers \noxkiwi\validator\Validator::isNullAllowed()
     * @covers \noxkiwi\validator\Validator::validate()
     */
    public function testDefaultBehaviour(): void
    {
        $validator = Validator::get();
        $this->assertEquals(false, $validator->isValid(null));
    }

    /**
     * I will [To be filled by Jan]
     *
     * @throws \noxkiwi\singleton\Exception\SingletonException
     * @covers \noxkiwi\validator\Validator::setNullAllowed()
     * @covers \noxkiwi\validator\Validator::isNullAllowed()
     */
    public function testNullIsAllowed(): void
    {
        $validator = Validator::get();
        $validator->setOptions([
                                   Validator::OPTION_NULL_ALLOWED => true
                               ]);
        $this->assertEquals(true, $validator->isValid(null));
    }

    /**
     * I will [To be filled by Jan]
     *
     * @throws \noxkiwi\singleton\Exception\SingletonException
     * @covers \noxkiwi\validator\Validator::setNullAllowed()
     * @covers \noxkiwi\validator\Validator::isNullAllowed()
     */
    public function testNullIsNotAllowed(): void
    {
        $validator = Validator::get();
        $validator->setOptions([
                                   Validator::OPTION_NULL_ALLOWED => false
                               ]);
        $this->assertEquals(false, $validator->isValid(null));
    }
}
