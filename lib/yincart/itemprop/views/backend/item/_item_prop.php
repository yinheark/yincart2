<?php

use yii\helpers\Html;
use yii\web\JsExpression;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $model yincart\item\models\Item */

$onSelectJs = new JsExpression('function(gTreeTableNode) {
    $("#category-id").val(gTreeTableNode.id);
    $.get($(".tree-index").data("item-prop-url"), {"categoryId": gTreeTableNode.id, "itemId": $("#item-id").val()}, function(response) {
        $(".item-prop").html(response);
    }, "text");
}');

$unSelectJs = new JsExpression('function(gTreeTableNode) {
    $(".item-prop").html("");
    $("#category-id").val(0);
}');
?>
<div class="tree-index" data-item-prop-url="<?= Url::to(['item-prop/form']); ?>">
    <?= $this->render('@vendor/gilek/yii2-gtreetable/views/widget', [
        'controller' => 'category',
        'options' => [
            'readonly' => true,
            'draggable' => false,
            'manyroots' => true,
            'onSelect' => $onSelectJs,
            'onUnselect' => $unSelectJs,
        ]]); ?>
    <?= Html::hiddenInput('item_id', $model->item_id, ['id' => 'item-id']); ?>
    <?= Html::hiddenInput('category_id', 0, ['id' => 'category-id']); ?>
</div>
<div class="item-prop">

</div>
