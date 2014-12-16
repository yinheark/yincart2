<?php
/**
 * @author Lujie.Zhou(gao_lujie@live.cn)
 * @Date 10/14/2014
 * @Time 9:45 AM
 */

namespace kiwi;

use kiwi\helpers\DirHelper;
use yii\base\BootstrapInterface;
use yii\base\InvalidConfigException;
use yii\helpers\ArrayHelper;

/**
 * Class Module
 * load module config and add to yii
 * @package kiwi
 * @author Lujie.Zhou(gao_lujie@live.cn)
 */
class Bootstrap implements BootstrapInterface
{
    public $codePools = ['@extensions'];

    public function bootstrap($app)
    {
//        $this->initModuleNamespace();
//        $this->loadModuleConfig();
//        $this->initModules();
        foreach (['initModuleNamespace', 'loadModuleConfig', 'initModules'] as $func) {
            \Yii::beginProfile($func, __METHOD__);
            $this->$func();
            \Yii::endProfile($func, __METHOD__);
        }
    }

    /**
     * set the alias of extension namespace for autoload
     */
    public function initModuleNamespace()
    {
        foreach ($this->codePools as $codePoolDir) {
            $namespaceDirs = DirHelper::getDirs(\Yii::getAlias($codePoolDir));
            foreach ($namespaceDirs as $namespaceDir) {
                \Yii::setAlias($namespaceDir, $codePoolDir . '/' . $namespaceDir);
            }
        }
    }

    /**
     * load module config file for add to yii
     */
    public function loadModuleConfig()
    {
        $moduleClasses = [];
        $configFiles = [];
        foreach ($this->codePools as $codePoolDir) {
            $namespaceDirs = DirHelper::getDirs($codePoolDir);
            foreach ($namespaceDirs as $namespaceDir) {
                $moduleDirs = DirHelper::getDirs($codePoolDir . '/' . $namespaceDir);
                foreach ($moduleDirs as $moduleDir) {
                    $moduleName = $namespaceDir . '_' . $moduleDir;
                    /** @var \kiwi\base\Module $moduleClass */
                    $moduleClass = $namespaceDir . '\\' . $moduleDir . '\\Module';
                    if (class_exists($moduleClass) && $moduleClass::$active) {
                        $moduleClasses[$moduleName] = $moduleClass;
                        $configFiles = ArrayHelper::merge($configFiles, $moduleClass::$config);
                    }
                }
            }
        }

        uasort($moduleClasses, function ($a, $b) {
            /** @var \kiwi\base\Module $a */
            /** @var \kiwi\base\Module $b */
            if (strpos($a, 'core') === 0 && strpos($b, 'core') !== 0) {
                return -1;
            }
            if (strpos($a, 'core') !== 0 && strpos($b, 'core') === 0) {
                return 1;
            }
            return 0;
        });

        $modules = [];
        foreach ($moduleClasses as $moduleName => $moduleClass) {
            if ($moduleClass::$depends) {
                foreach ($moduleClass::$depends as $depend) {
                    if (!isset($modules[$depend])) {
                        if (!isset($moduleClasses[$depend])) {
                            throw new InvalidConfigException(\Yii::t('kiwi', "Module {module} class is not defined, but it is depended by other module.", ['module' => $depend]));
                        }
                        $modules[$depend] = $moduleClasses[$depend];
                    }
                }
            }
            if (!isset($modules[$moduleName])) {
                $modules[$moduleName] = $moduleClass;
            }
        }

        \Yii::$app->params['KiwiModules'] = $modules;
        \Yii::$app->params['KiwiConfigFiles'] = $configFiles;

        \Yii::$app->setModules($modules);

//        $moduleConfigs = [];
//        foreach ($this->configDirs as $dir) {
//            $moduleConfigDir = \Yii::getAlias($dir);
//            if (is_dir($moduleConfigDir)) {
//                $files = DirHelper::getFiles($moduleConfigDir);
//                foreach ($files as $file) {
//                    $moduleConfigs = ArrayHelper::merge($moduleConfigs, include($moduleConfigDir . '/' . $file));
//                }
//            }
//        }

//        $modules = [];

//        if (!isset(\Yii::$app->params['KiwiConfigFiles'])) {
//            \Yii::$app->params['KiwiConfigFiles'] = [];
//        }
//
//        foreach ($moduleConfigs as $name => $config) {
//            $modules = ArrayHelper::merge($modules, $this->getModuleConfig($moduleConfigs, $name));
//
//            if (isset($config['config'])) {
//                $config['config'] = is_array($config['config']) ? $config['config'] : [$config['config']];
//                \Yii::$app->params['KiwiConfigFiles'] = ArrayHelper::merge(\Yii::$app->params['KiwiConfigFiles'], $config['config']);
//            }
//        }
//
//        \Yii::$app->params['KiwiModules'] = $modules;
//        \Yii::$app->setModules($modules);
    }

//    /**
//     * get module config with depends
//     * @param array $configs
//     * @param $name
//     * @param bool $beDepended
//     * @return array
//     * @throws InvalidConfigException
//     */
//    public function getModuleConfig(array $configs, $name, $beDepended = false)
//    {
//        $modules = [];
//        if (!isset($configs[$name])) {
//            throw new InvalidConfigException(\Yii::t('kiwi', "Module {module} is not found.", ['module' => $name]));
//        }
//        $config = $configs[$name];
//
//        if (!isset($config['active']) || !$config['active']) {
//            if ($beDepended) {
//                throw new InvalidConfigException(\Yii::t('kiwi', "Module {module} is not active, but it is depended by other module.", ['module' => $name]));
//            }
//            return [];
//        }
//
//        if (isset($config['depends'])) {
//            $beDepended = true;
//            $config['depends'] = is_array($config['depends']) ? $config['depends'] : [$config['depends']];
//            foreach ($config['depends'] as $moduleName) {
//                $modules = ArrayHelper::merge($modules, $this->getModuleConfig($configs, $moduleName, $beDepended));
//            }
//        }
//
//        if (!isset($config['class'])) {
//            throw new InvalidConfigException(\Yii::t('kiwi', "Module {module} class is not defined.", ['module' => $name]));
//        }
//        $modules[$name] = $config['class'];
//        return $modules;
//    }

    /**
     * init all modules
     */
    public function initModules()
    {
        $modules = \Yii::$app->params['KiwiModules'];
        foreach ($modules as $name => $class) {
            \Yii::$app->getModule($name);
        }
        foreach ($modules as $name => $class) {
            /** @var \kiwi\base\Module $module */
            $module = \Yii::$app->getModule($name);
            \Yii::beginProfile($module::className() . '->bootstrap', __METHOD__);
            $module->bootstrap(\Yii::$app);
            \Yii::endProfile($module::className() . '->bootstrap', __METHOD__);
        }
    }
}