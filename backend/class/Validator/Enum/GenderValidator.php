<?php declare(strict_types = 1);
namespace noxkiwi\validator\Validator\Enum;

use noxkiwi\validator\Validator\EnumValidator;

/**
 * I am the enumeration of available genders.
 *
 * @package      noxkiwi\validator\Validator\Enum
 * @author       Jan Nox <jan.nox@pm.me>
 * @license      https://nox.kiwi/license
 * @copyright    2021 noxkiwi
 * @version      1.0.0
 * @link         https://nox.kiwi/
 */
class GenderValidator extends EnumValidator
{
    protected const ENUMERATIONS = [
        'male',
        'female'
    ];
}
