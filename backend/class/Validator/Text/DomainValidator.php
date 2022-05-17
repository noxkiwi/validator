<?php declare(strict_types = 1);
namespace noxkiwi\validator\Validator\Text;

use noxkiwi\validator\Validator\TextValidator;
use function count;

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
class DomainValidator extends TextValidator
{
    /**
     * @inheritDoc
     */
    public function validate(mixed $value): array
    {
        if (! empty(parent::validate($value))) {
            return $this->getErrors();
        }
        if (empty($value)) {
            return $this->getErrors();
        }
        $domainarr = explode('.', $value);
        if (count($domainarr) < 2) {
            $this->addError('NO_PERIOD_FOUND', compact('value'));

            return $this->getErrors();
        }
        if (gethostbyname($value) === $value) {
            $this->addError('DOMAIN_NOT_RESOLVED', compact('value'));

            return $this->getErrors();
        }

        return $this->getErrors();
    }
}
