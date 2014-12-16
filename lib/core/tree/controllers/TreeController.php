<?php

namespace core\tree\controllers;

use kiwi\Kiwi;
use Yii;
use kiwi\web\Controller;
use yii\data\ActiveDataProvider;
use yii\data\Pagination;

/**
 * TreeController implements the CRUD actions for Tree model.
 */
class TreeController extends Controller
{
    public function treeModelName()
    {
        return Kiwi::getTreeClass();
    }

    public function treeModel(){
        return Kiwi::getTree();
    }
    public function actions() {
        return [
            'nodeChildren' => [
                'class' => 'gilek\gtreetable\actions\NodeChildrenAction',
                'treeModelName' => $this->treeModelName(),
            ],
            'nodeCreate' => [
                'class' => 'gilek\gtreetable\actions\NodeCreateAction',
                'treeModelName' => $this->treeModelName(),
            ],
            'nodeUpdate' => [
                'class' => 'gilek\gtreetable\actions\NodeUpdateAction',
                'treeModelName' => $this->treeModelName(),
            ],
            'nodeDelete' => [
                'class' => 'gilek\gtreetable\actions\NodeDeleteAction',
                'treeModelName' => $this->treeModelName(),
            ],
            'nodeMove' => [
                'class' => 'gilek\gtreetable\actions\NodeMoveAction',
                'treeModelName' => $this->treeModelName(),
            ],
        ];
    }

    public function actionIndex() {
        return $this->render('index');
    }

    public function actionList(){
        $name = htmlspecialchars(Yii::$app->request->get('name'));
        $treeModel =  $this->treeModel()->find()->where(['name'=>$name])->one();
        $itmTreeQuery = Kiwi::getItemTree()->find()->where(['tree_id'=>$treeModel->id]);
        $countQuery = clone $itmTreeQuery;
        $pages = new Pagination(['totalCount' =>$countQuery->count(), 'pageSize' => '6']);
        $itmTreeModels = $itmTreeQuery->offset($pages->offset)
            ->limit($pages->limit)
            ->all();
        return $this->render('list',
            [
                'itmTreeModels' => $itmTreeModels,
                'pages' => $pages,
            ]
        );
    }
}
