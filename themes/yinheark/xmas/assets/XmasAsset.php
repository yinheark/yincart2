<?php
/**
 * Created by PhpStorm.
 * User: Yinhe
 * Date: 2014/12/6
 * Time: 16:06
 */

namespace themes\xmas\assets;


use yii\bootstrap\BootstrapPluginAsset;
use yii\web\AssetBundle;

class XmasAsset extends AssetBundle
{
    public $sourcePath = '@themes/xmas/assets/source';

    public $js = [
		"js/ie8-responsive-file-warning.js",
      "https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js",
      "https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js",
      	"js/jquery-1.11.1.min.js",
	"js/jquery-migrate-1.2.1.min.js",
	"js/bootstrap.min.js",
	"js/bootstrap-hover-dropdown.min.js",
	"js/custom.js",
    ];

    public $css = [
	"css/bootstrap.min.css",
	"font-awesome/css/font-awesome.min.css",
	"css/style.css",
	"css/responsive.css",
    ];
} 