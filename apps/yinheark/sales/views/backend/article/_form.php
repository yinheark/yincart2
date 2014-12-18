<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use mihaildev\elfinder\InputFile;
use mihaildev\ckeditor\CKEditor;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $model core\cms\models\Cms */
/* @var $form yii\widgets\ActiveForm */

$type = ['fashion'=>'fashion','mv'=>'mv','text'=>'text','article'=>'article','slider'=>'slider'];
?>

<div class="cms-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'key')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'short_d')->textInput() ?>

    <?= $form->field($model, 'content')->widget(CKEditor::className(), ['editorOptions' => ['filebrowserBrowseUrl' => Url::to(['elfinder/manager'])]]);?>

    <?= $form->field($model, 'type')->dropDownList($type) ?>

    <?= $form->field($model, 'author')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'status')->textInput() ?>

    <?= $form->field($model, 'pictures')->widget(InputFile::className(), [
        'multiple' => true,
        'template' => '<div class="input-group">{input}<span class="input-group-btn">{button}</span></div>',
        'options' => ['class' => 'form-control'],
        'buttonOptions' => ['class' => 'btn btn-default'],
//        'callbackFunction' => new JsExpression('function(file, id){}')
    ]); ?>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
