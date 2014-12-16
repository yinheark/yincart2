<?php
/**
 * @author Cangzhou.Wu (wucangzhou@gmail.com)
 * @Date 14-11-22
 * @Time 上午10:48
 */

namespace yincart\cart\models;

use Yii;
use kiwi\Kiwi;
use yii\base\Component;
use yii\base\ModelEvent;
use yii\helpers\Json;

class ShoppingCart extends Component
{
    const EVENT_BEFORE_ADD = 'beforeAdd';
    const EVENT_AFTER_ADD = 'afterAdd';
    const EVENT_BEFORE_REMOVE = 'beforeRemove';
    const EVENT_AFTER_REMOVE = 'afterRemove';
    const EVENT_BEFORE_UPDATE = 'beforeUpdate';
    const EVENT_AFTER_UPDATE = 'afterUpdate';
    const SESSION_KEY = 'cart';

    /** @var Cart[] */
    public $cartItems = [];

    public function init()
    {
        $this->cartItems = Yii::$app->getSession()->has(self::SESSION_KEY) ? Yii::$app->getSession()->get(self::SESSION_KEY) : [];
        //@TODO need to take a event to login;
        if (!Yii::$app->getUser()->getIsGuest()) {
            $cartItems = Kiwi::getCart()->find()->where(['user_id' => Yii::$app->user->id])->indexBy('item_id')->all();
            $this->cartItems = $cartItems + $this->cartItems;
            Yii::$app->getSession()->set(self::SESSION_KEY, $this->cartItems);
            foreach ($this->cartItems as $cart) {
                $cart->save();
            }
        }
        $this->attachEvent();
    }

    public function beforeAdd($item_id, $qty,$data)
    {
        $event = new CartEvent;
        $event->item_id = $item_id;
        $event->qty =$qty;
        $event->content = $data;
        $this->trigger(self::EVENT_BEFORE_ADD, $event);
        return $event->isValid;
    }

    public function afterAdd()
    {
        $event = new CartEvent;
        $this->trigger(self::EVENT_AFTER_ADD, $event);
    }

    public function beforeUpdate($item_id, $qty,$data)
    {
        $event = new CartEvent;
        $event->item_id = $item_id;
        $event->qty =$qty;
        $event->content =$data;
        $this->trigger(self::EVENT_BEFORE_UPDATE, $event);
        return $event->isValid;
    }

    public function afterUpdate()
    {
        $event = new CartEvent;
        $this->trigger(self::EVENT_AFTER_UPDATE, $event);
    }

    public function beforeRemove($item_id)
    {
        $event = new CartEvent;
        $event->item_id = $item_id;
        $this->trigger(self::EVENT_BEFORE_REMOVE, $event);
        return $event->isValid;
    }

    public function afterRemove()
    {
        $event = new CartEvent;
        $this->trigger(self::EVENT_AFTER_REMOVE, $event);
    }

    public function attachEvent()
    {
        $this->on(self::EVENT_BEFORE_ADD, [$this, 'validate']);
        $this->on(self::EVENT_BEFORE_UPDATE, [$this, 'validate']);

        $this->on(self::EVENT_AFTER_ADD, [$this, 'save']);
        $this->on(self::EVENT_AFTER_UPDATE, [$this, 'save']);

        $this->on(self::EVENT_AFTER_REMOVE, [$this, 'save']);
    }

    /**
     * @param $event CartEvent
     */
    public function validate($event)
    {
        //@TODO need to move to cart model the have error message
        $item = Kiwi::getItem()->findOne($event->item_id);
        if (!$item || intval($event->qty) != $event->qty) {
            $event->isValid = false;
            return;
        }

        if ($event->qty <= 0
            || ($item->max_sale_qty && $event->qty > $item->max_sale_qty)
            || ($item->min_sale_qty && $event->qty < $item->min_sale_qty)
        ) {
            $event->isValid = false;
            return;
        }
    }

    public function save($event)
    {
        $cartItems = Yii::$app->getSession()->has(self::SESSION_KEY) ? Yii::$app->getSession()->get(self::SESSION_KEY) : [];
        $toDelCartItems = array_diff_key($cartItems, $this->cartItems);
        Yii::$app->getSession()->set(self::SESSION_KEY, $this->cartItems);
        if (!Yii::$app->user->isGuest) {
            foreach ($this->cartItems as $cart) {
                $cart->save();
            }
            Kiwi::getCart()->deleteAll(['item_id' => array_keys($toDelCartItems), 'user_id' => Yii::$app->user->id]);
        }
    }

    /**
     * add item to cart
     * @param $item_id
     * @param $qty
     * @return bool
     */
    public function add($item_id, $qty,$data)
    {
        if ($this->beforeAdd($item_id, $qty,$data)) {
            if (isset($this->cartItems[$item_id])) {
                $this->cartItems[$item_id]->qty += $qty;
            } else {
                $this->cartItems[$item_id] = Kiwi::getCart(['item_id' => $item_id, 'qty' => $qty]);
            }
            $this->cartItems[$item_id]->data = $data;
            $this->afterAdd();
            return true;
        }
        return false;
    }

    public function update($item_id, $qty,$data)
    {
        if ($this->beforeUpdate($item_id, $qty,$data)) {
            if (isset($this->cartItems[$item_id])) {
                $this->cartItems[$item_id]->qty = $qty;
                $this->cartItems[$item_id]->data = $data;
                $this->afterUpdate();
                return true;
            }
        }
        return false;
    }

    /**
     * delete item
     * @param $item_id
     * @return bool
     */
    public function remove($item_id)
    {
        if ($this->beforeRemove($item_id)) {
            if (isset($this->cartItems[$item_id])) {
                unset($this->cartItems[$item_id]);
                $this->afterRemove();
                return true;
            }
        }
        return false;
    }

    /**
     * delete all item
     * @return bool
     */
    public function clearAll()
    {
        //@TODO need to add event
        if (Yii::$app->getSession()->remove(self::SESSION_KEY) && Kiwi::getCart()->deleteAll(['user_id' => Yii::$app->user->id])) {
            $this->cartItems = [];
            return true;
        }
        return false;
    }

    /**
     * @param int $item_id
     * @return number|string
     */
    public function getSubTotal($item_id = 0)
    {
        //@TODO need to add event
        if ($item_id) {
            $cartItem = $this->cartItems[$item_id];

            $key = $cartItem->data['key'];
            /** @var \extensions\sales\models\CustomerSales $customer_sale */
            $customerSaleClass = Kiwi::getCustomerSalesClass();
            $customer_sale = $customerSaleClass::find()->where(['key' => $key])->one();
            return $customer_sale->sale_price * $cartItem->qty;

//            return $cartItem->item->price * $cartItem->qty;
        }
        $subTotals = [];
        foreach($this->cartItems as $item_id => $carItem) {
            $subTotals[$item_id] = $this->getSubTotal($item_id);
        }
        return array_sum($subTotals);
    }

    public function getShippingFee()
    {
        //@TODO need to add event
        $subTotals = [];
        foreach($this->cartItems as $item_id => $carItem) {
            $subTotals[$item_id] = $carItem->item->is_free_shipping ? 0 : $carItem->item->shipping_fee;
        }
        return array_sum($subTotals);
    }

    public function getTotal()
    {
        //@TODO need to add event
        return $this->getSubTotal() + $this->getShippingFee();
    }
}

class CartEvent extends ModelEvent
{
    public $item_id;

    public $qty;

    public $content;
}