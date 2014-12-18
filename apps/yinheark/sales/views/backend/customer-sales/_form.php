<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model extensions\sales\models\CustomerSales */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="customer-sales-form">

    <?php $form = ActiveForm::begin(); ?>

<?php
    $status = ['未审核','审核通过','审核未通过'];
?>
    <?= $form->field($model->user, 'username')->textInput(['disabled'=>TRUE]) ?>

    <?= $form->field($model->item, 'name')->textInput(['disabled'=>TRUE]) ?>

    <?= $form->field($model, 'status')->dropDownList($status) ?>

    <?= $form->field($model, 'price')->textInput(['disabled'=>TRUE]) ?>

    <?= $form->field($model, 'sale_price')->textInput() ?>

    <?= $form->field($model, 'memo')->textarea(['maxlength' => 255]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
