<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\bootstrap\Tabs;
use mihaildev\elfinder\InputFile;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model yincart\customer\models\Customer */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="customer-form">

    <?php $form = ActiveForm::begin();
//    print_r($model->getErrors());
    $fieldGroups = [];
    $fields = [];
    $fields[] = $form->field($model, 'username')->textInput(['maxlength' => 255]);
    $fields[] = $form->field($model, 'email')->textInput(['maxlength' => 255]);
//    $fields[] = $form->field($model, 'password')->passwordInput(['maxlength' => 255]);
    $fields[] = $form->field($model, 'status')->checkbox();
    $fieldGroups[] = ['label' => 'User Info', 'content' => implode('', $fields)];

    $fields = [];
    $customerInfo = $model->customerInfo ?: \kiwi\Kiwi::getCustomerInfo();
    $fields[] = $form->field($customerInfo, 'nick_name')->textInput(['maxlength' => 255]);
    $fields[] = $form->field($customerInfo, 'real_name')->textInput(['maxlength' => 255]);
    $fields[] = $form->field($customerInfo, 'avatars')->textInput(['maxlength' => 255]);
    $fields[] = $form->field($customerInfo, 'phone')->textInput(['maxlength' => 255]);
    $fields[] = $form->field($customerInfo, 'qq')->textInput(['maxlength' => 255]);
    $fields[] = $form->field($customerInfo, 'address')->textInput(['maxlength' => 255]);
    $fields[] = $form->field($customerInfo, 'sex')->textInput();
    $fields[] = $form->field($customerInfo, 'age')->textInput();
//    $fields[] = $form->field($customerInfo, 'payment_password')->textInput(['maxlength' => 255]);
    $fields[] = $form->field($customerInfo, 'id_card_no')->textInput(['maxlength' => 255]);
    $fields[] = $form->field($customerInfo, 'id_card_front_pic')->widget(InputFile::className(), [
        'template' => '<div class="input-group">{input}<span class="input-group-btn">{button}</span></div>',
        'options' => ['class' => 'form-control'],
        'buttonOptions' => ['class' => 'btn btn-default'],
    ]);
    $fields[] = $form->field($customerInfo, 'id_card_back_pic')->widget(InputFile::className(), [
        'template' => '<div class="input-group">{input}<span class="input-group-btn">{button}</span></div>',
        'options' => ['class' => 'form-control'],
        'buttonOptions' => ['class' => 'btn btn-default'],
    ]);
    $fieldGroups[] = ['label' => 'Customer Info', 'content' => implode('', $fields)];

    $fields = [];
    $groups = \kiwi\Kiwi::getGroup()->find()->all();
    $groups = ArrayHelper::map($groups, 'id', 'name');
    $fields[] = $form->field($model, 'groups')->widget(Select2::classname(), [
        'data' => $groups,
        'language' => 'en',
        'options' => ['placeholder' => 'Select a state ...'],
        'options' => [
//            'multiple' => true,
        ],
    ]);
    $fieldGroups[] = ['label' => 'Customer Group', 'content' => implode('', $fields)];

    echo Tabs::widget(['items' => $fieldGroups]);
    ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
