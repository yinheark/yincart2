<?php

namespace core\cms\controllers\backend;

use kiwi\Kiwi;
use Yii;
use core\cms\models\Cms;
use yii\data\ActiveDataProvider;
use kiwi\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CmsController implements the CRUD actions for Cms model.
 */
class CmsController extends Controller
{
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

    public function getModel()
    {
        return Kiwi::getCms();
    }

    public function getClassName(){
        $className = get_class( $this->getModel());
        return substr($className,strrpos($className,'\\')-strlen($className)+1 );
    }
    /**
     * Lists all Cms models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => $this->getModel()->find(),
        ]);

        return $this->render('/backend/index', [
            'dataProvider' => $dataProvider,
            'modelClass' => $this->getClassName(),
        ]);
    }

    /**
     * Displays a single Cms model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('/backend/view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Cms model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = $this->getModel();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['/'.strtolower($this->getClassName()).'/view', 'id' => $model->cms_id]);
        } else {
            return $this->render('/backend/create', [
                'model' => $model,
                'modelClass' => $this->getClassName(),
            ]);
        }
    }

    /**
     * Updates an existing Cms model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['/'.strtolower($this->getClassName()).'/view', 'id' => $model->cms_id]);
        } else {
            return $this->render('/backend/update', [
                'model' => $model,
                'modelClass' => $this->getClassName(),
            ]);
        }
    }

    /**
     * Deletes an existing Cms model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['/backend/index']);
    }

    /**
     * Finds the Cms model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Cms the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = $this->getModel()->findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
