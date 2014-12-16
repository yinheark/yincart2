<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model yincart\itemprop\models\PropValue */
/* @var $itemProp \yincart\itemprop\models\ItemProp */

$this->title = Yii::t('app', 'Create {modelClass}', [
    'modelClass' => 'Prop Value',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Prop Values'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="prop-value-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
