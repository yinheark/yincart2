<?php
/**
 * @link http://www.yincart.com/
 * @copyright Copyright (c) 2014 Yincart
 * @license http://www.yincart.com/license/
 */

use yii\helpers\Url;
use yincart\Yincart;

/* @var bool $iframe */

$elFinderClass = Yincart::$container->elFinderClass;
?>
<div class="row">
    <div class="col-xs-12">
        <div class="col-xs-12 col-sm-12 widget-container-col ui-sortable">
            <?= $elFinderClass::widget(['tagData' => ['url' => Url::to(['elfinder/connector']), 'iframe' => isset($iframe) ? $iframe : false]]) ?>
        </div>
    </div>
</div>