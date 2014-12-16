<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model core\auth\models\RoleModel */

$this->title = Yii::t('app', '更新 {modelClass}: ', [
    'modelClass' => Yii::t('app', '角色'),
]) . ' ' . $model->description;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Roles'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->description, 'url' => ['/view', 'id' => $model->description]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
$this->params['topMenuKey'] = 'system';
$this->params['leftMenuKey'] = 'role';
?>
<div class="role-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
