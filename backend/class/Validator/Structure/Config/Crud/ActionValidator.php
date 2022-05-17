<?php declare(strict_types = 1);
namespace noxkiwi\validator\Validator\Structure\Config\Crud;

use noxkiwi\core\Constants\Mvc;
use noxkiwi\validator\Validator\Structure\Config\CrudValidator;

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
class ActionValidator extends CrudValidator
{
    /**
     * @inheritDoc
     */
    protected function __construct(array $options = [])
    {
        $this->setOptions(
            [
                static::OPTION_STRUCTURE => ['name', Mvc::VIEW, Mvc::CONTEXT, 'icon', 'btnClass']
            ]
        );
        parent::__construct($options);
    }

    /**
     * @inheritDoc
     */
    public function validate(mixed $value): array
    {
        if (! empty(parent::validate($value))) {
            return $this->getErrors();
        }
        $this->checkKeys($value);

        return $this->getErrors();
    }
}
