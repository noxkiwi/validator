<?php declare(strict_types = 1);
namespace noxkiwi\validator\Validator\Structure;

use noxkiwi\validator\Validator\StructureValidator;

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
class AddressValidator extends StructureValidator
{
    /**
     * @inheritDoc
     */
    protected function __construct(array $options = [])
    {
        $this->arrKeys = [
            'country_id',
            'postalcode',
            'city',
            'street',
            'number'
        ];
        parent::__construct($options);
    }
}
