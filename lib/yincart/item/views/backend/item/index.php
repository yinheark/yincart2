<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel yincart\item\searches\ItemSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Items');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="item-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create {modelClass}', [
    'modelClass' => 'Item',
]), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'tableOptions' =>['class' => 'table table-striped table-bordered table-height',],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'item_id',
            'sku',
            'name',
//            'description:ntext',
//            'short_description:ntext',
             'meta_keywords',
//             'meta_description',
             'original_price',
             'price',
             'stock_qty',
             'min_sale_qty',
             'max_sale_qty',
             'weight',
             'shipping_fee',
             'is_free_shipping',
             'pictures',
             'sort',
             'status',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
<style type="text/css">
    .table-height{
        table-layout:fixed;
    }
    .table-height tr td{
        text-overflow:ellipsis; /* for IE */
        -moz-text-overflow: ellipsis; /* for Firefox,mozilla */
        height: 20px;

        overflow:hidden;
        white-space: nowrap;
        border:0px;
        text-align:left
    }
</style>
