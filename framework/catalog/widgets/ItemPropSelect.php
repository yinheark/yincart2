<?php
/**
 * @link http://www.yincart.com/
 * @copyright Copyright (c) 2014 Yincart
 * @license http://www.yincart.com/license/
 */

namespace yincart\catalog\widgets;

use yincart\base\base\Widget;

class ItemPropSelect extends Widget
{
    public $item;

    public function run()
    {
        return $this->render('itemPropSelect', ['item' => $this->item, 'data' => $this->getTagData()]);
    }
} 