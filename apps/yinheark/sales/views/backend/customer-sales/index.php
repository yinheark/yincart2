<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Customer Sales';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="customer-sales-index">

    <h1><?= Html::encode($this->title) ?></h1>

    
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'user.username:text:用户名',
            'item.name:text:商品名称',
            [
                'attribute' => 'status',
                'label' => '审核状态',
                'value' => function($model){
                        $status = ['未审核','审核通过','审核未通过'];
                        return $status[$model->status];
                    },
            ],
            'price:text:原始价格',
             'sale_price:text:销售价格',
             'memo:text:备注',
             'key',

            [
                'class' => 'yii\grid\ActionColumn',
                "buttons"   =>
                    [
                        'delete'=>function(){}
                    ]
            ],
        ],
    ]); ?>

</div>
