<?php

namespace yincart\catalog\models;

use Yii;
use yincart\base\db\ActiveRecord;
use yincart\Yincart;

/**
 * This is the model class for table "prop_value".
 *
 * @property integer $prop_value_id
 * @property integer $item_prop_id
 * @property string $name
 * @property integer $sort
 * @property integer $status
 *
 * @property ItemPropValue[] $itemPropValues
 * @property ItemProp $itemProp
 *
 * @method static PropValue getPropValue(int $id)
 */
class PropValue extends ActiveRecord
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
            [['sort'], 'default', 'value' => 0],
            [['status'], 'default', 'value' => 0],
            [['item_prop_id', 'sort', 'status'], 'integer'],
            [['item_prop_id', 'name'], 'required'],
            [['name'], 'string', 'max' => 45]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'prop_value_id' => Yii::t('yincart', 'Prop Value ID'),
            'item_prop_id' => Yii::t('yincart', 'Item Prop ID'),
            'name' => Yii::t('yincart', 'Name'),
            'sort' => Yii::t('yincart', 'Sort'),
            'status' => Yii::t('yincart', 'Status'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItemPropValues()
    {
        return $this->hasMany(Yincart::$container->itemPropValueClass, ['prop_value_id' => 'prop_value_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItemProp()
    {
        return $this->hasOne(Yincart::$container->itemPropClass, ['item_prop_id' => 'item_prop_id']);
    }
} 