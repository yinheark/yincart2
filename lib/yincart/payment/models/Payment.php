<?php

namespace yincart\payment\models;

use Yii;

/**
 * This is the model class for table "{{%payment}}".
 *
 * @property integer $payment_id
 * @property integer $order_id
 * @property integer $payment_method
 * @property string $payment_fee
 * @property string $transcation_no
 * @property integer $create_at
 * @property integer $status
 */
class Payment extends \kiwi\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%payment}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['order_id', 'payment_method', 'payment_fee', 'transcation_no', 'create_at', 'status'], 'required'],
            [['order_id', 'payment_method', 'create_at', 'status'], 'integer'],
            [['payment_fee'], 'number'],
            [['transcation_no'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'payment_id' => Yii::t('app', 'Payment ID'),
            'order_id' => Yii::t('app', 'Order ID'),
            'payment_method' => Yii::t('app', 'Payment Method'),
            'payment_fee' => Yii::t('app', 'Payment Fee'),
            'transcation_no' => Yii::t('app', 'Transcation No'),
            'create_at' => Yii::t('app', 'Create At'),
            'status' => Yii::t('app', 'Status'),
        ];
    }
}
