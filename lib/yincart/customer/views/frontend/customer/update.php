<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use mihaildev\elfinder\InputFile;

?>
<div class="customer-update">

    <h1><?= Html::encode($this->title) ?></h1>

<div class="customer-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($customerInfo, 'nick_name')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($customerInfo, 'real_name')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($customerInfo, 'avatars')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($customerInfo, 'phone')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($customerInfo, 'qq')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($customerInfo, 'address')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($customerInfo, 'sex')->textInput() ?>

    <?= $form->field($customerInfo, 'age')->textInput() ?>

    <?= $form->field($customerInfo, 'payment_password')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($customerInfo, 'id_card_no')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($customerInfo, 'id_card_front_pic')->textInput(['maxlength' => 255])?>

    <?= $form->field($customerInfo, 'id_card_back_pic')->textInput(['maxlength' => 255])->widget(InputFile::className(), [
        'template' => '<div class="input-group">{input}<span class="input-group-btn">{button}</span></div>',
        'options' => ['class' => 'form-control'],
        'buttonOptions' => ['class' => 'btn btn-default'],
    ]); ?>

    <div class="form-group">
        <?= Html::submitButton($customerInfo->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $customerInfo->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>


</div>