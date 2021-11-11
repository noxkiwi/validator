<?php declare(strict_types = 1);
namespace noxkiwi\validator\Validator\Text;

use noxkiwi\core\Exception\InvalidJsonException;
use noxkiwi\core\Helper\JsonHelper;
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
class JsonValidator extends TextValidator
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
            return $this->getErrors();
        }
        try {
            $data = JsonHelper::decodeStringToArray($value);
        } catch (InvalidJsonException) {
            // ErrorHandler::handleException($exception);
            $this->addError('JSON_INVALID', compact('value'));

            return $this->getErrors();
        }
        if ($data === null) {
            $this->addError('JSON_EMPTY_OR_INVALID', compact('value'));
        }

        return $this->getErrors();
    }
}
