<?php

namespace yincart\category\models;

use Yii;

/**
 * This is the model class for table "{{%item_tree}}".
 *
 * @property integer $item_tree_id
 * @property integer $item_id
 * @property integer $tree_id
 */
class ItemTree extends \kiwi\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%item_tree}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['item_id', 'tree_id'], 'required'],
            [['item_id', 'tree_id'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'item_tree_id' => Yii::t('app', 'Item Tree ID'),
            'item_id' => Yii::t('app', 'Item ID'),
            'tree_id' => Yii::t('app', 'Tree ID'),
        ];
    }
}
