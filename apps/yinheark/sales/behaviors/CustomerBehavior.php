<?php
/**
 * @author: changhai.lin
 * @Date: 2014/11/25
 * @Time: 19:02
 */

namespace extensions\sales\behaviors;

use kiwi\Kiwi;
use yii\base\Behavior;

/**
 * Class Item
 *
 * @property \yii\db\ActiveRecord $owner
 *
 * @package yincart\category\models
 */
class CustomerBehavior extends Behavior
{
    public function getCustomerSeller()
    {
        return $this->owner->hasOne(Kiwi::getCustomerSellerClass(), ['customer_id' => 'id']);
    }
} 