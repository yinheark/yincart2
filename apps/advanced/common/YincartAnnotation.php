<?php
/**
 * @link http://www.yincart.com/
 * @copyright Copyright (c) 2014 Yincart
 * @license http://www.yincart.com/license/
 */

namespace common;

use yincart\Yincart;

class YincartAnnotation
{
    public static function generateAnnotation()
    {
        $classes = array_merge(Yincart::$classMap['singleton'], Yincart::$classMap['class']);
        $annotationTypes = ['propertyInstance', 'propertyClass', 'methodInstance', 'methodClass'];
        $classTypes = ['Asset', 'widgets', 'Form', 'models'];
        $annotations = array_fill_keys($annotationTypes, array_fill_keys($classTypes, []));
        $newLine = "\n";

        foreach ($classes as $name => $class) {
            if (in_array($name, ['yii\web\JqueryAsset'])) {
                continue;
            }
            $len = 45 - strlen($class);
            $spaces = '';
            while ($len--) {
                $spaces .= ' ';
            }

            foreach ($classTypes as $type) {
                if (strpos($class, $type) !== false) {
                    $annotations['propertyInstance'][$type][] = " * @property \\$class       $spaces\$$name";
                    $annotations['propertyClass'][$type][] = " * @property string|\\$class$spaces\${$name}Class";
                    $name = ucfirst($name);
                    $annotations['methodInstance'][$type][] = " * @method \\$class         {$spaces}get$name(array \$config = [])";
                    $annotations['methodClass'][$type][] = " * @method string|\\$class  {$spaces}get{$name}Class()";
                    break;
                }
            }
        }

        foreach ($annotations as $key => $types) {
            foreach ($types as $type => $values) {
                $types[$type] = " * --- $type class $key ---$newLine" . implode("$newLine", $values) . "$newLine * ";
            }
            $annotations[$key] = implode("$newLine", $types);
        }
        $annotations = implode("$newLine * ================================================================================$newLine * $newLine", $annotations);
        $annotations = "/**\n * Class Container\n * \n" . $annotations . "\n * @package yincart\n * @author jeremy.zhou(gao_lujie@live.cn)\n */";
        return $annotations;
    }

    public static function generateYincartAnnotation()
    {
        $classes = array_merge(Yincart::$classMap['singleton'], Yincart::$classMap['class']);
        $annotationTypes = ['methodInstance', 'methodClass'];
        $classTypes = ['Asset', 'widgets', 'Form', 'models'];
        $annotations = array_fill_keys($annotationTypes, array_fill_keys($classTypes, []));
        $newLine = "\n";

        foreach ($classes as $name => $class) {
            if (in_array($name, ['yii\web\JqueryAsset'])) {
                continue;
            }
            $len = 45 - strlen($class);
            $spaces = '';
            while ($len--) {
                $spaces .= ' ';
            }

            foreach ($classTypes as $type) {
                if (strpos($class, $type) !== false) {
                    $name = ucfirst($name);
                    $annotations['methodInstance'][$type][] = " * @method static \\$class         {$spaces}get$name(array \$config = [])";
                    $annotations['methodClass'][$type][] = " * @method static string|\\$class  {$spaces}get{$name}Class()";
                    break;
                }
            }
        }

        foreach ($annotations as $key => $types) {
            foreach ($types as $type => $values) {
                $types[$type] = " * --- $type class $key ---$newLine" . implode("$newLine", $values) . "$newLine * ";
            }
            $annotations[$key] = implode("$newLine", $types);
        }
        $annotations = implode("$newLine * ================================================================================$newLine * $newLine", $annotations);
        $txt[] = 'use yincart $container to create model for rewrite';
        $txt[] = 'use controllerMap to rewrite controller';
        $txt[] = 'use view theme to rewrite view';
        $txt = implode("\n * ", $txt);
        $annotations = "/**\n * Class Yincart\n * $txt\n * \n" . $annotations . "\n * @package yincart\n * @author jeremy.zhou(gao_lujie@live.cn)\n */";
        return $annotations;
    }
} 