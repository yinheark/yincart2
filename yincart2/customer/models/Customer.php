<?php

namespace yincart\customer\models;

use Yii;
use yincart\base\db\ActiveRecord;
use yincart\Yincart;

/**
 * This is the model class for table "customer".
 *
 * @property integer $customer_id
 * @property integer $customer_group_id
 * @property string $name
 * @property string $email
 * @property string $password
 * @property integer $register_time
 * @property integer $last_login_time
 * @property integer $status
 *
 * @property Address[] $addresses
 * @property CustomerGroup $customerGroup
 * @property \yincart\sales\models\Order[] $orders
 * @property \yincart\sales\models\ShippingCart[] $shippingCarts
 * @property Wish[] $wishes
 *
 * @method static Customer getCustomer(int $id)
 */
class Customer extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%customer}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['status'], 'default', 'value' => 0],
            [['customer_group_id', 'status'], 'integer'],
            [['name', 'email', 'password'], 'required'],
            [['name', 'email', 'password'], 'string', 'max' => 45]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'customer_id' => Yii::t('yincart', 'Customer ID'),
            'customer_group_id' => Yii::t('yincart', 'Customer Group ID'),
            'name' => Yii::t('yincart', 'Name'),
            'email' => Yii::t('yincart', 'Email'),
            'password' => Yii::t('yincart', 'Password'),
            'register_time' => Yii::t('yincart', 'Register Time'),
            'last_login_time' => Yii::t('yincart', 'Last Login Time'),
            'status' => Yii::t('yincart', 'Status'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAddresses()
    {
        return $this->hasMany(Yincart::$container->addressClass, ['customer_id' => 'customer_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomerGroup()
    {
        return $this->hasOne(Yincart::$container->customerGroupClass, ['customer_group_id' => 'customer_group_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrders()
    {
        return $this->hasMany(Yincart::$container->orderClass, ['customer_id' => 'customer_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShippingCarts()
    {
        return $this->hasMany(Yincart::$container->shippingCartClass, ['customer_id' => 'customer_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWishes()
    {
        return $this->hasMany(Yincart::$container->wishClass, ['customer_id' => 'customer_id']);
    }
}
