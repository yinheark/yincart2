<?php
/**
 * @author Lujie.Zhou(lujie.zhou@jago-ag.cn) 
 * @Date 2014/11/10
 * @Time 20:11
 */

namespace yincart\group;


use kiwi\Kiwi;
use yii\base\Event;

class Module extends \kiwi\base\Module
{
    public $version = 'v0.1.0';

    public static $depends = ['core_tree', 'yincart_customer'];

    public function bootstrap($app)
    {
        $customerClass = Kiwi::getCustomerClass();
        Event::on($customerClass, $customerClass::EVENT_INIT, function($event) {
            /** @var \yincart\customer\models\Customer $customer */
            $customer = $event->sender;
            $customer->attachBehavior('group', Kiwi::getGroupBehaviorClass());
        });
    }
} 