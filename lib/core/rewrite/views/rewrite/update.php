<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model core\rewrite\models\UrlRewrite */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Url Rewrite',
]) . ' ' . $model->url_rewrite_id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Url Rewrites'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->url_rewrite_id, 'url' => ['/view', 'id' => $model->url_rewrite_id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
$this->params['topMenuKey'] = 'system';
$this->params['leftMenuKey'] = 'rewrite';
?>
<div class="url-rewrite-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
