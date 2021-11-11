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
class JpgValidator extends ImageValidator
{
    /**
     * Contains all whitelisted MIME Types
     *
     * @var array
     */
    public static array $mimeWhitelist = [
        MimeHelper::TYPE_JPG,
        MimeHelper::TYPE_JPEG,
        MimeHelper::TYPE_JPG_2000,
        MimeHelper::TYPE_JPEG_2000
    ];
}
