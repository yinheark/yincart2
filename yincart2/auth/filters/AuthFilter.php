<?php
/**
 * @link http://www.yincart.com/
 * @copyright Copyright (c) 2014 Yincart
 * @license http://www.yincart.com/license/
 */

namespace backend\modules\user\filters;

use yii\base\ActionFilter;
use yii\web\HttpException;

/**
 * Filter that automatically checks if the user has access to the current controller action.
 */
class AuthFilter extends ActionFilter
{
    /**
     * @var array name-value pairs that would be passed to business rules associated
     * with the tasks and roles assigned to the user.
     */
    public $params = [];

    /**
     * This method is invoked right before an action is to be executed (after all possible filters.)
     * @param \yii\base\Action $action the action to be executed.
     * @return bool whether the action should continue to be executed.
     * @throws \yii\web\HttpException
     */
    public function beforeAction($action)
    {
        $itemName = '';
        $controller = $action->controller;

        /**
         * @var \yii\web\User $user
         */
        $user = \Yii::$app->getUser();

        if ($user->isGuest) {
            $user->loginRequired();
        }

        if ($user->isAdmin()) {
            return true;
        }

        if (($module = $controller->module) !== null) {
            $itemName .= $module->id . '.';
            if ($user->can($itemName . '*')) {
                return true;
            }
        }

        $itemName .= $controller->id;
        if ($user->can($itemName . '.*')) {
            return true;
        }

        $itemName .= '.' . $action->id;
        if ($user->can($itemName, $this->params)) {
            return true;
        }

        throw new HttpException(401, \Yii::t('yii', 'You are not permission to perform this action.'));
    }

}
