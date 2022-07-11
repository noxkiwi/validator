<?php declare(strict_types = 1);
namespace noxkiwi\validator\Validator\Number;

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
class NaturalValidator extends IntegerValidator
{
    /**
     * @inheritDoc
     */
    public function validate(mixed $value): array
    {
        if (! empty(parent::validate($value))) {
            return $this->getErrors();
        }
        $value = (int)$value;
        if ($value === 0) {
            $this->addError('VALUE_EQUALS_ZERO', compact('value'));
        }
        if ($value < 0) {
            $this->addError('VALUE_BELOW_ZERO', compact('value'));
        }

        return $this->getErrors();
    }
}
