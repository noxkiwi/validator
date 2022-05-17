<?php declare(strict_types = 1);
namespace noxkiwi\validator\Validator\Structure\Config\Bucket;

use Exception;
use noxkiwi\core\Filesystem;
use noxkiwi\validator\Validator\Structure\Config\BucketValidator;
use function is_bool;

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
class LocalValidator extends BucketValidator
{
    /**
     * @inheritDoc
     */
    protected function __construct(array $options = [])
    {
        $this->setOptions([
                              static::OPTION_KEYS => ['basedir', 'public']
                          ]);
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
        if (! is_bool($value['public'])) {
            $this->addError('PUBLIC_KEY_NOT_FOUND', $value);

            return $this->getErrors();
        }
        if ($value['public'] && ! isset($value['baseurl'])) {
            $this->addError('BASEURL_NOT_FOUND', $value);

            return $this->getErrors();
        }
        try {
            $innerValidator = Filesystem::getInstance();
        } catch (Exception $exception) {
            $this->addError('VALIDATION_ERROR', $exception->getMessage());

            return $this->getErrors();
        }
        if (! $innerValidator->dirAvailable($value['basedir'])) {
            $this->addError('DIRECTORY_NOT_FOUND', $value['basedir']);

            return $this->getErrors();
        }

        return $this->getErrors();
    }
}
