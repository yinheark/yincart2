<?php

namespace yincart\customer\models;

use Yii;
use kiwi\Kiwi;
/**
 * This is the model class for table "customer_address".
 *
 * @property integer $customer_address_id
 * @property integer $user_id
 * @property string $province
 * @property string $city
 * @property string $district
 * @property string $address
 * @property string $zip_code
 * @property string $phone
 * @property string $name
 * @property integer $is_default
 *
 * @property \core\area\models\Area $provinceArea
 * @property \core\area\models\Area $cityArea
 * @property \core\area\models\Area $districtArea
 */
class CustomerAddress extends \kiwi\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'customer_address';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'is_default'], 'integer'],
            [['province', 'city', 'district', 'address', 'zip_code', 'phone', 'name'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'customer_address_id' => Yii::t('app', 'Customer Address ID'),
            'user_id' => Yii::t('app', 'User ID'),
            'province' => Yii::t('app', 'Province'),
            'city' => Yii::t('app', 'City'),
            'district' => Yii::t('app', 'District'),
            'address' => Yii::t('app', 'Address'),
            'zip_code' => Yii::t('app', 'Zip Code'),
            'phone' => Yii::t('app', 'Phone'),
            'name' => Yii::t('app', 'Name'),
            'is_default' => Yii::t('app', 'Is Default'),
        ];
    }
    public function getProvinceArea(){
        return $this->hasOne(Kiwi::getAreaClass(),['area_id'=>'province']);
    }
    public function getCityArea(){
        return $this->hasOne(Kiwi::getAreaClass(),['area_id'=>'city']);
    }
    public function getDistrictArea(){
        return $this->hasOne(Kiwi::getAreaClass(),['area_id'=>'district']);
    }

    public static function getAddressList()
    {
        /** @var \yincart\customer\models\Customer $customer */
        $customer = Yii::$app->user->identity;
        $addressList = array_map(function($address) {
            /** @var \yincart\customer\models\CustomerAddress $address */
            $addressInfo = [$address->provinceArea->name . $address->cityArea->name . $address->districtArea->name . $address->address,
                $address->zip_code, $address->name, $address->phone];
            $addressInfo = implode(' ', $addressInfo);
            return $addressInfo;
        }, $customer->customerAddresses);
        $defaultAddress = array_filter($customer->customerAddresses, function($address) {
            /** @var \yincart\customer\models\CustomerAddress $address */
            return $address->is_default;
        });
        if(!empty($defaultAddress)){
            $defaultKey = array_keys($defaultAddress)[0];
            $defaultAddress = $addressList[$defaultKey];
        }


        return [array_combine($addressList, $addressList), $defaultAddress];
    }
}
