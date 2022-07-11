<?php declare(strict_types = 1);
namespace noxkiwi\validator\Validator\Structure;

use Exception;
use noxkiwi\validator\Validator\StructureValidator;
use noxkiwi\validator\Validator\Text\EmailValidator;

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
class MailformValidator extends StructureValidator
{
    /**
     * @inheritDoc
     */
    protected function __construct(array $options = [])
    {
        $this->setOptions(
            [
                static::OPTION_KEYS => ['recipient', 'subject', 'body']
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
            $emailValidator = EmailValidator::getInstance();
        } catch (Exception $exception) {
            $this->addError($exception->getMessage());

            return $this->getErrors();
        }
        // Check email addresses
        $errors = $emailValidator->validate($value['recipient']);
        if (! empty($errors) && $value['recipient']) {
            $this->addError('INVALID_EMAIL_ADDRESS', $errors);
        }
        $errors = $emailValidator->validate($value['cc']);
        if (! empty($errors) && $value['cc']) {
            $this->addError('INVALID_EMAIL_ADDRESS', $errors);
        }
        $errors = $emailValidator->validate($value['bcc']);
        if (! empty($errors) && $value['bcc']) {
            $this->addError('INVALID_EMAIL_ADDRESS', $errors);
        }
        $errors = $emailValidator->validate($value['reply-to']);
        if (! empty($errors) && $value['reply-to']) {
            $this->addError('INVALID_EMAIL_ADDRESS', $errors);
        }
        // Check body length
        if ($value['body'] === '') {
            $this->addError('INVALID_EMAIL_BODY', $value);
        }
        // Check body length
        if ($value['subject'] === '') {
            $this->addError('INVALID_EMAIL_SUBJECT', $value);
        }

        return $this->getErrors();
    }
}
