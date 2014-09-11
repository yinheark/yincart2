<?php
/**
 * @link http://www.yincart.com/
 * @copyright Copyright (c) 2014 Yincart
 * @license http://www.yincart.com/license/
 */

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Json;
use yincart\Yincart;

/** @var yii\web\View $this */
/** @var \yincart\catalog\models\Item $item */

$jsAssetFolder = $this->getAssetManager()->publish('@yincart/themes/garbini/widgets/web/js');
$this->registerJsFile($jsAssetFolder[1] . '/item-prop-select.js', [Yincart::$container->garbiniAssetClass, Yincart::$container->jqueryFormAssetClass, Yincart::$container->juicerAssetClass]);
$cssAssetFolder = $this->getAssetManager()->publish('@yincart/themes/garbini/widgets/web/css');
$this->registerCssFile($cssAssetFolder[1] . '/item-prop-select.css', [Yincart::$container->garbiniAssetClass]);

$skus = $item->skus;
$outProperties = [];
foreach ($skus as $key => $sku) {
    if ($sku->stock_qty == 0) {
        $outProperties[] = $sku->properties;
    }

    $skus[$sku->properties] = $sku;
    unset($skus[$key]);
}

$propValueModel = $item->getPropValueModel();
$saleProps = $propValueModel->getSaleProps();
?>

<div class="variations" data-item='<?= Json::encode($item) ?>'
     data-skus='<?= Json::encode($skus) ?>'
     data-out-properties='<?= Json::encode($outProperties) ?>'>
    <?php foreach ($saleProps as $saleProp) {
        /** @var \yincart\catalog\models\ItemProp $itemProp */
        $itemProp = $saleProp['itemProp'];
        /** @var \yincart\catalog\models\PropValue[] $propValues */
        $propValues = $saleProp['propValues'];
        ?>
        <div class="row">
            <div class="col-sm-2">
                <?= $itemProp->name ?>
            </div>
            <div class="col-sm-5">
                <?php foreach ($propValues as $propValue) { ?>
                    <div class="item-prop-value"
                         data-prop-value="<?= $propValue->item_prop_id . ':' . $propValue->prop_value_id ?>"><?= $propValue->name ?></div>
                <?php } ?>
            </div>
        </div>
    <?php } ?>
</div>

<?php $cartForm = ActiveForm::begin(['id' => 'cart-form', 'action' => ['cart/add']]) ?>
<div class="quantity buttons_added">
    <?= Html::hiddenInput('item_id', $item->item_id) ?>
    <?= Html::hiddenInput('sku_id', 0) ?>
    <button class="minus"><i class="fa fa-minus"></i></button>
    <input type="number" size="4" class="qty text form-control" title="Qty" value="1" name="qty" step="1">
    <button class="plus"><i class="fa fa-plus"></i></button>
    <span class="item_stock">(stock <?= $item->stock_qty ?>)</span>
</div>

<input type="submit" class="btn btn-primary btn-lg" id="add-to-cart" value="Add to Cart">
<?php $cartForm->end() ?>