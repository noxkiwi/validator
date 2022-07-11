<?php declare(strict_types = 1);
namespace noxkiwi\validator\Validator\Structure\Config;

use noxkiwi\validator\Validator\Structure\Config\Crud\PaginationValidator;
use noxkiwi\validator\Validator\Structure\ConfigValidator;
use noxkiwi\validator\Validator\StructureValidator;

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
class CrudValidator extends ConfigValidator
{
    /**
     * @inheritDoc
     */
    protected function __construct(array $options = null)
    {
        parent::__construct($options);
        $this->structureDesign = [
            'pagination'    => PaginationValidator::class,
            'visibleFields' => StructureValidator::class,
            'order'         => StructureValidator::class
        ];
    }
}
