<?php declare(strict_types = 1);
namespace noxkiwi\validator\Validator;

use noxkiwi\validator\Validator;
use function compact;
use function is_array;
use function str_contains;
use function str_replace;

/**
 * I am the arbitrary structure validator.
 *
 * @package      noxkiwi\validator
 * @author       Jan Nox <jan.nox@pm.me>
 * @license      https://nox.kiwi/license
 * @copyright    2016 - 2018 noxkiwi
 * @version      1.0.0
 * @link         https://nox.kiwi/
 */
class StructureValidator extends Validator
{
    public const OPTION_STRUCTURE = 'structure';
    public const OPTION_KEYS      = 'keys';
    /** @var array Contains a list of array keys that MUST exist in the validated array */
    protected array $arrKeys = [];
    /**
     * I am the multi-dimensional array structure.
     * e.g. [
     *           'user_email' => 'text_email'
     *      ]
     *
     * @var array
     */
    protected array $structureDesign = [];

    /**
     * StructureValidator constructor.
     *
     * @param array|null $options
     */
    protected function __construct(array $options = null)
    {
        parent::__construct($options);
    }

    /**
     * @inheritDoc
     */
    public function validate(mixed $value, ?array $options = null): array
    {
        if (! empty(parent::validate($value, $options))) {
            return $this->getErrors();
        }
        if ($value === null) {
            return $this->getErrors();
        }
        if (! is_array($value)) {
            $this->addError('VALUE_NOT_AN_ARRAY');

            return $this->getErrors();
        }
        $this->checkKeys($value);

        return $this->getErrors();
    }

    /**
     * I will use the $arrKeys property of the validator_array class (that I am) to check if all keys exist in the value
     *
     * @param array $value
     *
     */
    protected function checkKeys(array $value): void
    {
        foreach ($this->structureDesign as $key => $dataType) {
            if ($dataType === null) {
                continue;
            }
            if (! str_contains($dataType, '[]')) {
                $errors = static::get($dataType)->validate($value[$key] ?? null);
                if (! empty($errors)) {
                    $this->addError('ARRAY_KEY_INVALID', compact('key', 'errors', 'dataType'));
                }
            } else {
                if (! is_array($value[$key])) {
                    $this->addError('ARRAY_KEY_NOT_AN_ARRAY', compact('key', 'dataType'));
                }
                $dataType = str_replace('[]', '', $dataType);
                foreach ($value[$key] as $testValue) {
                    $errors = static::get($dataType)->validate($testValue ?? null);
                    if (! empty($errors)) {
                        $this->addError('ARRAY_KEY_ENUMARTION_INVALID', compact('key', 'errors', 'value', 'dataType'));
                    }
                }
            }
        }
        foreach ($this->arrKeys as $myKey) {
            if (! isset($value[$myKey])) {
                $this->addError('ARRAY_MISSING_KEY', compact('value', 'myKey'));
            }
        }
    }

    /**
     * @inheritDoc
     */
    public function setOptions(array $options): Validator
    {
        parent::setOptions($options);
        if (isset($options[static::OPTION_STRUCTURE])) {
            $this->structureDesign = $options[static::OPTION_STRUCTURE];
        }
        if (isset($options[static::OPTION_KEYS])) {
            $this->arrKeys = $options[static::OPTION_KEYS];
        }

        return $this;
    }
}
