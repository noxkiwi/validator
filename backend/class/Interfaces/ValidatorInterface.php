<?php declare(strict_types = 1);
namespace noxkiwi\validator\Interfaces;

use noxkiwi\validator\Validator;

/**
 * I am the interface for all Validator classes.
 *
 * @package      noxkiwi\validator\Interfaces
 * @author       Jan Nox <jan.nox@pm.me>
 * @license      https://nox.kiwi/license
 * @copyright    2016 - 2018 noxkiwi
 * @version      1.0.0
 * @link         https://nox.kiwi/
 */
interface ValidatorInterface
{
    /**
     * I will validate the given value and return an array of errors.
     * If the value is valid, the array will be empty.
     * If you provide an array of $options, these will be used for the validation.
     *
     * @param mixed      $value
     * @param array|null $options
     *
     * @return       array
     */
    public function validate(mixed $value, ?array $options = null): array;

    /**
     * Sends the $value to the validate function and returns true, if the array of errors is empty.
     *
     * @param mixed $value
     *
     * @return       bool
     */
    public function isValid(mixed $value): bool;

    /**
     * Returns all the errors that exist in the instance.
     *
     * @return       array
     */
    public function getErrors(): array;

    /**
     * I will remove any error from the Errorstack instance.
     *
     * @return       \noxkiwi\validator\Validator
     */
    public function reset(): Validator;
}

