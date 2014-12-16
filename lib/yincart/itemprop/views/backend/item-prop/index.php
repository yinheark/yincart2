<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $category yincart\category\models\Category */

$this->title = Yii::t('app', 'Item Props');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="item-prop-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create {category} {modelClass}', [
            'category' => $category->name,
            'modelClass' => 'Item Prop',
        ]), ['create', 'categoryId' => $category->id], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

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

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
