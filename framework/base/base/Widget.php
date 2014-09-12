<?php
/**
 * @link http://www.yincart.com/
 * @copyright Copyright (c) 2014 Yincart
 * @license http://www.yincart.com/license/
 */

namespace yincart\base\base;

use yii\helpers\Html;

/**
 * Class Widget
 * @package yincart\base\base
 * @author jeremy.zhou(gao_lujie@live.cn)
 */
class Widget extends \yii\base\Widget
{

    /**
     * @var array custom data to show on html tag data
     */
    public $tagData = [];

    public function getTagData()
    {
        $tagData = [];
        foreach ($this->tagData as $key => $value) {
            $dataKey = $this->splitWords($key);
            $dataKey = implode('-', $dataKey);
            $tagData[$dataKey] = $value;
        }
        return $tagData;
    }

    public function splitWords($words)
    {
        $words = preg_split("/([A-Z])/", $words, -1, PREG_SPLIT_DELIM_CAPTURE);
        $result = [$words[0]];
        $count = count($words);
        for ($i = 1; $i < $count; $i = $i + 2) {
            $result[] = strtolower($words[$i]) . $words[$i + 1];
        }
        return $result;
    }

    #region @deprecated render js in page

    public $renderJs = false;

    /**
     * render js in page
     * @return string
     */
    public function renderJs()
    {
        $jsLines = "\n";
        if ($this->getView()->assetBundles) {
            foreach ($this->getView()->assetBundles as $assetBundle) {
                if (!$assetBundle->sourcePath) {
                    foreach ($assetBundle->js as $jsFile) {
                        $jsLines .= "\n" . Html::jsFile($jsFile, $assetBundle->jsOptions);
                    }
                }
            }
        }
        if ($this->getView()->jsFiles) {
            foreach ($this->getView()->jsFiles as $jsFiles) {
                $jsLines .= implode("\n", $jsFiles);
            }
        }
        if ($this->getView()->js) {
            foreach ($this->getView()->js as $js) {
                $jsLines .= implode("\n", $js);
            }
        }
        return $jsLines;
    }

    /**
     * @inheritdoc
     */
    public static function end()
    {
        /** @var Widget $widget */
        $widget = parent::end();
        if ($widget->renderJs) {
            echo $widget->renderJs();
        }
    }

    /**
     * @inheritdoc
     */
    public static function widget($config = [])
    {
        ob_start();
        ob_implicit_flush(false);
        /* @var $widget Widget */
        $config['class'] = get_called_class();
        $widget = \Yii::createObject($config);
        $out = $widget->run();
        $js = $widget->renderJs ? $widget->renderJs() : '';

        return ob_get_clean() . $out . $js;
    }

    #endregion render js in page
} 