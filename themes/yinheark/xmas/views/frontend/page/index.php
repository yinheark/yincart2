<?php
/**
 * @author Cangzhou Wu<wucang.zhou@jago-ag.cn>
 * @Date: 14-12-9
 * @Time: 上午8:51
 */

use yii\helpers\Url;
use kiwi\Kiwi;
?>
<div id="main-container" class="container">
    <div class="row">
        <!-- Primary Content Starts -->
        <div class="col-md-9">
            <!-- Breadcrumb Starts -->
            <ol class="breadcrumb">
                <li><a href="<?= Url::to(['site/index']) ?>">首页</a></li>
                <li class="active"><?= $page->name ?></li>
            </ol>
            <div class="panel" style="margin-top: 20px;word-wrap:break-word; padding: 20px">
                <!-- Product List Display Starts -->

                    <?php if (isset($page)&&$page->content) { ?>.
                        <h1 style="color: #9B6BCC;"><?= $page->name ?></h1>
                        <i class="fa fa-calendar" ></i><?= date('Y-m-d',$page->created_at) ?><span style="margin-left:20px ">作者：<?= $page->author ?></span>

                        <?= isset($page->content)?$page->content:'暂无数据' ?><br><br>
                    <?php } else echo Yii::t('app', 'No Data') ?>

            </div>

        </div>
        <div class="col-md-3">
            <!-- Categories Links Starts -->
            <h3 class="side-heading">访谈目录</h3>
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
            <!-- Categories Links Starts -->
            <h3 class="side-heading">导航目录</h3>
            <div class="list-group">
                <a href="<?= Url::to(['page/index','key'=>'notice'])?>" class="list-group-item"><i class="fa fa-chevron-right"></i>顾客必读</a>
                <a href="<?= Url::to(['page/index','key'=>'memberrank'])?>" class="list-group-item"><i class="fa fa-chevron-right"></i>会员等级折扣</a>
                <a href="<?= Url::to(['page/index','key'=>'orderstatus'])?>" class="list-group-item"><i class="fa fa-chevron-right"></i>订单的几种状态</a>
                <a href="<?= Url::to(['page/index','key'=>'scoreplan'])?>" class="list-group-item"><i class="fa fa-chevron-right"></i>积分奖励计划</a>
                <a href="<?= Url::to(['page/index','key'=>'returngood'])?>" class="list-group-item"><i class="fa fa-chevron-right"></i>商品退货保障</a>
                <a href="<?= Url::to(['page/index','key'=>'nonmember'])?>" class="list-group-item"><i class="fa fa-chevron-right"></i>非会员购物通道</a>
                <a href="<?= Url::to(['page/index','key'=>'service'])?>" class="list-group-item"><i class="fa fa-chevron-right"></i>售后服务</a>
                <a href="<?= Url::to(['page/index','key'=>'terms'])?>" class="list-group-item"><i class="fa fa-chevron-right"></i>网站使用条款</a>
                <a href="<?= Url::to(['page/index','key'=>'disclaimer'])?>" class="list-group-item"><i class="fa fa-chevron-right"></i>免责条款</a>
                <a href="<?= Url::to(['page/index','key'=>'process'])?>" class="list-group-item"><i class="fa fa-chevron-right"></i>简单的购物流程</a>
                <a href="<?= Url::to(['page/index','key'=>'payment'])?>" class="list-group-item"><i class="fa fa-chevron-right"></i>支付方式</a>
                <a href="<?= Url::to(['page/index','key'=>'shipping'])?>" class="list-group-item"><i class="fa fa-chevron-right"></i>配送方式</a>
                <a href="<?= Url::to(['page/index','key'=>'orderinfo'])?>" class="list-group-item"><i class="fa fa-chevron-right"></i>订单何时出库</a>
                <a href="<?= Url::to(['page/index','key'=>'onlinepayment'])?>" class="list-group-item"><i class="fa fa-chevron-right"></i>网上支付小贴士</a>
                <a href="<?= Url::to(['page/index','key'=>'shippinginfo'])?>" class="list-group-item"><i class="fa fa-chevron-right"></i>关于送货和验货</a>
            </div>
            <!-- Categories Links Ends -->
            <!-- Shopping Options Starts -->

        </div>

    </div>
</div>