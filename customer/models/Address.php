<?php

namespace yincart\customer\models;

use Yii;
use yincart\base\db\ActiveRecord;
use yincart\Yincart;

/**
 * This is the model class for table "address".
 *
 * @property integer $address_id
 * @property integer $customer_id
 * @property string $country
 * @property string $state
 * @property string $city
 * @property string $area
 * @property string $address
 * @property string $zip_code
 * @property string $phone
 * @property string $mobile
 * @property string $contact_name
 * @property integer $is_default
 *
 * @property Customer $customer
 *
 * @method static Address getAddress(int $id)
 */
class Address extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%address}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['customer_id', 'is_default'], 'integer'],
            [['country', 'state', 'city', 'area', 'address', 'zip_code', 'phone', 'mobile', 'contact_name'], 'required'],
            [['zip_code'], 'string', 'max' => 10],
            [['country', 'state', 'city', 'area', 'address', 'contact_name'], 'string', 'max' => 45],
            [['phone', 'mobile'], 'string', 'max' => 15]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'address_id' => Yii::t('yincart', 'Address ID'),
            'customer_id' => Yii::t('yincart', 'Customer ID'),
            'country' => Yii::t('yincart', 'Country'),
            'state' => Yii::t('yincart', 'State'),
            'city' => Yii::t('yincart', 'City'),
            'area' => Yii::t('yincart', 'Area'),
            'address' => Yii::t('yincart', 'Address'),
            'zip_code' => Yii::t('yincart', 'Zip Code'),
            'phone' => Yii::t('yincart', 'Phone'),
            'mobile' => Yii::t('yincart', 'Mobile'),
            'contact_name' => Yii::t('yincart', 'Contact Name'),
            'is_default' => Yii::t('yincart', 'Is Default'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomer()
    {
        return $this->hasOne(Yincart::$container->customerClass, ['customer_id' => 'customer_id']);
    }
}
