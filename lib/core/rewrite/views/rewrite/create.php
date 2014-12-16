<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model core\rewrite\models\UrlRewrite */

$this->title = Yii::t('app', 'Create {modelClass}', [
    'modelClass' => 'Url Rewrite',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Url Rewrites'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->params['topMenuKey'] = 'system';
$this->params['leftMenuKey'] = 'rewrite';
?>
<div class="url-rewrite-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
