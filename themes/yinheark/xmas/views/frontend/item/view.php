<?php
/* @var $this yii\web\View */
/* @var $item \yincart\item\models\Item */
/** @var \extensions\sales\models\CustomerSales $customer_sale */

use yii\helpers\Url;
use kiwi\Kiwi;

list($path, $link) = $this->getAssetManager()->publish('@yincart/item/web/js');
$this->registerJsFile($link . '/item.js', ['depends' => [\yii\web\JqueryAsset::className()]]);

$key = Yii::$app->request->get('key');
/** @var \extensions\sales\models\CustomerSales $customer_sale */
$customerSaleClass = Kiwi::getCustomerSalesClass();
$customer_sale = $customerSaleClass::find()->where(['key' => $key])->one();
?>
<!-- Main Container Starts -->
<div id="main-container" class="container">
<div class="row">
<!-- Primary Content Starts -->
<div class="col-md-12">
<!-- Breadcrumb Starts -->
<ol class="breadcrumb">
    <li><a href="<?= Url::to(['/'])?>">首页</a></li>
    <li class="active">商品</li>
</ol>
<!-- Breadcrumb Ends -->
<!-- Product Info Starts -->
<div class="row product-info">
    <!-- Left Starts -->
    <div class="col-sm-5 images-block">
        <?php
        $pictures = explode(',',$item->pictures);
        ?>
        <p>
            <img src="<?= isset($pictures[0])?$pictures[0]:'' ?>" class="img-responsive thumbnail"
                 <?php if(!$item->pictures[0]){?>data-src="holder.js/190x190" <?php } ?> />
        </p>
        <ul class="list-unstyled list-inline">
            <li>
                <img src="<?= isset($pictures[1])?$pictures[1]:'' ?>" class="img-responsive thumbnail"
                     style="height: 70px;width: 70px;display: <?php if(!isset($pictures[1])){ echo 'none'; } ?>"/>
            </li>
            <li>
                <img src="<?= isset($pictures[2])?$pictures[2]:'' ?>" class="img-responsive thumbnail"
                     style="height: 70px;width: 70px;display: <?php if(!isset($pictures[2])){ echo 'none'; } ?>"/>
            </li>
            <li>
                <img src="<?= isset($pictures[3])?$pictures[3]:'' ?>" class="img-responsive thumbnail"
                     style="height: 70px;width: 70px;display: <?php if(!isset($pictures[3])){ echo 'none'; } ?>"/>
            </li>
            <li>
                <img src="<?= isset($pictures[4])?$pictures[4]:'' ?>" class="img-responsive thumbnail"
                     style="height: 70px;width: 70px;display: <?php if(!isset($pictures[4])){ echo 'none'; } ?>"/>
            </li>
        </ul>
    </div>
    <!-- Left Ends -->
    <!-- Right Starts -->
    <div class="col-sm-7 product-details">
        <!-- Product Name Starts -->
        <h2><?= $item->name;?></h2>
        <!-- Product Name Ends -->
        <hr />
        <!-- Manufacturer Starts -->
        <ul class="list-unstyled manufacturer">
<!--            <li>-->
<!--                <span>是否有货:</span> <strong class="label label-success">有货</strong>-->
<!--            </li>-->
            <li><span>库存剩余:</span> <?= $item->stock_qty?>件</li>
        </ul>
        <!-- Manufacturer Ends -->
        <hr />
        <!-- Price Starts -->
        <div class="price">
            <span class="price-head">价格 :</span>
            <span class="price-new"><?= isset($customer_sale->sale_price)&&($customer_sale->sale_price != 0) ? $customer_sale->sale_price : $item->price ?> RMB</span>
        </div>
        <!-- Price Ends -->
        <hr />
        <!-- Available Options Starts -->
        <form>
            <input type="hidden" id="item_id" name="item_id" value="<?= $item->item_id; ?>"/>
            <input name="data[key]"  type="hidden" value="<?= Yii::$app->request->get('key'); ?>"/>
        <div class="options">
            <div class="form-group">
                <label class="control-label text-uppercase" for="input-quantity">数量:</label><br />
                <a href="javascript:void(0)" class="minus">
                    <span class="glyphicon glyphicon-minus-sign btn-reduce"></span>
                </a>
                <input type="text" style="width: 70%;display: inline" name="qty" data-min="<?= $item->min_sale_qty?>"
                       data-max="<?= $item->max_sale_qty?>" data-stock="<?= $item->stock_qty?>" value="<?= $item->min_sale_qty ? : 1?>" id="qty" class="form-control" />
                <a href="javascript:void(0)" class="add">
                    <span class="glyphicon glyphicon-plus-sign btn-add " style="margin-left: 5px"></span>
                </a>
            </div>
            <div class="cart-button button-group">
                <?php if(isset($customer_sale)) {?>
                <button type="button" class="btn btn-cart add-to-cart" data-url="<?= Url::to(['cart/add']); ?>">
                    加入购物车
                    <i class="fa fa-shopping-cart"></i>
                </button>
                <?php }?>
<!--                <button type="button" class="btn btn-cart buy-now" data-url="--><?//= Url::to(['order/create']); ?><!--">-->
<!--                    立即购买-->
<!--                    <i class="fa fa-crosshairs"></i>-->
<!--                </button>-->
                <?php
                $isApply = Kiwi::getCustomerSales()->find()->where(['item_id' => $item->item_id, 'user_id' => Yii::$app->user->id])->exists();
                ?>
                <button type="button" class="btn btn-cart request-sales" data-url="<?= Url::to(['customerSales/create']); ?>" style="<?= $isApply ? 'background-color: #333' : '' ?>">
                    <?php
                    if ($isApply) {
                        echo '已申请销售';
                    } else {
                        echo '申请销售';
                    }
                    ?>
                    <i class="fa fa-crosshairs"></i>
                </button>
            </div>
        </div>
        </form>
        <!-- Available Options Ends -->
        <hr />
    </div>
    <!-- Right Ends -->
</div>
<!-- product Info Ends -->
<!-- Product Description Starts -->
<div class="product-info-box">
    <h4 class="heading">商品简介</h4>
    <div class="content panel-smart">
        <p>
            <?= $item->short_description; ?>
        </p>
    </div>
</div>
<!-- Product Description Ends -->
<!-- Additional Information Starts -->
<div class="product-info-box">
    <h4 class="heading">商品描述</h4>
    <div class="content panel-smart">
        <p>
            <?= $item->description;?>
        </p>
    </div>
</div>
<!-- Additional Information Ends -->
</div>
<!-- Primary Content Ends -->
</div>
</div>
<!-- Main Container Ends -->