<?php
/**
 * @link http://www.yincart.com/
 * @copyright Copyright (c) 2014 Yincart
 * @license http://www.yincart.com/license/
 */

namespace yincart\customer\widgets;

use yincart\widgets\JqGrid;
use yincart\Yincart;

class CustomerGrid extends JqGrid
{
    public function init()
    {
        parent::init();
        $jsAssetFolder = $this->getView()->getAssetManager()->publish('@yincart/customer/widgets/web/js');
        $this->getView()->registerJsFile($jsAssetFolder[1] . '/customer-grid.js', [Yincart::$container->aceAdminAssetClass]);
    }
} 