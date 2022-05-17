<?php
namespace noxkiwi\validator\Validator;

use PHPUnit\Framework\TestCase;
use noxkiwi\validator\Validator\Text\EmailValidator;

class EmailValidatorTest extends TestCase
{
    public function testSetDnsRequiredTrue(): void
    {
        $v = EmailValidator::get();
        $v->setDnsRequired(true);
        // Test: Setter works as expected with TRUE value
        $this->assertEquals(true, $v->isDnsRequired());
    }

    public function testDnsValid(): void
    {
        $v = EmailValidator::get();
        $v->setDnsRequired(true);
        // Test: Valid domain exists
        $this->assertEquals(true, $v->isValid('jsdfgdksfgldfjkdfslksd@gmail.com'));
    }

    public function testSetDnsRequiredFalse(): void
    {
        $v = EmailValidator::get();
        $v->setDnsRequired(false);
        $this->assertEquals(false, $v->isDnsRequired());
    }

    public function testValidFakedomain(): void
    {
        $v = EmailValidator::get();
        $v->setDnsRequired(false);
        // Test: Invalid domain is accepted.
        $this->assertEquals(true, $v->isValid('jsdfgdksfgldfjkdfslksd@sdoifgsdfghsdfgkldfg.comacomacomachamelion'));
    }

    public function testInvalidFakeDomain(): void
    {
        $v = EmailValidator::get();
        $v->setDnsRequired(true);
        // Test: Invalid domain is refused
        $this->assertEquals(false, $v->isValid('jsdfgdksfgldfjkdfslksd@sdoifgsdfghsdfgkldfg.comacomacomachamelion'));
    }
}
