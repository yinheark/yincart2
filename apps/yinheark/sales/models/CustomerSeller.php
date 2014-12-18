<?php

namespace extensions\sales\models;

use Yii;
use kiwi\Kiwi;
use yii\db\Exception;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "customer_seller".
 *
 * @property integer $customer_id
 * @property string $money
 * @property string $pin_password
 * @property string $referrer
 * @property string $status
 * @property integer integral
 * @property integer reference_no
 * @property integer level
 */
class CustomerSeller extends \kiwi\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'customer_seller';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['customer_id', 'money', 'pin_password', 'referrer'], 'required'],
            [['customer_id', 'status','reference_no','level'], 'integer'],
            [['referrer'],'exist','targetClass'=> Kiwi::getCustomer(),'targetAttribute'=>'username', 'filter' => function($query) {
                    /** @var $query \yii\db\ActiveQuery */
                    $query->innerJoinWith('customerSeller');
                }],
            [['money', 'integral'], 'number'],
            [['pin_password', 'referrer'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'customer_id' => Yii::t('app', 'Customer ID'),
            'money' => Yii::t('app', 'Money'),
            'pin_password' => Yii::t('app', 'Pin Password'),
            'referrer' => Yii::t('app', 'Referrer'),
            'status' => Yii::t('app', 'Status'),
        ];
    }

    public function getUser(){
        return $this->hasOne(Kiwi::getcustomer(),['id'=>'customer_id']);
    }

    public function init()
    {
        parent::init();
        $this->customer_id = Yii::$app->user->id;
        $this->money = $this->status = $this->integral = $this->reference_no = 0;
        $this->level = 1;

        $this->attachEvents();
    }

    /**
     * update seller's Integral when order is create
     * @author Cangzhou.Wu(wucangzhou@gmail.com)
     * @param $event
     * @throws \yii\db\Exception
     */
    public static  function updateSeller($event){
        /** @var \yincart\order\models\Order $order */
        $order = $event->sender;
        foreach($order->orderItems as $orderItem){
            if(!empty($orderItem->data['key'])){
                $sellerModel = Kiwi::getCustomerSeller();
                $key = $orderItem->data['key'];
                $item = Kiwi::getCustomerSales()->findOne(['item_id'=>$orderItem->item_id,'key'=>$key]);
                $profit = ($item->sale_price - $item->price) * $orderItem->qty;
                $seller = $sellerModel->findOne(['customer_id'=>$item->user_id]);
                $seller->integral =($seller->integral + $profit * (0.35 + 0.05 * ($seller->level -1)));
                $seller->level = $sellerModel::updateLevel($seller->integral,$seller->reference_no);
                if(!$seller->save()){
                    throw new Exception('update Integral fail', $seller->getErrors());
                }

                $customer = Kiwi::getCustomer()->findOne(['username'=>$seller->referrer]);
                $oldSeller = Kiwi::getCustomerSeller()->findOne(['customer_id'=>$customer->id]);
                $oldSeller->integral = ($oldSeller->integral + $profit * 0.05) ;
                $oldSeller->level = $sellerModel::updateLevel($seller->integral,$seller->reference_no);
                if(!$oldSeller->save()){
                    throw new Exception('update old seller Integral fail',$oldSeller->getErrors());
                }
            }
        }
    }

    /**
     * update seller's level when order is create
     * @author Cangzhou.Wu(wucangzhou@gmail.com)
     * @param $integral
     * @param $reference_no
     * @return int
     */
    public function updateLevel($integral,$reference_no){
        if($integral>=300000 && $reference_no>=500){
            if($integral>=1500000 && $reference_no>=2000){
                return 3;
            }
            return 2;
        }
        return 1;
    }

    public function attachEvents()
    {
        $this->on(static::EVENT_AFTER_INSERT, [$this, 'updateReferenceNo']);
    }

    /**
     * update seller's reference number
     * @author Cangzhou.Wu(wucangzhou@gmail.com)
     * @throws \yii\db\Exception
     */
    public function updateReferenceNo(){
        $referrer = $this->referrer;
        $customer = Kiwi::getCustomer()->findOne(['username'=>$referrer]);
        $seller = Kiwi::getCustomerSeller()->findOne(['customer_id'=>$customer->id]);
        $seller->reference_no = $seller->reference_no + 1;
        if(!$seller->save()){
            throw new Exception('update ReferenceNo fail', $seller->getErrors());
        }
    }

    public function getSelesCount()
    {
        $sales = Kiwi::getCustomerSales()->find()->where(['user_id' => $this->customer_id])->all();
        $saleKeys = ArrayHelper::getColumn($sales, 'key');
        return Kiwi::getDealLog()->find()->innerJoinWith('orderItem')->where(['key' => $saleKeys])->count('order_item.qty');
    }

    public function getMonthSelesCount()
    {
        $sales = Kiwi::getCustomerSales()->find()->where(['user_id' => $this->customer_id])->all();
        $saleKeys = ArrayHelper::getColumn($sales, 'key');
        return Kiwi::getDealLog()->find()->innerJoinWith(['orderItem', 'order'])->where(['key' => $saleKeys])->andWhere('order.create_at > ' . strtotime('- 1 month'))->count('order_item.qty');
    }
}
