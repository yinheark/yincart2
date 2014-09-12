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
$categoryTreeClass = Yincart::$container->categoryTreeClass;
$categoryFormClass = Yincart::$container->categoryFormClass;
$itemPropGridClass = Yincart::$container->itemPropGridClass;
?>

<div class="row">
    <div class="col-xs-12">
        <div class="col-xs-12 col-sm-3 widget-container-col ui-sortable">
            <div class="widget-box">
                <div class="widget-header">
                    <h5 class="widget-title"><?= Yii::t('yincart', 'Category Tree') ?></h5>
                </div>
                <div class="widget-body">
                    <div class="widget-main">
                        <?= $categoryTreeClass::widget(['tagData' => [
                            'url' => Url::to(['category/get-categories']),
                            'save-url' => Url::to(['category/save-categories']),
                        ]]); ?>
                    </div>
                </div>
            </div>
            <div class="space"></div>
            <div class="widget-box">
                <div class="widget-header">
                    <h5 class="widget-title"><?= Yii::t('yincart', 'Category Form') ?></h5>
                </div>
                <div class="widget-body">
                    <div class="widget-main">
                        <?= $categoryFormClass::widget(['action' => ['category/save-category'], 'tagData' => [
                            'url' => Url::to(['category/get-category']),
                            'del-url' => Url::to(['category/delete-category']),
                        ]]); ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xs-12 col-sm-9 widget-container-col ui-sortable">
            <?= $itemPropGridClass::widget(['tagData' => [
                'grid-url' => Url::to(['category/get-item-props']),
                'grid-edit-url' => Url::to(['category/save-item-prop']),
                'sub-grid-url' => Url::to(['category/get-prop-values']),
                'sub-grid-edit-url' => Url::to(['category/save-prop-value']),
            ]]); ?>
        </div>
    </div>
</div>
