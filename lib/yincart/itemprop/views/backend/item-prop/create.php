<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model yincart\itemprop\models\ItemProp */

$this->title = Yii::t('app', 'Create {category} {modelClass}', [
    'category' => $category->name,
    'modelClass' => 'Item Prop',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Item Props'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="item-prop-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
