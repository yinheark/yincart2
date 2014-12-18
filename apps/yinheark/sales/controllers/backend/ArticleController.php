<?php
/**
 * @author Lujie.Zhou(lujie.zhou@jago-ag.cn) 
 * @Date 11/25/2014
 * @Time 11:56 AM
 */

namespace extensions\sales\controllers\backend;

use kiwi\Kiwi;
use core\cms\controllers\backend\CmsController;
use yii\data\ActiveDataProvider;
use Yii;
use yii\helpers\Json;
use yii\web\NotFoundHttpException;

class ArticleController extends CmsController
{
    public function init()
    {
        $this->getView()->params['topMenuKey'] = 'Cms';
        $this->getView()->params['leftMenuKey'] = 'Cms';
    }

    public function getModel()
    {
        return Kiwi::getArticle();
    }

    public function getModelClass(){
        return Kiwi::getArticleClass();
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

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'modelClass' => '页面管理',
        ]);
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
            return $this->render('update', [
                'model' => $model,
                'modelClass' => '页面管理',
            ]);
        }
    }
    /**
     * Displays a single Cms model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
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
        if ($model->load(Yii::$app->request->post())) {
            if($model->save() ) {
                return $this->redirect(['view', 'id' => $model->cms_id]);
            }

        } else {
            return $this->render('create', [
                'model' => $model,
                'modelClass' => '页面管理',
            ]);
        }
    }


} 