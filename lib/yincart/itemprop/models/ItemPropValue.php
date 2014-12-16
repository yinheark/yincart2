<?php

namespace yincart\itemprop\models;

use kiwi\Kiwi;
use Yii;

/**
 * This is the model class for table "{{%item_prop_value}}".
 *
 * @property integer $item_prop_value_id
 * @property integer $item_id
 * @property integer $item_prop_id
 * @property integer $prop_value_id
 * @property string $custom_prop_value
 *
 * @property \yincart\item\models\Item $item
 * @property ItemProp $itemProp
 * @property PropValue $propValue
 */
class ItemPropValue extends \kiwi\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%item_prop_value}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['item_id', 'item_prop_id', 'prop_value_id', 'custom_prop_value'], 'required'],
            [['item_id', 'item_prop_id', 'prop_value_id'], 'integer'],
            [['custom_prop_value'], 'string', 'max' => 1023]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'item_prop_value_id' => Yii::t('app', 'Item Prop Value ID'),
            'item_id' => Yii::t('app', 'Item ID'),
            'item_prop_id' => Yii::t('app', 'Item Prop ID'),
            'prop_value_id' => Yii::t('app', 'Prop Value ID'),
            'custom_prop_value' => Yii::t('app', 'Custom Prop Value'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItem()
    {
        return $this->hasOne(Kiwi::getItemClass(), ['item_id' => 'item_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItemProp()
    {
        return $this->hasOne(Kiwi::getItemPropClass(), ['item_prop_id' => 'item_prop_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPropValue()
    {
        return $this->hasOne(Kiwi::getPropValueClass(), ['prop_value_id' => 'prop_value_id']);
    }

    /**
     * @param int $itemId
     * @return ItemPropValue[]
     */
    public static function getItemPropValues($itemId)
    {
        $itemPropValues = self::find(false)
            ->where(['item_id' => $itemId])
            ->with('itemProp')
//            ->indexBy(function ($row) {
//                return $row['item_prop_id'] . ':' . $row['item_prop_value_id'];
//            })
            ->all();
        $propValues = [];
        foreach ($itemPropValues as $itemPropValue) {
            /** @var ItemPropValue $itemPropValue */
            if ($itemPropValue->itemProp->type == 'Checkbox') {
                if (!isset($propValues[$itemPropValue->item_prop_id])) {
                    $propValues[$itemPropValue->item_prop_id] = [];
                }
                $propValues[$itemPropValue->item_prop_id][$itemPropValue->prop_value_id] = $itemPropValue;
            } else {
                $propValues[$itemPropValue->item_prop_id] = $itemPropValue;
            }
        }
        return $propValues;
    }
}
