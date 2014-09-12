<?php
/**
 * @link http://www.yincart.com/
 * @copyright Copyright (c) 2014 Yincart
 * @license http://www.yincart.com/license/
 */

namespace yincart\catalog\controllers\backend;

use yii\helpers\Json;
use yincart\base\web\Controller;
use yincart\Yincart;

/**
 * Class CategoryController
 * @package backend\controllers
 * @author jeremy.zhou(gao_lujie@live.cn)
 */
class CategoryController extends Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionGetCategories()
    {
        $categoryClass = Yincart::$container->categoryClass;
        $categories = $categoryClass::getCategories();
        return Json::encode($categories);
    }

    public function actionGetCategory($id)
    {
        $categoryClass = Yincart::$container->categoryClass;
        $category = $categoryClass::getCategory($id);
        return Json::encode($category);
    }

    public function actionSaveCategory()
    {
        $categoryData = \Yii::$app->getRequest()->post('Category');
        if ($categoryData) {
            $category = Yincart::$container->category;
            if (!empty($categoryData['category_id'])) {
                $id = $categoryData['category_id'];
                $category = $category->getCategory($id);
            }
            if ($category) {
                $imageDomain = \Yii::$app->params['imageDomain'];
                $categoryData['image'] = str_replace($imageDomain, '', $categoryData['image']);
                $category->setAttributes($categoryData);
                if ($category->save()) {
                    return Json::encode(['success' => 1, 'message' => \Yii::t('yincart', 'Save Category Success!'), 'id' => $category->category_id]);
                } else {
                    return Json::encode(['success' => 0, 'message' => \Yii::t('yincart', 'Save Category Error!'), 'errors' => $category->getErrors()]);
                }
            }
        }
        return Json::encode(['success' => 0, 'message' => \Yii::t('yincart', 'Error Category ID!'), 'errors' => []]);
    }

    public function actionDeleteCategory()
    {
        $id = \Yii::$app->getRequest()->post('id');
        if ($id) {
            $categoryClass = Yincart::$container->categoryClass;
            $category = $categoryClass::getCategory($id);
            if ($category) {
                $category->delete();
                return Json::encode(['success' => 1, 'message' => \Yii::t('yincart', 'Remove Category Success!')]);
            }
        }
        return Json::encode(['success' => 0, 'message' => \Yii::t('yincart', 'Error Category ID!'), 'errors' => []]);
    }

    public function actionSaveCategories()
    {
        $treeNodes = \Yii::$app->getRequest()->post('treeNodes');
        if ($treeNodes) {
            $categoryClass = Yincart::$container->categoryClass;
            $result = true;
            foreach ($treeNodes as $treeNode) {
                $category = $categoryClass->getCategory($treeNode['category_id']);
                if ($category) {
                    $result = $result && $category->move($treeNode['parent_id'], $treeNode['pre_id']);
                }
            }
            if ($result) {
                return Json::encode(['success' => 1, 'message' => \Yii::t('yincart', 'Move Category Success!')]);
            }
        }
        return Json::encode(['success' => 0, 'message' => \Yii::t('yincart', 'Move Category Fail!'), 'errors' => []]);
    }

    public function actionGetItemProps($categoryId)
    {
        $jqForm = Yincart::$container->getJqForm(['model' => Yincart::$container->itemProp]);
        $data = $jqForm->search(['category_id' => $categoryId]);
        return Json::encode($data);
    }

    public function actionGetItemProp($id)
    {
        $itemPropClass = Yincart::$container->itemPropClass;
        $itemProp = $itemPropClass::getItemProp($id);
        return Json::encode($itemProp);
    }

    public function actionSaveItemProp()
    {
        $jqForm = Yincart::$container->getJqForm(['model' => Yincart::$container->itemProp]);
        return $jqForm->save();
    }

    public function actionGetPropValues($itemPropId)
    {
        $jqForm = Yincart::$container->getJqForm(['model' => Yincart::$container->propValue]);
        $data = $jqForm->search(['item_prop_id' => $itemPropId]);
        return Json::encode($data);
    }

    public function actionGetPropValue($id)
    {
        $itemPropValueClass = Yincart::$container->itemPropValueClass;
        $itemPropValue = $itemPropValueClass::getItemPropValue($id);
        return Json::encode($itemPropValue);
    }

    public function actionSavePropValue()
    {
        $jqForm = Yincart::$container->getJqForm(['model' => Yincart::$container->propValue]);
        return $jqForm->save();
    }
}