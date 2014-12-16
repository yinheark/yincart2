<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model core\auth\models\AdminModel */
?>

<div class="user-form">

    <?php $form = ActiveForm::begin(['options' => ['class' => 'form-horizontal']]); ?>

    <?= $model->formFields($form); ?>

    <div class="form-group">
        <div class="col-sm-offset-1 col-sm-11">
            <?= Html::submitButton($model->isNewRecord ? Yii::t('app', '添加') : Yii::t('app', '更新'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
