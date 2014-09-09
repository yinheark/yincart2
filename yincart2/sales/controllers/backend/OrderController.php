<?php
/**
 * @link http://www.yincart.com/
 * @copyright Copyright (c) 2014 Yincart
 * @license http://www.yincart.com/license/
 */

namespace yincart\sales\controllers\backend;

use yii\helpers\Json;
use yii\helpers\Url;
use yincart\base\web\Controller;
use yincart\Yincart;

class OrderController extends Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionGetOrders()
    {
        $jqForm = Yincart::$container->getJqForm(['model' => Yincart::$container->order]);
        $data = $jqForm->search();
        return Json::encode($data);
    }

    public function actionGetOrder($id)
    {
        $orderClass = Yincart::$container->orderClass;
        $order = $orderClass::getOrder($id);
        return Json::encode($order);
    }

    public function actionSaveOrder()
    {
        if (\Yii::$app->getRequest()->post('oper')) {
            $jqForm = Yincart::$container->getJqForm(['model' => Yincart::$container->order]);
            return $jqForm->save();
        } else {
            $modelForm = Yincart::$container->getModelForm(['model' => Yincart::$container->order]);
            return $modelForm->save();
        }
    }
} 