<?php
/**
 * @link http://www.yincart.com/
 * @copyright Copyright (c) 2014 Yincart
 * @license http://www.yincart.com/license/
 */

namespace yincart\assets;

use yincart\base\web\AssetBundle;

/**
 * Class JqueryAsset
 * @package yincart\assets
 * @author jeremy.zhou(gao_lujie@live.cn)
 */
class JqueryAsset extends AssetBundle
{
//    public $sourcePath = '@yincart/themes/aceAdmin/web';
//    public $js = [
////        'jquery.min.js',
//        'js/jquery1x.min.js',
//        'http://code.jquery.com/jquery-migrate-1.2.1.js'
//    ];

    public $sourcePath = '@yincart/themes/aceAdmin/web';
    public $js = [
        'js/jquery-1.7.2.min.js',
    ];
} 