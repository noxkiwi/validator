<?php declare(strict_types = 1);
namespace noxkiwi\validator\Validator\Structure;

use Exception;
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
class EntryfieldsValidator extends StructureValidator
{
    /**
     * @inheritDoc
     */
    public function validate(mixed $value, ?array $options = null): array
    {
        if (! empty(parent::validate($value, $options))) {
            return $this->getErrors();
        }
        if (empty($value)) {
            $this->addError('ENTRYFIELDS_EMPTY', $value);
        }
        try {
            $innerValidator = SecureNameValidator::getInstance();
        } catch (Exception $exception) {
            $this->addError('VALIDATION_ERROR', $exception->getMessage());

            return $this->getErrors();
        }
        foreach ($value as $fieldName => $fieldType) {
            $errors = $innerValidator->validate($fieldName);
            if (! empty($errors)) {
                $this->addError('INVALID_FIELDNAME', $errors);
            }
            $errors = $innerValidator->validate($fieldType);
            if (! empty($errors)) {
                $this->addError('VALIDATOR_NOT_FOUND', $errors);
            }
        }

        return $this->getErrors();
    }
}
