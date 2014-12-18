<?php
/**
 * @author Cangzhou Wu<wucang.zhou@jago-ag.cn>
 * @Date: 14-11-27
 * @Time: 下午2:13
 */

namespace extensions\sales\controllers\frontend;


use kiwi\Kiwi;
use kiwi\web\Controller;
use Yii;
use yii\helpers\Json;
use yii\data\ActiveDataProvider;

class CustomerSalesController extends Controller
{
    public $layout = "customer";

    public function actionCreate()
    {
        $post = Yii::$app->request->post();
        if ($post) {
            if (Yii::$app->user->isGuest) {
                return Json::encode(['message' => '请先登录']);
            }
            if (Kiwi::getCustomerSeller()->find()->where(['customer_id' => Yii::$app->user->id])->one()->status != 1) {
                return Json::encode(['message' => '您还不是销售，或者审核未通过，请去用户中心页面申请']);
            }
            if (Kiwi::getCustomerSales()->find()->where(['user_id' => Yii::$app->user->id, 'item_id' => $post['item_id']])->all()) {
                return Json::encode(['message' => '您已经申请过此商品，请耐心等候审核']);
            }
            $model = Kiwi::getCustomerSales(['user_id' => Yii::$app->user->id]);
            $model->item_id = $post['item_id'];
            $itemModel = Kiwi::getItem()->findOne(['item_id' => $model->item_id]);
            $model->status = 0;
            $model->price = $itemModel->original_price;
            if ($model->save()) {
                return Json::encode(['message' => '申请销售成功']);
            } else {
                return Json::encode(['message' => '申请销售失败，若多次出现请联系管理员']);
            }
        }
    }

    /**
     * user center customerSales index
     * @author Cangzhou.Wu(wucangzhou@gmail.com)
     * @return string|\yii\web\Response
     */
    public function actionIndex()
    {
        //make a request for bing a seller
        $model = Kiwi::getCustomerSeller()->find()->where(['customer_id' => Yii::$app->user->id])->one() ? : Kiwi::getCustomerSeller();

        if (!$model->isNewRecord && $model->status == 1) {
            // show CustomerSales data
            $dataProvider = new ActiveDataProvider([
                'query' => Kiwi::getCustomerSales()->find()->where(['user_id' => Yii::$app->user->id])
            ]);

            return $this->render('index', [
                'dataProvider' => $dataProvider,
                'model' => $model,
            ]);
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
//            return $this->redirect(['index']);
        }

        return $this->render('form', [
            'model' => $model,
        ]);
    }
} 