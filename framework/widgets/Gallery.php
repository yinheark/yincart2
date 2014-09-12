<?php
/**
 * @link http://www.yincart.com/
 * @copyright Copyright (c) 2014 Yincart
 * @license http://www.yincart.com/license/
 */

namespace yincart\widgets;

use yincart\base\base\Widget;
use yincart\Yincart;

class Gallery extends Widget
{
    public $inputName;

    public function init()
    {
        $juicerAssetClass = Yincart::$container->juicerAssetClass;
        $juicerAssetClass::register($this->getView());
        $jsAssetFolder = $this->getView()->getAssetManager()->publish('@yincart/widgets/web/js');
        $this->getView()->registerJsFile($jsAssetFolder[1] . '/gallery.js', [Yincart::$container->elFinderAssetClass]);
    }

    public function run()
    {
        return $this->render('gallery', ['inputName' => $this->inputName,'data' => $this->getTagData()]);
    }
} 