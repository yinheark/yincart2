<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Customer Sellers';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="customer-seller-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Customer Seller', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'user.username:text:用户名',
            'referrer:text:介绍人',
            [
                'attribute' => 'status',
                'label' => '审核状态',
                'value' => function($model){
                        $status = ['未审核','审核通过','审核未通过'];
                        return $status[$model->status];
                    },
            ],

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
