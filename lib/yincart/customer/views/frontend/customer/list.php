<?php
use yii\helpers\Html;
use yii\grid\GridView;
use yii\grid\DataColumn;
/**
 * @author: changhai.lin
 * @Date: 2014/11/30
 * @Time: 14:35
 */
?>
<div class="order-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'total_price',
            'shipping_fee',
            'payment_fee',
             'address',
             'memo',
            [
                'class' => DataColumn::className(),
                'attribute' => 'create_at',
                'value' => function($model){
                        return date('Y-m-d H:i:s',$model->create_at);
                    },
            ],
            [
                'class' => DataColumn::className(),
                'attribute' => 'update_at',
                'value' => function($model){
                        return date('Y-m-d H:i:s',$model->update_at);
                    },
            ],
            // 'status',

            [
                'class' => 'yii\grid\ActionColumn',
                "buttons"   =>
                    [
                        'view' => function ($url,$model){
                                return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', ['customer/order','view_id'=>$model->order_id]);
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