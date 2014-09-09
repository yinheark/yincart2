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
 * Class JqueryFormAsset
 * @package yincart\assets
 * @author jeremy.zhou(gao_lujie@live.cn)
 */
class JqueryFormAsset extends AssetBundle
{
    public $sourcePath = '@vendor/malsup/form';
    public $js = [
        'jquery.form.js'
    ];

    public function init()
    {
        $this->depends[] = Yincart::$container->jqueryAssetClass;
    }
} 