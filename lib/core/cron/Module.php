<?php
/**
 * @author Lujie.Zhou(gao_lujie@live.cn)
 * @Date 10/15/2014
 * @Time 9:40 AM
 */

namespace core\cron;


use kiwi\helpers\DirHelper;
use core\auth\models\User;
use kiwi\Kiwi;
use yii\base\Event;
use yii\helpers\ArrayHelper;
use yii\rbac\Permission;
use yii\web\Application;

/**
 * Class Module
 *
 * @method array getPermissions()
 * @method array getAdmins()
 *
 * @package core\cron
 * @author Lujie.Zhou(gao_lujie@live.cn)
 */
class Module extends \kiwi\base\Module
{
    public $version = 'v0.1.0';

    public function bootstrap($app)
    {

    }
} 