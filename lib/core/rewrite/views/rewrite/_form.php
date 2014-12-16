<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model core\rewrite\models\UrlRewrite */
/* @var $form yii\widgets\ActiveForm */

$template = "{label}\n<div class=\"col-sm-10\">{input}\n{hint}\n{error}</div>";
$labelOptions = ['class' => 'control-label col-sm-2'];
$options = ['template' => $template, 'labelOptions' => $labelOptions];
?>

<div class="url-rewrite-form">

    <?php $form = ActiveForm::begin(['options' => ['class' => 'form-horizontal']]); ?>

    <?= $form->field($model, 'request_path', $options)->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'route', $options)->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'params', $options)->textInput(['maxlength' => 255]) ?>

    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
