<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model core\cron\models\Cron */

$this->title = 'Create Cron';
$this->params['breadcrumbs'][] = ['label' => 'Crons', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->params['topMenuKey'] = 'system';
$this->params['leftMenuKey'] = 'cron';
?>
<div class="cron-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
