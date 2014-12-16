<?php

namespace core\cms\models;

use Yii;

/**
 * This is the model class for table "{{%cms}}".
 *
 * @property integer $cms_id
 * @property string $key
 * @property string $name
 * @property string $content
 * @property string $type
 * @property string $author
 * @property string $data
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 */
class Cms extends \kiwi\db\ActiveRecord
{
    const CMS_TYPE = 'cms';

    public function init()
    {
        $this->type = static::CMS_TYPE;
        if($this->isNewRecord){
            $this->created_at =$this->updated_at = time();
        }else{
            $this->updated_at = time();
        }
        parent::init();
    }

    /**
     * @inheritdoc
     */
    public static function find()
    {
        return parent::find()->where(['type' => static::CMS_TYPE]);
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%cms}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['key', 'name', 'content', 'type', 'author', 'status', 'created_at', 'updated_at'], 'required'],
            [['content','data'], 'string'],
            [['status', 'created_at', 'updated_at'], 'integer'],
            [['key', 'name', 'type', 'author'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'cms_id' => Yii::t('app', 'Cms ID'),
            'key' => Yii::t('app', 'Key'),
            'name' => Yii::t('app', 'Name'),
            'content' => Yii::t('app', 'Content'),
            'type' => Yii::t('app', 'Type'),
            'author' => Yii::t('app', 'Author'),
            'status' => Yii::t('app', 'Status'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'data' => Yii::t('app', 'Data'),
        ];
    }

    public function beforeSave($insert){
        $this->updated_at = time();
        return parent::beforeSave($insert);
    }
}
