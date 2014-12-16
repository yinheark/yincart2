<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model yincart\item\searches\ItemSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="item-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'item_id') ?>

    <?= $form->field($model, 'sku') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'description') ?>

    <?= $form->field($model, 'short_description') ?>

    <?php // echo $form->field($model, 'meta_keywords') ?>

    <?php // echo $form->field($model, 'meta_description') ?>

    <?php // echo $form->field($model, 'original_price') ?>

    <?php // echo $form->field($model, 'price') ?>

    <?php // echo $form->field($model, 'stock_qty') ?>

    <?php // echo $form->field($model, 'min_sale_qty') ?>

    <?php // echo $form->field($model, 'max_sale_qty') ?>

    <?php // echo $form->field($model, 'weight') ?>

    <?php // echo $form->field($model, 'shipping_fee') ?>

    <?php // echo $form->field($model, 'is_free_shipping') ?>

    <?php // echo $form->field($model, 'pictures') ?>

    <?php // echo $form->field($model, 'sort') ?>

    <?php // echo $form->field($model, 'status') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
