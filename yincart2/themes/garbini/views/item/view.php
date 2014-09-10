<?php
/**
 * @link http://www.yincart.com/
 * @copyright Copyright (c) 2014 Yincart
 * @license http://www.yincart.com/license/
 */

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Json;
use yii\helpers\Url;
use yincart\base\helpers\Image;
use yincart\Yincart;

/** @var yii\web\View $this */
/** @var \yincart\catalog\models\Item $item */

$jsAssetFolder = $this->getAssetManager()->publish('@yincart/themes/garbini/web/js');
$this->registerJsFile($jsAssetFolder[1] . '/item.js', [Yincart::$container->garbiniAssetClass, Yincart::$container->jqueryFormAssetClass]);

$items = $item->getItems();
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
<section id="content">
<div class="container">

<ol class="breadcrumb">
    <li><a href="<?= Url::home() ?>">Home</a></li>
    <li><?= $item->name ?></li>
</ol>

<div class="row">
    <div class="col-sm-5">

        <div id="product-large" class="owl-carousel">
            <?php foreach ($item->itemImgs as $itemImg) { ?>
                <div class="item"><img src="<?= Image::getThumbnail($itemImg->url, 458, 480) ?>"></div>
            <?php } ?>
        </div>
        <div id="product-thumb" class="owl-carousel">
            <?php foreach ($item->itemImgs as $itemImg) { ?>
                <div class="item"><img src="<?= Image::getThumbnail($itemImg->url, 78, 78) ?>"></div>
            <?php } ?>
        </div>

    </div>
    <div class="col-sm-7 summary entry-summary">

        <h1 class="product_title"><?= $item->name ?></h1>

        <p class="price">
            <sup>$</sup><span class="amount"><?= $item->price ?></span><sup>00</sup>
        </p>

        <h3>Description</h3>

        <?= $item->short_description ?>

        <hr>

        <h3>Very Few Items Left!</h3>

        <style type="text/css">
            .item-prop-value {
                border: 1px solid #AAAAAA;
                padding: 3px 15px;
                margin-right: 30px;
                margin-bottom: 5px;
                cursor: pointer;
                float: left;
            }

            .item-prop-value:hover {
                border: 1px solid red;
                padding: 3px 15px;
            }

            .item-prop-value-selected {
                border: 2px solid red !important;
                padding: 2px 14px !important;
            }

            .item-prop-value-disable {
                cursor: not-allowed !important;
                background-color: #EEEEEE !important;
                border: 1px solid #AAAAAA !important;
            }
        </style>


        <div class="variations" data-item='<?= Json::encode($item) ?>' data-skus='<?= Json::encode($skus) ?>'
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

    </div>
</div>

<!-- Nav tabs -->
<ul class="nav nav-tabs product-tabs">
    <li class="active"><a href="#description" data-toggle="tab">Description</a></li>
    <li><a href="#reviews" data-toggle="tab">Reviews (1)</a></li>
</ul>

<!-- Tab panes -->
<div class="tab-content">
    <div class="tab-pane active" id="description">
        <?= $item->description ?>
    </div>
    <div class="tab-pane" id="reviews">

        <div id="reviews">
            <ol class="commentlist">

                <li class="comment">
                    <div class="comment_container">
                        <img src="http://placehold.it/64x64" class="avatar">

                        <div class="comment-text">
                            <div class="start-rating">
                                <span class="glyphicon glyphicon-star"></span>
                                <span class="glyphicon glyphicon-star"></span>
                                <span class="glyphicon glyphicon-star"></span>
                                <span class="glyphicon glyphicon-star"></span>
                                <span class="glyphicon glyphicon-star"></span>
                            </div>
                            <h5 class="meta">James Koster <span>&mdash; June 7, 2013</span></h5>

                            <p>Really happy with this print. The colors are great, and the paper quality is good
                                too.</p>
                        </div>
                    </div>
                </li>

            </ol>
        </div>

        <hr>

        <div id="review_form">
            <h3 id="reply-title" class="comment-reply-title">Add a Review</h3>

            <form action="#" id="commentform" class="comment-form">
                <div class="row">
                    <p class="comment-form-author col-sm-4">
                        <input type="text" placeholder="Author *" class="form-control">
                    </p>

                    <p class="comment-form-email col-sm-4">
                        <input type="email" placeholder="Email *" class="form-control">
                    </p>

                    <p class="comment-form-rating col-sm-4">
                        <select class="form-control">
                            <option value="0">Your Rating</option>
                            <option value="0">Perfect &mdash; 5*</option>
                            <option value="0">Good &mdash; 4*</option>
                            <option value="0">Average &mdash; 3*</option>
                            <option value="0">Not That Bad &mdash; 2*</option>
                            <option value="0">Very Poor &mdash; 1*</option>
                        </select>
                    </p>
                </div>
                <p class="comment-form-comment"><textarea name="review" id="review" class="form-control" cols="30"
                                                          rows="5" placeholder="Your Review"></textarea></p>

                <p class="form-submit"><input type="submit" class="btn btn-primary btn-lg" name="proceed"
                                              value="Post Review"></p>
            </form>
        </div>

    </div>
</div>

<div class="related">
    <h2>You May Also Like</h2>
    <ul class="products row">
        <?php foreach ($items as $relatedItem) {
            if (count($relatedItem->itemImgs) == 0) continue;
            $url = $relatedItem->itemImgs[0]->url;
            ?>
            <li class="col-sm-3">
                <div class="product">
                    <div class="thumbnail">
                        <a href="<?= Url::to(['item/view', 'id' => $relatedItem->item_id]); ?>"><img
                                src="<?= Image::getThumbnail($url, 204, 204) ?>" alt=""></a>
                        <a href="#" class="add-to-cart" title="Add to Cart">
                        <span class="fa-stack fa-2x">
                            <i class="fa fa-circle fa-stack-2x"></i>
                            <i class="fa fa-shopping-cart  fa-stack-1x fa-inverse"></i>
                        </span>
                        </a>
                    </div>
                    <hr>
                    <div class="title">
                        <h3>
                            <a href="<?= Url::to(['item/view', 'id' => $relatedItem->item_id]); ?>"><?= $relatedItem->name ?></a>
                        </h3>

                        <p><?= $relatedItem->short_description ?></p>
                    </div>
                    <span class="price">$<?= $relatedItem->price ?></span>
                </div>
            </li>
        <?php } ?>
    </ul>
</div>

</div>
</section>