<?php
/**
 * @link http://www.yincart.com/
 * @copyright Copyright (c) 2014 Yincart
 * @license http://www.yincart.com/license/
 */

namespace yincart\catalog\widgets;

use yincart\widgets\JqGrid;
use yincart\Yincart;

/**
 * Class ItemPropGrid
 * @package yincart\catalog\widgets
 * @author jeremy.zhou(gao_lujie@live.cn)
 */
class ItemPropGrid extends JqGrid
{
    public function init()
    {
        parent::init();
        $jsAssetFolder = $this->getView()->getAssetManager()->publish('@yincart/catalog/widgets/web/js');
        $this->getView()->registerJsFile($jsAssetFolder[1] . '/item-prop-grid.js', [Yincart::$container->aceAdminAssetClass]);
    }
} 