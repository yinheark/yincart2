<?php
use kiwi\Kiwi;
use \yii\helpers\Url;

list($path, $link) = $this->getAssetManager()->publish('@themes/xmas/assets/source');
?>
<link href="<?= $link ?>/css/common.css" rel="stylesheet">
<!-- Slider Section Starts -->
<section class="slider">
    <div class="container">
        <div id="main-carousel" class="carousel slide" data-ride="carousel">
            <!-- Wrapper For Slides Starts -->
            <div class="carousel-inner">
                <?php
                $slider = Kiwi::getArticle()->find()->where(['type' => 'slider'])->orderBy(['updated_at' => SORT_DESC])->one();
                if($slider){
                $pictures = explode(',',$slider->pictures);
                ?>
                <div class="item active">
                    <img src="<?= is_array($pictures)?$pictures[0]:$pictures ?>" alt="Slider" class="img-responsive" style="width: 1140px;height: 479px"/>
                </div>
                <?php if(count($pictures)>1){ ?>
                <div class="item">
                    <img src="<?= is_array($pictures)?$pictures[1]:$pictures ?>" alt="Slider" class="img-responsive" style="width: 1140px;height: 479px"/>
                </div>
                <?php  }}  ?>
            </div>
            <!-- Wrapper For Slides Ends -->
            <!-- Controls Starts -->
            <a class="left carousel-control" href="#main-carousel" role="button" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left"></span>
            </a>
            <a class="right carousel-control" href="#main-carousel" role="button" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right"></span>
            </a>
            <!-- Controls Ends -->
        </div>
    </div>
</section>
<!-- Slider Section Ends -->

