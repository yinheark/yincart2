<?php
/**
 * @link http://www.yincart.com/
 * @copyright Copyright (c) 2014 Yincart
 * @license http://www.yincart.com/license/
 */

use yii\bootstrap\ActiveForm;
use yincart\Yincart;

/** @var \yincart\customer\models\LoginForm $loginForm */
/** @var \yincart\customer\models\RegisterForm $registerForm */

if (!isset($loginForm)) $loginForm = Yincart::$container->loginForm;
if (!isset($registerForm)) $registerForm = Yincart::$container->registerForm;
?>

<section id="content">
    <div class="container">

        <ol class="breadcrumb">
            <li><a href="#">Home</a></li>
            <li>Account Login</li>
        </ol>

        <h1 class="page-title">My Account Log In</h1>

        <div class="gap-10"></div>

        <div class="row">
            <div class="col-sm-6">

                <h3>Log In</h3>

                <div class="gap-20"></div>
                <?php $checkboxTemplate = "<div class=\"checkbox pull-left\">\n{beginLabel}\n{input}\n{labelTitle}\n{endLabel}\n{error}\n{hint}\n</div>" ?>
                <?php $form = ActiveForm::begin(['id' => 'login-form', 'action' => ['account/login']]) ?>
                <?= $form->field($loginForm, 'username')->textInput(['placeholder' => 'Username']) ?>
                <?= $form->field($loginForm, 'password')->passwordInput(['placeholder' => 'Password']) ?>
                <?= $form->field($loginForm, 'rememberMe', ['checkboxTemplate' => $checkboxTemplate])->checkbox() ?>
                <a href="#" class="pull-left" id="forgot-password">Forgot Your Password?</a>

                <div class="pull-right">
                    <button type="submit" class="btn btn-primary btn-lg">Log In</button>
                </div>
                <?php $form->end() ?>
                <div class="gap-30"></div>

            </div>
            <div class="col-sm-6">

                <h3>Create A Account</h3>

                <div class="gap-15"></div>

                <?php $form = ActiveForm::begin(['id' => 'register-form', 'action' => ['account/register']]) ?>
                <?= $form->field($registerForm, 'username')->textInput(['placeholder' => 'Username']) ?>
                <?= $form->field($registerForm, 'email')->textInput(['placeholder' => 'Email']) ?>
                <?= $form->field($registerForm, 'password')->passwordInput(['placeholder' => 'Password']) ?>
                <?= $form->field($registerForm, 'password_repeat')->passwordInput(['placeholder' => 'Password Repeat']) ?>
                <?= $form->field($registerForm, 'agree', ['checkboxTemplate' => $checkboxTemplate])->checkbox() ?>
                <div class="pull-right">
                    <button type="submit" class="btn btn-primary btn-lg">Sign Up</button>
                </div>
                <?php $form->end() ?>
            </div>
        </div>


    </div>
</section>