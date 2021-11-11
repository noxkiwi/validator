<?php declare(strict_types = 1);
namespace noxkiwi\validator\Validator\File\Image;

use noxkiwi\core\Helper\MimeHelper;
use noxkiwi\validator\Validator\File\ImageValidator;

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
class FifValidator extends ImageValidator
{
    /**
     * Contains all whitelisted MIME Types
     *
     * @var array
     */
    public static array $mimeWhitelist = [MimeHelper::TYPE_FIF];
}
