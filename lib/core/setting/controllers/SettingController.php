<?php
/**
 * @author Lujie.Zhou(gao_lujie@live.cn)
 * @Date 10/20/2014
 * @Time 2:12 PM
 */

namespace core\setting\controllers;


use kiwi\filters\AccessControl;
use kiwi\Kiwi;
use kiwi\web\Controller;

class SettingController extends Controller
{
    public $viewDir = 'setting';

    public function actionIndex()
    {
        /** @var \core\setting\models\SettingKVModel $settingKVModel */
        $settingKVModel = Kiwi::getSettingKVModel();
        if (\Yii::$app->getRequest()->getIsPost()) {
            $settingKVModel->load(\Yii::$app->getRequest()->post());
            $settingKVModel->save();
        }
        return $this->render('index', ['settingKVModel' => $settingKVModel]);
    }
} 