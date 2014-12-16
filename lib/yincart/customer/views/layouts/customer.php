<?php
/* @var $content string */

use yii\helpers\Html;
?>

<!--$this->beginContent('@app/views/layouts/main.php'); ?>-->
<div class="big-box container_24" >
    <div class="big-box-left grid_4" style="width:150px">
        <div class="box my-sidenav" style="font:14px;">
            <div class="box-title">我的账户</div>
            <div class="box-content">
                <ul>
                    <li><?= Html::a('个人信息', ['/customer']) ?></li>
                    <li><?= Html::a('收货地址', ['/customer/delivery-address']) ?></li>
                    <li><?= Html::a('更改密码', ['/customer/request-password-reset'])?></li>
                </ul>
            </div>
            <div class="box-title">我的交易</div>
            <div class="box-content">
                <ul>
                    <li><?= Html::a('我的订单', ['/customer/order']) ?></li>
                    <li><?= Html::a('我的购物车', ['/cart']) ?></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="big-box-right grid_20">
        <div id="content">
            <?= $content; ?>
        </div><!-- content -->
    </div>
    <div class="clr"></div>

</div>
<?php //$this->endContent(); ?>