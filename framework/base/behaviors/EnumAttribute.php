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
 * Class EnumAttribute
 * @package yincart\base\behaviors
 * @author jeremy.zhou(gao_lujie@live.cn)
 */
class EnumAttribute extends AttributeBehavior
{
    /**
     * @var array
     * for example:
     * [['status' => [0 => 'NO', 1 => 'YES']], ['is_enable' => ['N' => 'NO', 'Y' => 'YES']]
     */
    public $attributes = [];

    /**
     * @var bool it will change attribute value if set true.
     */
    public $changeOriginal = false;

    public function init()
    {
        $events = [
            ActiveRecord::EVENT_AFTER_FIND,
            ActiveRecord::EVENT_AFTER_INSERT,
            ActiveRecord::EVENT_AFTER_UPDATE,
            ActiveRecord::EVENT_BEFORE_VALIDATE,
        ];
        $this->attributes = array_fill_keys($events, $this->attributes);
    }

    /**
     * @var array to save enum attribute list and name
     */
    public $enumData = [];

    public function __get($name)
    {
        if (isset($this->enumData[$name])) {
            return $this->enumData[$name];
        }
        return parent::__get($name);
    }

    public function __set($name, $value)
    {
        if (isset($this->enumData[$name])) {
            $this->enumData[$name] = $value;
            return;
        }
        parent::__set($name, $value);
    }

    public function canGetProperty($name, $checkVars = true)
    {
        return isset($this->enumData[$name]) || parent::canGetProperty($name, $checkVars);
    }

    public function canSetProperty($name, $checkVars = true)
    {
        return isset($this->enumData[$name]) || parent::canSetProperty($name, $checkVars);
    }

    /**
     * Evaluates the attribute value and assigns it to the current attributes.
     * @param \yii\base\Event $event
     */
    public function evaluateAttributes($event)
    {
        if (isset($this->attributes[$event->name])) {
            $enumList = $this->attributes[$event->name];
            if ($this->changeOriginal) {
                if ($event->name == ActiveRecord::EVENT_BEFORE_VALIDATE) {
                    foreach ($enumList as $attribute => $values) {
                        $this->enumData[$attribute . 'List'] = $values;
                        $this->enumData[$attribute . 'Name'] = $this->owner->$attribute;
                        $values = array_flip($values);
                        $valueName = isset($values[$this->owner->$attribute]) ? $values[$this->owner->$attribute] : $this->owner->$attribute;
                        $this->enumData[$attribute . 'Value'] = $valueName;
                        $this->owner->$attribute = $valueName;
                    }
                }
                if (in_array($event->name, [ActiveRecord::EVENT_AFTER_FIND, ActiveRecord::EVENT_AFTER_INSERT, ActiveRecord::EVENT_AFTER_UPDATE])) {
                    foreach ($enumList as $attribute => $values) {
                        $this->enumData[$attribute . 'List'] = $values;
                        $this->enumData[$attribute . 'Value'] = $this->owner->$attribute;
                        $valueName = isset($values[$this->owner->$attribute]) ? $values[$this->owner->$attribute] : $this->owner->$attribute;
                        $this->enumData[$attribute . 'Name'] = $valueName;
                        $this->owner->$attribute = $valueName;
                    }
                }
            } else {
                if ($event->name == ActiveRecord::EVENT_AFTER_FIND) {
                    foreach ($enumList as $attribute => $values) {
                        $this->enumData[$attribute . 'List'] = $values;
                        $this->enumData[$attribute . 'Value'] = $this->owner->$attribute;
                        $valueName = isset($values[$this->owner->$attribute]) ? $values[$this->owner->$attribute] : $this->owner->$attribute;
                        $this->enumData[$attribute . 'Name'] = $valueName;
                    }
                }
            }
        }
    }
}
