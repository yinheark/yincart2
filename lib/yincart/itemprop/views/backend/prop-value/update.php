<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model yincart\itemprop\models\PropValue */
/* @var $itemProp \yincart\itemprop\models\ItemProp */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Prop Value',
]) . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Prop Values'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->prop_value_id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="prop-value-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
