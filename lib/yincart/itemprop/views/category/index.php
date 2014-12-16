<?php

use yii\helpers\Html;
use yii\web\JsExpression;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Categories');
$this->params['breadcrumbs'][] = $this->title;
$this->params['topMenuKey'] = 'yincart';
$this->params['leftMenuKey'] = 'category';

$js = new JsExpression('function(gTreeTableNode) {
    $.get($(".tree-index").data("item-prop-url"), {"categoryId": gTreeTableNode.id}, function(response) {
        $(".item-prop").html(response);
    }, "text");
}');
?>
<div class="tree-index" data-item-prop-url="<?= Url::to(['item-prop/index']); ?>">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('@vendor/gilek/yii2-gtreetable/views/widget', ['options' => [
        'draggable' => true,
        'manyroots' => true,
        'onSelect' => $js,
    ]]); ?>
</div>
<div class="item-prop">

</div>
