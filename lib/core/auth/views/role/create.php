<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $roleModel core\auth\models\RoleModel */

$this->title = Yii::t('app', '新建 {modelClass}', [
    'modelClass' => Yii::t('app', '角色'),
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', '角色'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->params['topMenuKey'] = 'system';
$this->params['leftMenuKey'] = 'role';
?>
<div class="role-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
