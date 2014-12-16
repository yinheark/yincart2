<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model core\setting\models\DataList */

$this->title = Yii::t('app', 'Create {modelClass}', [
    'modelClass' => 'Data List',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Data Lists'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->params['topMenuKey'] = 'system';
$this->params['leftMenuKey'] = 'dataList';
?>
<div class="data-list-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
