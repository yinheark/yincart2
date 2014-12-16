<?php

use kiwi\Kiwi;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap\Tabs;
use yii\data\ActiveDataProvider;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Data Lists');
$this->params['breadcrumbs'][] = $this->title;
$this->params['topMenuKey'] = 'system';
$this->params['leftMenuKey'] = 'dataList';
?>
<div class="data-list-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create {modelClass}', [
            'modelClass' => 'Data List',
        ]), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php $items = [];
    foreach ($dataLists as $type => $dataList) {
        $content = GridView::widget([
            'dataProvider' => new ActiveDataProvider(['query' => Kiwi::getDataList()->find()->where(['type' => $type])]),
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                'key',
                'value',

                ['class' => 'yii\grid\ActionColumn'],
            ],
        ]);
        $items[] = ['label' => $dataList['label'], 'content' => $content];
    }
    echo Tabs::widget(['items' => $items]);
    ?>
</div>


