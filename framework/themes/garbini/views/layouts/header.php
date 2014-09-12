<?php
/**
 * @link http://www.yincart.com/
 * @copyright Copyright (c) 2014 Yincart
 * @license http://www.yincart.com/license/
 */

use yii\helpers\Url;
use yincart\Yincart;

$garbiniPath = \Yii::$app->getAssetManager()->publish(\yincart\Yincart::$container->garbiniAsset->sourcePath);

$categoryClass = Yincart::$container->categoryClass;
$category = $categoryClass::getCategory(1);
$categoryMenu = $category ? $category->getCategoryMenu() : [];
?>
<header id="header">

    <!-- ========== TOP BAR START ========== -->

    <div id="top-bar">
        <div class="container">

            <nav id="language-selector">
                <ul class="nav nav-pills">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">English <b class="caret"></b></a>
                        <ul role="menu" class="dropdown-menu">
                            <li><a href="#">German</a></li>
                            <li><a href="#">Spanish</a></li>
                            <li><a href="#">Italian</a></li>
                        </ul>
                    </li>
                </ul>
            </nav>

            <nav id="shopping-cart">
                <a href="#">
                    <i class="fa fa-shopping-cart fa-lg"></i>
                    Cart
                    <span class="fa-stack">
                        <i class="fa fa-circle fa-stack-2x"></i>
                        <i class="fa fa-stack-1x fa-inverse">3</i>
                    </span>
                </a>
            </nav>

            <nav id="top-nav" role="navigation" class="navbar">
                <div class="navbar-header">
                    <button data-target=".top-nav" data-toggle="collapse" class="navbar-toggle" type="button">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>
                <div class="collapse navbar-collapse top-nav">
                    <ul class="nav navbar-nav">
                        <li><a href="<?= Url::to(['cms/about']) ?>">About</a></li>
                        <li><a href="<?= Url::to(['cms/blog']) ?>">Blog</a></li>
                        <li><a href="<?= Url::to(['cms/contact']) ?>">Contact</a></li>
                        <?php if (Yii::$app->getUser()->getIsGuest()) { ?>
                            <li><a href="<?= Url::to(['account/login']) ?>">LogIn / Register</a></li>
                        <?php } else { ?>
                            <li><a href="<?= Url::to(['account/index']) ?>"><?= Yii::$app->getUser()->getIdentity()->username ?></a></li>
                        <?php } ?>
                    </ul>
                </div>
                <!-- /.navbar-collapse -->
            </nav>

        </div>
    </div>
    <!-- / #top-bar -->

    <!-- ========== TOP BAR START ========== -->

    <!-- ========== MENU START ========== -->

    <nav id="main-nav">
        <div class="navbar">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".main-nav">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="<?= Url::home() ?>"><img src="<?= $garbiniPath[1] ?>/img/logo.png"
                                                                           alt="Garbini"
                                                                           class="img-responsive"></a>
                </div>
                <div class="navbar-collapse collapse main-nav">
                    <ul class="nav navbar-nav navbar-right">
                        <?php foreach ($categoryMenu as $category) { ?>
                            <li class="dropdown">
                                <?php if ($category['children']) { ?>
                                    <a href="<?= Url::to(['catalog/' . $category['category_id']]) ?>"
                                       class="dropdown-toggle" data-toggle="dropdown">
                                        <?= $category['name'] ?>
                                        <b class="caret"></b>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <?php foreach ($category['children'] as $childCategory) { ?>
                                            <li>
                                                <a href="<?= Url::to(['catalog/' . $childCategory['category_id']]) ?>"><?= $childCategory['name'] ?></a>
                                            </li>
                                        <?php } ?>
                                    </ul>
                                <?php } else { ?>
                                    <a href="<?= Url::to(['catalog/' . $category['category_id']]) ?>"
                                       class="dropdown-toggle" data-toggle=""><?= $category['name'] ?></a>
                                <?php } ?>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        </div>
    </nav>

</header>