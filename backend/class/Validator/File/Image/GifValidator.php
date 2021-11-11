<?php declare(strict_types = 1);
namespace noxkiwi\validator\Validator\File\Image;

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
class GifValidator extends ImageValidator
{
    /**
     * Contains all whitelisted MIME Types
     *
     * @var array
     */
    public static array $mimeWhitelist = ['image/gif'];
}
