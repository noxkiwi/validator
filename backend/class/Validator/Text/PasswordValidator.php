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
class PasswordValidator extends TextValidator
{
    /**
     * @inheritDoc
     */
    protected function __construct(array $options = [])
    {
        $this->setOptions([
                              static::OPTION_MINLENGTH => 12,
                              static::OPTION_MAXLENGTH => 64
                          ]);
        parent::__construct($options);
    }

    /**
     * @inheritDoc
     */
    public function validate(mixed $value): array
    {
        // @formatter:off
            ! empty(parent::validate($value))
         || ! $this->isValidUppercase($value)
         || ! $this->isValidLowercase($value)
         || ! $this->isValidSpecialChars($value)
         || ! $this->isValidNumeric($value);
        // @formatter:on
        return $this->getErrors();
    }

    /**
     * I will make sure that at least ONE upper case character is part of the password.
     *
     * @param string $value
     *
     * @return bool
     */
    private function isValidUppercase(string $value): bool
    {
        if (! PasswordValidator::containsType('A B C D E F G H I J K L M N O P Q R S T U V W X Y Z ', $value)) {
            $this->addError('PASSWORD_UPPER_CHARACTER_NOT_FOUND', compact('value'));
        }

        return true;
    }

    /**
     * I will check that at least one character of $complexity is part of the given $value.
     *
     * @param string $substring
     * @param string $string
     *
     * @return bool
     */
    private static function containsType(string $substring, string $string): bool
    {
        foreach (explode(' ', $substring) as $char) {
            if (empty($char)) {
                continue;
            }
            if (str_contains($string, $char)) {
                return true;
            }
        }

        return false;
    }

    /**
     * I will make sure that at least ONE lower case character is part of the password.
     *
     * @param string $value
     *
     * @return bool
     */
    private function isValidLowercase(string $value): bool
    {
        if (! PasswordValidator::containsType('a b c d e f g h i j k l m n o p q r s t u v w x y z ', $value)) {
            $this->addError('PASSWORD_LOWER_CHARACTER_NOT_FOUND', compact('value'));
        }

        return true;
    }

    /**
     * I will make sure that at least ONE special character is part of the password.
     *
     * @param string $value
     *
     * @return bool
     */
    private function isValidSpecialChars(string $value): bool
    {
        if (! PasswordValidator::containsType('! § $ % & / ( ) = ? [ ] | { } @ . ; : _  - # * " , \' ', $value)) {
            $this->addError('PASSWORD_SPECIAL_CHARACTER_NOT_FOUND', compact('value'));
        }

        return true;
    }

    /**
     * I will make sure that at least ONE digit is part of the password.
     *
     * @param string $value
     *
     * @return bool
     */
    private function isValidNumeric(string $value): bool
    {
        if (! PasswordValidator::containsType('0 1 2 3 4 5 6 7 8 9', $value)) {
            $this->addError('PASSWORD_UPPER_CHARACTER_NOT_FOUND', compact('value'));
        }

        return true;
    }
}
