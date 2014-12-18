<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\grid\DataColumn;
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '页面管理';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cms-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', '创建 ', [
            'modelClass' => $modelClass,
        ]), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'cms_id',
            'key',
            'name',
            'short_d',
            'type',
            'author',
            'status',
           [
              'class' => DataColumn::className(),
              'attribute' => 'created_at',
               'value' => function($model){
                       return date('Y-m-d H:i:s',$model->created_at);
                   },
           ],
            [
                'class' => DataColumn::className(),
                'attribute' => 'updated_at',
                'value' => function($model){
                        return date('Y-m-d H:i:s',$model->updated_at);
                    },
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
