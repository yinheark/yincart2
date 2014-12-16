<?php
/**
 * @author Lujie.Zhou(gao_lujie@live.cn)
 * @Date 10/15/2014
 * @Time 9:40 AM
 */

namespace core\auth;


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
 * @package core\auth
 * @author Lujie.Zhou(gao_lujie@live.cn)
 */
class Module extends \kiwi\base\Module
{
    public $version = 'v0.1.0';

    public static $config = ['permissions', 'admins'];

    protected $_permissions = [];

    public $configChildrenNames = ['groups', 'permissions'];

    public function bootstrap($app)
    {
        if ($app->id == 'backend') {
            Kiwi::registerClass(['class' => ['user' => 'core\auth\models\Admin']]);
        }

        $this->updatePermissions();
        $this->addAdminUser();
        $this->accessControl();
    }

    public function accessControl()
    {
        $accessControl = [
            'class' => \kiwi\filters\AccessControl::className(),
            'except' => ['site/login'],
            'rules' => [
                // deny all POST requests
                [
                    'class' => '\core\auth\filters\ActionAccessRule',
                    'allow' => true,
                ],
            ],
        ];
        $modules = \Yii::$app->params['KiwiModules'];
        foreach ($modules as $name => $class) {
            \Yii::$app->getModule($name)->attachBehavior('accessControl', $accessControl);
        }
        \Yii::$app->attachBehavior('accessControl', $accessControl);
    }

    public function addAdminUser()
    {
        $admins = $this->getAdmins();
        foreach ($admins as $admin) {
            /** @var \core\user\forms\SignupForm $user */
            $user = Kiwi::getSignupForm($admin);
            $user->signup();
        }
    }

    public $keySeparator = '_';

    public function updatePermissions()
    {
        $permissionKeys = $this->getPermissionKeys();
        $auth = \Yii::$app->getAuthManager();
        $permissions = $auth->getPermissions();
        foreach ($permissions as $permission) {
            if (isset($permissionKeys[$permission->name])) {
                unset($permissionKeys[$permission->name]);
            } else {
                $auth->remove($permission);
            }
        }
        foreach ($permissionKeys as $name => $desc) {
            $permission = new Permission();
            $permission->name = $name;
            $permission->description = $desc;
            $auth->add($permission);
        }
    }

    public function getPermissionKeys()
    {
        $permissionKeys = [];
        $permissions = $this->getPermissionsFromFile();
        foreach ($permissions as $moduleKey => $module) {
            foreach ($module['groups'] as $controllerKey => $group) {
                foreach ($group['permissions'] as $actionKey => $permission) {
                    $permissionKey = implode($this->keySeparator, [$moduleKey, $controllerKey, $actionKey]);
                    $permissionKeys[$permissionKey] = implode($this->keySeparator, [$module['label'], $group['label'], $permission['label']]);
                }
            }
        }
        return $permissionKeys;
    }

    /**
     * get permissions from file and sort
     * @return array
     */
    public function getPermissionsFromFile()
    {
        if (!$this->_permissions) {
            $permissions = $this->getPermissions();
            $this->_permissions = $this->sortConfig($permissions, $this->configChildrenNames);
        }
        return $this->_permissions;
    }

    protected function sortConfig($config, $childrenNames)
    {
        uasort($config, function ($a, $b) {
            if ($a['sort'] == $b['sort']) {
                return 0;
            }
            return ($a['sort'] < $b['sort']) ? -1 : 1;
        });

        if ($childrenNames) {
            $name = array_shift($childrenNames);
            foreach ($config as $key => $childConfig) {
                if (isset($childConfig[$name])) {
                    $config[$key][$name] = $this->sortConfig($config[$key][$name], $childrenNames);
                }
            }
        }

        return $config;
    }
} 