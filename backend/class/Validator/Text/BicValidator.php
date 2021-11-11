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
class BicValidator extends TextValidator
{
    /**
     * @inheritDoc
     */
    protected function __construct(array $options = [])
    {
        $this->setOptions(
            [
                static::OPTION_MINLENGTH     => 8,
                static::OPTION_MAXLENGTH     => 11,
                static::OPTION_CHARS_ALLOWED => 'ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890_'
            ]
        );
        parent::__construct($options);
    }
}
