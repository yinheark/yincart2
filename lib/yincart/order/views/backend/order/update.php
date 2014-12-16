<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\bootstrap\Tabs;
use \kiwi\Kiwi;

/* @var $this yii\web\View */
/* @var $model yincart\order\models\Order */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
        'modelClass' => 'Order',
    ]) . ' ' . $model->order_id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Orders'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->order_id, 'url' => ['view', 'id' => $model->order_id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="order-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php
    $items = [];

    $orderInfo = DetailView::widget([
        'model' => $model,
//        'condensed'=>true,
//        'hover'=>true,
//        'mode'=>DetailView::MODE_VIEW,
//        'panel'=>[
//            'heading'=>'Update # ' . $model->order_id,
//            'type'=>DetailView::PANEL_INFO,
//        ],
        'attributes' => [
            'total_price',
            'shipping_fee',
            'payment_fee',
            'address',
            'memo',
            'create_at',
            'update_at',
            'status',
        ]
    ]);

    if ($model->payment) {
        $paymentInfo = DetailView::widget([
            'model' => $model->payment,
//        'condensed'=>true,
//        'hover'=>true,
//        'mode'=>DetailView::MODE_VIEW,
//        'panel'=>[
//            'heading'=>'Update # ' . $model->order_id,
//            'type'=>DetailView::PANEL_INFO,
//        ],
            'attributes' => [
                'payment_method',
                'payment_fee',
                'transcation_no',
                'create_at',

            ]
        ]);
    } else {
        $paymentInfo = Yii::t('app', 'Not Paid');
    }

    if ($model->payment) {
        if ($model->shipment) {
            $shipmentInfo = DetailView::widget([
                'model' => $model->shipment,
//        'condensed'=>true,
//        'hover'=>true,
//        'mode'=>DetailView::MODE_VIEW,
//        'panel'=>[
//            'heading'=>'Update # ' . $model->order_id,
//            'type'=>DetailView::PANEL_INFO,
//        ],
                'attributes' => [
                    'shipment_method',
                    'trace_no',
                    'create_at',
                ]
            ]);
        } else {
            $shipment =  Kiwi::getShipment(['order_id'=> $model->order_id]);
            $shipmentInfo = $this->render('shipment', [
                'model' => $shipment,
            ]);
        }
    } else {
        $shipmentInfo = Yii::t('app', 'Not Paid');
    }

    $items = [
        ['label' => Yii::t('app', 'Order'), 'content' => $orderInfo],
        ['label' => Yii::t('app', 'Payment'), 'content' => $paymentInfo],
        ['label' => Yii::t('app', 'Shipment'), 'content' => $shipmentInfo],
        ['label' => Yii::t('app', 'Refund'), 'content' => ''],
    ];

    echo Tabs::widget(['items' => $items]);

    ?>

</div>
