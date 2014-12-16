<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model core\cron\models\Cron */

$this->title = 'Update Cron: ' . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Crons', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->cron_id]];
$this->params['breadcrumbs'][] = 'Update';
$this->params['topMenuKey'] = 'system';
$this->params['leftMenuKey'] = 'cron';
?>
<div class="cron-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
