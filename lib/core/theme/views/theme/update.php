<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model core\theme\models\Theme */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Theme',
]) . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Themes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['/view', 'id' => $model->theme_id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
$this->params['topMenuKey'] = 'system';
$this->params['leftMenuKey'] = 'theme';
?>
<div class="theme-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
