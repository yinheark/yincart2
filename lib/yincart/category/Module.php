<?php
/**
 * @author Lujie.Zhou(lujie.zhou@jago-ag.cn) 
 * @Date 2014/11/10
 * @Time 20:11
 */

namespace yincart\category;


use kiwi\Kiwi;
use yii\base\Event;

class Module extends \kiwi\base\Module
{
    public $version = 'v0.2.0';

    public static $depends = ['core_tree', 'yincart_item'];

    public function bootstrap($app)
    {
        $this->attachEvents();
    }

    public function attachEvents()
    {
        $itemClass = Kiwi::getItemClass();
        Event::on($itemClass, $itemClass::EVENT_INIT, function($event) {
            /** @var \yincart\item\models\Item $item */
            $item = $event->sender;
            $item->attachBehavior('category', Kiwi::getCategoryBehaviorClass());
            $item->attachBehavior('tag', Kiwi::getTagBehaviorClass());
        });
    }
} 