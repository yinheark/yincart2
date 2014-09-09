<?php
/**
 * @link http://www.yincart.com/
 * @copyright Copyright (c) 2014 Yincart
 * @license http://www.yincart.com/license/
 */

namespace yincart\base\helpers;

use Imagine\Image\ManipulatorInterface;

class Image extends \yii\imagine\Image
{
    public static function getThumbnail($filename, $width, $height, $mode = ManipulatorInterface::THUMBNAIL_OUTBOUND)
    {
        $paths = explode('/', $filename);
        $file = array_pop($paths);
        array_unshift($paths, '.thumbnail', $width . 'X' . $height);
        $fileDir = \Yii::getAlias(\Yii::$app->params['imagePath']);

        foreach ($paths as $path) {
            $fileDir = $fileDir . '/' . $path;
            if (!file_exists($fileDir)) {
                mkdir($fileDir);
            }
        }

        $thumbFilePath = $fileDir . '/' . $file;
        if (!file_exists($thumbFilePath)) {
            $thumb = self::thumbnail(\Yii::$app->params['imagePath'] . $filename, $width, $height, $mode);
            $thumb->save($thumbFilePath);
        }

        return \Yii::$app->params['imageDomain'] . '/.thumbnail/' . $width . 'X' . $height . $filename;
    }
} 