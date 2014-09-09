<?php
/**
 * @link http://www.yincart.com/
 * @copyright Copyright (c) 2014 Yincart
 * @license http://www.yincart.com/license/
 */

use yii\helpers\Url;
use yincart\base\helpers\Image;
use yincart\Yincart;

$itemClass = Yincart::$container->itemClass;
$items = $itemClass::getItems();
?>
<section id="slider">
    <div id="bs-carousel" class="carousel slide" data-ride="carousel">
        <!-- Indicators -->
        <ol class="carousel-indicators">
            <?php $i = 0;
            foreach ($items as $item) {
                if (count($item->itemImgs) == 0) continue;
                ?>
                <li data-target="#bs-carousel" data-slide-to="<?= $i++ ?>" class="<?= $i == 1 ? 'active' : '' ?>"></li>
            <?php } ?>
        </ol>
        <!-- Wrapper for slides -->
        <div class="carousel-inner">
            <?php $i = 0;
            foreach ($items as $item) {
                if (count($item->itemImgs) == 0) continue;
                $url = $item->itemImgs[0]->url;
                ?>
                <div class="item <?= $i++ == 0 ? 'active' : '' ?>">
                    <a href="<?= Url::to(['item/view', 'id' => $item->item_id]); ?>"><img src="<?= Image::getThumbnail($url, 1600, 550) ?>" alt=""></a>
                </div>
            <?php } ?>
        </div>

        <!-- Controls -->
        <a class="left carousel-control" href="#bs-carousel" data-slide="prev">
            <i class="fa fa-angle-left"></i>
            <!--span class="glyphicon glyphicon-chevron-left"></span-->
        </a>
        <a class="right carousel-control" href="#bs-carousel" data-slide="next">
            <i class="fa fa-angle-right"></i>
            <!--span class="glyphicon glyphicon-chevron-right"></span-->
        </a>
    </div>
</section>