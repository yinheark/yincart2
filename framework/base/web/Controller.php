<?php
/**
 * @link http://www.yincart.com/
 * @copyright Copyright (c) 2014 Yincart
 * @license http://www.yincart.com/license/
 */

namespace yincart\base\web;

use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yincart\trigger\behaviors\ControllerTrigger;

/**
 * Class Controller base controller
 * @package yincart\base\web
 * @author jeremy.zhou(gao_lujie@live.cn)
 */
class Controller extends \yii\web\Controller
{

    public $layout = '/main.php';

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
//            'trigger' => ['class' => ControllerTrigger::className()],
            //@TODO auth controller later
//            'auth' => ['class' => AuthFilter::className()],
//            'access' => [
//                'class' => AccessControl::className(),
//                'rules' => [
//                    [
//                        'actions' => ['login', 'error'],
//                        'allow' => true,
//                    ],
//                    [
//                        'actions' => ['logout', 'index'],
//                        'allow' => true,
//                        'roles' => ['@'],
//                    ],
//                ],
//            ],
//            'verbs' => [
//                'class' => VerbFilter::className(),
//                'actions' => [
//                    'logout' => ['post'],
//                ],
//            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
//            'error' => [
//                'class' => 'yii\web\ErrorAction',
//            ],
        ];
    }
}