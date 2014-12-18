<?php

namespace extensions\deal\models;

use kiwi\Kiwi;
use Yii;

/**
 * This is the model class for table "{{%deal_log}}".
 *
 * @property integer $deal_log_id
 * @property integer $user_id
 * @property integer $order_id
 * @property integer $item_id
 * @property integer $sale_price
 * @property integer $percent
 * @property string $memo
 * @property string $key
 * @property integer $deal_time
 * @property integer $created_at
 *
 * @property \extensions\sales\models\CustomerSales $customerSales
 */
class DealLog extends \kiwi\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%deal_log}}';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'deal_log_id' => Yii::t('app', 'Deal Log ID'),
            'user_id' => Yii::t('app', 'User ID'),
            'order_id' => Yii::t('app', 'Order ID'),
            'item_id' => Yii::t('app', 'Item ID'),
            'sale_price' => Yii::t('app', 'Sale Price'),
            'percent' => Yii::t('app', 'Percent'),
            'memo' => Yii::t('app', 'Memo'),
            'key' => Yii::t('app', 'Key'),
            'deal_time' => Yii::t('app', 'Deal Time'),
            'created_at' => Yii::t('app', 'Created At'),
        ];
    }

    public function getCustomerSales()
    {
        return $this->hasOne(Kiwi::getCustomerSalesClass(), ['key' => 'key']);
    }

    public function getItem()
    {
        return $this->hasOne(Kiwi::getItemClass(), ['item_id' => 'item_id']);
    }

    public function getOrder()
    {
        return $this->hasOne(Kiwi::getOrderClass(), ['order_id' => 'order_id']);
    }

    public function getOrderItem()
    {
        return $this->hasOne(Kiwi::getOrderItemClass(), ['order_id' => 'order_id', 'item_id' => 'item_id']);
    }
}
