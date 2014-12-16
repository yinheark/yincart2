<?php

namespace core\rewrite\controllers;

use kiwi\filters\AccessControl;
use kiwi\Kiwi;
use Yii;
use kiwi\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * RewriteController implements the CRUD actions for UrlRewrite model.
 */
class RewriteController extends Controller
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

    /**
     * Lists all UrlRewrite models.
     * @return mixed
     */
    public function actionIndex()
    {
        /** @var \core\rewrite\models\UrlRewriteSearch $searchModel */
        $searchModel = Kiwi::getUrlRewriteSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('/rewrite/index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Creates a new UrlRewrite model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        /** @var \core\rewrite\models\UrlRewrite $model */
        $model = Kiwi::getUrlRewrite();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        } else {
            return $this->render('/rewrite/create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing UrlRewrite model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        } else {
            return $this->render('/rewrite/update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing UrlRewrite model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the UrlRewrite model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return \core\rewrite\models\UrlRewrite the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        /** @var \core\rewrite\models\UrlRewrite $modelClass */
        $modelClass = Kiwi::getUrlRewriteClass();

        if (($model = $modelClass::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
