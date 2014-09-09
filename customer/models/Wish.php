<?php

namespace yincart\customer\models;

use Yii;
use yincart\base\db\ActiveRecord;
use yincart\Yincart;

/**
 * This is the model class for table "wish".
 *
 * @property integer $wish_id
 * @property integer $customer_id
 * @property integer $item_id
 *
 * @property Customer $customer
 * @property \yincart\catalog\models\Item $item
 *
 * @method static Wish getWish(int $id)
 */
class Wish extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%wish}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['customer_id', 'item_id'], 'integer'],
            [['customer_id', 'item_id'], 'required']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'wish_id' => Yii::t('yincart', 'Wish ID'),
            'customer_id' => Yii::t('yincart', 'Customer ID'),
            'item_id' => Yii::t('yincart', 'Item ID'),
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
}
