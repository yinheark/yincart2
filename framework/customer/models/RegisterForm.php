<?php
/**
 * @link http://www.yincart.com/
 * @copyright Copyright (c) 2014 Yincart
 * @license http://www.yincart.com/license/
 */

namespace yincart\customer\models;

use yii\base\Model;
use yincart\Yincart;

class RegisterForm extends Model
{
    public $username;
    public $email;
    public $password;
    public $password_repeat;
    public $agree;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'email', 'password', 'password_repeat'], 'required'],
            ['password_repeat', 'compare', 'compareAttribute' => 'password'],
            [['username', 'email', 'password', 'password_repeat'], 'string', 'max' => 45],
            ['username', 'validateUsername'],
            ['email', 'validateEmail'],
            ['agree', 'validateAgree']
        ];
    }

    public function validateAgree()
    {
        if ($this->agree != 1) {
            $this->addError('agree', \Yii::t('yincart', 'You must agree.'));
        }
    }

    public function validateUsername()
    {
        $customerClass = Yincart::$container->customerClass;
        if ($customerClass::findByUsername($this->username)) {
            $this->addError('username', \Yii::t('yincart', 'Username has exist.'));
        }
    }

    public function validateEmail()
    {
        $customerClass = Yincart::$container->customerClass;
        if ($customerClass::findByEmail($this->email)) {
            $this->addError('email', \Yii::t('yincart', 'Email has exist.'));
        }
    }

    public function register()
    {
        if ($this->validate()) {
            $customer = Yincart::$container->getCustomer(['username' => $this->username, 'email' => $this->email]);
            $customer->setPassword($this->password);
            $customer->generateAuthKey();
            if ($customer->save()) {
                \Yii::$app->user->login($customer);
                return true;
            }
        }
        return false;
    }
}