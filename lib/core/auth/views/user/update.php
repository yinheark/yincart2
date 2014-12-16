<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model core\auth\models\AdminModel */

$this->title = Yii::t('app', '更新 {modelClass}: ', [
    'modelClass' => Yii::t('app', '管理员'),
]) . ' ' . $model->user->username;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', '管理员'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->user->username, 'url' => ['/view', 'id' => $model->user->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
$this->params['topMenuKey'] = 'system';
$this->params['leftMenuKey'] = 'user';
?>
<div class="user-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
