<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model extensions\sales\models\CustomerSeller */

$this->title = $model->customer_id;
$this->params['breadcrumbs'][] = ['label' => 'Customer Sellers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$status = ['未审核','审核通过','审核未通过'];
?>
<div class="customer-seller-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
                'label'=>'用户名',
                'attribute'=>'user.username',
            ],
            [
                'label'=>'介绍人',
                'attribute'=>'referrer',
            ],
            [
                'label'=>'审核状态',
                'value'=> $status[$model->status],
            ],
        ],
    ]) ?>

</div>
