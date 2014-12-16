<?php
namespace core\auth\models;

use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use kiwi\db\ActiveRecord;
use yii\web\IdentityInterface;

/**
 * User model
 */
class Admin extends \core\user\models\User
{
    const ROLE_USER = 11;
}
