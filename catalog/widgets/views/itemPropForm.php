<?php
/**
 * @link http://www.yincart.com/
 * @copyright Copyright (c) 2014 Yincart
 * @license http://www.yincart.com/license/
 */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/** @var array $action */
/** @var \yincart\catalog\models\PropValueModel $propValueModel */
/** @var array $data */

$form = ActiveForm::begin(['id' => 'item-prop-form', 'action' => $action]);
echo Html::activeHiddenInput($propValueModel, 'itemId');
echo $propValueModel->formFields($form);
?>
<div class="space"></div>
<div class="form-group">
    <button class="btn btn-primary btn-action-save">
        <i class="ace-icon fa fa-floppy-o align-top bigger-125"></i>
        <?= Yii::t('yincart', 'Save') ?>
    </button>
</div>
<div class="space"></div>
<?= Html::tag('table', '', ['id' => 'item-sku-table', 'class' => 'table table-striped table-bordered table-hover', 'data' => $data]) ?>
<?php $form->end() ?>