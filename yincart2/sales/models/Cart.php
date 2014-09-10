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

    const CART_ITEMS_KEY = 'CartItems';

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

    /**
     * @var ShippingCart[]
     */
    public $items = [];

    public function add($item_id, $sku_id = 0, $qty = 1)
    {
        $key = $item_id . ':' . $sku_id;
        $shippingCart = isset($this->items[$key]) ? $this->items[$key] : Yincart::$container->getShippingCart(['item_id' => $item_id, 'sku_id' => $sku_id, 'qty' => 0]);
        $shippingCart->qty += $qty;
        $shippingCart->save();
        $this->items[$key] = $shippingCart;
        $this->saveToSession();
    }

    public function remove($item_id, $sku_id)
    {
        $key = $item_id . ':' . $sku_id;
        if (isset($this->items[$key])) {
            $this->items[$key]->delete();
            unset($this->items[$key]);
            $this->saveToSession();
        }
    }

    public function update($item_id, $sku_id = 0, $qty = 1)
    {
        $key = $item_id . ':' . $sku_id;
        $shippingCart = isset($this->items[$key]) ? $this->items[$key] : Yincart::$container->getShippingCart(['item_id' => $item_id, 'sku_id' => $sku_id, 'qty' => 0]);
        $shippingCart->qty = $qty;
        $shippingCart->save();
        $this->items[$key] = $shippingCart;
        $this->saveToSession();
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