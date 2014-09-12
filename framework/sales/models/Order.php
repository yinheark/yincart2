<?php

namespace yincart\sales\models;

use Yii;
use yincart\base\db\ActiveRecord;
use yincart\Yincart;

/**
 * This is the model class for table "order".
 *
 * @property integer $order_id
 * @property integer $customer_id
 * @property double $total_price
 * @property string $promotions
 * @property integer $created_time
 * @property integer $payment_time
 * @property integer $shipping_time
 * @property integer $completed_time
 * @property integer $canceled_time
 * @property integer $payment_type
 * @property string $payment_transaction_no
 * @property integer $shipping_type
 * @property string $shipping_address
 * @property integer $is_free_shipping
 * @property double $shipping_fee
 * @property string $remark
 * @property integer $status
 *
 * @property \yincart\customer\models\Customer $customer
 * @property OrderItem[] $orderItems
 *
 * @method static Order getOrder(int $id)
 */
class Order extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%order}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['promotions', 'payment_transaction_no', 'remark'], 'default', 'value' => ''],
            [['payment_time', 'shipping_time', 'completed_time', 'canceled_time', 'total_price', 'shipping_fee'], 'default', 'value' => 0],
            [['payment_type', 'shipping_type', 'is_free_shipping', 'status'], 'default', 'value' => 1],
            [['customer_id', 'shipping_address'], 'required'],
            [['customer_id', 'created_time', 'payment_time', 'shipping_time', 'completed_time', 'canceled_time', 'payment_type', 'shipping_type', 'is_free_shipping', 'status'], 'integer'],
            [['total_price', 'shipping_fee'], 'number'],
            [['promotions', 'payment_transaction_no'], 'string', 'max' => 45],
            [['shipping_address', 'remark'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'order_id' => Yii::t('yincart', 'Order ID'),
            'customer_id' => Yii::t('yincart', 'Customer ID'),
            'total_price' => Yii::t('yincart', 'Total Price'),
            'promotions' => Yii::t('yincart', 'Promotions'),
            'created_time' => Yii::t('yincart', 'Created Time'),
            'payment_time' => Yii::t('yincart', 'Payment Time'),
            'shipping_time' => Yii::t('yincart', 'Shipping Time'),
            'completed_time' => Yii::t('yincart', 'Completed Time'),
            'canceled_time' => Yii::t('yincart', 'Canceled Time'),
            'payment_type' => Yii::t('yincart', 'Payment Type'),
            'payment_transaction_no' => Yii::t('yincart', 'Payment Transaction No'),
            'shipping_type' => Yii::t('yincart', 'Shipping Type'),
            'shipping_address' => Yii::t('yincart', 'Shipping Address'),
            'is_free_shipping' => Yii::t('yincart', 'Is Free Shipping'),
            'shipping_fee' => Yii::t('yincart', 'Shipping Fee'),
            'remark' => Yii::t('yincart', 'Remark'),
            'status' => Yii::t('yincart', 'Status'),
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
    public function getOrderItems()
    {
        return $this->hasMany(Yincart::$container->orderItem, ['order_id' => 'order_id']);
    }
}
