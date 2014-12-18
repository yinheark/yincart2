<?php
/**
 * Created by PhpStorm.
 * User: LCH
 * Date: 2014/11/22
 * Time: 10:53
 */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $item \yincart\item\models\Item */

list($path, $link) = $this->getAssetManager()->publish('@yincart/item/web/js');
$this->registerJsFile($link . '/item.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->title = $item->name;
$form = ActiveForm::begin();
?>
<div>
    <h3><?= $item->name ?></h3>
    <?= Html::hiddenInput('item_id', $item->item_id) ?>
    <?= Html::textInput('qty', 1, ['id' => 'qty', 'data-stock' => $item->stock_qty, 'data-max' => $item->max_sale_qty, 'data-min' => $item->min_sale_qty]); ?>
    <?= Html::button(Yii::t('app', 'Add To Cart'), ['class' => 'btn btn-primary add-to-cart', 'data-url' => Url::to(['cart/add'])]) ?>
    <?= Html::button(Yii::t('app', 'Buy It Now'), ['class' => 'btn btn-primary buy-now', 'data-url' => Url::to(['order/create'])]) ?>
</div>
<?php $form->end(); ?>