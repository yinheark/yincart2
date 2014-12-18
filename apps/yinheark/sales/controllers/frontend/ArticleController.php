<?php
/**
 * @author Cangzhou Wu<wucang.zhou@jago-ag.cn>
 * @Date: 14-12-9
 * @Time: 上午11:45
 */

namespace extensions\sales\controllers\frontend;

use kiwi\web\Controller;
use kiwi\Kiwi;
use yii\data\Pagination;

class ArticleController extends Controller
{

    public function actionList($type){
        $articleQuery = Kiwi::getArticle()->find()->where(['type'=>$type])->orderBy(['updated_at'=>SORT_DESC]);
        $countQuery = clone $articleQuery;
        $pages = new Pagination(['totalCount' =>$countQuery->count(), 'pageSize' => '4']);
        $articleModels = $articleQuery->offset($pages->offset)
            ->limit($pages->limit)
            ->all();
        return $this->render('list',
            [
                'articleModels' => $articleModels,
                'pages' => $pages,
            ]
        );
    }
} 