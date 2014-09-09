<?php
/**
 * @link http://www.yincart.com/
 * @copyright Copyright (c) 2014 Yincart
 * @license http://www.yincart.com/license/
 */

namespace yincart\base\web;

use yii\helpers\ArrayHelper;

class AssetBundle extends \yii\web\AssetBundle
{
    /**
     * Registers the CSS and JS files with the given view.
     * public $css = [
     *      'css/bootstrap.min.css',
     *      'css/font-awesome.min.css' => array('position' => View::POS_END, 'condition' => 'lte IE 8')
     * ]
     * @param \yii\web\View $view the view that the asset files are to be registered with.
     */
    public function registerAssetFiles($view)
    {
        foreach ($this->js as $value) {
            if (is_array($value)) {
                if (isset($value['file'])) {
                    $js = $value['file'];
                    unset($value['file']);
                    $options = ArrayHelper::merge($this->jsOptions, $value);
                } else {
                    if (isset($value['content'])) {
                        $position = isset($value['position']) ? $value['position'] : $view::POS_READY;
                        $view->registerJs($value['content'], $position);
                    }
                    continue;
                }
            } else {
                $js = $value;
                $options = $this->jsOptions;
            }

            if ($js[0] !== '/' && $js[0] !== '.' && strpos($js, '://') === false) {
                $view->registerJsFile($this->baseUrl . '/' . $js, [], $options);
            } else {
                $view->registerJsFile($js, [], $options);
            }
        }

        foreach ($this->css as $value) {
            if (is_array($value)) {
                if (isset($value['file'])) {
                    $css = $value['file'];
                    unset($value['file']);
                    $options = ArrayHelper::merge($this->cssOptions, $value);
                } else {
                    if (isset($value['content'])) {
                        $position = isset($value['position']) ? $value['position'] : $view::POS_READY;
                        $view->registerCss($value['content'], $position);
                    }
                    continue;
                }
            } else {
                $css = $value;
                $options = $this->cssOptions;
            }

            if ($css[0] !== '/' && $css[0] !== '.' && strpos($css, '://') === false) {
                $view->registerCssFile($this->baseUrl . '/' . $css, [], $options);
            } else {
                $view->registerCssFile($css, [], $options);
            }
        }
    }

    /**
     * Publishes the asset bundle if its source code is not under Web-accessible directory.
     * It will also try to convert non-CSS or JS files (e.g. LESS, Sass) into the corresponding
     * CSS or JS files using [[AssetManager::converter|asset converter]].
     * @param \yii\web\AssetManager $am the asset manager to perform the asset publishing
     */
    public function publish($am)
    {
        if ($this->sourcePath !== null && !isset($this->basePath, $this->baseUrl)) {
            list ($this->basePath, $this->baseUrl) = $am->publish($this->sourcePath, $this->publishOptions);
        }
        $converter = $am->getConverter();
        foreach ($this->js as $i => $value) {
            if (is_array($value)) {
                if (isset($value['file'])) {
                    $js = $value['file'];
                } else {
                    continue;
                }
            } else {
                $js = $value;
            }

            if (strpos($js, '/') !== 0 && strpos($js, '://') === false) {
                if (isset($this->basePath, $this->baseUrl)) {
                    $js = $converter->convert($js, $this->basePath);
                } else {
                    $js = '/' . $js;
                }

                if (is_array($value)) {
                    $value['file'] = $js;
                } else {
                    $value = $js;
                }
                $this->js[$i] = $value;
            }
        }
        foreach ($this->css as $i => $value) {
            if (is_array($value)) {
                if (isset($value['file'])) {
                    $css = $value['file'];
                } else {
                    continue;
                }
            } else {
                $css = $value;
            }

            if (strpos($css, '/') !== 0 && strpos($css, '://') === false) {
                if (isset($this->basePath, $this->baseUrl)) {
                    $css = $converter->convert($css, $this->basePath);
                } else {
                    $css = '/' . $css;
                }

                if (is_array($value)) {
                    $value['file'] = $css;
                } else {
                    $value = $css;
                }
                $this->css[$i] = $value;
            }
        }
    }
} 