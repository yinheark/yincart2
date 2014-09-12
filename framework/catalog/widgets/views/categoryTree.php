<?php
/**
 * @link http://www.yincart.com/
 * @copyright Copyright (c) 2014 Yincart
 * @license http://www.yincart.com/license/
 */

use yii\helpers\Html;

/** @var array $data */
?>
<?= Html::tag('ul', '', ['id' => 'category-tree', 'class' => 'ztree', 'data' => $data]); ?>