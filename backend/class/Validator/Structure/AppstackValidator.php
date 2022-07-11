<?php declare(strict_types = 1);
namespace noxkiwi\validator\Validator\Structure;

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
class AppstackValidator extends StructureValidator
{
    /**
     * @inheritDoc
     */
    public function validate(mixed $value): array
    {
        if (! empty(parent::validate($value))) {
            return $this->getErrors();
        }
        if (empty($value)) {
            $this->addError('APPSTACK_EMPTY', $value);
        }

        return $this->getErrors();
    }
}
