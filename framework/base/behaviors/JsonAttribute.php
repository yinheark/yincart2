<?php
/**
 * @link http://www.yincart.com/
 * @copyright Copyright (c) 2014 Yincart
 * @license http://www.yincart.com/license/
 */

namespace yincart\base\behaviors;

use yii\behaviors\AttributeBehavior;
use yii\db\ActiveRecord;

/**
 * Class JsonAttribute
 * @package yincart\base\behaviors
 * @author jeremy.zhou(gao_lujie@live.cn)
 */
Class JsonAttribute extends AttributeBehavior
{
    /**
     * @var array the columns saved with json format
     * for example:
     * ['jsonEncode', 'jsonDecode']
     */
    public $attributes = [];

    public function init()
    {
        $events = [
            ActiveRecord::EVENT_AFTER_FIND,
            ActiveRecord::EVENT_AFTER_VALIDATE,
            ActiveRecord::EVENT_AFTER_INSERT,
            ActiveRecord::EVENT_AFTER_UPDATE,
            ActiveRecord::EVENT_BEFORE_VALIDATE,
            ActiveRecord::EVENT_BEFORE_INSERT,
            ActiveRecord::EVENT_BEFORE_UPDATE,
        ];
        $this->attributes = array_fill_keys($events, $this->attributes);
    }

    public $isArray = true;

    /**
     * Evaluates the attribute value and assigns it to the current attributes.
     * @param \yii\base\Event $event
     */
    public function evaluateAttributes($event)
    {
        if (!empty($this->attributes[$event->name])) {
            $attributes = (array)$this->attributes[$event->name];
            if (strpos($event->name, 'after') !== false) {
                foreach ($attributes as $attribute) {
                    if (!is_array($this->owner->$attribute)) {
                        $this->owner->$attribute = json_decode($this->owner->$attribute, $this->isArray);
                    }
                }
            } else if (strpos($event->name, 'before') !== false) {
                foreach ($attributes as $attribute) {
                    if (is_array($this->owner->$attribute)) {
                        $this->owner->$attribute = json_encode($this->owner->$attribute);
                    }
                }
            }
        }
    }
}