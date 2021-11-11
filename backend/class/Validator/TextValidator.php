<?php declare(strict_types = 1);
namespace noxkiwi\validator\Validator;

use noxkiwi\validator\Validator;
use function is_int;
use function is_string;
use function strlen;

/**
 * I am the basic text validator. I will validate texts (length, allowed or forbidden chars)
 *
 * @package      noxkiwi\validator
 * @author       Jan Nox <jan.nox@pm.me>
 * @license      https://nox.kiwi/license
 * @copyright    2016 - 2018 noxkiwi
 * @version      1.0.0
 * @link         https://nox.kiwi/
 */
class TextValidator extends Validator
{
    public const OPTION_MINLENGTH       = 'minlength';
    public const OPTION_MAXLENGTH       = 'maxlength';
    public const OPTION_CHARS_ALLOWED   = 'allowedchars';
    public const OPTION_CHARS_FORBIDDEN = 'forbiddenchars';
    /** @var int I am the minimum length of a valid string. */
    private int $minLength;
    /** @var int I am the maximum length of a valid string. */
    private int $maxLength;
    /** @var string I am the characters, the string must consist of. */
    private string $allowedChars;
    /** @var string I am the characters, the string must not contain. */
    private string $forbiddenChars;

    /**
     * @inheritDoc
     */
    public function validate($value, ?array $options = []): array
    {
        // @formatter:off
        /** @noinspection NotOptimalIfConditionsInspection
         * This is only to stop validation if value is (allowed to be) NULL.
         */
            ! empty(parent::validate($value, $options))
         || $value === null
         || ! $this->isValidString($value)
         || ! $this->isValidMinLength($value)
         || ! $this->isValidMaxLength($value)
         || ! $this->isValidCharacters($value);
        // @formatter:on
        return $this->getErrors();
    }

    /**
     * I will validate the given $value for it really is a string.
     *
     * @param $value
     *
     * @return bool
     */
    private function isValidString($value): bool
    {
        if (! is_string($value)) {
            $this->addError('VALUE_NOT_A_STRING', compact('value'));

            return false;
        }

        return true;
    }

    /**
     * I will validate the given $value for the minimum length.
     *
     * @param string $value
     *
     * @return bool
     */
    private function isValidMinLength(string $value): bool
    {
        $length  = strlen($value);
        $minimum = $this->getMinLength();
        if (! empty($minimum) && $length < $minimum) {
            $this->addError('STRING_TOO_SHORT', compact('value', 'length', 'minimum'));

            return false;
        }

        return true;
    }

    /**
     * I will return the minimum length of the text.
     * @return int
     */
    final public function getMinLength(): int
    {
        return $this->minLength;
    }

    /**
     * I will set the minimum length of the text.
     *
     * @param int $minLength
     */
    final public function setMinLength(int $minLength): void
    {
        $this->minLength = max(0, $minLength);
    }

    /**
     * I will validate the given $value for the maximum length.
     *
     * @param string $value
     *
     * @return bool
     */
    private function isValidMaxLength(string $value): bool
    {
        $length  = strlen($value);
        $maximum = $this->getMaxLength();
        if (! empty($maximum) && $length > $maximum) {
            $this->addError('STRING_TOO_LONG', compact('value', 'length', 'maximum'));

            return false;
        }

        return true;
    }

    /**
     * I will return the maximum length of the string.
     * @return int
     */
    final public function getMaxLength(): int
    {
        return $this->maxLength;
    }

    /**
     * I will set the maximum length of the string.
     *
     * @param int $maxLength
     */
    final public function setMaxLength(int $maxLength): void
    {
        $this->maxLength = max(0, $maxLength);
    }

    /**
     * I will validate the given $value for invalid characters.
     *
     * @param string $value
     *
     * @return bool
     */
    private function isValidCharacters(string $value): bool
    {
        $length = strlen($value);
        if (empty($this->getAllowedChars()) && empty($this->getForbiddenChars())) {
            return true;
        }
        for ($position = 0; $position <= $length - 1; $position++) {
            $character = $value[$position];
            if (! empty($this->allowedChars) && ! str_contains($this->getAllowedChars(), $character)) {
                $this->addError('STRING_CONTAINS_INVALID_CHARACTERS', compact('value', 'position', 'character'));

                return false;
            }
            if (! empty($this->getForbiddenChars()) && str_contains($this->getForbiddenChars(), $character)) {
                $this->addError('STRING_CONTAINS_INVALID_CHARACTERS', compact('value', 'position', 'character'));

                return false;
            }
        }

        return true;
    }

    /**
     * I will return the characters the text must consist of.
     * @return string
     */
    final public function getAllowedChars(): string
    {
        return $this->allowedChars;
    }

    /**
     * I will set the caracters the text must consist of.
     *
     * @param string $allowedChars
     */
    final public function setAllowedChars(string $allowedChars): void
    {
        $this->allowedChars = $allowedChars;
    }

    /**
     * I will return the list of forbidden characters.
     * @return string
     */
    final public function getForbiddenChars(): string
    {
        return $this->forbiddenChars;
    }

    /**
     * I will solely set the list of forbidden characters.
     *
     * @param string $forbiddenChars
     */
    final public function setForbiddenChars(string $forbiddenChars): void
    {
        $this->forbiddenChars = $forbiddenChars;
    }

    /**
     * @inheritDoc
     */
    public function setOptions(array $options): Validator
    {
        $this->setMinLength(0);
        $this->setMaxLength(0);
        $this->setAllowedChars('');
        $this->setForbiddenChars('');
        parent::setOptions($options);
        if (! empty($options[static::OPTION_MINLENGTH]) && is_int($options[static::OPTION_MINLENGTH])) {
            $this->setMinLength($options[static::OPTION_MINLENGTH]);
        }
        if (! empty($options[static::OPTION_MAXLENGTH]) && is_int($options[static::OPTION_MAXLENGTH])) {
            $this->setMaxLength($options[static::OPTION_MAXLENGTH]);
        }
        if (! empty($options[static::OPTION_CHARS_ALLOWED]) && is_string($options[static::OPTION_CHARS_ALLOWED])) {
            $this->setAllowedChars($options[static::OPTION_CHARS_ALLOWED]);
        }
        if (! empty($options[static::OPTION_CHARS_FORBIDDEN]) && is_string($options[static::OPTION_CHARS_FORBIDDEN])) {
            $this->setForbiddenChars($options[static::OPTION_CHARS_FORBIDDEN]);
        }

        return $this;
    }
}
