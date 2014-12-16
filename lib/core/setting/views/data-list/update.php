<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model core\setting\models\DataList */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Data List',
]) . ' ' . $model->data_list_id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Data Lists'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->data_list_id, 'url' => ['view', 'id' => $model->data_list_id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
$this->params['topMenuKey'] = 'system';
$this->params['leftMenuKey'] = 'dataList';
?>
<div class="data-list-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
