<?php
use yii\helpers\Html;
use yii\helpers\Url;

/** @var \yincart\customer\models\CustomerInfo $customer */

$customerInfo = $customer->customerInfo ?: \kiwi\Kiwi::getCustomerInfo();
$this->params['breadcrumbs'] = [
    'title' => '个人信息'
];
?>
<h3 style="margin-left:220px"><?php echo Yii::t('app','Your profile'); ?></h3>

<table class="table table-bordered personal-info" >
    <tr>
        <th class="col-xs-4"><?php echo Html::encode($customer->getAttributeLabel('username')); ?></th>
        <td class="col-xs-8"><?php echo Html::encode($customer->username); ?></td>
    </tr>
    <tr>
        <th class="col-xs-4"><?php echo Html::encode($customer->getAttributeLabel('email')); ?></th>
        <td class="col-xs-8"><?php echo Html::encode($customer->email); ?></td>
    </tr>
    <tr>
        <th class="col-xs-4"><?php echo Html::encode($customerInfo->getAttributeLabel('phone')); ?></th>
        <td class="col-xs-8"><?php echo $customerInfo->phone; ?></td>
    </tr>
    <tr>
        <th class="col-xs-4"><?php echo Html::encode($customerInfo->getAttributeLabel('id_card_no')); ?></th>
        <td class="col-xs-8"><?php echo Html::encode($customerInfo->id_card_no); ?></td>
    </tr>
    <tr>
        <td class="col-xs-12" colspan="2" style="text-align: center;border:1px solid white;">
            <?= Html::a(Yii::t('app', 'Change Profile'),Url::to(['customer/update']),['class'=>'btn btn-primary'])?>
        </td>
    </tr>
</table>