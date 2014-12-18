<?php
/**
 * @link http://www.yincart.com/
 * @copyright Copyright (c) 2014 Yincart
 * @license http://www.yincart.com/license/
 */

namespace extensions\sales\controllers\frontend;


use kiwi\Kiwi;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;

class CustomerController extends \yincart\customer\controllers\frontend\CustomerController
{
    public $layout = "customer";

    public function actionIntegral()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Kiwi::getDealLog()->find()->innerJoinWith('customerSales')->where(['customer_sales.user_id' => \Yii::$app->user->id])
        ]);

        /** @var \yincart\customer\models\Customer $customer */
        $customer = \Yii::$app->user->identity;
        $customerSellers = Kiwi::getCustomerSeller()->find()->where(['referrer' => $customer->username])->all();
        $sellerIds = ArrayHelper::getColumn($customerSellers, 'customer_id');
        $referrerProvider = new ActiveDataProvider([
            'query' => Kiwi::getDealLog()->find()->innerJoinWith('customerSales')->where(['customer_sales.user_id' => $sellerIds])
        ]);

        return $this->render('integral', ['dataProvider' => $dataProvider, 'referrerProvider' => $referrerProvider]);
    }
} 