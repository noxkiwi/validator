<?php declare(strict_types = 1);
namespace noxkiwi\validator\Validator\Text;

use noxkiwi\validator\Validator\TextValidator;

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
class MacValidator extends TextValidator
{
    /**
     * @inheritDoc
     */
    protected function __construct(array $options = [])
    {
        $this->setOptions(
            [
                static::OPTION_MINLENGTH     => 17,
                static::OPTION_MAXLENGTH     => 17,
                static::OPTION_CHARS_ALLOWED => ':ABCEDF0123456789'
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
        if (! filter_var($value, FILTER_VALIDATE_MAC)) {
            $this->addError('VALUE_NOT_A_MACADDRESS', compact('value'));
        }

        return $this->getErrors();
    }
}
