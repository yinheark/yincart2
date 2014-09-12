<?php
/**
 * @link http://www.yincart.com/
 * @copyright Copyright (c) 2014 Yincart
 * @license http://www.yincart.com/license/
 */

namespace yincart\trigger\behaviors;

use yii\base\Behavior;

/**
 * Class TriggerBehavior the base event behavior
 * @package yincart\trigger\behaviors
 * @author jeremy.zhou(gao_lujie@live.cn)
 */
abstract class TriggerBehavior extends Behavior
{
    public $type;

    public function init()
    {
        parent::init();
        $this->type = $this->className();
    }

    public function events()
    {
        return array_fill_keys($this->eventList(), [$this, 'trigger']);
    }

    abstract public function eventList();

    /**
     * get events to register, merge config data and db data
     * @return array
     */
    public function getEvents()
    {
        /** @var \yincart\trigger\module $module */
        //@TODO need to add config
//        $module = \Yii::$app->getModule('trigger');
//        $events = $module->events;
        $events = [];
        //get config trigger data
        $events = isset($events[$this->type]) ? $events[$this->type] : [];

        //get db trigger data
        //@TODO
//        $key = 'EventModule.eventList';
//        $eventArray = \Yii::$app->cache->get($key);
//        if ($eventArray === false) {
//            $eventArray = Event::find()->where(['status' => 1, 'type' => $this->type])->all();
//            \Yii::$app->cache->set($key, $eventArray);
//        }

//        foreach ($eventArray as $e) {
//            /** @var \backend\modules\trigger\models\Event $e */
//            if (!isset($events[$e->name])) {
//                $events[$e->name] = [];
//            }
//            $events[$e->name][] = [$e->class, $e->func, $e->filter];
//        }

        return $events;
    }

    /**
     * trigger the event and filter the custom function
     * @param \yii\base\Event $event event object
     */
    public function trigger($event)
    {
        $events = $this->getEvents();
        if (isset($events[$event->name])) {
            foreach ($events[$event->name] as $e) {
                /** @var yincart\trigger\models\Event $e */
                list($class, $func, $filter) = $e;
                if ($this->checkFilter($filter, $event))
                    call_user_func([$class, $func], $event);
            }
        }
    }

    /**
     * check if the event should be trigger
     * @param string $filter the event filter
     * @param \yii\base\Event $event event
     * @return bool if the trigger is run
     */
    public function checkFilter($filter, $event)
    {
        return empty($filter) || $filter === '*';
    }
} 