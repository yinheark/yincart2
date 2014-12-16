<?php
/**
 * @author Lujie.Zhou(gao_lujie@live.cn)
 * @Date 10/16/2014
 * @Time 4:16 PM
 */

namespace kiwi\web;


use yii\helpers\Inflector;

class Controller extends \yii\web\Controller
{
    public $viewDir;

    public function getViewPath()
    {
        if (!$this->viewDir || true) {
            $names = explode('\\', $this->className());
            $controllerName = array_pop($names);
            $controllerName = Inflector::camel2id(substr($controllerName, 0, -10));
            for ($i = count($names) - 1; $names[$i] != 'controllers'; $i--) {
                $controllerName = $names[$i] . '/' . $controllerName;
            }
            $this->viewDir = $controllerName;
        }

        return $this->module->getViewPath() . DIRECTORY_SEPARATOR . $this->viewDir;
    }
} 