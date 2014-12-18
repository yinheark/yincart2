<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model extensions\front\models\CustomerSales */

$this->title = 'Update Customer Sales: ' . ' ' . $model->customer_sales_id;
$this->params['breadcrumbs'][] = ['label' => 'Customer Sales', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->customer_sales_id, 'url' => ['view', 'id' => $model->customer_sales_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="customer-sales-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
