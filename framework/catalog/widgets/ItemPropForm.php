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
 * Class ItemPropForm
 * @package yincart\catalog\widgets
 * @author jeremy.zhou(gao_lujie@live.cn)
 */
class ItemPropForm extends Widget
{
    public $action;

    public $categoryId;

    public $itemId;

    public function init()
    {
        $jsAssetFolder = $this->getView()->getAssetManager()->publish('@yincart/catalog/widgets/web/js');
        $this->getView()->registerJsFile($jsAssetFolder[1] . '/item-prop-form.js', [Yincart::$container->aceAdminAssetClass]);
    }

    public function run()
    {
        $propValueModel = Yincart::$container->getPropValueModel(['categoryId' => $this->categoryId, 'itemId' => $this->itemId]);
        return $this->render('itemPropForm', ['propValueModel' => $propValueModel, 'action' => $this->action, 'data' => $this->getTagData()]);
    }
}