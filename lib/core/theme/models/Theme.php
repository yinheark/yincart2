<?php

namespace core\theme\models;

use Yii;

/**
 * This is the model class for table "{{%theme}}".
 *
 * @property integer $theme_id
 * @property string $key
 * @property string $name
 * @property string $thumb
 * @property integer $scope
 * @property integer $sort
 * @property integer $is_active
 */
class Theme extends \kiwi\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%theme}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['key', 'name', 'scope', 'sort', 'is_active'], 'required'],
            [['sort', 'is_active'], 'integer'],
            [['key', 'name', 'scope'], 'string', 'max' => 255],
            [['thumb'], 'string', 'max' => 1023]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'theme_id' => Yii::t('app', 'Theme ID'),
            'key' => Yii::t('app', 'Key'),
            'name' => Yii::t('app', 'Name'),
            'thumb' => Yii::t('app', 'Thumb'),
            'scope' => Yii::t('app', 'Scope'),
            'sort' => Yii::t('app', 'Sort'),
            'is_active' => Yii::t('app', 'Is Active'),
        ];
    }
}
