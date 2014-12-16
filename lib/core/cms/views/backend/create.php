<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model core\cms\models\Cms */

$this->title = Yii::t('app', 'Create', [
    'modelClass' => $modelClass,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app',$modelClass), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cms-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
