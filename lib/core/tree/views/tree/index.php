<?php

use yii\helpers\Html;
use yii\web\JsExpression;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */
?>
<div class="tree-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('@vendor/gilek/yii2-gtreetable/views/widget', ['options' => [
        'draggable' => true,
        'manyroots' => true,
    ]]); ?>
</div>
