<?php
/**
 * @link http://www.yincart.com/
 * @copyright Copyright (c) 2014 Yincart
 * @license http://www.yincart.com/license/
 */

namespace yincart\catalog\controllers\frontend;

use yii\web\NotFoundHttpException;
use yincart\base\web\Controller;
use yincart\Yincart;

class ItemController extends Controller
{
    public function actionView($id)
    {
        $itemClass = Yincart::$container->itemClass;
        $item = $itemClass::getItem($id);
        if (!$item) {
            throw new NotFoundHttpException('Error Product ID');
        }
        return $this->render('view', ['item' => $item]);
    }
} 