<?php

namespace yincart\catalog\models;

use Yii;
use yincart\base\db\ActiveRecord;
use yincart\Yincart;

/**
 * This is the model class for table "item_prop_value".
 *
 * @property integer $item_prop_value_id
 * @property integer $item_id
 * @property integer $item_prop_id
 * @property integer $prop_value_id
 * @property string $custom_prop_value
 * @property string $image_url
 *
 * @property Item $item
 * @property ItemProp $itemProp
 * @property PropValue $propValue
 *
 * @method static ItemPropValue getItemPropValue(int $id)
 */
class ItemPropValue extends ActiveRecord
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
            [['custom_prop_value', 'image_url'], 'default', 'value' => ''],
            [['prop_value_id'], 'default', 'value' => 0],
            [['item_id', 'item_prop_id', 'prop_value_id'], 'integer'],
            [['item_id', 'item_prop_id'], 'required'],
            [['custom_prop_value'], 'string', 'max' => 45],
            [['image_url'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'item_prop_value_id' => Yii::t('yincart', 'Item Prop Value ID'),
            'item_id' => Yii::t('yincart', 'Item ID'),
            'item_prop_id' => Yii::t('yincart', 'Item Prop ID'),
            'prop_value_id' => Yii::t('yincart', 'Prop Value ID'),
            'custom_prop_value' => Yii::t('yincart', 'Custom Prop Value'),
            'image_url' => Yii::t('yincart', 'Image Url'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItem()
    {
        return $this->hasOne(Yincart::$container->itemClass, ['item_id' => 'item_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItemProp()
    {
        return $this->hasOne(Yincart::$container->itemPropClass, ['item_prop_id' => 'item_prop_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPropValue()
    {
        return $this->hasOne(Yincart::$container->propValueClass, ['prop_value_id' => 'prop_value_id']);
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