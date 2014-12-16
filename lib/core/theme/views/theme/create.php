<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model core\theme\models\Theme */

$this->title = Yii::t('app', 'Create {modelClass}', [
    'modelClass' => 'Theme',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Themes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->params['topMenuKey'] = 'system';
$this->params['leftMenuKey'] = 'theme';
?>
<div class="theme-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
