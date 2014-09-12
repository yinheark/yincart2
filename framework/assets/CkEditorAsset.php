<?php
/**
 * @link http://www.yincart.com/
 * @copyright Copyright (c) 2014 Yincart
 * @license http://www.yincart.com/license/
 */

namespace yincart\assets;

use yincart\base\web\AssetBundle;
use yincart\Yincart;

class CkEditorAsset extends AssetBundle
{
    public $sourcePath = '@vendor/ckeditor/ckeditor-releases';
    public $js = [
        'ckeditor.js',
        'adapters/jquery.js',
    ];

    public function init()
    {
        $this->depends[] = Yincart::$container->jqueryAssetClass;
    }
} 