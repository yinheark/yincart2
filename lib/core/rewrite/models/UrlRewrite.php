<?php

namespace core\rewrite\models;

use Yii;

/**
 * This is the model class for table "{{%url_rewrite}}".
 *
 * @property integer $url_rewrite_id
 * @property string $request_path
 * @property string $route
 * @property string $params
 */
class UrlRewrite extends \kiwi\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%url_rewrite}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['request_path', 'route'], 'required'],
            [['request_path', 'route', 'params'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'url_rewrite_id' => Yii::t('app', 'Url Rewrite ID'),
            'request_path' => Yii::t('app', 'Request Path'),
            'route' => Yii::t('app', 'Route'),
            'params' => Yii::t('app', 'Params'),
        ];
    }

    public function getParamsPath($params = [])
    {
        ksort($params);
        return http_build_query($params);
    }

    public function getParamsArray($paramsPath = '')
    {
        parse_str($paramsPath, $params);
        return $params;
    }
}
