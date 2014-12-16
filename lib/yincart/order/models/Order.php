<?php

namespace yincart\order\models;

use kiwi\Kiwi;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\Exception;

/**
 * This is the model class for table "{{%order}}".
 *
 * @property integer $order_id
 * @property integer $user_id
 * @property integer $order_no
 * @property string $total_price
 * @property string $shipping_fee
 * @property string $payment_fee
 * @property string $address
 * @property string $memo
 * @property integer $create_at
 * @property integer $update_at
 * @property integer $status
 *
 * @property OrderItem[] $orderItems
 * @property \yincart\payment\models\Payment $payment
 * @property \yincart\shipment\models\Shipment $shipment
 * @property \yincart\refund\models\Refund $refund
 */
class Order extends \kiwi\db\ActiveRecord
{
    const STATUS_WAIT_PAYMENT = 1;

    const STATUS_WAIT_SHIPMENT = 2;

    const STATUS_COMPLETE = 3;

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
            ['memo', 'default', 'value' => ''],
            [['address', 'memo'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'order_id' => Yii::t('app', 'Order ID'),
            'user_id' => Yii::t('app', 'User ID'),
            'total_price' => Yii::t('app', 'Total Price'),
            'shipping_fee' => Yii::t('app', 'Shipping Fee'),
            'payment_fee' => Yii::t('app', 'Payment Fee'),
            'address' => Yii::t('app', 'Address'),
            'memo' => Yii::t('app', 'Memo'),
            'create_at' => Yii::t('app', 'Create At'),
            'update_at' => Yii::t('app', 'Update At'),
            'status' => Yii::t('app', 'Status'),
        ];
    }

    public function getOrderItems()
    {
        return $this->hasMany(Kiwi::getOrderItemClass(), ['order_id' => 'order_id']);
    }

    public function getPayment()
    {
        return $this->hasOne(Kiwi::getPaymentClass(), ['order_id' => 'order_id']);
    }

    public function getShipment()
    {
        return $this->hasOne(Kiwi::getShipmentClass(), ['order_id' => 'order_id']);
    }

    public function getRefund()
    {
        return $this->hasOne(Kiwi::getRefund(), ['order_id' => 'order_id']);
    }

    public function behaviors()
    {
        return [
            'time' => [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'create_at',
                'updatedAtAttribute' => 'update_at',
            ]
        ];
    }

    public function saveOrder()
    {
        $ShoppingCart = Kiwi::getShoppingCart();
        $this->user_id = Yii::$app->user->id;
        $this->total_price = $ShoppingCart->getTotal();
        /**@TODO attributes  * */
        $this->shipping_fee = $ShoppingCart->getShippingFee();
        $this->payment_fee = 0;
        $this->status = 1;
        $cartItems = $ShoppingCart->cartItems;
        $orderItems = [];
        foreach ($cartItems as $cartItem) {

            $key = $cartItem->data['key'];
            /** @var \extensions\sales\models\CustomerSales $customer_sale */
            $customerSaleClass = Kiwi::getCustomerSalesClass();
            $customer_sale = $customerSaleClass::find()->where(['key' => $key])->one();

            $orderItem = Kiwi::getOrderItem();
            $orderItem->item_id = $cartItem->item->item_id;
            $orderItem->price = $customer_sale->sale_price;
            $orderItem->qty = $cartItem->qty;
            $orderItem->name = $cartItem->item->name;
            $orderItem->data = $cartItem->data;
            /**@TODO picture can not null * */
            $orderItem->picture = is_null($cartItem->item->pictures) ? $cartItem->item->pictures : 'default';
            $orderItems[] = $orderItem;
        }
        $this->orderItems = $orderItems;
        if ($this->save()) {
            $ShoppingCart->clearAll();
            return true;
        }
        return false;
    }

    public function getOrderName()
    {
        return $this->order_no;
    }

    public function init()
    {
        parent::init();
        $this->attachEvents();
    }

    public function attachEvents()
    {
        $this->on(static::EVENT_BEFORE_INSERT, [$this, 'generateOrderNo']);
        $this->on(static::EVENT_AFTER_INSERT, [$this, 'updateItemStock']);
    }

    public function generateOrderNo()
    {
        $this->order_no = date('YmdHis') . rand(1000, 9999);
    }


    public function updateItemStock()
    {
        foreach($this->orderItems as $orderItem){
            $item = Kiwi::getItem()->findOne(['item_id'=>$orderItem->item_id]);
            $item->stock_qty = $item->stock_qty - $orderItem->qty;
            if(!$item->save()){
                throw new Exception('update item fail');
            }
        }
    }
}