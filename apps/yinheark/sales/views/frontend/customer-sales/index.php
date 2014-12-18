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

$this->title = '申请销售列表';
$this->params['breadcrumbs'] = [
    'title' => '申请销售'
];
$level = ['初级销售','中级销售','高级销售'];
?>
<div class="customer-sales-index">

    <h1><?= Html::encode($this->title) ?></h1>

<span>当前销售等级：<?= Html::encode($level[$model->level-1]) ?></span> <br>
<span>积分：<?= Html::encode($model->integral) ?></span><br>
<span>介绍人数：<?= Html::encode($model->reference_no) ?></span>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

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
            [
                'attribute' => 'key',
                'label' => '网址',
                'value' => function($model){
                        if($model->status == 1){
                            $url = Yii::$app->urlManager->createUrl(['item/view','id'=>$model->item->item_id,'key'=>$model->key]);
                            $host = Yii::$app->urlManager->hostInfo;
                            return $host.$url;
                        }
                    },
            ],

        ],
    ]); ?>

</div>