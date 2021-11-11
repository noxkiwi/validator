<?php declare(strict_types = 1);
namespace noxkiwi\validator\Validator\Structure\Config;

use noxkiwi\core\Constants\Mvc;
use noxkiwi\validator\Validator\Structure\ConfigValidator;
use noxkiwi\validator\Validator\Text\SecureNameValidator;

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
class ContextValidator extends ConfigValidator
{
    /**
     * @inheritDoc
     */
    protected array $structureDesign = ['defaultview' => SecureNameValidator::class, Mvc::VIEW => null];
}
