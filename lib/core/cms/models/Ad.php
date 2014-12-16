<?php
/**
 * @author Lujie.Zhou(lujie.zhou@jago-ag.cn) 
 * @Date 11/25/2014
 * @Time 11:47 AM
 */

namespace core\cms\models;

class Ad extends Cms
{
    const AD_TYPE_CAROUSE = 'ad-carouse';
    const AD_TYPE_HTML = 'ad-html';

    public function init()
    {
        parent::init();
        $this->type = static::AD_TYPE_HTML;
    }

    /**
     * @inheritdoc
     */
    public static function find()
    {
        return parent::find()->where(['type' => [static::AD_TYPE_CAROUSE, static::AD_TYPE_HTML]]);
    }
} 