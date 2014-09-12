<?php

namespace yincart\sales\models;

use Yii;
use yincart\base\db\ActiveRecord;
use yincart\Yincart;

/**
 * This is the model class for table "shipping_cart".
 *
 * @property integer $shipping_cart_id
 * @property integer $customer_id
 * @property integer $item_id
 * @property integer $sku_id
 * @property integer $qty
 *
 * @property \yincart\customer\models\Customer $customer
 * @property \yincart\catalog\models\Item $item
 * @property \yincart\catalog\models\Sku $sku
 *
 * @method static ShippingCart getShippingCart(int $id)
 */
class shippingCart extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%shipping_cart}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['sku_id'], 'default', 'value' => 0],
            [['qty'], 'default', 'value' => 1],
            [['customer_id', 'item_id', 'sku_id', 'qty'], 'integer'],
            [['customer_id', 'item_id'], 'required']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'shipping_cart_id' => Yii::t('yincart', 'shipping Cart ID'),
            'customer_id' => Yii::t('yincart', 'Customer ID'),
            'item_id' => Yii::t('yincart', 'Item ID'),
            'sku_id' => Yii::t('yincart', 'Sku ID'),
            'qty' => Yii::t('yincart', 'Qty'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomer()
    {
        return $this->hasOne(Yincart::$container->customerClass, ['customer_id' => 'customer_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItem()
    {
        return $this->hasOne(Yincart::$container->itemClass, ['item_id' => 'item_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSku()
    {
        return $this->hasOne(Yincart::$container->skuClass, ['sku_id' => 'sku_id']);
    }
}
