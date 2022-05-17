<?php declare(strict_types = 1);
namespace noxkiwi\validator\Validator\Text;

use noxkiwi\validator\Validator\TextValidator;

/**
 * I am
 *
 * @package      noxkiwi\validator
 * @author       Jan Nox <jan.nox@pm.me>
 * @license      https://nox.kiwi/license
 * @copyright    2020 noxkiwi
 * @version      1.0.0
 * @link         https://nox.kiwi/
 */
class SecureNameValidator extends TextValidator
{
    /**
     * @inheritDoc
     */
    protected function __construct(array $options = [])
    {
        parent::__construct($options);
        $this->setOptions(
            [
                static::OPTION_MINLENGTH     => 1,
                static::OPTION_MAXLENGTH     => 32,
                static::OPTION_CHARS_ALLOWED => 'abcdefghijklmnopqrstuvwxyz'
            ]
        );
    }
}
