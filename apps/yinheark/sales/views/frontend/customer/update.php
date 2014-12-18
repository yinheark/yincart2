<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use mihaildev\elfinder\InputFile;

?>
<div class="customer-update">

    <h1><?= Html::encode($this->title) ?></h1>

<div class="customer-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($customerInfo, 'phone')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($customerInfo, 'payment_password')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($customerInfo, 'id_card_no')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($customerInfo, 'id_card_front_pic')->fileInput() ?>

    <?= $form->field($customerInfo, 'id_card_back_pic')->fileInput() ?>

    <div class="form-group">
        <?= Html::submitButton($customerInfo->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $customerInfo->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>


</div>