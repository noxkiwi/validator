<?php declare(strict_types = 1);
namespace noxkiwi\validator\Validator\Number;

use noxkiwi\validator\Validator;
use noxkiwi\validator\Validator\NumberValidator;

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
class MoneyValidator extends NumberValidator
{
    /**
     * @inheritDoc
     */
    public function setOptions(array $options): Validator
    {
        parent::setOptions($options);
        $this->setMaxPrecision(5);

        return $this;
    }
}
