<?php

namespace extensions\sales\models;

use kiwi\Kiwi;
use Yii;


/**
 * This is the model class for table "customer_sales".
 *
 * @property integer $customer_sales_id
 * @property integer $user_id
 * @property integer $item_id
 * @property integer $status
 * @property integer $price
 * @property integer $sale_price
 * @property string $memo
 * @property string $key
 *
 * @property \yincart\Item\models\Item $item
 * @property \yincart\customer\models\Customer $customer
 */
class CustomerSales extends \kiwi\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'customer_sales';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'item_id', 'status'], 'integer'],
            [['price', 'sale_price'],'number'],
            ['sale_price', 'number', 'min' => $this->price, 'max' => $this->item->price],
            [['memo'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'customer_sales_id' => Yii::t('app', 'Customer Sales ID'),
            'user_id' => Yii::t('app', 'User ID'),
            'item_id' => Yii::t('app', 'Item ID'),
            'status' => Yii::t('app', 'Status'),
            'price' => Yii::t('app', 'Price'),
            'sale_price' => Yii::t('app', 'Sale Price'),
            'memo' => Yii::t('app', 'Memo'),
            'key' => Yii::t('app', 'Key'),
            'integral' => Yii::t('app', 'integral'),
            'reference_no' => Yii::t('app', 'reference_no'),
            'level' => Yii::t('app', 'level'),
        ];
    }

    public function getUser(){
        return $this->hasOne(Kiwi::getcustomer(),['id'=>'user_id']);
    }

    public function getCustomer(){
        return $this->hasOne(Kiwi::getcustomer(),['id'=>'user_id']);
    }

    public function getItem(){
        return $this->hasOne(Kiwi::getItem(),['item_id'=>'item_id']);
    }

    public function init()
    {
        parent::init();
        $this->key = Yii::$app->security->generateRandomString();
    }


    public function validateLevel(){

    }
}
