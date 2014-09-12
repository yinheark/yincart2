<?php
/**
 * @link http://www.yincart.com/
 * @copyright Copyright (c) 2014 Yincart
 * @license http://www.yincart.com/license/
 */

namespace yincart\trigger\behaviors;

use yii\db\ActiveRecord;

/**
 * Class ActiveRecordTrigger the event behavior for ActiveRecord
 * @package yincart\trigger\behaviors
 * @author jeremy.zhou(gao_lujie@live.cn)
 */
class ActiveRecordTrigger extends TriggerBehavior
{
    public function eventList()
    {
        return [
            ActiveRecord::EVENT_BEFORE_VALIDATE,
            ActiveRecord::EVENT_AFTER_VALIDATE,
            ActiveRecord::EVENT_BEFORE_INSERT,
            ActiveRecord::EVENT_AFTER_INSERT,
            ActiveRecord::EVENT_BEFORE_UPDATE,
            ActiveRecord::EVENT_AFTER_UPDATE,
            ActiveRecord::EVENT_BEFORE_DELETE,
            ActiveRecord::EVENT_AFTER_DELETE,
            ActiveRecord::EVENT_AFTER_FIND,
            ActiveRecord::EVENT_INIT,
        ];
    }

    public function checkFilter($filter, $event)
    {
        if (parent::checkFilter($filter, $event)) {
            return true;
        }

        $filters = explode('.', $filter);
        /** @var ActiveRecord $model */
        $model = $event->sender;

        return $model->className() == $filter;
    }
} 