<?php
/**
 * @link http://www.yincart.com/
 * @copyright Copyright (c) 2014 Yincart
 * @license http://www.yincart.com/license/
 */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yincart\Yincart;

/** @var \yincart\catalog\models\Category $model */
/** @var array $action */
/** @var array $data */

$galleryClass = Yincart::$container->galleryClass;
?>

<?php $form = ActiveForm::begin(['id' => 'category-form', 'action' => $action, 'options' => ['data' => $data]]); ?>
<?= Html::activeHiddenInput($model, 'category_id') ?>
<?= $form->field($model, 'name') ?>
<?= $form->field($model, 'url_key') ?>
<?php
echo Html::hiddenInput('Category[image]');
$field = $form->field($model, 'image');
$field->parts['{input}'] = $galleryClass::widget(['inputName' => 'Category[image]', 'tagData' => ['is-one' => true]]);
echo $field;
?>
<?= $form->field($model, 'meta_keywords') ?>
<?= $form->field($model, 'meta_description') ?>
<?= $form->field($model, 'sort') ?>
<?= $form->field($model, 'is_navigation_menu')->checkbox() ?>
<?= $form->field($model, 'is_inherit')->checkbox() ?>
<?= $form->field($model, 'status')->checkbox() ?>
<div class="form-group">
    <?= Html::submitButton(Yii::t('yincart', 'Save'), ['class' => 'btn btn-primary', 'id' => 'category-save-button']) ?>
    <?= Html::resetButton(Yii::t('yincart', 'New'), ['class' => 'btn btn-success', 'id' => 'category-new-button']) ?>
    <?= Html::button(Yii::t('yincart', 'Delete'), ['type' => 'button', 'class' => 'btn btn-danger', 'id' => 'category-delete-button']) ?>
</div>
<?php $form->end() ?>