<?php
/**
 * @link http://www.yincart.com/
 * @copyright Copyright (c) 2014 Yincart
 * @license http://www.yincart.com/license/
 */

namespace yincart\cart\controllers\frontend;

use Yii;
use kiwi\web\Controller;
use kiwi\Kiwi;
use yii\helpers\Json;

class CartController extends Controller
{
    public function actionIndex()
    {
        $cartItems = Kiwi::getShoppingCart()->cartItems;

        return $this->render('index', [
            'cartItems' => $cartItems,
        ]);
    }

    public function actionAdd()
    {
        $item_id = Yii::$app->request->post('item_id');
        $qty = Yii::$app->request->post('qty');
        $data = Yii::$app->request->post('data');
        if(Kiwi::getShoppingCart()->add($item_id, $qty,$data)) {
            return Json::encode(['message' => \Yii::t('app', 'add to cart success')]);
        } else {
            return Json::encode(['message' => \Yii::t('app', 'add to cart fail')]);
        }
    }

    public function actionUpdate()
    {
        $cart = Yii::$app->request->post('Cart');
        $message = null;
        foreach($cart as $cartItem){
            if(Kiwi::getShoppingCart()->update($cartItem['item_id'],$cartItem['qty'],'')){
                $message  =$message . $cartItem['name'].' update success  ';
            }else {
                $message  =$message . $cartItem['name'].' update fail  ';
            }
        }
        return Json::encode(['message' => $message,'redirect' =>'index']);
    }

    public function actionRemove()
    {
        $item_id = Yii::$app->request->post('item_id');
        if (Kiwi::getShoppingCart()->remove($item_id)) {
            echo Json::encode(['message' => 'remove success','redirect' =>'index']);
        } else {
            echo Json::encode(['message' => 'remove fail','redirect' =>'index']);
        }
    }

    public function actionClearAll(){
        if (Kiwi::getShoppingCart()->clearAll()) {
            echo Json::encode(['message' => 'remove success','redirect' =>'index']);
        } else {
            echo Json::encode(['message' => 'remove fail','redirect' =>'index']);
        }
    }
} 