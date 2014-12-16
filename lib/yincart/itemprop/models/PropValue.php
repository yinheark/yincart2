<?php

namespace yincart\itemprop\models;

use kiwi\Kiwi;
use Yii;

/**
 * This is the model class for table "{{%prop_value}}".
 *
 * @property integer $prop_value_id
 * @property integer $item_prop_id
 * @property string $name
 * @property integer $sort
 * @property integer $status
 *
 * @property ItemPropValue[] $itemPropValues
 * @property ItemProp $itemProp
 */
class PropValue extends \kiwi\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%prop_value}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['item_prop_id', 'name', 'sort', 'status'], 'required'],
            [['item_prop_id', 'sort', 'status'], 'integer'],
            [['name'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'prop_value_id' => Yii::t('app', 'Prop Value ID'),
            'item_prop_id' => Yii::t('app', 'Item Prop ID'),
            'name' => Yii::t('app', 'Name'),
            'sort' => Yii::t('app', 'Sort'),
            'status' => Yii::t('app', 'Status'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItemPropValues()
    {
        return $this->hasMany(Kiwi::getItemPropValueClass(), ['prop_value_id' => 'prop_value_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItemProp()
    {
        return $this->hasOne(Kiwi::getItemPropClass(), ['item_prop_id' => 'item_prop_id']);
    }
}
