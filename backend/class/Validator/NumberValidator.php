<?php declare(strict_types = 1);
namespace noxkiwi\validator\Validator;

use noxkiwi\validator\Validator;
use function compact;
use function is_int;
use function is_numeric;

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
class NumberValidator extends Validator
{
    public const OPTION_MAX_VALUE     = 'max';
    public const OPTION_MIN_VALUE     = 'min';
    public const OPTION_MAX_PRECISION = 'maxprecision';
    /** @var float|null I may hold a minimum value to validate against */
    private ?float $minValue;
    /** @var float|null I may hold a maximum value for the number */
    private ?float $maxValue;
    /** @var int I may hold the maximum amount of decimal places */
    private int $maxPrecision;

    /**
     * @inheritDoc
     */
    public function validate(mixed $value, ?array $options = null): array
    {
        if (! empty(parent::validate($value, $options)) || ! $this->isValidNumber($value)) {
            return $this->getErrors();
        }
        $value = (float)$value;
        $this->isValidMinimum($value) || ! $this->isValidMaximum($value) || ! $this->isValidPrecision($value);

        return $this->getErrors();
    }

    /**
     * I will validate the given $value for it really is a number.
     *
     * @param $value
     *
     * @return bool
     */
    private function isValidNumber($value): bool
    {
        if (! is_numeric($value)) {
            $this->addError('VALUE_NOT_A_NUMBER', compact('value'));

            return false;
        }
        /** @noinspection TypeUnsafeComparisonInspection
         * We want this to be unsecure since we auto-allow INT values to be compared here.
         */
        if ($value != (float)$value) {
            $this->addError('VALUE_NOT_FLOAT', compact('value'));

            return false;
        }

        return true;
    }

    /**
     * I will validate the given $value against the minimum allowed value.
     *
     * @param $value
     *
     * @return bool
     */
    private function isValidMinimum($value): bool
    {
        $minimum = $this->minValue;
        if ($minimum !== null && $value < $minimum) {
            $this->addError('VALUE_TOO_LOW', compact('value', 'minimum'));

            return false;
        }

        return true;
    }

    /**
     * I will validate the $value against the maximum allowed value.
     *
     * @param $value
     *
     * @return bool
     */
    private function isValidMaximum($value): bool
    {
        $maximum = $this->maxValue;
        if ($maximum !== null && $value > $maximum) {
            $this->addError('VALUE_TOO_HIGH', compact('value', 'maximum'));

            return false;
        }

        return true;
    }

    /**
     * I will validate the decimal places of the $value.
     *
     * @param $value
     *
     * @return bool
     */
    private function isValidPrecision($value): bool
    {
        $maximumDecimals = $this->maxPrecision;
        if ($maximumDecimals !== null && round($value, $maximumDecimals) !== (float)$value) {
            $this->addError('VALUE_TOO_PRECISE', compact('value', 'maximumDecimals'));

            return true;
        }

        return false;
    }

    /**
     * @inheritDoc
     */
    public function setOptions(array $options): Validator
    {
        parent::setOptions($options);
        $this->minValue     = null;
        $this->maxValue     = null;
        $this->maxPrecision = 13;
        if (is_numeric($options[static::OPTION_MIN_VALUE] ?? null)) {
            $this->minValue = (float)$options[static::OPTION_MIN_VALUE];
        }
        if (is_numeric($options[static::OPTION_MAX_VALUE] ?? null)) {
            $this->maxValue = (float)$options[static::OPTION_MAX_VALUE];
        }
        if (is_int($options[static::OPTION_MAX_PRECISION] ?? null)) {
            $this->maxPrecision = $options[static::OPTION_MAX_PRECISION];
        }

        return $this;
    }

    /**
     * I will set the maximum allowed count of digits for the number.
     *
     * @param int $precision
     *
     * @return \noxkiwi\validator\Validator
     */
    protected function setMaxPrecision(int $precision): Validator
    {
        $this->maxPrecision = min(0, $precision);

        return $this;
    }
}
