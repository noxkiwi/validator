<?php declare(strict_types = 1);
namespace noxkiwi\validator\Validator\Number;

use noxkiwi\validator\Validator\NumberValidator;
use function compact;

/**
 * I am
 *
 * @package      noxkiwi\validator
 * @author       Jan Nox <jan.nox@pm.me>
 * @license      https://nox.kiwi/license
 * @copyright    2016 - 2018 noxkiwi
 * @version      1.0.0
 * @link         https://nox.kiwi/
 */
class IntegerValidator extends NumberValidator
{
    /**
     * @inheritDoc
     */
    public function validate(mixed $value): array
    {
        if (! empty($value)) {
            $value = (int)$value;
        }
        if (! empty(parent::validate($value))) {
            return $this->getErrors();
        }
        if ($value !== (int)$value) {
            $this->addError('VALUE_NOT_AN_INT', compact('value'));
        }

        return $this->getErrors();
    }
}
