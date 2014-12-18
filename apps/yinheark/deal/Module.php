<?php
/**
 * @author Lujie.Zhou(lujie.zhou@jago-ag.cn) 
 * @Date 2014/11/10
 * @Time 20:11
 */

namespace extensions\deal;

use kiwi\Kiwi;
use yii\base\Event;
use yii\db\Exception;

class Module extends \kiwi\base\Module
{
    public $version = 'v0.1.0';

    public function bootstrap($app)
    {
        $this->attachEvents();
    }

    public function attachEvents()
    {
        $orderClass = Kiwi::getOrderClass();
        Event::on($orderClass, $orderClass::EVENT_AFTER_INSERT, [$this, 'addDealLog']);
    }

    /**
     * @param \yii\base\ModelEvent $event
     * @throws \yii\db\Exception
     */
    public function addDealLog($event)
    {
        /** @var \yincart\order\models\Order $order */
        $order = $event->sender;
        foreach($order->orderItems as $orderItem) {
            $deal_log = Kiwi::getDealLog();
            $deal_log->user_id = $order->user_id;
            $deal_log->order_id = $order->order_id;
            $deal_log->item_id = $orderItem->item_id;
            $deal_log->sale_price = $orderItem->price;
            $deal_log->memo = $orderItem->name;
            $deal_log->key = $orderItem->data['key'];
            $deal_log->deal_time = $order->create_at;
            $deal_log->percent = (0.35 + 0.05 * ($deal_log->customerSales->customer->customerSeller->level -1));
            $deal_log->created_at = time();
            if (!$deal_log->save()) {
                throw new Exception(\Yii::t('app', 'add deal log fail'), $deal_log->getErrors());
            }
        }
    }
} 