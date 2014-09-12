<?php
/**
 * @link http://www.yincart.com/
 * @copyright Copyright (c) 2014 Yincart
 * @license http://www.yincart.com/license/
 */

namespace yincart\catalog\controllers\backend;

use yii\helpers\Json;
use yii\helpers\Url;
use yincart\base\web\Controller;
use yincart\Yincart;

/**
 * Class ItemController
 * @package backend\controllers
 * @author jeremy.zhou(gao_lujie@live.cn)
 */
class ItemController extends Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionGetItems()
    {
        $jqForm = Yincart::$container->getJqForm(['model' => Yincart::$container->item]);
        $data = $jqForm->search();
        return Json::encode($data);
    }

    public function actionGetItem($id)
    {
        $itemClass = Yincart::$container->itemClass;
        $item = $itemClass::getItem($id);
        return Json::encode($item->getRelations(['itemImgs']));
    }

    public function actionSaveItem()
    {
        if (\Yii::$app->getRequest()->post('oper')) {
            $jqForm = Yincart::$container->getJqForm(['model' => Yincart::$container->item]);
            return $jqForm->save();
        } else {
            $modelForm = Yincart::$container->getModelForm(['model' => Yincart::$container->item, 'relations' => ['itemImgs' => function () {
                    $itemImgs = ['indexKey' => 'url'];
                    $urls = \Yii::$app->getRequest()->post('image', []);
                    foreach ($urls as $index => $url) {
                        $imageDomain = \Yii::$app->params['imageDomain'];
                        $url = str_replace($imageDomain, '', $url);
                        $itemImg = ['url' => $url, 'sort' => $index];
                        $itemImgs[] = $itemImg;
                    }
                    return $itemImgs;
                }]]);
            return $modelForm->save();
        }
    }

    public function actionGetItemProps($categoryId, $itemId = '')
    {
        $itemPropFormClass = Yincart::$container->itemPropFormClass;
        return $itemPropFormClass::widget([
            'categoryId' => $categoryId,
            'itemId' => $itemId,
            'action' => ['item/save-item-props', 'itemId' => $itemId],
            'tagData' => ['skuUrl' => Url::to(['item/get-skus', 'itemId' => $itemId])]
        ]);
    }


    public function actionSaveItemProps($itemId)
    {
        if (!$itemId) {
            $PropValueModelData = \Yii::$app->getRequest()->post('PropValueModel');
            if (empty($PropValueModelData['itemId'])) {
                Json::encode(['success' => 0, 'message' => \Yii::t('yincart', 'Error Item ID!')]);
            }
            $itemId = $PropValueModelData['itemId'];
        }
        $itemClass = Yincart::$container->itemClass;
        $item = $itemClass::getItem($itemId);
        $skus = \Yii::$app->getRequest()->post('Sku');
        if ($item && $skus) {
            $item->setRelation('skus', $skus);
            if (!$item->save()) {
                return Json::encode(['success' => 0, 'message' => \Yii::t('yincart', 'Save Error!'), 'errors' => $item->getErrors()]);
            }
        }

        $modelForm = Yincart::$container->getModelForm(['model' => Yincart::$container->getPropValueModel(['itemId' => $itemId])]);
        return $modelForm->save();
    }

    public function actionGetSkus($itemId)
    {
        $skuClass = Yincart::$container->skuClass;
        return Json::encode($skuClass::getSkus($itemId));
    }
} 