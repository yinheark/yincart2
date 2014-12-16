<?php

namespace core\comment\models;

use Yii;

/**
 * This is the model class for table "{{%comment}}".
 *
 * @property integer $comment_id
 * @property integer $user_id
 * @property string $type
 * @property integer $type_id
 * @property string $content
 * @property integer $created_at
 */
class Comment extends \kiwi\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%comment}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'type', 'type_id', 'content', 'created_at'], 'required'],
            [['user_id', 'type_id', 'created_at'], 'integer'],
            [['content'], 'string'],
            [['type'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'comment_id' => Yii::t('app', 'Comment ID'),
            'user_id' => Yii::t('app', 'User ID'),
            'type' => Yii::t('app', 'Type'),
            'type_id' => Yii::t('app', 'Type ID'),
            'content' => Yii::t('app', 'Content'),
            'created_at' => Yii::t('app', 'Created At'),
        ];
    }
}
