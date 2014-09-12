<?php
/**
 * @link http://www.yincart.com/
 * @copyright Copyright (c) 2014 Yincart
 * @license http://www.yincart.com/license/
 */

/** @var \yii\web\View $this */
/** @var string $content */

use yii\helpers\Html;
use yincart\Yincart;

$garbiniAssetClass = Yincart::$container->garbiniAssetClass;
$garbiniAssetClass::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
    <meta charset="<?= Yii::$app->charset ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
<!-- Header -->
<?= $this->render('/layouts/header') ?>

<!-- ========== MENU END ========== -->

<!-- ========== SLIDER START ========== -->

<?php //$this->render('/layouts/slider') ?>

<!-- ========== SLIDER END ========== -->

<!-- ========== CONTENT START ========== -->

<?php //$this->render('/layouts/content') ?>
<?= $content ?>

<!-- ========== CONTENT END ========== -->

<!-- ========== FOOTER START ========== -->

<?= $this->render('/layouts/footer') ?>

<!-- ========== FOOTER END ========== -->

<?= $this->render('/layouts/cart') ?>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>