<?php declare(strict_types = 1);
namespace noxkiwi\validator\Validator\Structure\Config\Bucket;

use noxkiwi\validator\Validator\BooleanValidator;
use noxkiwi\validator\Validator\Structure\Config\BucketValidator;
use noxkiwi\validator\Validator\Structure\Config\FtpValidator as FtpServerValidator;
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
class FtpValidator extends BucketValidator
{
    /**
     * @inheritDoc
     */
    protected function __construct(array $options = null)
    {
        parent::__construct($options);
        $this->structureDesign = [
            'basedir'   => TextValidator::class,
            'public'    => BooleanValidator::class,
            'ftpserver' => FtpServerValidator::class
        ];
    }
}
