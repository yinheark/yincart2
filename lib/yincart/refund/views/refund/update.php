<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model yincart\refund\models\Refund */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Refund',
]) . ' ' . $model->refund_id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Refunds'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->refund_id, 'url' => ['view', 'id' => $model->refund_id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="refund-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
