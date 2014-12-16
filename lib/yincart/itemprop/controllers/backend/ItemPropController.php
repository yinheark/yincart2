<?php

namespace yincart\itemprop\controllers\backend;

use kiwi\Kiwi;
use Yii;
use yii\bootstrap\ActiveForm;
use yincart\itemprop\models\ItemProp;
use yii\data\ActiveDataProvider;
use kiwi\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ItemPropController implements the CRUD actions for ItemProp model.
 */
class ItemPropController extends Controller
{
    public function init()
    {
        $this->view->params['topMenuKey'] = 'yincart';
        $this->view->params['leftMenuKey'] = 'category';
    }

    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all ItemProp models.
     * @param $categoryId
     * @return mixed
     */
    public function actionIndex($categoryId)
    {
        $itemPropClass = Kiwi::getItemPropClass();
        $dataProvider = new ActiveDataProvider([
            'query' => $itemPropClass::find()->where(['category_id' => $categoryId]),
        ]);

        return $this->renderPartial('index', [
            'dataProvider' => $dataProvider,
            'category' => Kiwi::getCategory()->findOne($categoryId)
        ]);
    }

    /**
     * Creates a new ItemProp model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @param $categoryId
     * @return mixed
     */
    public function actionCreate($categoryId)
    {
        $model = Kiwi::getItemProp(['category_id' => $categoryId]);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['category/index']);
        } else {
            return $this->render('create', [
                'model' => $model,
                'category' => Kiwi::getCategory()->findOne($categoryId)
            ]);
        }
    }

    /**
     * Updates an existing ItemProp model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['category/index']);
        } else {
            return $this->render('update', [
                'model' => $model,
                'category' => $model->category
            ]);
        }
    }

    /**
     * Deletes an existing ItemProp model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['category/index']);
    }

    /**
     * Finds the ItemProp model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ItemProp the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        $itemPropClass = Kiwi::getItemPropClass();
        if (($model = $itemPropClass::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionForm($categoryId, $itemId = 0)
    {
        $propValueModel = Kiwi::getPropValueModel(['categoryId' => $categoryId, 'itemId' => $itemId]);
        ob_start();
        ob_implicit_flush(false);
        $form = new ActiveForm();
        ob_get_clean();
        return $propValueModel->formFields($form);
    }
}
