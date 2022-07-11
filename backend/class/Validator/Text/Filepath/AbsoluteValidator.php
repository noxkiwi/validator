<?php declare(strict_types = 1);
namespace noxkiwi\validator\Validator\Text\Filepath;

use noxkiwi\validator\Validator\TextValidator;
use function strlen;

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
class AbsoluteValidator extends TextValidator
{
    /**
     * @inheritDoc
     */
    protected function __construct(array $options = [])
    {
        $this->setOptions(
            [
                static::OPTION_MINLENGTH     => 4,
                static::OPTION_MAXLENGTH     => 256,
                static::OPTION_CHARS_ALLOWED => 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyz_-./'
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
        if (strncmp($value, '/', 1) !== 0) {
            $this->addError('MUST_BEGIN_WITH_SLASH', compact('value'));

            return $this->getErrors();
        }
        if (strpos($value, '/') === strlen($value) - 1) {
            $this->addError('MUST_NOT_END_WITH_SLASH', compact('value'));

            return $this->getErrors();
        }

        return $this->getErrors();
    }
}
