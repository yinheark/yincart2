<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use mihaildev\ckeditor\CKEditor;
use mihaildev\elfinder\InputFile;
use yii\web\JsExpression;
use yii\bootstrap\Tabs;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model yincart\item\models\Item */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="item-form">

    <?php $form = ActiveForm::begin();
    $fieldGroups = [];
    $fields = [];
    $fields[] = $form->field($model, 'sku')->textInput(['maxlength' => 255]);
    $fields[] = $form->field($model, 'name')->textInput(['maxlength' => 255]);
    $fields[] = $form->field($model, 'description')->widget(CKEditor::className(), ['editorOptions' => ['filebrowserBrowseUrl' => Url::to(['elfinder/manager'])]]);
    $fields[] = $form->field($model, 'short_description')->widget(CKEditor::className(), ['editorOptions' => ['filebrowserBrowseUrl' => Url::to(['elfinder/manager'])]]);
    $fields[] = $form->field($model, 'meta_description')->textarea(['rows' => 6]);
    $fields[] = $form->field($model, 'meta_keywords')->textInput(['maxlength' => 255]);
    $fields[] = $form->field($model, 'sort')->textInput();
    $fields[] = $form->field($model, 'status')->checkbox();
    $fieldGroups[] = ['label' => 'Base Info', 'content' => implode('', $fields)];

    $fields = [];
    $fields[] = $form->field($model, 'original_price')->textInput(['maxlength' => 10]);
    $fields[] = $form->field($model, 'price')->textInput(['maxlength' => 10]);
    $fields[] = $form->field($model, 'stock_qty')->textInput();
    $fields[] = $form->field($model, 'min_sale_qty')->textInput();
    $fields[] = $form->field($model, 'max_sale_qty')->textInput();
    $fields[] = $form->field($model, 'weight')->textInput(['maxlength' => 10]);
    $fields[] = $form->field($model, 'shipping_fee')->textInput(['maxlength' => 10]);
    $fields[] = $form->field($model, 'is_free_shipping')->checkbox();
    $fieldGroups[] = ['label' => 'Price & Stock', 'content' => implode('', $fields)];

    $fields = [];
    $fields[] = $form->field($model, 'pictures')->widget(InputFile::className(), [
        'multiple' => true,
        'template' => '<div class="input-group">{input}<span class="input-group-btn">{button}</span></div>',
        'options' => ['class' => 'form-control'],
        'buttonOptions' => ['class' => 'btn btn-default'],
//        'callbackFunction' => new JsExpression('function(file, id){}')
    ]);

    $categories = \kiwi\Kiwi::getCategory()->find()->all();
    $categories = ArrayHelper::map($categories, 'id', 'name');
    $fields[] = $form->field($model, 'categoryIds')->widget(Select2::classname(), [
        'data' => $categories,
        'language' => 'en',
        'options' => ['placeholder' => 'Select a state ...'],
        'options' => [
            'multiple' => true,
        ],
    ]);

    $tags = \kiwi\Kiwi::getTag()->find()->all();
    $tags = ArrayHelper::map($tags, 'id', 'name');
    $fields[] = $form->field($model, 'tagIds')->widget(Select2::classname(), [
        'data' => $tags,
        'language' => 'en',
        'options' => ['placeholder' => 'Select a state ...'],
        'options' => [
            'multiple' => true,
        ],
    ]);

    $fieldGroups[] = ['label' => 'Picture & Category & Tag', 'content' => implode('', $fields)];

    echo Tabs::widget(['items' => $fieldGroups]);
    ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
