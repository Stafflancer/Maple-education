<?php
/**
 * ImageBehavior class file.
 */

namespace app\components;

use Yii;
use \yii\base\Behavior;
use yii\imagine\Image;
use Imagine\Image\ManipulatorInterface;

/**
 * Class ImageBehavior.
 *
 * @package app\components
 */
class ImageBehavior extends Behavior
{
    /**
     * @var string base image directory path alias
     */
    public $imageDirectory = '';
    /**
     * @var string image file attribute
     */
    public $imageAttribute = 'imageFile';


    public function getImageBaseAlias()
    {
        return '@app/web/image';
    }

    /**
     * Returns image path.
     *
     * @return bool|string image base path.
     */
    public function getImagePath()
    {
        return Yii::getAlias($this->getImageBaseAlias() . DIRECTORY_SEPARATOR . $this->imageDirectory);
    }

    /**
     * Returns image cache path.
     *
     * @return bool|string image base path.
     */
    public function getImageCachePath()
    {
        return Yii::getAlias($this->getImageBaseAlias() . DIRECTORY_SEPARATOR . 'cache' . DIRECTORY_SEPARATOR . $this->imageDirectory);
    }

    /**
     * Resize image.
     *
     * @param string $filename image filename
     * @param int $width image width in pixels
     * @param int $height image height in pixels
     * @param string $mode image resize mode (inset/outset)
     * @param int $quality image quality (0 - 100). Defaults 100.
     * @return null|string resized image path
     */
    public function resizeImage($filename, $width, $height, $mode = ManipulatorInterface::THUMBNAIL_INSET, $quality = 100)
    {
        if (empty($filename)) {
            $filename = 'placeholder.png';
            $this->imageDirectory = '';
        }

        $imageBaseUrl = Yii::$app->request->baseUrl . '/image/cache/' . (!empty($this->imageDirectory) ? $this->imageDirectory . '/' : '');

        $imageOld = $filename;
        $imageOldPath = $this->getImagePath() . DIRECTORY_SEPARATOR . $filename;
        $imageOldUrl = $imageBaseUrl . $imageOld;

        if (!is_file($imageOldPath)) {
            return null;
        }

        $extension = pathinfo($imageOld, PATHINFO_EXTENSION);

        $imageNew = substr($filename, 0, strrpos($filename, '.')) . '-' . $width . (($height) ? ('x' . $height) : '') . '.' . $extension;
        $imageNewPath = $this->getImageCachePath() . DIRECTORY_SEPARATOR . $imageNew;

        if (!is_file($imageNewPath) || (filemtime($imageOldPath) > filemtime($imageNewPath))) {
            list($widthOrig, $heightOrig, $imageType) = getimagesize($imageOldPath);

            if (!in_array($imageType, array(IMAGETYPE_PNG, IMAGETYPE_JPEG, IMAGETYPE_GIF))) {
                return $imageOldUrl;
            }

            if (!is_dir($this->getImageCachePath())) {
                @mkdir($this->getImageCachePath(), 0777, true);
            }

            if ($widthOrig != $width || $heightOrig != $height) {
                Image::thumbnail($imageOldPath, $width, $height, $mode)->save($imageNewPath, ['quality' => $quality]);
            } else {
                copy($imageOldPath, $imageNewPath);
            }
        }

        return $imageBaseUrl . $imageNew;
    }

    /**
     * Uploads image.
     *
     * @param bool|string $attribute image attribute. Defaults false, meaning behavior attribute will be used
     * @param bool|string $index index used for array attribute value
     * @return bool|string uploaded image file name, false otherwise
     */
    public function uploadImage($attribute = false, $index = false)
    {
        $imageAttribute = $attribute ? $attribute : $this->imageAttribute;

        $attr = $index ? $this->owner->{$imageAttribute}[$index] : $this->owner->{$imageAttribute};

        if ($this->owner->validate($imageAttribute)) {
            if (!empty($attr)) {
                $imageName = $this->generateImageName($attr->extension);
                $filename = $this->getImagePath() . DIRECTORY_SEPARATOR . $imageName;

                if (!is_dir($this->getImagePath())) {
                    @mkdir($this->getImagePath(), 0777, true);
                }

                $attr->saveAs($filename);

                return $imageName;
            }
        }

        return false;
    }

    /**
     * Removes image and all related thumbnails.
     *
     * @param string $filename file name to remove
     */
    public function removeImage($filename)
    {
        if (!empty($filename)) {
            $image = $this->getImagePath() . DIRECTORY_SEPARATOR . $filename;

            if (file_exists($image)) {
                unlink($image);
            }

            $this->removeThumbnailImages($filename);
        }
    }

    /**
     * Removes thumbnail images.
     *
     * @param string $filename original image file name
     */
    public function removeThumbnailImages($filename)
    {
        $extension = pathinfo($filename, PATHINFO_EXTENSION);
        $file = pathinfo($filename, PATHINFO_FILENAME);

        $images = glob($this->getImageCachePath() . DIRECTORY_SEPARATOR . $file . '*' . $extension);

        foreach ($images as $image) {
            if (file_exists($image)) {
                unlink($image);
            }
        }
    }

    /**
     * Generates unique image file name.
     *
     * @param string $extension image file extension
     * @return string name
     */
    public function generateImageName($extension)
    {
        return md5(uniqid(time(), true)) . '.' . $extension;
    }

    /**
     * Returns image placeholder.
     *
     * @param int $width image width in pixels
     * @param int $height image height in pixels
     * @param string $mode image resize mode (inset/outset)
     * @param int $quality image quality (0 - 100). Defaults 100.
     * @return null|string resized image path
     */
    public static function placeholder($width, $height, $mode = ManipulatorInterface::THUMBNAIL_INSET, $quality = 100)
    {
        return (new self())->resizeImage('placeholder.png', $width, $height, $mode, $quality);
    }
}
