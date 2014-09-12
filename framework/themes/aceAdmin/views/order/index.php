<?php
/**
 * @link http://www.yincart.com/
 * @copyright Copyright (c) 2014 Yincart
 * @license http://www.yincart.com/license/
 */

use yii\helpers\Url;
use yincart\Yincart;

$orderGridClass = Yincart::$container->orderGridClass;
?>

<div class="row">
    <div class="col-xs-12 col-sm-12 widget-container-col ui-sortable">
        <?= $orderGridClass::widget(['tagData' => [
            'gridUrl' => Url::to(['customer/get-customers']),
            'gridEditUrl' => Url::to(['customer/save-customer']),
        ]]); ?>
    </div>
</div>
<div class="space"></div>