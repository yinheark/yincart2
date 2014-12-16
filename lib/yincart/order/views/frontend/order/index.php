<?php

use yii\helpers\Html;
use yii\helpers\Url;
use kartik\detail\DetailView;
use Kiwi\Kiwi;

    /* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

list($path, $link) = $this->getAssetManager()->publish('@yincart/order/web/js');
$this->registerJsFile($link . '/order.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->title = Yii::t('app', 'order');
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="cart-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php
    foreach($cartItems as $cartItem){
        /**@var Item $item * */
        $item = $cartItem->item;
        ?>
    <div>
        <?= Html::img($item->pictures); ?>
        <?= Html::textInput('[name]', $item->name,['disabled'=>true]); ?>
        <?= Html::textInput('[price]', $item->price,['disabled'=>true]); ?>
        <?= Html::textInput('[qty]', $cartItem->qty,['disabled'=>true]); ?>

    </div>
   <?php
    }
    ?>
    <?= Html::label(Yii::t('app', 'Price'), 'totalPrice'); ?>
    <?= Html::textInput('totalPrice', Kiwi::getShoppingCart()->getTotal(),['disabled'=>true]); ?>
    <?= Html::button(Yii::t('app', 'Create order'), ['class' => 'btn btn-primary create-order', 'data-create'=>true,'data-url' => Url::to(['order/order-save'])]) ?>
    <?= Html::a(Yii::t('app', 'Cancel'), ['site/index']) ?>
</div>

