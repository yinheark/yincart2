<?php

namespace yincart\customer\models;

use Yii;
use yii\base\NotSupportedException;
use yii\web\IdentityInterface;
use yincart\base\db\ActiveRecord;
use yincart\Yincart;

/**
 * This is the model class for table "customer".
 *
 * @property integer $customer_id
 * @property integer $customer_group_id
 * @property string $username
 * @property string $email
 * @property string $auth_key
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $password write-only password
 * @property integer $register_time
 * @property integer $last_login_time
 * @property integer $status
 *
 * @property Address[] $addresses
 * @property CustomerGroup $customerGroup
 * @property \yincart\sales\models\Order[] $orders
 * @property \yincart\sales\models\ShippingCart[] $shippingCarts
 * @property Wish[] $wishes
 *
 * @method static Customer getCustomer(int $id)
 */
class Customer extends ActiveRecord implements IdentityInterface
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%customer}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['customer_group_id', 'status'], 'default', 'value' => 1],
            [['password_reset_token'], 'default', 'value' => ''],
            [['customer_group_id', 'username', 'email', 'auth_key', 'password_hash', 'register_time', 'last_login_time'], 'required'],
            [['customer_group_id', 'register_time', 'last_login_time', 'status'], 'integer'],
            [['username', 'email', 'auth_key'], 'string', 'max' => 45],
            [['password_hash', 'password_reset_token'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'customer_id' => Yii::t('yincart', 'Customer ID'),
            'customer_group_id' => Yii::t('yincart', 'Customer Group ID'),
            'username' => Yii::t('yincart', 'Username'),
            'email' => Yii::t('yincart', 'Email'),
            'auth_key' => Yii::t('yincart', 'Auth Key'),
            'password_hash' => Yii::t('yincart', 'Password Hash'),
            'password_reset_token' => Yii::t('yincart', 'Password Reset Token'),
            'register_time' => Yii::t('yincart', 'Register Time'),
            'last_login_time' => Yii::t('yincart', 'Last Login Time'),
            'status' => Yii::t('yincart', 'Status'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAddresses()
    {
        return $this->hasMany(Yincart::$container->addressClass, ['customer_id' => 'customer_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomerGroup()
    {
        return $this->hasOne(Yincart::$container->customerGroupClass, ['customer_group_id' => 'customer_group_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrders()
    {
        return $this->hasMany(Yincart::$container->orderClass, ['customer_id' => 'customer_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShippingCarts()
    {
        return $this->hasMany(Yincart::$container->shippingCartClass, ['customer_id' => 'customer_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWishes()
    {
        return $this->hasMany(Yincart::$container->wishClass, ['customer_id' => 'customer_id']);
    }


    const STATUS_DELETED = 0;
    const STATUS_ACTIVE = 1;

    public $needConfirm = true;

    public $loginAfterRegister = true;

    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return static::findOne(['customer_id' => $id, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * Finds user by email
     *
     * @param string $email
     * @return static|null
     */
    public static function findByEmail($email)
    {
        return static::findOne(['email' => $email, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * Finds user by password reset token
     *
     * @param string $token password reset token
     * @return static|null
     */
    public static function findByPasswordResetToken($token)
    {
        $expire = Yii::$app->params['user.passwordResetTokenExpire'];
        $parts = explode('_', $token);
        $timestamp = (int) end($parts);
        if ($timestamp + $expire < time()) {
            // token expired
            return null;
        }

        return static::findOne([
            'password_reset_token' => $token,
            'status' => self::STATUS_ACTIVE,
        ]);
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomKey();
    }

    /**
     * Generates new password reset token
     */
    public function generatePasswordResetToken()
    {
        $this->password_reset_token = Yii::$app->security->generateRandomKey() . '_' . time();
    }

    /**
     * Removes password reset token
     */
    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }

    public function sendConfirmEmail()
    {
        return Yii::$app->getMailer()->compose('account/confirm', ['customer' => $this])
            ->setFrom(Yii::$app->params['adminEmail'])
            ->setTo($this->email)
            ->send();
    }

    public function sendResetPasswordEmail()
    {
        return Yii::$app->getMailer()->compose('account/resetPassword', ['customer' => $this])
            ->setFrom(Yii::$app->params['adminEmail'])
            ->setTo($this->email)
            ->send();
    }
}
