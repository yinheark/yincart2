<?php
/**
 * @link http://www.yincart.com/
 * @copyright Copyright (c) 2014 Yincart
 * @license http://www.yincart.com/license/
 */

namespace yincart\customer\controllers\backend;

use yii\helpers\Json;
use yii\helpers\Url;
use yincart\base\web\Controller;
use yincart\Yincart;

class CustomerController extends Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionGetCustomers()
    {
        $jqForm = Yincart::$container->getJqForm(['model' => Yincart::$container->customer]);
        $data = $jqForm->search();
        return Json::encode($data);
    }

    public function actionGetCustomer($id)
    {
        $customerClass = Yincart::$container->customerClass;
        $customer = $customerClass::getCustomer($id);
        return Json::encode($customer);
    }

    public function actionSaveCustomer()
    {
        if (\Yii::$app->getRequest()->post('oper')) {
            $jqForm = Yincart::$container->getJqForm(['model' => Yincart::$container->customer]);
            return $jqForm->save();
        } else {
            $modelForm = Yincart::$container->getModelForm(['model' => Yincart::$container->customer]);
            return $modelForm->save();
        }
    }
} 