<?php declare(strict_types = 1);
namespace noxkiwi\validator\Validator;

use Exception;
use noxkiwi\core\Filesystem;
use noxkiwi\core\Helper\MimeHelper;
use noxkiwi\validator\Validator;
use function compact;
use function finfo_close;
use function finfo_file;
use function finfo_open;
use function in_array;
use const FILEINFO_MIME_TYPE;

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
class FileValidator extends Validator
{
    /** @var array I am the upload data. */
    private array $upload;
    /**
     * Contains all whitelisted MIME Types
     *
     * @var string[]
     */
    public static array $mimeWhitelist = [
        MimeHelper::TYPE_JPG,
        MimeHelper::TYPE_JPEG,
        MimeHelper::TYPE_PNG,
        MimeHelper::TYPE_GIF,
        MimeHelper::TYPE_FIF,
        MimeHelper::TYPE_IEF,
        MimeHelper::TYPE_TIFF,
        MimeHelper::TYPE_VASA,
        MimeHelper::TYPE_X_ICON,
        MimeHelper::TYPE_PDF
    ];

    /**
     * @inheritDoc
     */
    public function validate(mixed $value, ?array $options = null): array
    {
        if (! empty(parent::validate($value, $options))) {
            return $this->getErrors();
        }
        $this->upload = $value;
        try {
            $innerValidator = Filesystem::getInstance();
        } catch (Exception $exception) {
            $this->addError('VALIDATION_ERROR', $exception->getMessage());

            return $this->getErrors();
        }
        if (! $innerValidator->fileAvailable($value)) {
            $this->addError('FILE_NOT_FOUND', compact('value'));

            return $this->getErrors();
        }
        $currentMimeType = $this->getMimetype($value);
        if (! in_array($currentMimeType, static::$mimeWhitelist, true)) {
            $this->addError('FORBIDDEN_MIME_TYPE', compact('value', 'currentMimeType'));

            return $this->getErrors();
        }

        return $this->getErrors();
    }

    /**
     * Returns the MIME type of the given file
     *
     * @param string $file
     *
     * @return       string
     */
    protected function getMimetype(string $file): string
    {
        $fileInfo = finfo_open(FILEINFO_MIME_TYPE);
        $mimeType = (string)finfo_file($fileInfo, $file);
        finfo_close($fileInfo);

        return $mimeType;
    }

    /**
     * Returns the uploaded file's ending by analyzing its MIME type
     *
     * @return       string
     */
    public function getFileExtension(): string
    {
        return match ($this->getMimetype($this->upload['tmp_name'])) {
            MimeHelper::TYPE_JPG    => 'jpg',
            MimeHelper::TYPE_JPEG   => 'jpeg',
            MimeHelper::TYPE_GIF    => 'gif',
            MimeHelper::TYPE_PNG    => 'png',
            MimeHelper::TYPE_FIF    => 'fif',
            MimeHelper::TYPE_IEF    => 'ief',
            MimeHelper::TYPE_TIFF   => 'tiff',
            MimeHelper::TYPE_VASA   => 'vasa',
            MimeHelper::TYPE_X_ICON => 'ico',
            MimeHelper::TYPE_PDF    => 'pdf',
            default                 => 'file',
        };
    }
}
