<?php
/**
 * @link http://www.yincart.com/
 * @copyright Copyright (c) 2014 Yincart
 * @license http://www.yincart.com/license/
 */

namespace yincart\catalog\controllers\backend;

use yincart\base\web\Controller;

class ElfinderController extends Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionIframe()
    {
        $this->layout = 'empty';
        return $this->render('index', ['iframe' => true]);
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'connector' => [
                'class' => 'yincart\catalog\actions\ElfinderConnectorAction',
            ],
        ];
    }
} 