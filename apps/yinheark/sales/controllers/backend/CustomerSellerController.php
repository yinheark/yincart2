<?php

namespace extensions\sales\controllers\backend;

use Yii;
use yii\data\ActiveDataProvider;
use kiwi\web\Controller;
use yii\web\NotFoundHttpException;
use kiwi\Kiwi;
/**
 * CustomerSellerController implements the CRUD actions for CustomerSeller model.
 */
class CustomerSellerController extends Controller
{
    public function init()
    {
        $this->getView()->params['topMenuKey'] = 'Dahan';
        $this->getView()->params['leftMenuKey'] = 'Dahan';
    }

    /**
     * Lists all CustomerSeller models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Kiwi::getCustomerSeller()->find()->where('status = 0'),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Lists all CustomerSales which were checked.
     * @author Cangzhou.Wu(wucangzhou@gmail.com)
     * @return string
     */
    public function actionChecked()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Kiwi::getCustomerSeller()->find()->where('status != 0')
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single CustomerSeller model.
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
     * Updates an existing CustomerSeller model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->customer_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }


    /**
     * Finds the CustomerSeller model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return CustomerSeller the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        $model = Kiwi::getCustomerSeller();
        if (($model = $model::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}