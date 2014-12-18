<?php
/**
 * @author Lujie.Zhou(gao_lujie@live.cn)
 * @Date 10/15/2014
 * @Time 9:46 AM
 */

namespace kiwi\base;


use kiwi\db\Migration;
use kiwi\helpers\DirHelper;
use kiwi\Kiwi;
use yii\base\BootstrapInterface;
use yii\base\Event;
use yii\base\ModelEvent;
use yii\helpers\ArrayHelper;
use yii\log\Logger;

class Module extends \yii\base\Module implements BootstrapInterface
{
    public $version;

    public static $active = true;

    public static $depends = [];

    public static $config = [];

    public function init()
    {
        parent::init();
        if ($this->module) {
//            $this->migrateUp();
//            $this->loadClassMap();
//            $this->loadControllerMap();
//            $this->loadViewPathMap();
//            $this->loadCustomConfig();
            foreach (['loadClassMap', 'loadCustomConfig', 'migrateUp'] as $func) {
                \Yii::beginProfile(get_called_class() . '->' . $func, __METHOD__);
                $this->$func();
                \Yii::endProfile(get_called_class() . '->' . $func, __METHOD__);
            }
        }
    }

    public function bootstrap($app)
    {

    }

    public function migrateUp()
    {
        $dataVersion = $this->getDataVersion();
        if ($dataVersion && $dataVersion == $this->version) {
            return;
        }

        //get migration files
        $migrationFileDir = $this->getBasePath() . '/migrations';

        if (!is_dir($migrationFileDir))
            return;

        $migrationFiles = DirHelper::getFiles($migrationFileDir);
        if (!$migrationFiles)
            return;

        $migrationVersions = array_map(function ($fileName) {
            $fileName = explode('.', $fileName);
            unset($fileName[count($fileName) - 1]);
            return implode('.', $fileName);
        }, $migrationFiles);

        $installVersion = '';
        $upgradeVersions = [];
        //get version list
        foreach ($migrationVersions as $migrationVersion) {
            if (strpos($migrationVersion, '_') === false) {
                $installVersion = $migrationVersion;
            } else {
                $migrationVersion = explode('_', $migrationVersion);
                $upgradeVersions[$migrationVersion[0]] = $migrationVersion[1];
            }
        }

        //if not install, find install file and run
        if (!$dataVersion && $installVersion) {
            include($migrationFileDir . '/' . $installVersion . '.php');
            $class = $this->getModuleNameSpace() . '\\migrations\\' . str_replace('.', '_', $installVersion);
            /** @var \kiwi\db\Migration $migration */
            $migration = new $class(['module' => $this->id]);
            $migration->up();
            $dataVersion = $installVersion;
            \Yii::getLogger()->log("Module {$this->id} version $dataVersion installed", Logger::LEVEL_INFO);
        }
        //if has upgrade version, run upgrade
        while (isset($upgradeVersions[$dataVersion])) {
            include($migrationFileDir . '/' . $dataVersion . '_' . $upgradeVersions[$dataVersion] . '.php');
            $class = $this->getModuleNameSpace() . '\\migrations\\' . str_replace('.', '_', $dataVersion . '_' . $upgradeVersions[$dataVersion]);
            /** @var \kiwi\db\Migration $migration */
            $migration = new $class(['module' => $this->id]);
            $migration->up();
            $dataVersion = $upgradeVersions[$dataVersion];
            \Yii::getLogger()->log("Module {$this->id} version $dataVersion upgraded", Logger::LEVEL_INFO);
        }
    }

    public function getDataVersion()
    {
        $migration = new Migration(['module' => $this->id]);
        return $migration->getVersion();
    }

    public function getModuleNameSpace()
    {
        $class = get_called_class();
        if (($pos = strrpos($class, '\\')) !== false) {
            return substr($class, 0, $pos);
        }
        return 'app';
    }

    protected function loadClassMap()
    {
        $classMapFile = $this->getBasePath() . '/config/classes.php';
        if (is_file($classMapFile)) {
            $classMap = include($classMapFile);
            Kiwi::registerClass($classMap);
        }
    }

    protected function loadCustomConfig()
    {
        if (!isset($this->module->params['KiwiConfig'])) {
            $this->module->params['KiwiConfig'] = [];
        }

        foreach ($this->module->params['KiwiConfigFiles'] as $configName) {
            $configFile = $this->getBasePath() . '/config/' . $configName . '.php';
            if (is_file($configFile)) {
                $configData = include($configFile);
                if (!isset($this->module->params['KiwiConfig'][$configName])) {
                    $this->module->params['KiwiConfig'][$configName] = [];
                }
                $this->module->params['KiwiConfig'][$configName] = ArrayHelper::merge($this->module->params['KiwiConfig'][$configName], $configData);
            }
        }
    }

    public function getCustomConfig($name)
    {
        return isset($this->module->params['KiwiConfig'][$name]) ? $this->module->params['KiwiConfig'][$name] : [];
    }

    public function setCustomConfig($name, $config)
    {
        $this->module->params['KiwiConfig'][$name] = $config;
    }

    public function __get($name)
    {
        if (isset($this->module->params['KiwiConfig'][$name])) {
            return $this->module->params['KiwiConfig'][$name];
        }
        return parent::__get($name);
    }

    public function __call($name, $arguments)
    {
        if (substr($name, 0, 3) === 'get') {
            $key = lcfirst(substr($name, 3));
            if (isset($this->module->params['KiwiConfig'][$key])) {
                return $this->module->params['KiwiConfig'][$key];
            }
        }
        return parent::__call($name, $arguments);
    }

    public function createController($route)
    {
        return $this->beforeCreateController($route) ? parent::createController($route) : false;
    }

    const EVENT_BEFORE_CREATE_CONTROLLER = 'beforeCreateController';

    public function beforeCreateController($route)
    {
        $event = new ModelEvent(['data' => ['route' => $route]]);
        $this->trigger(self::EVENT_BEFORE_CREATE_CONTROLLER, $event);
        return $event->isValid;
    }
}