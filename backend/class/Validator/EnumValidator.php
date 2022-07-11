<?php declare(strict_types = 1);
namespace noxkiwi\validator\Validator;

use noxkiwi\validator\Validator;
use function in_array;

/**
 * I am the Validator for enumerations.
 *
 * @package      noxkiwi\validator
 * @author       Jan Nox <jan.nox@pm.me>
 * @license      https://nox.kiwi/license
 * @copyright    2021 noxkiwi
 * @version      1.0.0
 * @link         https://nox.kiwi/
 */
abstract class EnumValidator extends Validator
{
    public const ENUMERATION = [];

    /**
     * @inheritDoc
     */
    public function validate(mixed $value): array
    {
        if (! empty(parent::validate($value))) {
            return $this->getErrors();
        }
        $this->checkEnum($value);

        return $this->getErrors();
    }

    /**
     * I will check that the given $value is available in the ENUMERATIONS list.
     * @see \noxkiwi\validator\Validator\EnumValidator::ENUMERATION
     *
     * @param $value
     */
    private function checkEnum($value): void
    {
        if (! in_array($value, static::ENUMERATION, true)) {
            $this->addError('VALUE_NOT_BOOLEAN');
        }
    }
}
