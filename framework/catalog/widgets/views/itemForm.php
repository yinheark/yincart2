<?php
/**
 * @link http://www.yincart.com/
 * @copyright Copyright (c) 2014 Yincart
 * @license http://www.yincart.com/license/
 */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
use yincart\Yincart;

/** @var \yincart\catalog\models\Item $model */
/** @var array $action */
/** @var array $data */

$categoryTreeClass = Yincart::$container->categoryTreeClass;
$galleryClass = Yincart::$container->galleryClass;
?>

<?php $form = ActiveForm::begin(['id' => 'item-form', 'action' => $action, 'options' => ['data' => $data]]) ?>
<?= Html::activeHiddenInput($model, 'item_id') ?>
<div class="tabbable">
    <ul class="nav nav-tabs" id="">
        <li class="active">
            <a data-toggle="tab" href="#general">
                <i class="blue ace-icon fa fa-tachometer bigger-110"></i>
                <?= Yii::t('yincart', 'General') ?>
            </a>
        </li>
        <li class="">
            <a data-toggle="tab" href="#price">
                <i class="orange ace-icon fa fa-dollar bigger-110"></i>
                <?= Yii::t('yincart', 'Price') ?>
            </a>
        </li>
        <li class="">
            <a data-toggle="tab" href="#inventory">
                <i class="green ace-icon fa fa-gift bigger-110"></i>
                <?= Yii::t('yincart', 'Inventory') ?>
            </a>
        </li>
        <li class="">
            <a data-toggle="tab" href="#category">
                <i class="pink ace-icon fa fa-book bigger-110"></i>
                <?= Yii::t('yincart', 'Category') ?>
            </a>
        </li>
        <li class="">
            <a data-toggle="tab" href="#more-info">
                <i class="ace-icon fa fa-rocket bigger-110"></i>
                <?= Yii::t('yincart', 'More Info') ?>
            </a>
        </li>
        <li class="">
            <a data-toggle="tab" href="#images">
                <i class="red ace-icon fa fa-picture-o bigger-110"></i>
                <?= Yii::t('yincart', 'Images') ?>
            </a>
        </li>
    </ul>
    <div class="tab-content" style="border-width: 1px">
        <div id="general" class="tab-pane in active">
            <?= $form->field($model, 'name') ?>
            <?= $form->field($model, 'description')->textarea() ?>
            <?= $form->field($model, 'short_description')->textarea() ?>
            <?= $form->field($model, 'meta_keywords') ?>
            <?= $form->field($model, 'meta_description') ?>
            <?= $form->field($model, 'sku') ?>
            <?= $form->field($model, 'url_key') ?>
            <?= $form->field($model, 'sort') ?>
            <?= $form->field($model, 'status')->checkbox() ?>
        </div>
        <div id="price" class="tab-pane">
            <?= $form->field($model, 'news_from_date') ?>
            <?= $form->field($model, 'news_to_date') ?>
            <?= $form->field($model, 'original_price') ?>
            <?= $form->field($model, 'price') ?>
            <?= $form->field($model, 'weight') ?>
            <?= $form->field($model, 'shipping_fee') ?>
            <?= $form->field($model, 'is_free_shipping')->checkbox() ?>
        </div>
        <div id="inventory" class="tab-pane">
            <?= $form->field($model, 'stock_qty') ?>
            <?= $form->field($model, 'notify_stock_qty') ?>
            <?= $form->field($model, 'min_sale_qty') ?>
            <?= $form->field($model, 'max_sale_qty') ?>
            <?= $form->field($model, 'qty_increments') ?>
        </div>
        <div id="category" class="tab-pane">
            <?= Html::activeHiddenInput($model, 'category_id') ?>
            <?= $categoryTreeClass::widget(['tagData' => ['url' => Url::to(['category/get-categories']), 'type' => 'radio']]) ?>
        </div>
        <div id="more-info" class="tab-pane">
            <?= $form->field($model, 'clicks') ?>
            <?= $form->field($model, 'wishes') ?>
            <?= $form->field($model, 'sales') ?>
        </div>
        <div id="images" class="tab-pane">
            <?= $galleryClass::widget() ?>
        </div>
    </div>
</div>
<div class="space"></div>
<div class="form-group">
    <button class="btn btn-primary btn-action-save">
        <i class="ace-icon fa fa-floppy-o align-top bigger-125"></i>
        <?= Yii::t('yincart', 'Save') ?>
    </button>
</div>
<?php $form->end() ?>
