<?php
/**
 * @author: changhai.lin
 * @Date: 2014/12/6
 * @Time: 20:38
 */
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
?>
<!-- Main Container Starts -->
<div id="main-container" class="container">
    <!-- Breadcrumb Starts -->
    <ol class="breadcrumb">
        <li><a href="<?= Url::to(['/']);?>">首页</a></li>
        <li class="active">登陆</li>
    </ol>
    <!-- Breadcrumb Ends -->
    <!-- Main Heading Starts -->
    <h2 class="main-heading text-center">
        登陆或者创建新用户
    </h2>
    <!-- Main Heading Ends -->
    <!-- Login Form Section Starts -->
    <section class="login-area">
        <div class="row">
            <div class="col-sm-6">
                <!-- Login Panel Starts -->
                <div class="panel panel-smart">
                    <div class="panel-heading">
                        <h3 class="panel-title">登陆</h3>
                    </div>
                    <div class="panel-body">
                        <p>
                            请用您已有的账户登陆
                        </p>
                        <!-- Login Form Starts -->
                        <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>
                        <?= $form->field($model, 'username') ?>
                        <?= $form->field($model, 'password')->passwordInput() ?>
                        <?= $form->field($model, 'rememberMe')->checkbox() ?>
                        <div style="color:#999;margin:1em 0">
                            如果您忘记密码，您可以 <?= Html::a('重置密码', ['site/request-password-reset']) ?>.
                        </div>
                        <div class="form-group">
                            <?= Html::submitButton('登陆', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                        </div>
                        <?php ActiveForm::end(); ?>
                        <!-- Login Form Ends -->
                    </div>
                </div>
                <!-- Login Panel Ends -->
            </div>
            <div class="col-sm-6">
                <!-- Account Panel Starts -->
                <div class="panel panel-smart">
                    <div class="panel-heading">
                        <h3 class="panel-title">
                            创建新账户
                        </h3>
                    </div>
                    <div class="panel-body">
                        <p>
                            注册新用户成为本网站的会员！
                        </p>
                        <a href="<?= Url::to(['user/signup'])?>" class="btn btn-warning">
                            注册
                        </a>
                    </div>
                </div>
                <!-- Account Panel Ends -->
            </div>
        </div>
    </section>
    <!-- Login Form Section Ends -->
</div>
<!-- Main Container Ends -->