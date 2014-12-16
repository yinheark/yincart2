<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model core\auth\models\Admin */

$this->title = Yii::t('app', '新建 {modelClass}', [
    'modelClass' => Yii::t('app', '管理员'),
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', '管理员'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->params['topMenuKey'] = 'system';
$this->params['leftMenuKey'] = 'user';
?>
<div class="user-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
