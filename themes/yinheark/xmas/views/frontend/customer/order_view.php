<?php
/**
 * @var $order yincart\order\models\Order
 * @var $orderItems yincart\order\models\OrderItem
 */
use yii\helpers\Html;

$orderItems = $order->getOrderItems()->all();
$this->params['breadcrumbs'] = [
    'title' => '我的订单'
];
?>
<div class="panel-heading">
    <h3 class="panel-title">订单详情</h3>
</div>
<div class="panel-body">
    <ul class="list-unstyled contact-details">
        <li class="clearfix">
            <span class="pull-left">
                订单号：<?= $order->order_no?><br/>
            </span>
        </li>
        <li class="clearfix">
            <span class="pull-left">
                下单时间：<?= date("Y-m-d H:i",$order->create_at);?><br/>
            </span>
        </li>
        <li class="clearfix">
            <span class="pull-left">
                收货地址：<?= $order->address;?><br/>
            </span>
        </li>
        <li class="clearfix">
            <span class="pull-left">
                订单商品：<br/>
            </span>
        </li>
        <table class="table table-bordered" style="text-align: center">
            <thead>
            <tr>
                <td></td>
                <td>商品名称</td>
                <td>数量</td>
                <td>商品单价（RMB）</td>
            </tr>
            </thead>
            <tbody>
            <?php
            $count = 1;
            foreach($orderItems as $orderItem) {
                /** @var $orderItem yincart\order\models\OrderItem */
                echo '<tr><td>'.$count.'</td><td>'.$orderItem->name.'</td><td>'.$orderItem->qty.'</td><td>'.$orderItem->price.'</td></tr>';
                $count++;
            }
            ?>
            </tbody>
            <tfoot>
            <tr>
                <td class="text-right" colspan="3">
                    <strong>运费 :</strong>
                </td>
                <td class="text-left"> <?= $order->shipping_fee?> </td>
            </tr>
            <tr>
                <td class="text-right" colspan="3">
                    <strong>小结 :</strong>
                </td>
                <td class="text-left"> <?= $order->total_price?> </td>
            </tr>
            </tfoot>
        </table>
        <?= Html::a(Yii::t('app', '支付'), ['alipay/index?id='.$order->order_id],
            [
                'class' => 'btn btn-danger pull-right ',
                'style' => "line-height:2.429;margin-right:15px;"])
        ?>
    </ul>
</div>
