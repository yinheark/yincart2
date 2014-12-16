<?php
/**
 * @author Lujie.Zhou(gao_lujie@live.cn)
 * @Date 10/17/2014
 * @Time 4:24 PM
 */

namespace core\auth\filters;


use kiwi\filters\AccessRule;
use yii\base\Application;

/**
 * Class ActionAccessRule
 *
 * public function behaviors()
 * {
 *     return [
 *         'access' => [
 *             'class' => \kiwi\filters\AccessControl::className(),
 *             'only' => ['create', 'update'],
 *             'rules' => [
 *                 // deny all POST requests
 *                 [
 *                     'class' => '\core\auth\filters\ActionAccessRule'
 *                     'allow' => true,
 *                     'verbs' => ['POST']
 *                 ],
 *                 // allow authenticated users
 *                 [
 *                     'class' => '\core\auth\filters\ActionAccessRule'
 *                     'allow' => true,
 *                     'roles' => ['@'],
 *                 ],
 *                 // everything else is denied
 *             ],
 *         ],
 *     ];
 * }
 *
 * @package core\auth\filters
 * @author Lujie.Zhou(gao_lujie@live.cn)
 */
class ActionAccessRule extends AccessRule
{
    public $params = [];

    public function allows($action, $user, $request)
    {
        if ($this->matchActionAccess($action, $user, $request)) {
            return parent::allows($action, $user, $request);
        }
        return null;
    }

    /**
     * check the permission, if we rewrite and controller, the controller id and module id is not changed
     * @param \yii\base\Action $action
     * @param \yii\web\User $user
     * @param \yii\web\Request $request
     * @return bool
     */
    public function matchActionAccess($action, $user, $request)
    {
        if ($user->getIsGuest()) {
            return false;
        }

        /** @var \core\auth\Module $authModule */
        $authModule = \Yii::$app->getModule('core_auth');
        foreach ($authModule->getAdmins() as $key => $admin) {
            if ($user->getIdentity()->username == $admin['username']) {
                return true;
            }
        }

        if ($action->controller->module instanceof Application) {
            $key = 'default' . '_' . $action->controller->id . '_' . $action->id;
        } else {
            $key = $action->getUniqueId();
            $key = explode('/', $key);
            array_shift($key);
            $key = implode('_', $key);
        }
        $key = lcfirst(implode('', array_map(function($k) { return ucfirst($k); }, explode('-', $key))));
        return $user->can($key, $this->params);
    }
} 