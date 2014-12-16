<?php

namespace yincart\customer\models;

use Yii;

/**
 * This is the model class for table "{{%customer_info}}".
 *
 * @property integer $user_id
 * @property string $nick_name
 * @property string $real_name
 * @property string $avatars
 * @property string $phone
 * @property string $qq
 * @property string $address
 * @property integer $sex
 * @property integer $age
 * @property string $payment_password
 * @property string $id_card_no
 * @property string $id_card_front_pic
 * @property string $id_card_back_pic
 */
class CustomerInfo extends \kiwi\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%customer_info}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id'], 'required'],
            [['user_id', 'sex', 'age'], 'integer'],
            [['nick_name', 'real_name', 'avatars', 'phone', 'qq', 'address', 'payment_password', 'id_card_no', 'id_card_front_pic', 'id_card_back_pic'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'user_id' => Yii::t('app', 'User ID'),
            'nick_name' => Yii::t('app', 'Nick Name'),
            'real_name' => Yii::t('app', 'Real Name'),
            'avatars' => Yii::t('app', 'Avatars'),
            'phone' => Yii::t('app', 'Phone'),
            'qq' => Yii::t('app', 'Qq'),
            'address' => Yii::t('app', 'Address'),
            'sex' => Yii::t('app', 'Sex'),
            'age' => Yii::t('app', 'Age'),
            'payment_password' => Yii::t('app', 'Payment Password'),
            'id_card_no' => Yii::t('app', 'Id Card No'),
            'id_card_front_pic' => Yii::t('app', 'Id Card Front Pic'),
            'id_card_back_pic' => Yii::t('app', 'Id Card Back Pic'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomer()
    {
        return $this->hasOne(Kiwi::getCustomerClass(), ['user_id' => 'user_id']);
    }
}
