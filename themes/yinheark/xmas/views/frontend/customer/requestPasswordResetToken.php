<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\PasswordResetRequestForm */

$this->title = '重置密码';
$this->params['breadcrumbs'] = [
    'title' => '更改密码'
];
?>
<div class="site-request-password-reset">
    <h3 class="breadcrumb" style="text-align: center"><?= Html::encode($this->title) ?></h3>

    <p>请填写您的邮箱，一个重置密码的链接将会发到您的邮箱！</p>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'request-password-reset-form']); ?>
            <?= $form->field($model, 'email') ?>
            <div class="form-group">
                <?= Html::submitButton('发送', ['class' => 'btn btn-primary']) ?>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
