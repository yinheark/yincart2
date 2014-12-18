<?php
/* @var $content string */

use yii\helpers\Html;
use yii\helpers\Url;

$this->beginContent('@app/views/layouts/main.php'); ?>

    <!-- Main Container Starts -->
    <div id="main-container" class="container">
        <!-- Breadcrumb Starts -->
        <ol class="breadcrumb">
            <li><a href="<?= Url::to(['/'])?>">首页</a></li>
            <li><a href="<?= Url::to(['/customer'])?>">会员中心</a></li>
            <li class="active"><?php print_r(isset($this->params['breadcrumbs']['title']) ? $this->params['breadcrumbs']['title'] : '');?></li>
        </ol>
        <!-- Breadcrumb Ends -->
        <!-- Starts -->
        <div class="row">
            <!-- Contact Details Starts -->
            <div class="col-sm-4">
                <div class="panel panel-smart">
                    <div class="panel-heading">
                        <h3 class="panel-title">会员中心</h3>
                    </div>
                    <div class="panel-body">
                        <ul class="list-unstyled contact-details">
                            <li class="clearfix">
                                <i class="fa fa-user pull-left"></i>
									<span class="pull-left">
										<?= Html::a('个人信息', ['/customer']) ?> <br/>
									</span>
                            </li>
                            <li class="clearfix">
                                <i class="fa fa-home pull-left"></i>
									<span class="pull-left">
										<?= Html::a('收货地址', ['/customer/delivery-address']) ?> <br/>
									</span>
                            </li>
                            <li class="clearfix">
                                <i class="fa fa-envelope-o pull-left"></i>
									<span class="pull-left">
										<?= Html::a('更改密码', ['/customer/request-password-reset']) ?> <br/>
									</span>
                            </li>
                        </ul>
                    </div>
                    <div class="panel-body">
                        <ul class="list-unstyled contact-details">
                            <li class="clearfix">
                                <i class="fa fa-crosshairs pull-left"></i>
									<span class="pull-left">
										<?= Html::a('销售记录', ['/customerSales']) ?> <br/>
									</span>
                            </li>
                            <?php
                            /** @var \yincart\customer\models\Customer $customer */
                            $customer = Yii::$app->user->identity;
                            if ($customer->customerSeller && $customer->customerSeller->status) {
                                ?>
                                <li class="clearfix">
                                    <i class="fa fa-crosshairs pull-left"></i>
									<span class="pull-left">
										<?= Html::a('我的积分', ['/customer/integral']) ?> <br/>
									</span>
                                </li>
                            <?php } ?>
                            <li class="clearfix">
                                <i class="fa fa-heart pull-left"></i>
									<span class="pull-left">
										<?= Html::a('我的订单', ['/customer/order']) ?> <br/>
									</span>
                            </li>
                            <li class="clearfix">
                                <i class="fa fa-shopping-cart pull-left"></i>
									<span class="pull-left">
										<?= Html::a('我的购物车', ['/cart']) ?> <br/>
									</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- Contact Details Ends -->
            <!-- Contact Form Starts -->
            <div class="col-sm-8">
                <div class="panel panel-smart">
                    <?= $content ?>
                </div>
            </div>
            <!-- Contact Form Ends -->
        </div>
        <!-- Ends -->
    </div>
    <!-- Main Container Ends -->
<?php $this->endContent(); ?>