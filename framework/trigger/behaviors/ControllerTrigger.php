<?php
/**
 * @link http://www.yincart.com/
 * @copyright Copyright (c) 2014 Yincart
 * @license http://www.yincart.com/license/
 */

namespace yincart\trigger\behaviors;

use yii\web\Controller;

/**
 * Class ControllerTrigger the event behavior for Controller
 * @package yincart\trigger\behaviors
 * @author jeremy.zhou(gao_lujie@live.cn)
 */
class ControllerTrigger extends TriggerBehavior
{
    public function eventList()
    {
        return [
            Controller::EVENT_BEFORE_ACTION,
            Controller::EVENT_AFTER_ACTION,
        ];
    }

    public function checkFilter($filter, $event)
    {
        if (parent::checkFilter($filter, $event)) {
            return true;
        }

        /** @var \yii\base\Action $action */
        $action = $event->sender;

        $itemName = '';
        $controller = $action->controller;

        if (($module = $controller->module) !== null) {
            $itemName .= $module->id . '.';
            if ($itemName . '.*' == $filter) {
                return true;
            }
        }

        $itemName .= $controller->id;
        if ($itemName . '.*' == $filter) {
            return true;
        }

        $itemName .= '.' . $action->id;
        if ($itemName . '.*' == $filter) {
            return true;
        }

        return false;
    }
} 