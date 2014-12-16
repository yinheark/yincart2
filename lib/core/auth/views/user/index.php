<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel core\auth\models\AdminSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', '管理员列表');
$this->params['breadcrumbs'][] = $this->title;
$this->params['topMenuKey'] = 'system';
$this->params['leftMenuKey'] = 'user';
?>
<div class="user-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', '新建 {modelClass}', [
            'modelClass' => Yii::t('app', '管理员')
        ]), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            ['label' =>  Yii::t('app', '管理员名称'), 'attribute' => 'username'],
            ['label' =>  Yii::t('app', '邮箱'), 'attribute' => 'email'],
//            'email:email',
            ['class' => 'yii\grid\ActionColumn', 'template' => '{update} {delete}'],
        ],
    ]); ?>

</div>
