<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model yincart\item\models\Item */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Items'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="item-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->item_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->item_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'item_id',
            'sku',
            'name',
            'description:ntext',
            'short_description:ntext',
            'meta_keywords',
            'meta_description',
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
        ],
    ]) ?>

</div>
