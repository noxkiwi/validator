<?php declare(strict_types = 1);
namespace noxkiwi\validator\Validator\Text;

use noxkiwi\validator\Validator\TextValidator;
use function count;
use function strlen;

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
class DateValidator extends TextValidator
{
    /**
     * @inheritDoc
     */
    protected function __construct(array $options = [])
    {
        $this->setOptions(
            [
                static::OPTION_MINLENGTH     => 10,
                static::OPTION_MAXLENGTH     => 10,
                static::OPTION_CHARS_ALLOWED => '0123456789-'
            ]
        );
        parent::__construct($options);
    }

    /**
     * @inheritDoc
     */
    public function validate(mixed $value, ?array $options = null): array
    {
        if (! empty(parent::validate($value, $options))) {
            return $this->getErrors();
        }
        if (empty($value)) {
            return $this->getErrors();
        }
        $dateArray = explode('-', $value);
        if (count($dateArray) !== 3) {
            $this->addError('INVALID_COUNT_AREAS', compact('value'));

            return $this->getErrors();
        }
        if (strlen($dateArray[0]) !== 4) {
            $this->addError('INVALID_YEAR', compact('value'));

            return $this->getErrors();
        }
        if (strlen($dateArray[1]) !== 2) {
            $this->addError('INVALID_MONTH', compact('value'));

            return $this->getErrors();
        }
        if (strlen($dateArray[2]) !== 2) {
            $this->addError('INVALID_DAY', compact('value'));

            return $this->getErrors();
        }
        if (! checkdate((int)$dateArray[1], (int)$dateArray[2], (int)$dateArray[0])) {
            $this->addError('INVALID_DATE', compact('value'));

            return $this->getErrors();
        }

        return $this->getErrors();
    }
}
