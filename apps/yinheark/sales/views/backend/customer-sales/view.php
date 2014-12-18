<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model extensions\sales\models\CustomerSales */

$this->title = $model->customer_sales_id;
$this->params['breadcrumbs'][] = ['label' => 'Customer Sales', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$status = ['未审核','审核通过','审核未通过'];
?>
<div class="customer-sales-view">

    <h1><?= Html::encode($this->title) ?></h1>


    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [

            [
                'label'=>'用户名',
                'attribute'=>'user.username',
            ],
            [
                'label'=>'商品名称',
                'attribute'=>'item.name',
            ],
            [
                'label'=>'审核状态',
                'value'=> $status[$model->status],
            ],
            [
                'label'=>'原始价格',
                'attribute'=>'price',
            ],
            [
                'label'=>'销售价格',
                'attribute'=>'sale_price',
            ],
            [
                'label'=>'备注',
                'attribute'=>'memo',
            ],
            'key',
        ],
    ]) ?>

</div>
