<?php
/**
 * @link http://www.yincart.com/
 * @copyright Copyright (c) 2014 Yincart
 * @license http://www.yincart.com/license/
 */

namespace yincart\sales\controllers\frontend;

use yincart\base\web\Controller;
use yincart\Yincart;

class CartController extends Controller
{
    public function actionAdd()
    {
        $itemId = \Yii::$app->getRequest()->post('item_id');
        $skuId = \Yii::$app->getRequest()->post('sku_id', 0);
        $qty = \Yii::$app->getRequest()->post('qty', 1);

        if ($qty > 0) {
            $cart = Yincart::$container->cart;
            $cart->add($itemId, $skuId, $qty);
        }
    }

    public function actionRemove()
    {
        $itemId = \Yii::$app->getRequest()->post('item_id');
        $skuId = \Yii::$app->getRequest()->post('sku_id', 0);

        $cart = Yincart::$container->cart;
        $cart->remove($itemId, $skuId);
    }

    public function actionUpdateQty()
    {
        $itemId = \Yii::$app->getRequest()->post('item_id');
        $skuId = \Yii::$app->getRequest()->post('sku_id', 0);
        $qty = \Yii::$app->getRequest()->post('qty', 1);

        $cart = Yincart::$container->cart;
        if ($qty > 0) {
            $cart->updateQty($itemId, $skuId, $qty);
        } else {
            $cart->remove($itemId, $skuId);
        }
    }
} 