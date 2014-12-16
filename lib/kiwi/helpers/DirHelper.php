<?php
/**
 * @author Lujie.Zhou(gao_lujie@live.cn)
 * @Date 10/15/2014
 * @Time 10:05 AM
 */

namespace kiwi\helpers;

class DirHelper
{
    public static function readDirs($dir, $isPath = false, $filter = null) {
        $dirs = [];
        $dir = \Yii::getAlias($dir);
        if ($handle = opendir($dir)) {
            while (($file = readdir()) !== false) {
                if (!$filter || call_user_func_array($filter, [$file, $dir])) {
                    $dirs[] = $file;
                }
            }
        }
        if ($isPath) {
            foreach ($dirs as $key => $name) {
                $dirs[$key] = $dir . '/' . $name;
            }
        }
        return $dirs;
    }

    public static function getDirs($dir, $isPath = false) {
        $filter = function($file, $path) {
            return $file != "." && $file != ".." && is_dir($path . '/' . $file);
        };
        return self::readDirs($dir, $isPath, $filter);
    }

    public static function getFiles($dir, $isPath = false) {
        $filter = function($file, $path) {
            return $file != "." && $file != ".." && is_file($path . '/' . $file);
        };
        return self::readDirs($dir, $isPath, $filter);
    }
} 