<?php
/**
 * @link http://www.yincart.com/
 * @copyright Copyright (c) 2014 Yincart
 * @license http://www.yincart.com/license/
 */

use yii\helpers\Html;
use yii\helpers\Url;
use yincart\Yincart;

/** @var array $data */
/** @var string $inputName */

$elFinderClass = Yincart::$container->elFinderClass;
?>
<style>
    .gallery-img {
        width: 150px;
        height: 150px;
    }
</style>
<?= $elFinderClass::widget(['tagData' => ['url' => Url::to(['elfinder/connector']), 'dialog' => true]]); ?>
<div>
    <?= Html::tag('ul', '', ['id' => 'gallery-list', 'class' => 'ace-thumbnails clearfix', 'data-image-domain' => Yii::$app->params['imageDomain'], 'data' => $data]); ?>
</div>

<button id="add-image-button" type="button" class="btn btn-app btn-light btn-sm">
    <i class="ace-icon fa fa-picture-o bigger-200"></i>
    Image
</button>

<script type="text/juicer" id="gallery-item">
    <li>
        <a href="${url}" data-rel="colorbox">
            <img src="${url}" class="gallery-img"/>
        </a>
        <div class="tools tools-top">
            <a href="javascript:void(0)" data-action="left">
                <i class="ace-icon fa fa-arrow-left"></i>
            </a>
            <a href="javascript:void(0)" data-action="remove">
                <i class="red ace-icon fa fa-times"></i>
            </a>
            <a href="javascript:void(0)" data-action="right">
                <i class="ace-icon fa fa-arrow-right"></i>
            </a>
        </div>
        <input type="hidden" name="<?= $inputName ? $inputName : 'image[]' ?>" value="${url}" />
    </li>
</script>