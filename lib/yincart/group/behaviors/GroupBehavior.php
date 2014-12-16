<?php
/**
 * @author: changhai.lin
 * @Date: 2014/11/25
 * @Time: 19:02
 */

namespace yincart\group\behaviors;

use kiwi\Kiwi;
use yii\base\Behavior;

/**
 * Class GroupBehavior
 *
 * @property \yii\db\ActiveRecord $owner
 *
 * @package yincart\group\behaviors
 */
class GroupBehavior extends Behavior
{
    public function getGroups()
    {
        $this->owner->hasMany(Kiwi::getGroupClass(), ['id' => 'tree_id'])
            ->viaTable('{{%customer_tree}}', ['user_id' => 'customer_id']);
    }
} 