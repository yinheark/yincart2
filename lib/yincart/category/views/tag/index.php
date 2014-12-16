<?php


/* @var $this yii\web\View */

$this->title = Yii::t('app', 'Tag');
$this->params['breadcrumbs'][] = $this->title;
$this->params['topMenuKey'] = 'yincart';
$this->params['leftMenuKey'] = 'tag';

echo $this->render('@core/tree/views/tree/index');
