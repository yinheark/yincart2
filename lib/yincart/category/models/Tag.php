<?php

namespace yincart\category\models;

use core\tree\models\Tree;
use kiwi\Kiwi;
use Yii;

/**
 * Class Tag
 * @property items
 *
 * @package yincart\category\models
 */
class Tag extends Tree
{
    const TYPE_DEFAULT = 'yincart-tag';

    public function getItemTags()
    {
        return $this->hasMany(Kiwi::getItemTagClass(), ['tree_id' => 'id']);
    }

    public function getItems()
    {
        return $this->hasMany(Kiwi::getItemClass(), ['item_id' => 'item_id'])
            ->via('itemTags');
    }
}
