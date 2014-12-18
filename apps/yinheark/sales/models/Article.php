<?php
/**
 * @author Lujie.Zhou(lujie.zhou@jago-ag.cn) 
 * @Date 11/25/2014
 * @Time 11:47 AM
 */

namespace extensions\sales\models;

use core\cms\models\Cms;
use kiwi\behaviors\JsonAttribute;
use yii\helpers\ArrayHelper;
use Yii;
class Article extends Cms
{
    const TYPE_FASHION = 'fashion';
    const TYPE_MV = 'mv';
    const TYPE_TEXT = 'text';
    const TYPE_ARTICLE = 'article';
    const TYPE_SLIDER = 'slider';

    public function init()
    {
        parent::init();
    }

    /**
     * @inheritdoc
     */
    public static function find()
    {
        return parent::find()->where(['type' => [static::TYPE_FASHION, static::TYPE_MV,static::TYPE_TEXT, static::TYPE_ARTICLE,static::TYPE_SLIDER]]);
    }

    public function __get($name)
    {
        if (in_array($name, ['short_d','pictures'])){
            return isset($this->data[$name]) ? $this->data[$name] : '';
        }
        return parent::__get($name);
    }

    public function __set($name, $value){
        if (in_array($name, ['short_d','pictures'])){
            if (!is_array($this->data)) {
                $this->data = [];
            }
            $this->data = ArrayHelper::merge($this->data, [$name => $value]);
            return;
        }
        parent::__set($name, $value);
    }

    public function rules()
    {
        return ArrayHelper::merge(parent::rules(), [[['short_d','pictures'], 'string']]);
    }

    public function behaviors()
    {
        return [
            'json' => [
                'class' => JsonAttribute::className(),
                'attributes' => ['data']
            ]
        ];
    }

    public function attributeLabels()
    {
        return parent::attributeLabels() + [
            'short_d' => Yii::t('app', 'Short D'),
            'pictures' => Yii::t('app', 'Pictures'),
        ];
    }
} 