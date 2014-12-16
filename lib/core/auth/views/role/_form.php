<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model core\auth\models\RoleModel */
/* @var $form yii\bootstrap\ActiveForm */
?>

<div class="role-form">
    <?php
    $template = "{label}\n<div class=\"col-sm-11\">{input}\n{hint}\n{error}</div>";
    $labelOptions = ['class' => 'control-label col-sm-1'];
    $options = ['template' => $template, 'labelOptions' => $labelOptions];

    $form = ActiveForm::begin(['options' => ['class' => 'form-horizontal']]);
    echo $form->field($model, 'description', $options);
    echo Html::tag('div', '', ['class' => 'clearfix']);
    $groups = $model->formFields($form, $options);
    ?>
    <div class="form-group">
        <label class="col-sm-1 control-label"><?= Yii::t('app', '权限列表') ?></label>

        <div class="col-sm-11">
            <?php
            foreach ($groups as $key => $labelContent) {
                ?>
                <div class="panel panel-default">
                    <div class="panel-heading"><?= $labelContent['label'] ?></div>
                    <div class="panel-body">
                        <?= $labelContent['content'] ?>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-1 col-sm-11">
            <?= Html::submitButton($model->isNewRecord ? Yii::t('app', '添加') : Yii::t('app', '更新'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
    </div>
    <?php $form->end(); ?>
</div>
