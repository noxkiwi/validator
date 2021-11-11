<?php declare(strict_types = 1);
namespace noxkiwi\validator\Validator;

use DateTime;
use noxkiwi\validator\Validator;

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
class DatetimeValidator extends Validator
{
    /**
     * @inheritDoc
     */
    public function validate(mixed $value, ?array $options = null): array
    {
        if (! empty(parent::validate($value, $options))) {
            return $this->getErrors();
        }
        if (! empty($value) && ! $value instanceof DateTime) {
            $this->addError('VALUE_NO_DATETIME');
        }

        return $this->getErrors();
    }
}
