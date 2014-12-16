<?php

namespace yincart\itemprop\controllers\backend;

use kiwi\Kiwi;
use Yii;
use yincart\itemprop\models\PropValue;
use yii\data\ActiveDataProvider;
use kiwi\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PropValueController implements the CRUD actions for PropValue model.
 */
class PropValueController extends Controller
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
     * Creates a new PropValue model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @param $itemPropId
     * @return mixed
     */
    public function actionCreate($itemPropId)
    {
        $model = Kiwi::getPropValue(['item_prop_id' => $itemPropId]);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['item-prop/update', 'id' => $model->item_prop_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'itemProp' => Kiwi::getItemProp()->findOne($itemPropId),
            ]);
        }
    }

    /**
     * Updates an existing PropValue model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['item-prop/update', 'id' => $model->item_prop_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'itemProp' => $model->itemProp
            ]);
        }
    }

    /**
     * Deletes an existing PropValue model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $model->delete();

        return $this->redirect(['item-prop/update', 'id' => $model->item_prop_id]);
    }

    /**
     * Finds the PropValue model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return PropValue the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PropValue::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
