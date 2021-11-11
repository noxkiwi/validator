<?php declare(strict_types = 1);
namespace noxkiwi\validator;

use Exception;
use InvalidArgumentException;
use noxkiwi\singleton\Singleton;
use noxkiwi\validator\Constants\Type;
use noxkiwi\validator\Interfaces\ValidatorInterface;
use function is_bool;

/**
 * I am the base validator. My purpose is to check basic values (nullable or not).
 *
 * @package      noxkiwi\validator
 * @author       Jan Nox <jan.nox@pm.me>
 * @license      https://nox.kiwi/license
 * @copyright    2016 - 2021 noxkiwi
 * @version      1.1.7
 * @link         https://nox.kiwi/
 */
class Validator extends Singleton implements ValidatorInterface
{
    public const OPTION_NULL_ALLOWED = 'nullAllowed';
    /** @var bool $nullAllowed Holds true if the value can be null. */
    private bool $nullAllowed;
    /** @var array I am the list of errors that occured. */
    private array $errors;

    /**
     * I will construct the validator instance with the given $options.
     *
     * @param array|null $options
     */
    protected function __construct(array $options = null)
    {
        parent::__construct();
        $this->setOptions($options ?? []);
        $this->reset();
    }

    /**
     * I will import all options into the validation.
     *
     * @param array $options
     *
     * @return \noxkiwi\validator\Validator
     */
    public function setOptions(array $options): Validator
    {
        if (is_bool($options[static::OPTION_NULL_ALLOWED] ?? null)) {
            $this->setNullAllowed($options[static::OPTION_NULL_ALLOWED]);
        }

        return $this;
    }

    /**
     * @inheritDoc
     */
    final public function reset(): Validator
    {
        $this->errors = [];

        return $this;
    }

    /**
     * @inheritDoc
     */
    final public function isValid(mixed $value, array $options = null): bool
    {
        return empty($this->validate($value, $options ?? []));
    }

    /**
     * @inheritDoc
     */
    public function validate(mixed $value, ?array $options = null): array
    {
        $this->setOptions($options ?? []);
        if ($value === null && ! $this->isNullAllowed()) {
            $this->addError('VALUE_IS_NULL', $value);
        }

        return $this->getErrors();
    }

    /**
     * I will solely return if null values are allowed to pass the Validator.
     * @return bool
     */
    final public function isNullAllowed(): bool
    {
        return $this->nullAllowed;
    }

    /**
     * I will set the null allowed flag.
     *
     * @param bool $nullAllowed
     */
    final public function setNullAllowed(bool $nullAllowed = null): void
    {
        $this->nullAllowed = $nullAllowed ?? true;
    }

    /**
     * I will add the error to the errorstack
     *
     * @param string $code
     * @param mixed  $info
     */
    final protected function addError(string $code, mixed $info = null): void
    {
        $this->errors[] = [
            'vali' => static::class,
            'code' => $code,
            'info' => $info
        ];
    }

    /**
     * @inheritDoc
     */
    final public function getErrors(): array
    {
        return $this->errors;
    }

    /**
     * Loads an instance of the given Validator type and returns it.
     *
     * @param string|null $type Type of the Validator
     *
     * @throws       \InvalidArgumentException
     * @return       \noxkiwi\validator\Validator
     */
    final public static function get(string $type = null): Validator
    {
        try {
            if (empty($type)) {
                return static::getInstance()->reset();
            }
            if (! str_contains($type, '\\')) {
                $type = self::getFromDictionary($type);
            }
            /** @var \noxkiwi\validator\Validator $type */
            $inst = $type::getInstance();
            $inst->reset();

            return $inst;
        } catch (Exception) {
            throw new InvalidArgumentException("Validator $type was not found.", E_ERROR);
        }
    }

    /**
     * I will return the "emegerncy" vaidator for the given $type.
     *
     * @param string $type
     *
     * @return string
     */
    private static function getFromDictionary(string $type): string
    {
        return match ($type) {
            'number_natural' => Type::NATURAL,
            'number_integer' => Type::INTEGER,
            'text_json'      => Type::JSON,
            'structure'      => Type::STRUCTURE,
            default          => Type::TEXT,
        };
    }
}
