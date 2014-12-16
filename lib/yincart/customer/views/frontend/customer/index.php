<?php
/**
 * @author: changhai.lin
 * @Date: 2014/11/22
 * @Time: 16:01
 */

use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $customer \yincart\customer\models\CustomerInfo */
$this->title = $customer->username;
$customerInfo = $customer->customerInfo ?: \kiwi\Kiwi::getCustomerInfo();
?>
<div>
    <h3><?= $customer->nick_name ?></h3>
    <?= Html::hiddenInput('user_id', $customerInfo->user_id) ?>
    <?= Html::label(Yii::t('app', 'Phone')); ?>
    <?= Html::tag('phone', $customerInfo->phone)?><br>
    <?= Html::label(Yii::t('app', 'QQ')); ?>
    <?= Html::tag('qq', $customerInfo->qq)?><br>
    <?= Html::label(Yii::t('app', 'Sex')); ?>
    <?= Html::tag('sex', $customerInfo->sex)?><br>
    <?= Html::label(Yii::t('app', 'Age')); ?>
    <?= Html::tag('age', $customerInfo->age)?><br>
    <?= Html::label(Yii::t('app', 'Address')); ?>
    <?= Html::tag('address', $customerInfo->address)?>

    <?= Html::a(Yii::t('app', 'Change Profile'),Url::to(['customer/update']))?><br>
    <?= Html::a(Yii::t('app', 'Reset Password'),Url::to(['customer/request-password-reset']))?><br>
    <?= Html::a(Yii::t('app', 'Add Delivery Address'),Url::to(['customer/add-delivery-address']))?><br>
</div>