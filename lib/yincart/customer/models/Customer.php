<?php
/**
 * @author: changhai.lin
 * @Date: 2014/11/22
 * @Time: 14:42
 */

namespace yincart\customer\models;

use kiwi\Kiwi;

/**
 * Class User
 *
 * @property CustomerInfo $customerInfo
 * @property CustomerInfo $customerAddresses
 *
 * @package yincart\customer\models
 */
class Customer extends \core\user\models\User
{
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomerInfo()
    {
        return $this->hasOne(Kiwi::getCustomerInfoClass(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomerAddresses()
    {
        return $this->hasMany(Kiwi::getCustomerAddressClass(), ['user_id' => 'id']);
    }
} 