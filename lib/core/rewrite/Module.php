<?php

namespace core\rewrite;


use kiwi\Kiwi;
use yii\base\Event;
use yii\helpers\ArrayHelper;

/**
 * @description :
 * Class Module
 *
 * @method array getAlias()
 * @method array getControllers()
 *
 * @package core\rewrite
 * @author: Changhai.Lin <changhai.lin@jago-ag.cn>
 */
class Module extends \kiwi\base\Module
{
    public $version = 'v0.1.0';

    public static $config = ['controllers'];

    public function bootstrap($app)
    {
        $this->addRewriteRule();
        $this->loadControllerMap();
        $this->blockModuleControllerAccess();
    }

    protected function addRewriteRule()
    {
        $urlManager = \Yii::$app->getUrlManager();
        $urlManager->enablePrettyUrl = true;
        $urlManager->addRules([['class' => Kiwi::getRewriteUrlRuleClass()]]);
    }

    protected function loadControllerMap()
    {
        $controllerMap = $this->getControllers();
        if (isset($controllerMap[$this->module->id])) {
            $this->module->controllerMap = ArrayHelper::merge($this->module->controllerMap, $controllerMap[$this->module->id]);
        }
    }

    protected function blockModuleControllerAccess()
    {
        Event::on(\kiwi\base\Module::className(), \kiwi\base\Module::EVENT_BEFORE_CREATE_CONTROLLER, function($event) { $event->isValid = false; });
    }

    /**
     * @deprecated
     * description : not use now, because of block the controller from module
     * @author: Changhai.Lin <changhai.lin@jago-ag.cn>
     */
    protected function loadModuleAlias()
    {
        $alias = $this->getAlias();
        foreach ($alias as $key => $alia) {
            $alias[$key . '/<controller>'] = $alia . '/<controller>';
            $alias[$key . '/<controller>/<action>'] = $alia . '/<controller>/<action>';
        }
        \Yii::$app->getUrlManager()->addRules($alias);
    }
} 