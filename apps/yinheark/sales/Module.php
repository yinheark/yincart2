<?php
/**
 * @author Lujie.Zhou(lujie.zhou@jago-ag.cn) 
 * @Date 2014/11/10
 * @Time 20:11
 */

namespace apps\yinheark\sales;

use kiwi\Kiwi;
use yii\base\Event;

class Module extends \kiwi\base\Module
{
    public $version = 'v0.2.0';
    public static  $depends = ['yincart_category', 'yincart_customer'];

    public function bootstrap($app)
    {
        $this->attacheEvents();
    }

    public function attacheEvents()
    {
        $customerClass = Kiwi::getCustomerClass();
        Event::on($customerClass, $customerClass::EVENT_INIT, function($event) {
            /** @var \yincart\customer\models\Customer $customer */
            $customer = $event->sender;
            $customer->attachBehavior('category', Kiwi::getCustomerBehaviorClass());
        });

        $orderClass = Kiwi::getOrderClass();
        Event::on($orderClass, $orderClass::EVENT_AFTER_INSERT, [Kiwi::getCustomerSellerClass(), 'updateSeller']);

    }
} 