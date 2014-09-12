<?php
/**
 * @link http://www.yincart.com/
 * @copyright Copyright (c) 2014 Yincart
 * @license http://www.yincart.com/license/
 */

namespace yincart\trigger\behaviors;

use yii\base\Model;

/**
 * Class ModelTrigger the event for form model
 * @package yincart\trigger\behaviors
 * @author jeremy.zhou(gao_lujie@live.cn)
 */
class ModelTrigger extends TriggerBehavior
{
    public function eventList()
    {
        return [
            Model::EVENT_BEFORE_VALIDATE,
            Model::EVENT_AFTER_VALIDATE,
        ];
    }

    public function checkFilter($filter, $event)
    {
        if (parent::checkFilter($filter, $event)) {
            return true;
        }

        $filters = explode('.', $filter);
        /** @var Model $model */
        $model = $event->sender;

        return $model->className() == $filter;
    }
} 