<?php

namespace extensions\sales\models;

use Yii;

/**
 * This is the model class for table "seller_money_log".
 *
 * @property integer $seller_money_log_id
 * @property string $money
 * @property string $type
 * @property string $info
 * @property string $created_at
 */
class SellerMoneyLog extends \kiwi\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'seller_money_log';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['seller_money_log_id'], 'integer'],
            [['money', 'type', 'info', 'created_at'], 'required'],
            [['money'], 'number'],
            [['type', 'info', 'created_at'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'seller_money_log_id' => Yii::t('app', 'Seller Money Log ID'),
            'money' => Yii::t('app', 'Money'),
            'type' => Yii::t('app', 'Type'),
            'info' => Yii::t('app', 'Info'),
            'created_at' => Yii::t('app', 'Created At'),
        ];
    }
}
