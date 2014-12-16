<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model yincart\shipment\models\Shipment */

$this->title = Yii::t('app', 'Create {modelClass}', [
    'modelClass' => 'Shipment',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Shipments'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="shipment-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
