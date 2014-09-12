<?php
/**
 * @link http://www.yincart.com/
 * @copyright Copyright (c) 2014 Yincart
 * @license http://www.yincart.com/license/
 */

namespace yincart\sales\widgets;

use yincart\widgets\JqGrid;
use yincart\Yincart;

class OrderGrid extends JqGrid
{
    public function init()
    {
        parent::init();
        $jsAssetFolder = $this->getView()->getAssetManager()->publish('@yincart/sales/widgets/web/js');
        $this->getView()->registerJsFile($jsAssetFolder[1] . '/order-grid.js', [Yincart::$container->aceAdminAssetClass]);
    }
} 