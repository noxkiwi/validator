<?php declare(strict_types = 1);
namespace noxkiwi\validator\Validator\Structure\Config\Crud;

use Exception;
use noxkiwi\validator\Validator\Number\NaturalValidator;
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
class PaginationValidator extends CrudValidator
{
    /**
     * @inheritDoc
     */
    protected function __construct(array $options = [])
    {
        $this->setOptions(
            [
                static::OPTION_KEYS => ['limit']
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
        try {
            $errors = NaturalValidator::getInstance()->validate($value['limit']);
        } catch (Exception $exception) {
            $this->addError($exception->getMessage());

            return $this->getErrors();
        }
        if (! empty($errors)) {
            $this->addError('INVALID_LIMIT', $errors);

            return $this->getErrors();
        }
        if ($value['limit'] <= 0) {
            $this->addError('LIMIT_TOO_SMALL', $value['limit']);

            return $this->getErrors();
        }
        if ($value['limit'] >= 501) {
            $this->addError('LIMIT_TOO_HIGH', $value['limit']);

            return $this->getErrors();
        }

        return $this->getErrors();
    }
}
