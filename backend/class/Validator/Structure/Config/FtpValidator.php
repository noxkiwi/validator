<?php declare(strict_types = 1);
namespace noxkiwi\validator\Validator\Structure\Config;

use noxkiwi\validator\Validator\Number\PortValidator;
use noxkiwi\validator\Validator\Structure\ConfigValidator;
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
class FtpValidator extends ConfigValidator
{
    /**
     * @inheritDoc
     */
    protected array $structureDesign = [
        'host' => TextValidator::class,
        'port' => PortValidator::class,
        'user' => TextValidator::class,
        'pass' => TextValidator::class
    ];
}
