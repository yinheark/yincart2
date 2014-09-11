<?php
/**
 * @link http://www.yincart.com/
 * @copyright Copyright (c) 2014 Yincart
 * @license http://www.yincart.com/license/
 */

namespace yincart\customer\controllers\frontend;

use yincart\base\web\Controller;
use yincart\Yincart;

class AccountController extends Controller
{
    public function actionLogin()
    {
        $loginForm = Yincart::$container->loginForm;
        if (\Yii::$app->getRequest()->getIsPost()) {
            $loginForm->load(\Yii::$app->getRequest()->post(), 'LoginForm');
            if ($loginForm->login()) {
                $this->redirect(['account/index']);
            }
        }
        return $this->render('login', ['loginForm' => $loginForm]);
    }

    public function actionRegister()
    {
        $registerForm = Yincart::$container->registerForm;
        if (\Yii::$app->getRequest()->getIsPost()) {
            $registerForm->load(\Yii::$app->getRequest()->post(), 'RegisterForm');
            if ($registerForm->register()) {
                $this->redirect(['account/index']);
            }
        }
        return $this->render('login', ['registerForm' => $registerForm]);
    }

    public function actionSendConfirmEmail()
    {

    }

    public function actionForgetPassword()
    {

    }

    public function actionSendForgetPasswordEmail()
    {

    }

    public function actionAddress()
    {

    }

    public function actionOrders()
    {

    }

    public function actionWishes()
    {

    }

    public function actionSaveAddress()
    {

    }

    public function actionDelAddress()
    {

    }

    public function actionRemoveWish()
    {

    }
} 