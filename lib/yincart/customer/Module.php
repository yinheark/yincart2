<?php
/**
 * @author Lujie.Zhou(lujie.zhou@jago-ag.cn) 
 * @Date 2014/11/10
 * @Time 20:11
 */

namespace yincart\customer;

use kiwi\Kiwi;

class Module extends \kiwi\base\Module
{
    public $version = 'v0.2.0';

    public static $depends = ['core_user'];

    public function bootstrap($app)
    {
        if ($app->id == 'frontend') {
            Kiwi::registerClass(['class' => ['user' => 'yincart\customer\models\Customer']]);
        }

        $this->accessControl();
    }

    public function accessControl()
    {
        if (\Yii::$app->id == 'frontend') {
            $accessControl = [
                'class' => \kiwi\filters\AccessControl::className(),
                'only' => ['customer/index'],
                'rules' => [
                    // deny all POST requests
                    [
                        'class' => '\yii\filters\AccessRule',
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ];
            $modules = \Yii::$app->params['KiwiModules'];
            foreach ($modules as $name => $class) {
                \Yii::$app->getModule($name)->attachBehavior('accessControl', $accessControl);
            }
            \Yii::$app->attachBehavior('accessControl', $accessControl);
        }
    }
} 