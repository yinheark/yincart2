<?php
/**
 * @link http://www.yincart.com/
 * @copyright Copyright (c) 2014 Yincart
 * @license http://www.yincart.com/license/
 */

namespace yincart\catalog\widgets;

use yincart\base\base\Widget;
use yincart\Yincart;

/**
 * Class ItemForm
 * @package yincart\catalog\widgets
 * @author jeremy.zhou(gao_lujie@live.cn)
 */
class ItemForm extends Widget
{
    public $itemId;

    public $action;

    public function init()
    {
        $ckEditorAssetClass = Yincart::$container->ckEditorAssetClass;
        $ckEditorAssetClass::register($this->getView());
        $jsAssetFolder = $this->getView()->getAssetManager()->publish('@yincart/catalog/widgets/web/js');
        $this->getView()->registerJsFile($jsAssetFolder[1] . '/item-form.js', [Yincart::$container->jqueryFormAssetClass]);
    }

    public function run()
    {
        $item = Yincart::$container->item;
        if ($this->itemId) {
            $item = $item->getItem($this->itemId);
        }
        return $this->render('itemForm', [
            'model' => $item,
            'action' => $this->action,
            'data' => $this->getTagData()
        ]);
    }
} 