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

/**
 * Class AceAdminAsset
 * @package yincart\base\assets
 * @author jeremy.zhou(gao_lujie@live.cn)
 */
class AceAdminAsset extends AssetBundle
{
    public $sourcePath = '@yincart/themes/aceAdmin/web';
    public $css = [
        'css/bootstrap.min.css',
        'css/font-awesome.min.css',
        //page specific plugin styles insert here
        'css/jquery.gritter.css',
        'css/jquery-ui.min.css',
        'css/jquery-ui.custom.min.css',
        'css/datepicker.css',
        'css/ui.jqgrid.css',
        'css/colorbox.css',
        'css/ace-fonts.css',
        'css/ace.min.css',
        ['file' => 'css/ace-part2.min.css', 'condition' => 'lte IE 9'],
        'css/ace-skins.min.css',
        'css/ace-rtl.min.css',
        ['file' => 'css/ace-ie.min.css', 'condition' => 'lte IE 9'],
    ];
    public $js = [
        ['file' => 'js/ace-extra.min.js', 'position' => View::POS_HEAD],
        ['file' => 'js/html5shiv.js', 'position' => View::POS_HEAD, 'condition' => 'lte IE 8'],
        ['file' => 'js/respond.min.js', 'position' => View::POS_HEAD, 'condition' => 'lte IE 8'],
        'js/bootstrap.min.js',
        //page specific plugin scripts insert here
        'js/jquery-ui.min.js',
        'js/jquery-ui.custom.min.js',
        'js/jquery.ui.touch-punch.min.js',
        'js/jquery.slimscroll.min.js',
        'js/jquery.gritter.min.js',
        'js/date-time/bootstrap-datepicker.min.js',
        'js/jqGrid/jquery.jqGrid.min.js',
        'js/jqGrid/i18n/grid.locale-en.js',
        'js/jquery.colorbox-min.js',
        'js/ace-elements.min.js',
        'js/ace.min.js',
    ];

    public function init()
    {
        $assetFolder = \Yii::$app->getAssetManager()->publish($this->sourcePath);
        $content = <<<EOD
if ('ontouchstart' in document.documentElement) document.write("<script src='$assetFolder[1]/js/jquery.mobile.custom.min.js'><"+"/script>");
EOD;
        $this->js[] = ['content' => $content, 'position' => View::POS_END];

        $this->depends[] = Yincart::$container->jqueryAssetClass;
    }
} 