<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model yincart\payment\models\Payment */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Payment',
]) . ' ' . $model->payment_id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Payments'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->payment_id, 'url' => ['view', 'id' => $model->payment_id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="payment-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
