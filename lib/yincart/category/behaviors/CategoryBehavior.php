<?php
/**
 * @author: changhai.lin
 * @Date: 2014/11/25
 * @Time: 19:02
 */

namespace yincart\category\behaviors;

use kiwi\Kiwi;
use yii\base\Behavior;

/**
 * Class Item
 *
 * @property \yii\db\ActiveRecord $owner
 *
 * @package yincart\category\models
 */
class CategoryBehavior extends Behavior
{
    public function getItemCategories()
    {
        return $this->owner->hasMany(Kiwi::getItemCategoryClass(), ['item_id' => 'item_id']);
    }

    public function getCategories()
    {
        return $this->owner->hasMany(Kiwi::getCategoryClass(), ['id' => 'tree_id'])
            ->via('itemCategories');
    }
} 