<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use mihaildev\ckeditor\CKEditor;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model core\cms\models\Cms */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cms-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'key')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'content')->widget(CKEditor::className(), ['editorOptions' => ['filebrowserBrowseUrl' => Url::to(['elfinder/manager'])]]);?>

    <?= $form->field($model, 'type')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'author')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'status')->textInput() ?>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
