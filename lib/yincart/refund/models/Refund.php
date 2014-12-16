<?php

namespace yincart\refund\models;

use Yii;

/**
 * This is the model class for table "{{%refund}}".
 *
 * @property integer $refund_id
 * @property integer $order_id
 * @property string $refund_fee
 * @property string $reason
 * @property string $memo
 * @property integer $create_at
 * @property integer $update_at
 * @property integer $status
 */
class Refund extends \kiwi\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%refund}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['order_id', 'refund_fee', 'reason', 'memo', 'create_at', 'update_at', 'status'], 'required'],
            [['order_id', 'create_at', 'update_at', 'status'], 'integer'],
            [['refund_fee'], 'number'],
            [['reason', 'memo'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'refund_id' => Yii::t('app', 'Refund ID'),
            'order_id' => Yii::t('app', 'Order ID'),
            'refund_fee' => Yii::t('app', 'Refund Fee'),
            'reason' => Yii::t('app', 'Reason'),
            'memo' => Yii::t('app', 'Memo'),
            'create_at' => Yii::t('app', 'Create At'),
            'update_at' => Yii::t('app', 'Update At'),
            'status' => Yii::t('app', 'Status'),
        ];
    }
}