<div class="warp_product row">
    <div class="col-lg-9">
        <?php
        $a = 0;
        /** @var \yincart\category\models\Tag $tag */
        foreach($tags as $tag){  ?>
<!--            <div class="product_cate_tit--><?php //echo $a++; ?><!--"><label>--><?php //echo $tag->name; ?><!--</label><a href="--><?php //echo Url::to(['tag/list','name'=>$tag->name]) ?><!--">更多推荐>></a></div>-->
        <div class="left-box">
            <div class="center-block" style="width:300px">
                <a href="<?php echo Url::to(['tag/list','name'=>$tag->name]) ?>">
                <img alt="<?= $tag->name; ?> [300x30]" data-src="holder.js/300x30/text:<?= $tag->name; ?>" style="width: 300px; height: 30px;" data-holder-rendered="true">
                </a>
        </div>
            <div class="product_c">
                <div class="product_list">
                    <?php
                    if($tag->name == '时尚推荐') {
                        $items = $tag->getItems()->limit(12)->all();
                    } else{
                        $items = $tag->getItems()->limit(4)->all();
                    }
                    foreach($items as $item){
                        $pictures = explode(',',$item->pictures);
                        $itemUrl = Yii::$app->urlManager->createUrl(['item/view', 'id' => $item->item_id]);
                        ?>
                        <div class="product_d ">
                            <div class="product_img"><a href="<?= $itemUrl; ?>" class="thumbnail">

                                    <img alt="<?= $item->name; ?>" src="<?= is_array($pictures)?$pictures[0]:$pictures ?>" <?php if(!$item->pictures){?>data-src="holder.js/190x190" <?php } ?>
                                         width="190" height="190" ></a>
                            </div>
                            <div class="product_name">
                                <a href="<?= $itemUrl; ?>"><?= $item->name; ?></a>
                            </div>
                            <div class="product_price">
                                <div class="product_price_n">￥<?= $item->price; ?></div>
                                <div class="product_price_v"><a href="<?= $itemUrl; ?>">详情点击</a></div>
                            </div>
                        </div>

                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>
        <?php } ?>
    </div>
    <div class="col-lg-3">
        <p class="title-right news-left">时尚资讯</p>
        <ul class="news">
            <?php
            $articles = Kiwi::getArticle()->find()->where(['type' => 'fashion'])->orderBy(['updated_at' => SORT_DESC])->limit(4)->all();
            foreach ($articles as $article) {
                $pictures = explode(',',$article->pictures);
                ?>
                <li class="clearfix">
                    <img  width="100" height="100" src="<?= is_array($pictures)?$pictures[0]:$pictures ?>" <?php if(!$article->pictures){ ?>data-src="holder.js/100x100/热点新闻图片" <?php } ?>class="pull-left" alt=""/>

                    <div class="pull-left news-content" style="margin-top: 7px">
                        <p>简介：<?php echo $article->short_d;?></p>
                        <p>&nbsp;&nbsp;&nbsp;&nbsp;<?= $article->name ?><a href="<?= Yii::$app->urlManager->createUrl(['page','key'=>$article->key]) ?>">【查看详情】</a></p>

                    </div>
                </li>
            <?php } ?>
        </ul>
        <a href="<?= \yii\helpers\Url::to(['article/list','type'=>'fashion'])?>" class="pull-right look-more" style="margin-right:0;">查看更多</a>
    </div>
    <div class="col-lg-3 ">
        <p class="title-right">排行榜</p>
        <ul class="nav nav-tabs nav-order" role="tablist" style="background:transparent;">
            <li class="active"><a href="#profile" style="padding: 8px" data-toggle="tab">月销量之星</a></li>
            <li class=""><a href="#dropdown" style="padding: 8px" data-toggle="tab">总销售大神</a></li>
            <li class=""><a href="#category" style="padding: 8px" data-toggle="tab">分类排行</a></li>
        </ul>
        <div id="myTabContent" class="tab-content">
            <div class="tab-pane fade active in" id="profile">
                <ul class="list-unstyled contact-details">
                    <?php
                    $month = date('m');
                    $year = date('Y');
                    $last_month = date('m') - 1;

                    if($month == 1){
                        $last_month = 12;
                        $year = $year - 1;
                    }
                    $start = mktime(0, 0, 0, $last_month, 0, $year);
                    $end = mktime(0, 0, 0, $month, 0, $year);

                    $dealLogModels = Kiwi::getDealLog()->find()->select('key,count(*) as order_id')->where(['between','created_at',$start,$end])->groupBy('user_id')->orderBy('order_id desc')->limit(7)->all();
                    foreach($dealLogModels as $dealLogModel){
                        $seller = Kiwi::getCustomerSales()->find()->where(['key' => $dealLogModel->key])->one();
                        if($seller){
                            $user =$seller->user; ?>
                            <li><span><?= $user->username ?></span> 卖出 <?= $dealLogModel->order_id ?> 单</li>
                    <?php
                        }
                    }
                    ?>
                </ul>
            </div>
            <div class="tab-pane fade" id="dropdown">
                <ul class="list-unstyled contact-details">
                    <?php
                    $topSellers = Kiwi::getCustomerSeller()->find()->orderBy(['integral' => SORT_DESC])->limit(7)->all();
                    foreach($topSellers as $topSeller){ ?>
                        <li style="padding: 10px 30px; border-bottom: dashed 1px #8c8b8b; line-height: 24px">销售: <?= $topSeller->user->username ?>; 销量: <?= $topSeller->getSelesCount() ?></li>
                    <?php
                    }
                    ?>
                </ul>
            </div>
            <div class="tab-pane fade" id="category">
                <ul class="list-unstyled contact-details">
                    <?php $categories = Kiwi::getOrderItem()->getCategoryOrderBy();
                    foreach($categories as $value) { ?>
                        <li style="padding: 10px 30px; border-bottom: dashed 1px #8c8b8b; line-height: 24px"><?= $value['name'] ?>; 销量: <?= $value['total'] ?></li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </div>
</div>

<div class="container" style="border:1px solid lightgray">
    <div class="row">
        <div class="interview ">
            <ul class="nav nav-tabs interview " role="tablist">
                <p class="pull-left interview-title"><span class="glyphicon glyphicon-star-empty"></span>&nbsp;&nbsp;本日期销售之星访谈</p>
                <li role="presentation" class="active pull-right"><a href="#font" role="tab" data-toggle="tab">文字访谈</a></li>
                <li role="presentation" class="pull-right"><a href="#mv" role="tab" data-toggle="tab">视频访谈</a></li>
            </ul>
        </div>
    </div>



    <!-- Tab panes -->
    <div class="tab-content row" >
        <div role="tabpanel" class="tab-pane active" id="font">
            <?php
            $articles = Kiwi::getArticle()->find()->where(['type' => 'text'])->orderBy(['updated_at' => SORT_DESC])->limit(2)->all();
            foreach ($articles as $article) {
                $pictures = explode(',',$article->pictures);
                ?>
                <ul class="col-sm-6 interview-content">
                    <li class="col-xs-5">
                        <a href="<?= Yii::$app->urlManager->createUrl(['page','key'=>$article->key])?>"><img width="200" height="200" <?php if(!$article->pictures){?>data-src="holder.js/200x200/text:人物" <?php } ?> src="<?= is_array($pictures)?$pictures[0]:$pictures?>" alt="<?= $article->name;?>"/></a>
                    </li>
                    <li class="col-xs-7">
                        <p><a href="<?= Yii::$app->urlManager->createUrl(['page','key'=>$article->key])?>"><?= $article->name;?></a></p>
                        <p>作者：<?= $article->author;?></p>
                        <p>简介：<?php echo $article->short_d;?></p>
                        <p class="interview-link"><a href="<?= Yii::$app->urlManager->createUrl(['page','key'=>$article->key])?>">【查看详情】</a>&nbsp;&nbsp;<a href="<?= Url::to(['article/list','type'=>'text'])?>">【往期回顾】</a></p>
                    </li>
                </ul>
            <?php
            } ?>
        </div>
        <div role="tabpanel" class="tab-pane" id="mv">
            <?php
            $articles = Kiwi::getArticle()->find()->where(['type' => 'mv'])->orderBy(['updated_at' => SORT_DESC])->limit(2)->all();
            foreach ($articles as $article) {
                $pictures = explode(',',$article->pictures);
                ?>
                <ul class="col-sm-6 interview-content">
                    <li class="col-xs-5">
                        <a href="<?= Yii::$app->urlManager->createUrl(['page','key'=>$article->key])?>"><img width="200" height="200" <?php if(!$article->pictures){?>data-src="holder.js/200x200/text:人物" <?php } ?>src="<?= is_array($pictures)?$pictures[0]:$pictures?>" alt="<?= $article->name;?>"/></a>
                    </li>
                    <li class="col-xs-7">
                        <p><a href="<?= Yii::$app->urlManager->createUrl(['page','key'=>$article->key])?>"><?= $article->name;?></a></p>
                        <p>作者：<?= $article->author;?></p>
                        <p>简介：<?php echo $article->short_d;?></p>
                        <p class="interview-link"><a href="<?= Yii::$app->urlManager->createUrl(['page','key'=>$article->key])?>">【查看详情】</a>&nbsp;&nbsp;<a href="<?= Url::to(['article/list','type'=>'mv'])?>">【往期回顾】</a></p>
                    </li>
                </ul>
            <?php
            } ?>
        </div>

    </div>
</div>
<div class="clear" style="margin-bottom: 20px"></div>

