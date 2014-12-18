<?php
use yii\helpers\Html;
use yii\grid\GridView;
/**
 * @author: changhai.lin
 * @Date: 2014/11/30
 * @Time: 14:35
 */

$this->params['breadcrumbs'] = [
    'title' => '我的订单'
];
?>
<div class="order-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'order_id',
            'user_id',
            'total_price',
            'shipping_fee',
            'payment_fee',
            // 'address',
            // 'memo',
            // 'create_at',
            // 'update_at',
            // 'status',

            [
                'class' => 'yii\grid\ActionColumn',
                "buttons"   =>
                    [
                        'view' => function ($url,$model){
                            return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', ['customer/order','order_id'=>$model->order_id]);
                        },
                        'update' => function (){
                            return ;
                        },
                        'delete' => function (){
                            return ;
                        },
                    ]
            ],
        ],
    ]); ?>

</div>