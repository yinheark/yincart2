<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model yincart\cart\models\Cart */

$this->title = Yii::t('app', 'Create {modelClass}', [
    'modelClass' => 'Cart',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Carts'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cart-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
