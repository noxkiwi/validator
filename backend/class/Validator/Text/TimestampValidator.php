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
class TimestampValidator extends TextValidator
{
    /**
     * @inheritDoc
     */
    protected function __construct(array $options = [])
    {
        $this->setOptions(
            [
                static::OPTION_MINLENGTH     => 18,
                static::OPTION_MAXLENGTH     => 50,
                static::OPTION_CHARS_ALLOWED => '0123456789 :-.+'
            ]
        );
        parent::__construct($options);
    }
}
