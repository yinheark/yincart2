<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model core\comment\models\Comment */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Comment',
]) . ' ' . $model->comment_id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Comments'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->comment_id, 'url' => ['view', 'id' => $model->comment_id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="comment-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
