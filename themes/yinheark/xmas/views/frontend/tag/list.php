<?php
use yii\widgets\LinkPager;
use kiwi\Kiwi;
use yii\helpers\Url;
?>
<!-- Main Container Starts -->
<div id="main-container" class="container">
<div class="row">
<!-- Primary Content Starts -->
<div class="col-md-9">
    <!-- Breadcrumb Starts -->
    <ol class="breadcrumb">
        <li><a href="<?= Url::to(['site/index']) ?>">首页</a></li>
        <li class="active"><?= htmlspecialchars(Yii::$app->request->get('name')) ?></li>
    </ol>
    <!-- Product List Display Starts -->
    <div class="row">
        <!-- Product #1 Starts -->
        <?php
        foreach($itmTreeModels as $itmTreeModel){
            $itemClass = Kiwi::getItemClass();
            $item = $itemClass::findOne($itmTreeModel->item_id);
            $pictures = explode(',',$item->pictures);
            $itemUrl = Yii::$app->urlManager->createUrl(['item/view', 'id' => $item->item_id]);
            ?>
            <div class="col-md-4 col-sm-6">
                <div class="product-col">
                    <div class="image thumbnail" >
                        <a href="<?= $itemUrl ?>"><img width="221" height="221" src="<?= is_array($pictures)?$pictures[0]:$pictures ?>" alt="product" class="img-responsive" /></a>
                    </div>
                    <div class="caption" >
                        <div class="product_name" style="  height:27px;overflow:hidden;">
                            <h4><a href="<?= $itemUrl ?>"><?= $item->name ?></a></h4>
                        </div>
                        <div class="description" style=" height:44px;overflow:hidden;">
                            <?= $item->short_description ?>
                        </div>
                        <div class="product_price">
                            <div class="product_price_n" style="font-size:18px;font-weight:700;color:#d50000;float:left;">￥<?= $item->price; ?></div>
                            <div class="product_price_v" style="background:#d50000;padding:1px 5px;float:right;"><a style="color: #FFF" href="<?= $itemUrl; ?>">详情点击</a></div>
                        </div>
                    </div>
                </div>
            </div>


        <?php
        } ?>
    </div>
    <!-- Product List Display Ends -->
    <!-- Pagination & Results Starts -->
    <div class="row">
        <!-- Pagination Starts -->
        <div class="col-sm-6 pagination-block">
            <?= LinkPager::widget([
                'pagination' => $pages,
                ]);
            ?>
        </div>
    </div>
    <!-- Pagination & Results Ends -->
</div>
<!-- Primary Content Ends -->
<!-- Sidebar Starts -->
<div class="col-md-3">
    <!-- Categories Links Starts -->
    <h3 class="side-heading">目录</h3>
    <div class="list-group">
        <?php
        $tag = Kiwi::getTag()->find()->where(['name'=>'首页导航'])->one();
        $childrenTags = $tag->children()->all();
        foreach($childrenTags as $childrenTag){
        ?>
        <a href="<?= Url::to(['/tag/list','name'=>$childrenTag->name]) ?>" class="list-group-item">
            <i class="fa fa-chevron-right"></i>
            <?= $childrenTag->name; ?>
        </a>
       <?php } ?>
    </div>
    <!-- Categories Links Ends -->
    <!-- Shopping Options Starts -->

</div>
<!-- Sidebar Ends -->
</div>
</div>
<!-- Main Container Ends -->