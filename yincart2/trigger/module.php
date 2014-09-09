<?php
/**
 * @link http://www.yincart.com/
 * @copyright Copyright (c) 2014 Yincart
 * @license http://www.yincart.com/license/
 */

namespace yincart\trigger;

/**
 * Class module
 * @package yincart\trigger
 * @author jeremy.zhou(gao_lujie@live.cn)
 */
class module extends \yii\base\Module
{
    public $controllerNamespace = 'yincart\trigger\controllers';

    public function init()
    {
        parent::init();

        // custom initialization code goes here
    }

    /**
     * @var array events register data
     * format like:
     * [
     *      type => [
     *          event => [
     *              ['class', 'function', 'filter']
     *          ]
     *      ]
     * ]
     * for example:
     * [
     *      ControllerTrigger => [
     *          Controller::EVENT_AFTER_ACTION => [
     *              ['EventBehavior', 'getEvents', 'module.controller.action']
     *          ]
     *      ]
     * ]
     */
    public $events = [];

    /**
     * @var array the custom event name
     */
    public $customEventNames = [];

    /**
     * @var string table name
     */
    public $table = '{{%trigger}}';

}