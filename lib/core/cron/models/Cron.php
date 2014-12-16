<?php

namespace core\cron\models;

use Yii;

/**
 * This is the model class for table "cron".
 *
 * @property integer $cron_id
 * @property string $name
 * @property string $expression
 * @property string $func
 * @property integer $once
 * @property integer $status
 */
class Cron extends \yii\db\ActiveRecord
{

    const  STATUS_ACTIVE = 1;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cron';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'expression', 'func', 'once', 'status'], 'required'],
            [['once', 'status'], 'integer'],
            [['name', 'func'], 'string', 'max' => 255],
            [['expression'], 'string', 'max' => 32]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'cron_id' => 'Cron ID',
            'name' => 'Name',
            'expression' => 'Expression',
            'func' => 'Func',
            'once' => 'Once',
            'status' => 'Status',
        ];
    }

    public function test2()
    {
        echo 'xxxxxxxxxxxxx';
        Yii::trace('xxxxxx', __METHOD__);
    }
}
