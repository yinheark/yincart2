<?php

namespace yincart\category\models;

use core\tree\models\Tree;
use kiwi\Kiwi;
use Yii;

/**
 * This is the model class for table "{{%category}}".
 * @property items
 */
class Category extends Tree
{
    const TYPE_DEFAULT = 'category';

    public function getItemCategories()
    {
        return $this->hasMany(Kiwi::getItemCategoryClass(), ['tree_id' => 'id']);
    }

    public function getItems()
    {
        return $this->hasMany(Kiwi::getItemClass(), ['item_id' => 'item_id'])
            ->via('itemCategories');
    }
}
