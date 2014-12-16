<?php
/**
 * @link http://www.yincart.com/
 * @copyright Copyright (c) 2014 Yincart
 * @license http://www.yincart.com/license/
 */

namespace kiwi\widgets\gallery;

use yii\helpers\ArrayHelper;
use yii\helpers\Html;

class Gallery extends \dosamigos\gallery\Gallery
{
    public $inputFields = [];

    public function renderItem($item)
    {
        if (is_string($item)) {
            return Html::a(Html::img($item), $item, ['class' => 'gallery-item']);
        }
        $src = ArrayHelper::getValue($item, 'src');
        if ($src === null) {
            return null;
        }
        $url = ArrayHelper::getValue($item, 'url', $src);
        $options = ArrayHelper::getValue($item, 'options', []);
        Html::addCssClass($options, 'gallery-item');

        $inputHtml = [];
        foreach ($this->inputFields as $name => $label) {
            $values = ArrayHelper::getValue($item, 'values', []);
            if (is_integer($name)) {
                $inputHtml[] = Html::hiddenInput($label, $values[$label]);
            } else {
                $inputHtml[] = Html::label($label, $name) . Html::textInput($name, $values[$name]);
            }
        }
        $inputHtml = implode('', $inputHtml);

        return Html::a(Html::img($src) . $inputHtml, $url, $options);
    }
} 