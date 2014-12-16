<?php
/**
 * Created by Changhai.Lin.
 * Date: 11/19/2014 1:40 PM
 */

namespace core\setting\controllers;


use kiwi\web\Controller;

class HelperController extends Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionGenerateKiwiModuleHelper()
    {
        $modules = \Yii::$app->params['KiwiModules'];
        foreach ($modules as $module => $class) {
            $annotations = [];
            $classFile = '@' . str_replace('_', '/', $module) . '/config/classes.php';
            $classFile = \Yii::getAlias($classFile);
            if (!is_file($classFile))
                continue;

            $classes = include($classFile);
            foreach (['singleton', 'class'] as $key) {
                if (isset($classes[$key])) {
                    foreach ($classes[$key] as $name => $class) {
                        $name = ucfirst($name);
                        $annotations[] = " * @method static \\{$class} get{$name}()";
                    }
                }
            }

            foreach (['singleton', 'class'] as $key) {
                if (isset($classes[$key])) {
                    foreach ($classes[$key] as $name => $class) {
                        $name = ucfirst($name);
                        $annotations[] = " * @method static string|\\{$class} get{$name}Class()";
                    }
                }
            }
            $annotations = implode("\n", $annotations);

            $helperDir = '@' . str_replace('_', '/', $module) . '/_helpers';
            $helperDir = \Yii::getAlias($helperDir);
            $helperPath = '@' . str_replace('_', '/', $module) . '/_helpers/_kiwi_helper.php';
            $helperPath = \Yii::getAlias($helperPath);
            $data = <<<EOF
<?php

namespace kiwi;

exit("This file should not be included, only analyzed by your IDE");

/**
{$annotations}
 */
class Kiwi
{
}
EOF;
            if (!file_exists($helperDir)) {
                mkdir($helperDir);
            }
            file_put_contents($helperPath, $data);
        }
    }


    public function actionGenerateDataListModelHelper()
    {
        $modules = \Yii::$app->params['KiwiModules'];
        foreach ($modules as $module => $class) {
            $annotations = [];
            $configFile = '@' . str_replace('_', '/', $module) . '/config/settings.php';
            $configFile = \Yii::getAlias($configFile);
            if (!is_file($configFile))
                continue;

            $config = include($configFile);
            if (!isset($config['dataList']))
                continue;

            $dataList = $config['dataList'];
            $dataListKeys = array_keys($dataList);
            $annotations = array_map(function($key) {
                $key = lcfirst($key);
                return " * @property array {$key}";
            }, $dataListKeys);

            $annotations = implode("\n", $annotations);

            $helperDir = '@' . str_replace('_', '/', $module) . '/_helpers';
            $helperDir = \Yii::getAlias($helperDir);
            $helperPath = '@' . str_replace('_', '/', $module) . '/_helpers/_dataList_model_helper.php';
            $helperPath = \Yii::getAlias($helperPath);
            $data = <<<EOF
<?php

namespace core\setting\models;

exit("This file should not be included, only analyzed by your IDE");

/**
{$annotations}
 */
class DataList
{
}
EOF;
            if (!file_exists($helperDir)) {
                mkdir($helperDir);
            }
            file_put_contents($helperPath, $data);
        }
    }

    public function actionGenerateSettingModelHelper()
    {
        $modules = \Yii::$app->params['KiwiModules'];
        foreach ($modules as $module => $class) {
            $annotations = [];
            $configFile = '@' . str_replace('_', '/', $module) . '/config/settings.php';
            $configFile = \Yii::getAlias($configFile);
            if (!is_file($configFile))
                continue;

            $config = include($configFile);
            if (!isset($config['config']))
                continue;

            $config = $config['config'];
            foreach ($config as $tabKey => $tabConfig) {
                foreach ($tabConfig['groups'] as $groupKey => $groupConfig) {
                    foreach ($groupConfig['fields'] as $fieldKey => $fieldConfig) {
                        $annotations[] = " * @property string {$tabKey}_{$groupKey}_{$fieldKey}";
                    }
                }
            }

            $annotations = implode("\n", $annotations);

            $helperDir = '@' . str_replace('_', '/', $module) . '/_helpers';
            $helperDir = \Yii::getAlias($helperDir);
            $helperPath = '@' . str_replace('_', '/', $module) . '/_helpers/_setting_model_helper.php';
            $helperPath = \Yii::getAlias($helperPath);
            $data = <<<EOF
<?php

namespace core\setting\models;

exit("This file should not be included, only analyzed by your IDE");

/**
{$annotations}
 */
class SettingKVModel
{
}
EOF;
            if (!file_exists($helperDir)) {
                mkdir($helperDir);
            }
            file_put_contents($helperPath, $data);
        }
    }
} 