<?php
/**
 * @link http://www.yincart.com/
 * @copyright Copyright (c) 2014 Yincart
 * @license http://www.yincart.com/license/
 */

use yii\helpers\Url;
use yincart\Yincart;

/* @var $this yii\web\View */
$this->title = 'My Yii Application';
$itemGridClass = Yincart::$container->itemGridClass;
$itemFormClass = Yincart::$container->itemFormClass;
$itemPropFormClass = Yincart::$container->itemPropFormClass;
$js = <<<EOF
$(function() {
    $('#save-item-button').click(function() {
        $('#item-form').submit();
    });
    $('#new-item-button').click(function() {
        $('#gallery-list').html('');

        var zTreeObj = $.fn.zTree.getZTreeObj('category-tree');
        var treeNode = zTreeObj.getNodeByParam('category_id', $('#item-category_id').val());
        zTreeObj.checkNode(treeNode, false, true, true);

        $('#item-form')[0].reset();
        $('#item-form').find('[name^="Item"]').val('');
    });
});
EOF;
$this->registerJs($js);
?>
<style>
    #item-form .btn-action-save, #item-prop-form .btn-action-save {
        display: none;
    }
</style>
<div class="row">
    <div class="col-xs-12 col-sm-12 widget-container-col ui-sortable">
        <?= $itemGridClass::widget(['tagData' => [
            'gridUrl' => Url::to(['item/get-items']),
            'gridEditUrl' => Url::to(['item/save-item']),
        ]]); ?>
    </div>
</div>
<div class="space"></div>
<div class="row">
    <div class="col-xs-12 col-sm-6 widget-container-col ui-sortable">
        <button id="new-item-button" class="btn btn-primary btn-white btn-lg btn-bold btn-block">
            <i class="ace-icon fa fa-pencil-square-o align-top bigger-120"></i>
            <?= Yii::t('yincart', 'New') ?>
        </button>
    </div>
    <div class="col-xs-12 col-sm-6 widget-container-col ui-sortable">
        <button id="save-item-button" class="btn btn-primary btn-white btn-lg btn-bold btn-block">
            <i class="ace-icon fa fa-floppy-o align-top bigger-120"></i>
            <?= Yii::t('yincart', 'Save') ?>
        </button>
    </div>
</div>
<div class="row">
    <div class="col-xs-12 col-sm-6 widget-container-col ui-sortable">
        <div class="widget-box">
            <div class="widget-header">
                <h5 class="widget-title"><?= Yii::t('yincart', 'Product Info') ?></h5>
            </div>
            <div class="widget-body">
                <div class="widget-main">
                    <?= $itemFormClass::widget([
                        'action' => ['item/save-item'],
                        'tagData' => [
                            'url' => Url::to(['item/get-item']),
                            'propUrl' => Url::to(['item/get-item-props']),
                            'fileBrowserUrl' => Url::to(['elfinder/iframe']),
                            'triggerPropSave' => true
                        ]
                    ]); ?>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xs-12 col-sm-6 widget-container-col ui-sortable">
        <div class="widget-box">
            <div class="widget-header">
                <h5 class="widget-title"><?= Yii::t('yincart', 'Product Attributes') ?></h5>
            </div>
            <div class="widget-body">
                <div class="widget-main">
                    <?= $itemPropFormClass::widget(); ?>
                </div>
            </div>
        </div>
    </div>
</div>