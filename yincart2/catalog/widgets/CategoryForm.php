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
 * Class CategoryForm
 * @package yincart\catalog\widgets
 * @author jeremy.zhou(gao_lujie@live.cn)
 */
class CategoryForm extends Widget
{
    public $action;

    public function init()
    {
        $jsAssetFolder = $this->getView()->getAssetManager()->publish('@yincart/catalog/widgets/web/js');
        $this->getView()->registerJsFile($jsAssetFolder[1] . '/category-form.js', [Yincart::$container->jqueryFormAssetClass]);
    }

    public function run()
    {
        $category = Yincart::$container->category;
        return $this->render('categoryForm', ['model' => $category, 'action' => $this->action, 'data' => $this->getTagData()]);
    }
} 