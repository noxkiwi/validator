<?php declare(strict_types = 1);
namespace noxkiwi\validator\Validator\Structure\Upload;

use Exception;
use noxkiwi\validator\Validator\Structure\UploadValidator;

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
class ImageValidator extends UploadValidator
{
    /**
     * @inheritDoc
     */
    public function validate(mixed $value, ?array $options = null): array
    {
        if (! empty(parent::validate($value, $options))) {
            return $this->getErrors();
        }
        try {
            $innerValidator = ImageValidator::getInstance();
        } catch (Exception $exception) {
            $this->addError('VALIDATION_ERROR', $exception->getMessage());

            return $this->getErrors();
        }
        $errors = $innerValidator->validate($value['tmp_name']);
        if (! empty($errors)) {
            $this->addError('IMAGE_INVALID', compact('value'));

            return $this->getErrors();
        }

        return $this->getErrors();
    }
}
