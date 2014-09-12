<?php
namespace backend\controllers;

use common\YincartAnnotation;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use common\models\LoginForm;
use yii\filters\VerbFilter;
use yincart\base\helpers\Image;
use yincart\Yincart;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionTest()
    {
        $itemClass = Yincart::$container->itemClass;
        $items = $itemClass::getItems();
        $url = $items[1]->itemImgs[0]->url;
        print_r(Image::getThumbnail($url, 1600, 550));
    }

    public function actionGa()
    {
        return YincartAnnotation::generateAnnotation();
    }

    public function actionGya()
    {
        return YincartAnnotation::generateYincartAnnotation();
    }
}
