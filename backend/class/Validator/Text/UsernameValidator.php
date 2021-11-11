<?php declare(strict_types = 1);
namespace noxkiwi\validator\Validator\Text;

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
class UsernameValidator extends TextValidator
{
    /**
     * @inheritDoc
     */
    protected function __construct(array $options = [])
    {
        $this->setOptions(
            [
                static::OPTION_MINLENGTH     => 5,
                static::OPTION_MAXLENGTH     => 16,
                static::OPTION_CHARS_ALLOWED => '.-abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'
            ]
        );
        parent::__construct($options);
    }
}
