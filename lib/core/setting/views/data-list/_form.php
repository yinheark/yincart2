<?php

use kiwi\Kiwi;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model core\setting\models\DataList */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="data-list-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'type')->dropDownList(Kiwi::getDataList()->typeDataList) ?>

    <?= $form->field($model, 'key')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'value')->textInput(['maxlength' => 255]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
