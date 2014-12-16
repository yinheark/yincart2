<?php
use backend\assets\AppAsset;
use kartik\widgets\SideNav;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use yii\helpers\ArrayHelper;

/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
<?php
/** @var \core\setting\Module $settingModule */
$settingModule = Yii::$app->getModule('core_setting');
?>
<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => 'Yincart',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    $topMenuItems = $settingModule->getTopMenu();
    $topMenuItems = ArrayHelper::merge([['label' => 'Home', 'url' => ['/site/index']]], $topMenuItems);
    if (isset($this->params['topMenuKey'])) {
        $topMenuKey = $this->params['topMenuKey'];
//        $topMenuItems[$topMenuKey]['active'] = true;
        $leftKey = $topMenuItems[$topMenuKey]['leftMenuKey'];
        $leftKey = $topMenuItems[$topMenuKey]['leftMenuKey'];
        $leftMenuItems = $settingModule->getLeftMenu($leftKey);
        if (isset($this->params['leftMenuKey'])) {
            $leftMenuKey = $this->params['leftMenuKey'];
            foreach ($leftMenuItems as $menu) {
                if (isset($menu[$leftMenuKey])) {
//                    $menu[$leftMenuKey]['active'] = true;
                }
            }
        }
    }

    if (Yii::$app->user->isGuest) {
        $topMenuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
    } else {
        $topMenuItems[] = [
            'label' => 'Logout (' . Yii::$app->user->identity->username . ')',
            'url' => ['/site/logout'],
            'linkOptions' => ['data-method' => 'post'],
        ];
    }

    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $topMenuItems,
    ]);
    NavBar::end();
    ?>

    <div class="container" style="width: 100%">
        <div class="left col-sm-2">
            <?php
            if (isset($leftMenuItems)) {
                echo SideNav::widget([
                    'items' => $leftMenuItems,
                ]);
            }
            ?>
        </div>
        <div class="right col-sm-10">
            <?= Breadcrumbs::widget(['links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],]) ?>
            <?= $content ?>
        </div>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; Yincart <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
