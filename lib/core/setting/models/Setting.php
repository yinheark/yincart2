<?php

namespace core\setting\models;

use Yii;
use kiwi\db\ActiveRecord;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "{{%setting}}".
 *
 * @property integer $setting_id
 * @property string $path
 * @property string $value
 */
class Setting extends ActiveRecord
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%setting}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['path'], 'required'],
            [['value'], 'string'],
            [['path'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'setting_id' => Yii::t('app', 'Setting ID'),
            'path' => Yii::t('app', 'Path'),
            'value' => Yii::t('app', 'Value'),
        ];
    }

    /**
     * get config from db
     * @return array
     */
    public static function getConfigFromDB()
    {
        /** @var Setting[] $settings */
        $settings = static::findAll([]);
        $config = [];
        foreach ($settings as $setting) {
            $config[$setting->path] = ['value' => $setting->value];
        }
        return $config;
    }
}
