<?php

namespace yincart\catalog\models;

use Yii;
use yincart\base\db\ActiveRecord;
use yincart\Yincart;

/**
 * This is the model class for table "sku".
 *
 * @property integer $sku_id
 * @property integer $item_id
 * @property string $sku
 * @property string $properties
 * @property string $property_names
 * @property integer $stock_qty
 * @property double $price
 *
 * @property \yincart\sales\models\OrderItem[] $orderItems
 * @property \yincart\sales\models\ShippingCart[] $shippingCarts
 * @property Item $item
 *
 * @method static Sku getSku(int $id)
 */
class Sku extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%sku}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['stock_qty', 'price'], 'default', 'value' => 0],
            [['item_id', 'stock_qty'], 'integer'],
//            [['sku'], 'unique'],
            [['item_id', 'sku', 'properties', 'property_names'], 'required'],
            [['price'], 'number'],
            [['sku'], 'string', 'max' => 45],
            [['properties', 'property_names'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'sku_id' => Yii::t('yincart', 'Sku ID'),
            'item_id' => Yii::t('yincart', 'Item ID'),
            'sku' => Yii::t('yincart', 'Sku'),
            'properties' => Yii::t('yincart', 'Properties'),
            'property_names' => Yii::t('yincart', 'Property Names'),
            'stock_qty' => Yii::t('yincart', 'Stock Qty'),
            'price' => Yii::t('yincart', 'Price'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderItems()
    {
        return $this->hasMany(Yincart::$container->orderItemClass, ['sku_id' => 'sku_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShippingCarts()
    {
        return $this->hasMany(Yincart::$container->shippingCartClass, ['sku_id' => 'sku_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItem()
    {
        return $this->hasOne(Yincart::$container->itemClass, ['item_id' => 'item_id']);
    }

    public static function getSkus($itemId)
    {
        $skus = self::find(false)->where(['item_id' => $itemId])->indexBy('properties')->all();
        return $skus ? $skus : [];
    }
}