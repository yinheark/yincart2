<?php

namespace yincart\item\controllers\frontend;

use kiwi\Kiwi;
use Yii;
use kiwi\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * ItemController implements the CRUD actions for Item model.
 */
class ItemController extends Controller
{
    /**s
     * view item
     * @param $id
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionView($id) {
        return $this->render('view',[
            'item' => $this->findModel($id)
        ]);
    }

    /**
     * Finds the Item model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return \yincart\item\models\Item the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        $itemClass = Kiwi::getItemClass();
        if (($model = $itemClass::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
