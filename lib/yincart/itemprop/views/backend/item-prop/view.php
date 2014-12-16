<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model yincart\itemprop\models\ItemProp */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Item Props'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="item-prop-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->item_prop_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->item_prop_id], [
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
            'item_prop_id',
            'category_id',
            'name',
            'type',
            'is_key',
            'is_sale',
            'is_color',
            'is_search',
            'is_must',
            'sort',
            'status',
        ],
    ]) ?>

</div>
