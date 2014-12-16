<?php
/**
 * @author Lujie.Zhou(gao_lujie@live.cn)
 * @Date 10/14/2014
 * @Time 9:41 AM
 */

namespace kiwi;

use yii\base\UnknownMethodException;
use yii\helpers\ArrayHelper;

/**
 * Class Kiwi
 * use $container to create model for rewrite
 * use controllerMap to rewrite controller
 * use view theme to rewrite view
 *
 * @method static registerClass(array $classes)
 *
 * @package kiwi
 * @author Lujie.Zhou(gao_lujie@live.cn)
 */
class Kiwi
{
    /**
     * @var Container create object by call [[createObject()]].
     */
    public static $container;

    /**
     * @param $name
     * @param $arguments
     * @return mixed
     */
    public static function __callStatic($name, $arguments)
    {
        return call_user_func_array([self::$container, $name], $arguments);
    }
}

/**
 * Class Container
 * register class and create object
 * @package kiwi
 * @author Lujie.Zhou(gao_lujie@live.cn)
 */
class Container
{
    /**
     * @var array class map used for class create
     */
    private static $classMap = [];

    public function __construct($classes = [])
    {
        $classes = ArrayHelper::merge($classes, $this->getClasses());
        $this->registerClass($classes);
    }

    public function __call($name, $arguments)
    {
        if (strlen($name) > 3 && substr($name, 0, 3) === 'get') {
            $className = lcfirst(substr($name, 3));
            if (strlen($name) > 8 && substr($name, -5) === 'Class') {
                $className = lcfirst(substr($name, 3, -5));
                foreach (['singleton', 'class'] as $key) {
                    if (isset(self::$classMap[$key][$className])) {
                        $class = self::$classMap[$key][$className];
                        return is_array($class) ? $class['class'] : $class;
                    }
                }
            }
            $type = ['class' => $className];
            if (count($arguments) == 1 && is_array($arguments[0])) {
                $type = ArrayHelper::merge($type, $arguments[0]);
            }
            return \Yii::createObject($type);
        }
        throw new UnknownMethodException('Calling unknown method: ' . get_class($this) . "::$name()");
    }

    /**
     * register class, define the class map
     * @param array $classes the class map
     */
    public function registerClass(array $classes)
    {
        foreach (['singleton', 'class'] as $key) {
            if (isset($classes[$key])) {
                $keys = array_keys($classes[$key]);
                $keys = array_map(function($k) { return lcfirst($k); }, $keys);
                $classes[$key] = array_combine($keys, array_values($classes[$key]));
            }
        }

        self::$classMap = ArrayHelper::merge(self::$classMap, $classes);

        if (isset($classes['singleton']) && is_array($classes['singleton'])) {
            foreach ($classes['singleton'] as $name => $class) {
                \Yii::$container->setSingleton($name, $class);
            }
        }
        if (isset($classes['class']) && is_array($classes['class'])) {
            foreach ($classes['class'] as $name => $class) {
                \Yii::$container->set($name, $class);
            }
        }
    }

    /**
     * get class from custom define
     * @return array the class map
     */
    public function getClasses()
    {
        if (isset(\Yii::$app->params['classMap']) && is_array(\Yii::$app->params['classMap'])) {
            return \Yii::$app->params['classMap'];
        }
        return [];
    }
}

Kiwi::$container = new Container();