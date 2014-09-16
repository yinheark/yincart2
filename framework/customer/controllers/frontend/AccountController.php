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
                $this->redirect(['account/success']);
            }
        }
        return $this->render('login', ['registerForm' => $registerForm]);
    }

    public function actionLogout()
    {
        \Yii::$app->getUser()->logout();
        \Yii::$app->getResponse()->redirect('/');
    }

    public function actionSendConfirmEmail($email)
    {
        $customer = Yincart::$container->customer;
        if ($customer->needConfirm) {
            /** @var \yincart\customer\models\Customer $customer */
            $customer = $customer->findByEmail($email);
            if ($customer) {
                $customer->sendConfirmEmail();
            }
        }
    }

    public function actionForgetPassword()
    {

    }

    public function actionSendForgetPasswordEmail($username)
    {
        $customerClass = Yincart::$container->customerClass;
        /** @var \yincart\customer\models\Customer $customer */
        $customer = $customerClass::findByUsername($username);
        if ($customer) {
            $customer->sendResetPasswordEmail();
        }
    }

    public function actionAddress()
    {
        /** @var \yincart\customer\models\Customer $customer */
        $customer = \Yii::$app->getUser()->getIdentity();
        $addresses = $customer->addresses;
        return $this->render('address', ['addresses' => $addresses]);
    }

    public function actionOrders()
    {
        /** @var \yincart\customer\models\Customer $customer */
        $customer = \Yii::$app->getUser()->getIdentity();
        $orders = $customer->orders;
        return $this->render('order', ['orders' => $orders]);
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