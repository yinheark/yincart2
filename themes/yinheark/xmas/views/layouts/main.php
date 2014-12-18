<?php
use backend\assets\AppAsset;
AppAsset::register($this);
list($path, $link) = $this->getAssetManager()->publish('@themes/xmas/assets/source');

use yii\helpers\Html;
?>
<?php $this->beginPage() ?>
<!doctype html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <?= Html::csrfMetaTags() ?>
    <title>大汉飞楼 - 引领电子商务新时尚</title>

    <!-- Bootstrap Core CSS -->
    <link href="<?= $link ?>/css/bootstrap.min.css" rel="stylesheet">

    <!-- Google Web Fonts -->
<!--    <link href="http://fonts.googleapis.com/css?family=Roboto+Condensed:300italic,400italic,700italic,400,300,700" rel="stylesheet" type="text/css">-->
<!--    <link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>-->

    <?php $this->head() ?>
    <!-- CSS Files -->
    <link href="<?= $link ?>/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="<?= $link ?>/css/style.css" rel="stylesheet">
    <link href="<?= $link ?>/css/responsive.css" rel="stylesheet">


    <!--[if lt IE 9]>
    <script src="<?= $link ?>/js/ie8-responsive-file-warning.js"></script>
    <![endif]-->

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Fav and touch icons -->
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?= $link ?>/images/fav-144.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?= $link ?>/images/fav-114.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?= $link ?>/images/fav-72.png">
    <link rel="apple-touch-icon-precomposed" href="<?= $link ?>/images/fav-57.png">
    <link rel="shortcut icon" href="<?= $link ?>/images/fav.png">
</head>
<body>
<?php $this->beginBody() ?>
<!-- Header Section Starts -->
<?php echo \webapp\widgets\Header::widget(); ?>
<!-- Header Section Ends -->
<?= $content ?>
<!-- Footer Section Starts -->
<?php echo \webapp\widgets\Footer::widget(); ?>
<!-- Footer Section Ends -->
<!-- JavaScript Files -->
<script src="<?= $link ?>/js/jquery-1.11.1.min.js"></script>
<script src="<?= $link ?>/js/jquery-migrate-1.2.1.min.js"></script>
<script src="<?= $link ?>/js/bootstrap.min.js"></script>
<script src="<?= $link ?>/js/bootstrap-hover-dropdown.min.js"></script>
<script src="<?= $link ?>/js/custom.js"></script>
<script src="<?= $link ?>/js/customerSales.js" ></script>
<script src="<?= $link ?>/js/holder.js" ></script>
<script src="<?= $link ?>/js/lrtk.js" ></script>
<script src="<?= $link ?>/js/pptBox.js" ></script>
<script src="<?= $link ?>/js/review.js" ></script>
<script src="<?= $link ?>/js/slides.jquery.js" ></script>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
<script type="text/javascript">
    $(function() {
        $('.search_name').click(function() {
            var name = $(' #search_name').val();
            window.location.href = $('.search_name').data('url')+ '?search_name='+name;
        });
    });
</script>
