<?php declare(strict_types = 1);
namespace noxkiwi\validator\Validator\Structure;

use noxkiwi\core\Constants\Mvc;
use noxkiwi\validator\Validator\StructureValidator;
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
class RequestValidator extends StructureValidator
{
    /**
     * @inheritDoc
     */
    protected function __construct(array $options = null)
    {
        parent::__construct($options);
        $this->structureDesign = [
            Mvc::CONTEXT => SecureNameValidator::class,
            Mvc::VIEW    => SecureNameValidator::class
        ];
    }
}
