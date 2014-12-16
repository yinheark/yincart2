<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model yincart\shipment\models\Shipment */

$this->title = $model->shipment_id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Shipments'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="shipment-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->shipment_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->shipment_id], [
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
            'shipment_id',
            'order_id',
            'shipment_method',
            'trace_no',
            'create_at',
            'status',
        ],
    ]) ?>

</div>
