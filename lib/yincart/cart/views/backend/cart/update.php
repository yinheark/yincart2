<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model yincart\cart\models\Cart */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Cart',
]) . ' ' . $model->cart_id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Carts'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->cart_id, 'url' => ['view', 'id' => $model->cart_id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="cart-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
