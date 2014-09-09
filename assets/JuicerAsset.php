<?php
/**
 * @link http://www.yincart.com/
 * @copyright Copyright (c) 2014 Yincart
 * @license http://www.yincart.com/license/
 */

namespace yincart\assets;

use yincart\base\web\AssetBundle;

/**
 * Class JuicerAsset
 * @package yincart\assets
 * @author jeremy.zhou(gao_lujie@live.cn)
 */
class JuicerAsset extends AssetBundle
{
    public $sourcePath = '@vendor/PaulGuo/Juicer';
    public $js = [
        'src/juicer.js'
    ];
} 