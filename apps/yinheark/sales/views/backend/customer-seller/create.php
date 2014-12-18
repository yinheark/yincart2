<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model extensions\sales\models\CustomerSeller */

$this->title = 'Create Customer Seller';
$this->params['breadcrumbs'][] = ['label' => 'Customer Sellers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="customer-seller-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
