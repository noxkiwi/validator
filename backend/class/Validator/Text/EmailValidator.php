<?php declare(strict_types = 1);
namespace noxkiwi\validator\Validator\Text;

use noxkiwi\core\Environment;
use noxkiwi\core\Exception;
use noxkiwi\singleton\Exception\SingletonException;
use noxkiwi\validator\Validator;
use noxkiwi\validator\Validator\TextValidator;
use function count;
use function in_array;
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
class EmailValidator extends TextValidator
{
    public const OPTION_VALIDATE_DNS = 'validateDNS';
    /** @var string[] Blacklist some email providers */
    private array $forbiddenHosts;
    /** @var bool I state if the Domain of the mailbox will be validated. */
    private bool $validateDns;

    /**
     * @inheritDoc
     */
    protected function __construct(array $options = [])
    {
        try {
            $this->forbiddenHosts = (array)Environment::getInstance()->get('validator>email>blockedDomains', []);
        } catch (Exception) {
            $this->forbiddenHosts = [];
            // IGNORE!
        }
        parent::__construct($options);
    }

    /**
     * @inheritDoc
     */
    public function setOptions(array $options): Validator
    {
        parent::setOptions($options);
        if (is_bool($options[static::OPTION_VALIDATE_DNS] ?? null)) {
            $this->setDnsRequired($options[static::OPTION_VALIDATE_DNS]);
        }

        return $this;
    }

    /**
     * I will enable/disable validation of the domain on the email address.
     *
     * @param bool $validateDns
     *
     * @return \noxkiwi\validator\Validator
     */
    final public function setDnsRequired(bool $validateDns): Validator
    {
        $this->validateDns = $validateDns;

        return $this;
    }

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
        if (! (strpos($value, '@') > 0)) {
            $this->addError('EMAIL_AT_NOT_FOUND', compact('value'));

            return $this->getErrors();
        }
        [$mailbox, $domain] = $address = explode('@', $value);
        if (count($address) !== 2) {
            $this->addError('EMAIL_AT_NOT_UNIQUE', compact('value'));

            return $this->getErrors();
        }
        if (empty($mailbox) || empty($domain)) {
            $this->addError('EMAIL_AT_NOT_COMPLETE', compact('value'));

            return $this->getErrors();
        }
        if (in_array(strtolower($domain), $this->forbiddenHosts, true)) {
            $this->addError('EMAIL_DOMAIN_BLOCKED', compact('value', 'domain'));

            return $this->getErrors();
        }
        if ($this->isDnsRequired()) {
            try {
                $errors = DomainValidator::getInstance()->validate($domain);
            } catch (SingletonException) {
                $this->addError('EMAIL_DOMAIN_INVALID_ERROR', compact('value', 'domain'));
            }
            if (! empty($errors)) {
                $this->addError('EMAIL_DOMAIN_INVALID', compact('value', 'domain'));

                return $this->getErrors();
            }
        }

        return $this->getErrors();
    }

    /**
     * I will return whether the DNS should be validated or not.
     * @return bool
     */
    final public function isDnsRequired(): bool
    {
        return $this->validateDns;
    }
}
