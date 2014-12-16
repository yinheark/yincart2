<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model yincart\refund\models\Refund */

$this->title = Yii::t('app', 'Create {modelClass}', [
    'modelClass' => 'Refund',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Refunds'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="refund-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
