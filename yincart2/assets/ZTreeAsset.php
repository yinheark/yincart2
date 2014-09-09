<?php
/**
 * @link http://www.yincart.com/
 * @copyright Copyright (c) 2014 Yincart
 * @license http://www.yincart.com/license/
 */

namespace yincart\assets;

use yincart\base\web\AssetBundle;
use yincart\Yincart;

/**
 * Class ZTreeAsset
 * @package yincart\base\assets
 * @author jeremy.zhou(gao_lujie@live.cn)
 */
class ZTreeAsset extends AssetBundle
{
    public $sourcePath = '@vendor/zTree/zTree_v3';
    public $css = [
        'css/zTreeStyle/zTreeStyle.css'
    ];
    public $js = [
        'js/jquery.ztree.all-3.5.js'
    ];

    public function init()
    {
        $this->depends[] = Yincart::$container->jqueryAssetClass;
    }
} 