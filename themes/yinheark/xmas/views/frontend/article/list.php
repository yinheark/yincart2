<?php
use yii\widgets\LinkPager;
use kiwi\Kiwi;
use yii\helpers\Url;

$type = ['fashion'=>'时尚资讯','mv'=>'视频访谈','text'=>'文字访谈']
?>
<!-- Main Container Starts -->
<div id="main-container" class="container">
<div class="row">
<!-- Primary Content Starts -->
<div class="col-md-9">
    <!-- Breadcrumb Starts -->
    <ol class="breadcrumb">
        <li><a href="<?= Url::to(['site/index']) ?>">Home</a></li>
        <li class="active"><?= $type[htmlspecialchars(Yii::$app->request->get('type'))] ?></li>
    </ol>
    <!-- Product List Display Starts -->
    <div class="row">
        <!-- Product #1 Starts -->
        <?php
        foreach($articleModels as $article){
            $pictures = explode(',',$article->pictures);
            ?>
            <div class="col-xs-12">
                <div class="product-col list clearfix">
                    <div class="image">
                        <img src="<?=is_array($pictures)?$pictures[0]:$pictures ?>" alt="product" class="img-responsive"  style="width:333px;height:285px;" />
                    </div>
                    <div class="caption">
                        <h2><a href="<?= Url::to(['page/index','key'=>$article->key]) ?>" style="color: #9B6BCC"><?= $article->name ?></a></h2>
                        <div class="description">
                            <?= $article->short_d ?>
                        </div>
                        <div class="price">
                            <p>作者：<?= $article->author ?> </p>
                            <p >创作时间：<?= date('Y-m-d,H:i:s',$article->created_at) ?></p>
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
        <a href="<?= Url::to(['/article/list','type'=>'fashion']) ?>" class="list-group-item">
            <i class="fa fa-chevron-right"></i>
            时尚资讯
        </a>
        <a href="<?= Url::to(['/article/list','type'=>'mv']) ?>" class="list-group-item">
            <i class="fa fa-chevron-right"></i>
            视频访谈
        </a>
        <a href="<?= Url::to(['/article/list','type'=>'text']) ?>" class="list-group-item">
            <i class="fa fa-chevron-right"></i>
            文字访谈
        </a>
    </div>
    <!-- Categories Links Ends -->
    <!-- Shopping Options Starts -->

</div>
<!-- Sidebar Ends -->
</div>
</div>
<!-- Main Container Ends -->