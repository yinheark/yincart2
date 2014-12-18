<?php
/**
 * @author Cangzhou Wu<wucang.zhou@jago-ag.cn>
 * @Date: 14-11-28
 * @Time: 下午3:19
 */
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $referrerProvider yii\data\ActiveDataProvider */

$this->title = '我的积分';
$this->params['breadcrumbs'] = [
    'title' => '我的积分'
];
/** @var \yincart\customer\models\Customer $customer */
$customer = Yii::$app->user->identity;
/** @var \extensions\sales\models\CustomerSeller $customerSeller */
$customerSeller = $customer->customerSeller;

?>
<div class="customer-sales-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <h2>当前积分：<?= $customerSeller->integral ?></h2> <br>

    <h3>我的销售积分</h3>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'item.name:text:商品名称',
            'customerSales.price:text:原始价格(元)',
            'sale_price:text:销售价格(元)',
            ['attribute' => 'percent', 'value' => function($model) { return $model->percent . '%'; }],
            ['label' => '提成(元)', 'value' => function($model) {
                return ($model->sale_price - $model->customerSales->price) * $model->percent / 100;
            }]

        ],
    ]); ?>

    <h3>下家销售积分</h3>
    <?= GridView::widget([
        'dataProvider' => $referrerProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'item.name:text:商品名称',
            'customerSales.customer.username',
            'customerSales.price:text:原始价格(元)',
            'sale_price:text:销售价格(元)',
            ['attribute' => 'percent', 'value' => function() { return 5 . '%'; }],
            ['label' => '提成(元)', 'value' => function($model) {
                return ($model->sale_price - $model->customerSales->price) * 5 / 100;
            }]
        ],
    ]); ?>

</div>