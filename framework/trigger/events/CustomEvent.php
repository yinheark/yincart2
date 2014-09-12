<?php
/**
 * @link http://www.yincart.com/
 * @copyright Copyright (c) 2014 Yincart
 * @license http://www.yincart.com/license/
 */

namespace yincart\trigger\events;

use yii\base\Event;

/**
 * Class CustomEvent
 * @package backend\modules\trigger\events
 * @author jeremy.zhou(gao_lujie@live.cn)
 */
class CustomEvent extends Event
{
    public $customData;
    /**
     * @var boolean whether to continue running the action. Event handlers of
     * [[Controller::EVENT_BEFORE_ACTION]] may set this property to decide whether
     * to continue running the current action.
     */
    public $isValid = true;
} 