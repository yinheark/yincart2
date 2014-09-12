<?php
/**
 * @link http://www.yincart.com/
 * @copyright Copyright (c) 2014 Yincart
 * @license http://www.yincart.com/license/
 */

namespace yincart\assets;


use yii\web\View;
use yincart\base\web\AssetBundle;
use yincart\Yincart;

class GarbiniAsset extends AssetBundle
{
    public $sourcePath = '@yincart/themes/garbini/web';
    public $css = [
        'css/bootstrap.min.css',
        'css/owl.carousel.css',
        'css/owl.theme.css',
        'css/owl.transitions.css',
        'css/style.css',
        'css/config.css',
    ];
    public $js = [
        ['file' => 'js/html5shiv.js', 'position' => View::POS_HEAD, 'condition' => 'lte IE 9'],
        'js/bootstrap.min.js',
        'js/owl.carousel.min.js',
        'js/jquery.jpanelmenu.min.js',
        'js/main.js',
    ];

    public $style = 'blue';

    public function init()
    {
        $this->sourcePath .= '/' . $this->style;
        $this->depends[] = Yincart::$container->jqueryAssetClass;
    }
} 