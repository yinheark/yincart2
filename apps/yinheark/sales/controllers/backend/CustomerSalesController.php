<?php

namespace extensions\sales\controllers\backend;

use Yii;
use yii\data\ActiveDataProvider;
use kiwi\web\Controller;
use yii\web\NotFoundHttpException;
use kiwi\Kiwi;

/**
 * CustomerSalesController implements the CRUD actions for CustomerSales model.
 */
class CustomerSalesController extends Controller
{

    public function init()
    {
        $this->getView()->params['topMenuKey'] = 'Dahan';
        $this->getView()->params['leftMenuKey'] = 'Dahan';
    }
    /**
     * Lists all CustomerSales which were haven't been checked .
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Kiwi::getCustomerSales()->find()->where(['status'=>0])
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }
    /**
     * Lists all CustomerSales which were checked.
     * @return mixed
     */
    public function actionChecked()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Kiwi::getCustomerSales()->find()->where('status != 0')
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single CustomerSales model.
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
     * Updates an existing CustomerSales model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->customer_sales_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }


    /**
     * Finds the CustomerSales model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return CustomerSales the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        $model =  Kiwi::getCustomerSales();
        if (($model = $model::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
