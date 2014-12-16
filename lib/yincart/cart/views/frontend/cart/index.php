<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

list($path, $link) = $this->getAssetManager()->publish('@yincart/cart/web/js');
$this->registerJsFile($link . '/cart.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->title = Yii::t('app', 'Carts');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cart-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php
    $form = ActiveForm::begin();
    foreach ($cartItems as $cartItem) {
        /**@var Item $item * */
        $item = $cartItem->item;
        ?>
        <div>
            <?= Html::img($item->pictures); ?>
            <?= Html::hiddenInput('Cart[' . $cartItem->item_id . '][item_id]', $cartItem->item_id) ?>
            <?= Html::textInput('Cart[' . $cartItem->item_id . '][name]', $item->name); ?>
            <?= Html::textInput('Cart[' . $cartItem->item_id . '][price]', $item->price); ?>
            <?= Html::textInput('Cart[' . $cartItem->item_id . '][qty]', $cartItem->qty); ?>
            <?= Html::button(Yii::t('app', 'Remove'), ['class' => 'btn btn-primary remove-item', 'data-item' => $cartItem->item_id, 'data-url' => Url::to(['cart/remove'])]) ?>

        </div>
    <?php } ?>
    <?= Html::button(Yii::t('app', 'Clear All'), ['class' => 'btn btn-primary clear-all', 'data-url' => Url::to(['cart/clear-all'])]) ?>

    <?= Html::button(Yii::t('app', 'Update Cart'), ['class' => 'btn btn-primary update-cart', 'data-url' => Url::to(['cart/update'])]) ?>
    <?= Html::a(Yii::t('app', 'Create Order'), ['order/index']) ?>
    <?php $form->end(); ?>

</div>
