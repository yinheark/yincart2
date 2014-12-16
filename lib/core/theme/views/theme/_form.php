<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kiwi\Kiwi;

/* @var $this yii\web\View */
/* @var $model core\theme\models\Theme */
/* @var $form yii\widgets\ActiveForm */
$dataList = Kiwi::getDataList();
?>

<div class="theme-form">

    <?php $form = ActiveForm::begin([
        'type' => ActiveForm::TYPE_HORIZONTAL,
        'formConfig' => ['labelSpan' => 1, 'deviceSize' => ActiveForm::SIZE_SMALL]
    ]); ?>

    <?= $form->field($model, 'key')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'thumb')->textInput(['maxlength' => 1023]) ?>

    <?= $form->field($model, 'scope')->dropDownList($dataList->themeScope) ?>

    <?= $form->field($model, 'sort')->textInput() ?>

    <?= $form->field($model, 'is_active')->dropDownList($dataList->boolean) ?>

    <div class="form-group">
        <div class="col-sm-offset-1 col-sm-9">
            <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
