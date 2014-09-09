<?php
/**
 * @link http://www.yincart.com/
 * @copyright Copyright (c) 2014 Yincart
 * @license http://www.yincart.com/license/
 */

namespace yincart\trigger\behaviors;

/**
 * Class CustomTrigger the event behavior for custom class
 * @package yincart\trigger\behaviors
 * @author jeremy.zhou(gao_lujie@live.cn)
 */
class CustomTrigger  extends TriggerBehavior
{
    public function eventList()
    {
        /** @var \backend\modules\trigger\module $eventModule */
        $eventModule = \Yii::$app->getModule('event');
        $events = $eventModule->$customEventNames;
        return $events;
    }
} 