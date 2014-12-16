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
class TagBehavior extends Behavior
{
    public function getItemTags()
    {
        return $this->owner->hasMany(Kiwi::getItemTagClass(), ['item_id' => 'item_id']);
    }

    public function getTags()
    {
        return $this->owner->hasMany(Kiwi::getTagClass(), ['id' => 'tree_id'])
            ->via('itemTags');
    }
} 