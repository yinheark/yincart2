<?php
/**
 * @link http://www.yincart.com/
 * @copyright Copyright (c) 2014 Yincart
 * @license http://www.yincart.com/license/
 */

namespace yincart\catalog\widgets;

use yii\helpers\Html;
use yincart\base\base\Widget;
use yincart\Yincart;

/**
 * Class CategoryTree
 * @package yincart\catalog\widgets
 * @author jeremy.zhou(gao_lujie@live.cn)
 */
class CategoryTree extends Widget
{
    public function init()
    {
        $jsAssetFolder = $this->getView()->getAssetManager()->publish('@yincart/catalog/widgets/web/js');
        $this->getView()->registerJsFile($jsAssetFolder[1] . '/category-tree.js', [Yincart::$container->zTreeAssetClass]);
    }

    public function run()
    {
        if (empty($this->tagData['type'])) {
            $this->tagData['type'] = 'edit';
        }
        return $this->render('categoryTree', ['data' => $this->getTagData()]);
    }
} 