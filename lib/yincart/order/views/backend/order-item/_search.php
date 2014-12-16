<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model yincart\order\searches\OrderItemSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="order-item-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'order_item_id') ?>

    <?= $form->field($model, 'order_id') ?>

    <?= $form->field($model, 'item_id') ?>

    <?= $form->field($model, 'price') ?>

    <?= $form->field($model, 'qty') ?>

    <?php // echo $form->field($model, 'name') ?>

    <?php // echo $form->field($model, 'picture') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
