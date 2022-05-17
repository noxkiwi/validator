<?php declare(strict_types = 1);
namespace noxkiwi\validator\Validator\Text;

use InvalidArgumentException;
use noxkiwi\validator\Validator;
use noxkiwi\validator\Validator\TextValidator;

/**
 * I am a Validator for Validator strings
 * <br />I will check the schema of the Validator string AND if the given Validator actually is accessable
 *
 * @package      noxkiwi\validator
 * @author       Jan Nox <jan.nox@pm.me>
 * @license      https://nox.kiwi/license
 * @copyright    2016 - 2018 noxkiwi
 * @version      1.0.0
 * @link         https://nox.kiwi/
 */
class ValidatorValidator extends TextValidator
{
    /**
     * @inheritDoc
     */
    protected function __construct(array $options = [])
    {
        $this->setOptions(
            [
                static::OPTION_MINLENGTH     => 4,
                static::OPTION_MAXLENGTH     => 32,
                static::OPTION_CHARS_ALLOWED => '_abcdefghijklmnopqrstuvwxyz1234567890'
            ]
        );
        parent::__construct($options);
    }

    /**
     * @inheritDoc
     */
    public function validate(mixed $value): array
    {
        if (! empty(parent::validate($value))) {
            return $this->getErrors();
        }
        try {
            Validator::get($value);
        } catch (InvalidArgumentException $exception) {
            $this->addError($exception->getMessage());
        }

        return $this->getErrors();
    }
}
