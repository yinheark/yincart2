<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $itemProp \yincart\itemprop\models\ItemProp */

$this->title = Yii::t('app', 'Prop Values');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="prop-value-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create {modelClass}', [
            'modelClass' => 'Prop Value',
        ]), ['prop-value/create', 'itemPropId' => $itemProp->item_prop_id], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'prop_value_id',
            'item_prop_id',
            'name',
            'sort',
            'status',

            ['class' => 'yii\grid\ActionColumn', 'controller' => 'prop-value'],
        ],
    ]); ?>

</div>
