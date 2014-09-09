<?php
/**
 * @link http://www.yincart.com/
 * @copyright Copyright (c) 2014 Yincart
 * @license http://www.yincart.com/license/
 */

namespace yincart\widgets;

use yii\helpers\Html;
use yii\helpers\Url;
use yincart\base\base\Widget;
use yincart\Yincart;

class ElFinder extends Widget
{
    public function init()
    {
        $elFinderAssetClass = Yincart::$container->elFinderAssetClass;
        $elFinderAssetClass::register($this->getView());
        $jsAssetFolder = $this->getView()->getAssetManager()->publish('@yincart/widgets/web/js');
        $this->getView()->registerJsFile($jsAssetFolder[1] . '/elfinder.js', [Yincart::$container->elFinderAssetClass]);
        $cssAssetFolder = $this->getView()->getAssetManager()->publish('@yincart/widgets/web/css');
        $this->getView()->registerCssFile($cssAssetFolder[1] . '/elfinder.css', [Yincart::$container->elFinderAssetClass]);
    }

    public function run()
    {
        return Html::tag('div', '', ['id' => 'elfinder', 'data' => $this->getTagData()]);
    }
} 