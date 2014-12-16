<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model yincart\cart\models\Cart */

$this->title = $model->cart_id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Carts'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cart-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->cart_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->cart_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'cart_id',
            'user_id',
            'item_id',
            'qty',
        ],
    ]) ?>

</div>
