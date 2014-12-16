<?php
/**
 * @link http://www.yincart.com/
 * @copyright Copyright (c) 2014 Yincart
 * @license http://www.yincart.com/license/
 */

namespace kiwi\widgets\elfinder;

use dosamigos\gallery\Gallery;
use mihaildev\elfinder\AssetsCallBack;
use mihaildev\elfinder\InputFile;
use yii\helpers\Html;

class ElfinderInput extends InputFile
{
    public $inputs = [];

    /**
     * Runs the widget.
     */
    public function run()
    {
        $images = $this->model->{$this->attribute};
        $galleryItems = array_map(function($value) {
            return [
                'url' => isset($value['url']) ? $value['url'] : '',
                'src' => isset($value['url']) ? $value['url'] : '',
                'options' => $value
            ];
        }, $images);

        Gallery::widget();

        if ($this->hasModel()) {
            $replace['{input}'] = Html::activeTextInput($this->model, $this->attribute, $this->options);
        } else {
            $replace['{input}'] = Html::textInput($this->name, $this->value, $this->options);
        }

        $replace['{button}'] = Html::tag($this->buttonTag,$this->buttonName, $this->buttonOptions);


        echo strtr($this->template, $replace);

        AssetsCallBack::register($this->getView());

        if (!empty($this->multiple))
            $this->getView()->registerJs("ElFinderFileCallback.register(" . Json::encode($this->options['id']) . ", function(files, id){ var _f = []; for (var i in files) { _f.push(files[i].url); } \$('#' + id).val(_f.join(', ')); return true;}); $(document).on('click','#" . $this->buttonOptions['id'] . "', function(){ElFinderFileCallback.openManager(" . Json::encode($this->_managerOptions) . ");});");
        else
            $this->getView()->registerJs("ElFinderFileCallback.register(" . Json::encode($this->options['id']) . ", function(file, id){ \$('#' + id).val(file.url); return true;}); $(document).on('click', '#" . $this->buttonOptions['id'] . "', function(){ElFinderFileCallback.openManager(" . Json::encode($this->_managerOptions) . ");});");
    }
} 