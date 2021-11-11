<?php declare(strict_types = 1);
namespace noxkiwi\validator\Validator\Number;

use noxkiwi\validator\Validator\NumberValidator;

/**
 * I am
 *
 * @package      noxkiwi\validator
 * @author       Jan Nox <jan.nox@pm.me>
 * @license      https://nox.kiwi/license
 * @copyright    2016 - 2018 noxkiwi
 * @link         https://nox.kiwi/
 */
class HourValidator extends NumberValidator
{
    /**
     * @inheritDoc
     */
    protected function __construct(array $options = [])
    {
        $this->setOptions(
            [
                static::OPTION_MIN_VALUE     => 0,
                static::OPTION_MAX_VALUE     => 23,
                static::OPTION_MAX_PRECISION => 0
            ]
        );
        parent::__construct($options);
    }
}
