<?php
/**
 * @link http://www.yincart.com/
 * @copyright Copyright (c) 2014 Yincart
 * @license http://www.yincart.com/license/
 */

namespace yincart\base\behaviors;

use yii\behaviors\AttributeBehavior;
use yii\db\ActiveRecord;

class DateAttribute extends AttributeBehavior
{
    /**
     * @var string the date format that the value being validated should follow.
     * Please refer to <http://www.php.net/manual/en/datetime.createfromformat.php> on
     * supported formats.
     */
    public $format = 'Y-m-d';

    /**
     * @var array the columns saved with timestamp
     * for example:
     * ['created_at', 'updated_at']
     */
    public $attributes = [];

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
     * Evaluates the attribute value and assigns it to the current attributes.
     * @param \yii\base\Event $event
     */
    public function evaluateAttributes($event)
    {
        if (!empty($this->attributes[$event->name])) {
            $attributes = (array)$this->attributes[$event->name];
            if (strpos($event->name, 'after') !== false) {
                foreach ($attributes as $attribute) {
                    if (is_int($this->owner->$attribute)) {
                        $this->owner->$attribute = $this->owner->$attribute ? date($this->format, $this->owner->$attribute) : '';
                    }
                }
            } else if (strpos($event->name, 'before') !== false) {
                foreach ($attributes as $attribute) {
                    if (!is_numeric($this->owner->$attribute)) {
                        $date = \DateTime::createFromFormat($this->format, $this->owner->$attribute);
                        $this->owner->$attribute = $date ? $date->getTimestamp() : 0;
                    }
                }
            }
        }
    }
} 