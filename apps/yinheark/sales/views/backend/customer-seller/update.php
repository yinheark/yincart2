<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model extensions\sales\models\CustomerSeller */

$this->title = 'Update Customer Seller: ' . ' ' . $model->customer_id;
$this->params['breadcrumbs'][] = ['label' => 'Customer Sellers', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->customer_id, 'url' => ['view', 'id' => $model->customer_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="customer-seller-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
