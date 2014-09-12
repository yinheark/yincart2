<?php
/**
 * @link http://www.yincart.com/
 * @copyright Copyright (c) 2014 Yincart
 * @license http://www.yincart.com/license/
 */

use yii\helpers\Url;
use yincart\base\helpers\Image;
use yincart\Yincart;

$garbiniPath = \Yii::$app->getAssetManager()->publish(\yincart\Yincart::$container->garbiniAsset->sourcePath);

$itemClass = Yincart::$container->itemClass;
$items = $itemClass::getItems();
?>
<section id="content">
    <div class="container">

        <div class="row ad-banners">
            <div class="col-sm-4">
                <a href="#"><img src="<?= $garbiniPath[1] ?>/img/images/ad-1.png" alt=""></a>
            </div>
            <div class="col-sm-4">
                <a href="#"><img src="<?= $garbiniPath[1] ?>/img/images/ad-2.png" alt=""></a>
                <a href="#"><img src="<?= $garbiniPath[1] ?>/img/images/ad-3.png" alt=""></a>
            </div>
            <div class="col-sm-4">
                <a href="#"><img src="<?= $garbiniPath[1] ?>/img/images/ad-4.png" alt=""></a>
            </div>
        </div>

        <div class="products-carousel products-small products">

            <div class="banner">
                <img src="<?= $garbiniPath[1] ?>/img/images/30-off.png" alt="">
            </div>

            <div class="carousel">
                <?php foreach ($items as $item) {
                if (count($item->itemImgs) == 0) continue;
                $url = $item->itemImgs[0]->url;
                ?>
                <div>
                    <div class="product">
                        <div class="thumbnail">
                            <a href="<?= Url::to(['item/view', 'id' => $item->item_id]); ?>"><img src="<?= Image::getThumbnail($url, 204, 204) ?>" alt=""></a>
                        </div>
                        <hr>
                        <div class="title">
                            <h3><a href="<?= Url::to(['item/view', 'id' => $item->item_id]); ?>"><?= $item->name ?></a></h3>

                            <p><?= $item->short_description ?></p>
                        </div>
                    </div>
                </div>
                <?php } ?>
            </div>

        </div>

        <h2 class="align-center unbranded">Browse Our Store</h2>

        <div class="gap-25"></div>

        <ul class="products row">
            <?php foreach ($items as $item) {
                if (count($item->itemImgs) == 0) continue;
                $url = $item->itemImgs[0]->url;
                ?>
                <li class="col-sm-3">
                    <div class="product">
                        <div class="thumbnail">
                            <a href="<?= Url::to(['item/view', 'id' => $item->item_id]); ?>"><img
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
                            <h3><a href="<?= Url::to(['item/view', 'id' => $item->item_id]); ?>"><?= $item->name ?></a></h3>

                            <p><?= $item->short_description ?></p>
                        </div>
                        <span class="price">$<?= $item->price ?></span>
                    </div>
                </li>
            <?php } ?>
        </ul>
    </div>
</section>