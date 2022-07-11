<?php declare(strict_types = 1);
namespace noxkiwi\validator\Validator;

use noxkiwi\validator\Validator;
use function is_bool;

/**
 * I am the boolean valiator. I will validate boolean values.
 *
 * @package      noxkiwi\validator
 * @author       Jan Nox <jan.nox@pm.me>
 * @license      https://nox.kiwi/license
 * @copyright    2016 - 2018 noxkiwi
 * @version      1.0.0
 * @link         https://nox.kiwi/
 */
final class BooleanValidator extends Validator
{
    /**
     * @inheritDoc
     */
    public function validate(mixed $value): array
    {
        if (! empty(parent::validate($value))) {
            return $this->getErrors();
        }
        $this->isBoolean($value);

        return $this->getErrors();
    }

    /**
     * I will validate that the given $value of type boolean.
     *
     * @param $value
     *
     * @return void
     */
    private function isBoolean($value): void
    {
        if (! is_bool($value)) {
            $this->addError('VALUE_NOT_BOOLEAN');
        }
    }
}
