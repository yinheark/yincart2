<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Categories');
$this->params['breadcrumbs'][] = $this->title;
$this->params['topMenuKey'] = 'yincart';
$this->params['leftMenuKey'] = 'category';

echo $this->render('@core/tree/views/tree/index');
