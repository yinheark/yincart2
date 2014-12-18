<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model extensions\front\models\CustomerSales */

$this->title = 'Create Customer Sales';
$this->params['breadcrumbs'][] = ['label' => 'Customer Sales', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="customer-sales-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
