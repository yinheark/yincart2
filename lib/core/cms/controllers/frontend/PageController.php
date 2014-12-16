<?php
/**
 * @author Cangzhou.Wu(wucangzhou@gmail.com)
 * @Date 14-11-25
 * @Time 下午9:13
 */

namespace core\cms\controllers\frontend;

use Yii;
use kiwi\web\Controller;
use kiwi\Kiwi;
class PageController extends Controller
{
    public function actionIndex($key){
        $page = Kiwi::getPage()->find()->where(['key'=>$key,'status'=>1])->one();
        if(!$page){
            $page = Kiwi::getPage();
        }
        return $this->render('index', array(
            'page' => $page,
        ));
    }
} 