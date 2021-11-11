<?php declare(strict_types = 1);
namespace noxkiwi\validator\Constants;

use noxkiwi\validator\Validator\ArbitraryValidator;
use noxkiwi\validator\Validator\BooleanValidator;
use noxkiwi\validator\Validator\DatetimeValidator;
use noxkiwi\validator\Validator\FileValidator;
use noxkiwi\validator\Validator\Number\IntegerValidator;
use noxkiwi\validator\Validator\Number\NaturalValidator;
use noxkiwi\validator\Validator\NumberValidator;
use noxkiwi\validator\Validator\StructureValidator;
use noxkiwi\validator\Validator\Text\AuthhashValidator;
use noxkiwi\validator\Validator\Text\BicValidator;
use noxkiwi\validator\Validator\Text\ColorhexadecimalValidator;
use noxkiwi\validator\Validator\Text\DateValidator;
use noxkiwi\validator\Validator\Text\DomainValidator;
use noxkiwi\validator\Validator\Text\EmailValidator;
use noxkiwi\validator\Validator\Text\FaxValidator;
use noxkiwi\validator\Validator\Text\FilenameValidator;
use noxkiwi\validator\Validator\Text\HostnameValidator;
use noxkiwi\validator\Validator\Text\IbanValidator;
use noxkiwi\validator\Validator\Text\Ipv4Validator;
use noxkiwi\validator\Validator\Text\JsonValidator;
use noxkiwi\validator\Validator\Text\MacValidator;
use noxkiwi\validator\Validator\Text\MobileValidator;
use noxkiwi\validator\Validator\Text\ObjectidentifierValidator;
use noxkiwi\validator\Validator\Text\ObjecttypeValidator;
use noxkiwi\validator\Validator\Text\PassportdeValidator;
use noxkiwi\validator\Validator\Text\PasswordValidator;
use noxkiwi\validator\Validator\Text\PersonaldeValidator;
use noxkiwi\validator\Validator\Text\SecureNameValidator;
use noxkiwi\validator\Validator\Text\TaxnumberdeValidator;
use noxkiwi\validator\Validator\Text\TelephoneValidator;
use noxkiwi\validator\Validator\Text\TimestampValidator;
use noxkiwi\validator\Validator\Text\TranslationcodeValidator;
use noxkiwi\validator\Validator\Text\UrlValidator;
use noxkiwi\validator\Validator\Text\UsernameValidator;
use noxkiwi\validator\Validator\Text\ValidatorValidator;
use noxkiwi\validator\Validator\Text\WysiwygValidator;
use noxkiwi\validator\Validator\TextValidator;

/**
 * I am the base validator. My purpose is to check basic values (nullable or not).
 *
 * @package      noxkiwi\validator
 * @author       Jan Nox <jan.nox@pm.me>
 * @license      https://nox.kiwi/license
 * @copyright    2016 - 2018 noxkiwi
 * @version      1.0.0
 * @link         https://nox.kiwi/
 */
abstract class Type
{
    public const TEXT              = TextValidator::class;
    public const AUTH_HASH         = AuthhashValidator::class;
    public const BIC               = BicValidator::class;
    public const COLOR_HEXADECIMAL = ColorhexadecimalValidator::class;
    public const DATE              = DateValidator::class;
    public const DOMAIN            = DomainValidator::class;
    public const EMAIL             = EmailValidator::class;
    public const FAX               = FaxValidator::class;
    public const FILENAME          = FilenameValidator::class;
    public const HOSTNAME          = HostnameValidator::class;
    public const IP_BAN            = IbanValidator::class;
    public const IPV4              = Ipv4Validator::class;
    public const JSON              = JsonValidator::class;
    public const MAC               = MacValidator::class;
    public const MOBILE            = MobileValidator::class;
    public const OBJECT_IDENTIFIER = ObjectidentifierValidator::class;
    public const OBJECT_TYPE       = ObjecttypeValidator::class;
    public const PASSPORT_DE       = PassportdeValidator::class;
    public const PASSWORD          = PasswordValidator::class;
    public const PERSONAL_DE       = PersonaldeValidator::class;
    public const SECURE_NAME       = SecureNameValidator::class;
    public const TAX_NUMBER_DE     = TaxnumberdeValidator::class;
    public const TELEPHONE         = TelephoneValidator::class;
    public const TIMESTAMP         = TimestampValidator::class;
    public const TRANSLATION_CODE  = TranslationcodeValidator::class;
    public const URL               = UrlValidator::class;
    public const USER_NAME         = UsernameValidator::class;
    public const VALIDATOR         = ValidatorValidator::class;
    public const WYSIWYG           = WysiwygValidator::class;
    public const TEXTS             = [
        self::AUTH_HASH,
        self::BIC,
        self::COLOR_HEXADECIMAL,
        self::DATE,
        self::DOMAIN,
        self::EMAIL,
        self::FAX,
        self::FILENAME,
        self::HOSTNAME,
        self::IP_BAN,
        self::IPV4,
        self::JSON,
        self::MAC,
        self::MOBILE,
        self::OBJECT_IDENTIFIER,
        self::OBJECT_TYPE,
        self::PASSPORT_DE,
        self::PASSWORD,
        self::PERSONAL_DE,
        self::SECURE_NAME,
        self::TAX_NUMBER_DE,
        self::TELEPHONE,
        self::TIMESTAMP,
        self::TRANSLATION_CODE,
        self::URL,
        self::USER_NAME,
        self::VALIDATOR,
        self::WYSIWYG,
    ];
    public const STRUCTURE         = StructureValidator::class;
    public const NUMBER            = NumberValidator::class;
    public const INTEGER           = IntegerValidator::class;
    public const NATURAL           = NaturalValidator::class;
    public const FILE              = FileValidator::class;
    public const DATETIME          = DatetimeValidator::class;
    public const BOOLEAN           = BooleanValidator::class;
    public const ARBITRARY         = ArbitraryValidator::class;
}
