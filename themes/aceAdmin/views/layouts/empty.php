<?php
/**
 * @link http://www.yincart.com/
 * @copyright Copyright (c) 2014 Yincart
 * @license http://www.yincart.com/license/
 */

/** @var string $content */

use yii\helpers\Html;
use yincart\Yincart;

Yincart::$container->aceAdminAsset->register($this);
Yincart::$container->jqueryFormAsset->register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
    <meta charset="<?= Yii::$app->charset ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0"/>
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>

<body class="no-skin">
<?php $this->beginBody() ?>
<?= $this->render('/layouts/navbar') ?>
<div class="main-container" id="main-container">
    <?= $content ?>
    <?= $this->render('/layouts/footer') ?>
</div>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
