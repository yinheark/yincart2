<?php
/**
 * @link http://www.yincart.com/
 * @copyright Copyright (c) 2014 Yincart
 * @license http://www.yincart.com/license/
 */

namespace yincart\sales\models;

use yii\base\Model;
use yincart\Yincart;

class Cart extends Model
{

    const CART_ITEMS_KEY = 'CART_ITEMS';

    /**
     * @var ShippingCart[]
     */
    public $items = [];

    public function init()
    {
        $this->loadFromSession();
    }

    public function loadFromSession()
    {
        $this->items = \Yii::$app->getSession()->get(self::CART_ITEMS_KEY);
    }

    public function saveToSession()
    {
        \Yii::$app->getSession()->set(self::CART_ITEMS_KEY, $this->items);
    }

    public $cartItemIds = [];

    public function loadFromDB()
    {
        if (!\Yii::$app->getUser()->isGuest) {
            /** @var \yincart\customer\models\Customer $customer */
            $customer = \Yii::$app->getUser();
            $cartItems = $customer->shippingCarts;
            foreach ($cartItems as $cartItem) {
                $this->items[$cartItem->item_id . ':' . $cartItem->sku_id] = $cartItem;
                $this->cartItemIds[$cartItem->item_id . ':' . $cartItem->sku_id] = $cartItem->shipping_cart_id;
            }
        }
    }

    public function saveToDB()
    {
        if (!\Yii::$app->getUser()->isGuest) {
            $cartItemIds = [];
            $customer_id = \Yii::$app->getUser()->getId();
            foreach ($this->items as $cartItem) {
                $cartItem->customer_id = $customer_id;
                $cartItem->save();
                $cartItemIds[$cartItem->item_id . ':' . $cartItem->sku_id] = $cartItem->shipping_cart_id;
            }
            $toDelIds = array_diff($this->cartItemIds, $cartItemIds);
            $this->cartItemIds = $cartItemIds;
            if ($toDelIds) {
                $shippingCartClass = Yincart::$container->shippingCartClass;
                $shippingCartClass::deleteAll(['shipping_cart_id' => $toDelIds]);
            }
        }
    }

    public function add($item_id, $sku_id = 0, $qty = 1)
    {
        $key = $item_id . ':' . $sku_id;
        $shippingCart = isset($this->items[$key]) ? $this->items[$key] : Yincart::$container->getShippingCart(['item_id' => $item_id, 'sku_id' => $sku_id, 'qty' => 0]);
        $shippingCart->qty += $qty;
        $this->items[$key] = $shippingCart;
        $this->saveToSession();
        $this->saveToDB();
    }

    public function remove($item_id, $sku_id)
    {
        $key = $item_id . ':' . $sku_id;
        if (isset($this->items[$key])) {
            $this->items[$key]->delete();
            unset($this->items[$key]);
            $this->saveToSession();
            $this->saveToDB();
        }
    }

    public function updateQty($item_id, $sku_id = 0, $qty = 1)
    {
        $key = $item_id . ':' . $sku_id;
        $shippingCart = isset($this->items[$key]) ? $this->items[$key] : Yincart::$container->getShippingCart(['item_id' => $item_id, 'sku_id' => $sku_id, 'qty' => 0]);
        $shippingCart->qty = $qty;
        $shippingCart->save();
        $this->items[$key] = $shippingCart;
        $this->saveToSession();
        $this->saveToDB();
    }

    public function getTotalPrice()
    {
        $prices = [];
        foreach ($this->items as $key => $cartItem) {
            $price = $cartItem->sku ? $cartItem->sku->price : $cartItem->item->price;
            $totalPrice = $price * $cartItem->qty;
            $prices[$key] = $totalPrice;
        }
        return array_sum($prices);
    }
} 