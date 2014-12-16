<?php


/* @var $this yii\web\View */

$this->title = Yii::t('app', 'Group');
$this->params['breadcrumbs'][] = $this->title;
$this->params['topMenuKey'] = 'yincart';
$this->params['leftMenuKey'] = 'group';

echo $this->render('@core/tree/views/tree/index');
