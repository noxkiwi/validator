<?php declare(strict_types = 1);
namespace noxkiwi\validator\Validator\File;

use noxkiwi\core\Helper\MimeHelper;
use noxkiwi\validator\Validator\FileValidator;

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
class ImageValidator extends FileValidator
{
    /**
     * Contains all whitelisted MIME Types
     *
     * @var array
     */
    public static array $mimeWhitelist = [
        MimeHelper::TYPE_JPEG,
        MimeHelper::TYPE_JPG,
        MimeHelper::TYPE_JPEG_2000,
        MimeHelper::TYPE_JPG_2000,
        MimeHelper::TYPE_PNG,
        MimeHelper::TYPE_GIF,
        MimeHelper::TYPE_FIF,
        MimeHelper::TYPE_TIFF,
        MimeHelper::TYPE_VASA,
        MimeHelper::TYPE_X_ICON
    ];
}
