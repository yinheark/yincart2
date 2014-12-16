<?php

namespace yincart\customer\controllers\frontend;

use core\user\controllers\UserController;
use yii\data\ActiveDataProvider;
use kiwi\Kiwi;
use Yii;
use yii\helpers\Json;
use yincart\customer\models\Customer;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CustomerController implements the CRUD actions for Customer model.
 */
class CustomerController extends UserController
{
    public $layout = "customer";

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
     * find customer's information
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionIndex()
    {
        return $this->render('index', [
            'customer' => $this->findModel(Yii::$app->user->id),
        ]);
    }

    /**
     * Updates an existing Customer model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate()
    {
        /** @var \yincart\customer\models\CustomerInfo $model */
        $model = Kiwi::getCustomerInfo()->find()->where(['user_id'=>Yii::$app->user->id])->one();
        if(!$model){
            $model = Kiwi::getCustomerInfo(['user_id'=>Yii::$app->user->id]);
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index', 'id' => $model->user_id]);
        } else {
            return $this->render('update', [
                'customerInfo' => $model,
            ]);
        }
    }

    public function actionAddDeliveryAddress()
    {
        /** @var \yincart\customer\models\CustomerInfo $model */
        $customer = $this->findModel(Yii::$app->user->id);
        return $this->render('delivery_address',[
            'model' => $customer
        ]);
    }

    /**
     * Finds the Customer model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Customer the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        /** @var \yincart\customer\models\CustomerInfo $customerInfoClass */
        $customerClass = Kiwi::getCustomerClass();
        if (($model = $customerClass::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * find customer's address
     * @author Cangzhou Wu<wucang.zhou@jago-ag.cn>
     * @return string
     */
    public function actionDeliveryAddress(){
        /* @var \yincart\customer\models\CustomerAddress $model */
        $model = Kiwi::getCustomerAddress(['user_id'=>Yii::$app->user->id]);

        $dataProvider = new ActiveDataProvider([
            'query' =>  $model::find()->where(['user_id'=>Yii::$app->user->id]),
        ]);

        //view
        if(Yii::$app->request->get('view_id')){
            $model = $model->find()->where(['customer_address_id'=>Yii::$app->request->get('view_id'),'user_id'=>Yii::$app->user->id])->one();
        }

        //create and update
        if ($model->load(Yii::$app->request->post()) ) {
            $model->save();
        }



        $area = Kiwi::getArea()->find()->where(['parent_id'=>100000])->all();
        $catList = [];

        foreach($area as $s){
            $catList[$s->area_id] = $s->name;
        }
        return $this->render('delivery_address',[
            'model' => $model,
            'catList' => $catList,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * get cities list
     * @author Cangzhou Wu<wucang.zhou@jago-ag.cn>
     */
    public function actionGetCities() {
        $out = [];
        if (isset($_POST['depdrop_parents'])) {
            $parents = $_POST['depdrop_parents'];
            if ($parents != null) {
                $cat_id = $parents[0];
                $out = self::getList($cat_id);
                echo Json::encode(['output'=>$out, 'selected'=>'']);
                return;
            }
        }
        echo Json::encode(['output'=>'', 'selected'=>'']);
    }

    /**
     * get district list
     * @author Cangzhou Wu<wucang.zhou@jago-ag.cn>
     */
    public function actionGetDistrict() {
        $out = [];
        if (isset($_POST['depdrop_parents'])) {
            $ids = $_POST['depdrop_parents'];
            $cat_id = empty($ids[0]) ? null : $ids[0];
            $subcat_id = empty($ids[1]) ? null : $ids[1];
            if ($cat_id != null) {
                $data = self::getList($subcat_id,false);
                echo Json::encode(['output'=>$data['out'], 'selected'=>$data['selected']]);
                return;
            }
        }
        echo Json::encode(['output'=>'', 'selected'=>'']);
    }

    /**
     * get catList
     * @author Cangzhou Wu<wucang.zhou@jago-ag.cn>
     * @param $cat_id
     * @param bool $city  city list flag
     * @return array
     */
    public function getList($cat_id,$city=true){
        $cities =  Kiwi::getArea()->find()->where(['parent_id'=>$cat_id])->all();
        $catList = [];
        if($city){
            foreach($cities as $s){
                $catList[] = ['id'=>$s->area_id, 'name'=>$s->name];
            }
        }else{
            foreach($cities as $s){
                $catList[ 'out'][] = ['id'=>$s->area_id, 'name'=>$s->name];
            }
            $catList['selected'] = $s->area_id;
        }

        return $catList;
    }

    /**
     * Deletes an existing customerAddress model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findCustomerAddressModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the customerAddress model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return customerAddress the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findCustomerAddressModel($id)
    {
        $model = Kiwi::getCustomerAddress();
        if (($model = $model::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionOrder()
    {
        $order_id = Yii::$app->request->get('order_id');
        if(isset($order_id)) {
            $orderClass = Kiwi::getOrderClass();
            if(($order = $orderClass::findOne($order_id)) !== null) {
                return $this->render('order_view',['order' => $order]);
            } else {
                throw new NotFoundHttpException('The requested page does not exist.');
            }
        }
        $model = Kiwi::getOrder();
        $dataProvider = new ActiveDataProvider([
            'query' =>  $model::find()->where(['user_id'=>Yii::$app->user->id]),
        ]);
        return $this->render('list', [
            'dataProvider' => $dataProvider,
        ]);
    }
}
