<?php

namespace yincart\itemprop\models;

use kiwi\Kiwi;
use Yii;

/**
 * This is the model class for table "{{%sku}}".
 *
 * @property integer $sku_id
 * @property integer $item_id
 * @property string $sku
 * @property string $properties
 * @property string $property_names
 * @property integer $stock_qty
 * @property integer $price
 *
 * @property \yincart\order\models\OrderItem[] $orderItems
 * @property \yincart\cart\models\Cart[] $cart
 * @property \yincart\item\models\Item $item
 */
class Sku extends \kiwi\db\ActiveRecord
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
            [['item_id', 'sku', 'properties', 'property_names', 'stock_qty', 'price'], 'required'],
            [['item_id', 'stock_qty', 'price'], 'integer'],
            [['sku', 'properties', 'property_names'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'sku_id' => Yii::t('app', 'Sku ID'),
            'item_id' => Yii::t('app', 'Item ID'),
            'sku' => Yii::t('app', 'Sku'),
            'properties' => Yii::t('app', 'Properties'),
            'property_names' => Yii::t('app', 'Property Names'),
            'stock_qty' => Yii::t('app', 'Stock Qty'),
            'price' => Yii::t('app', 'Price'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderItems()
    {
        return $this->hasMany(Kiwi::getOrderItemClass(), ['sku_id' => 'sku_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShoppingCarts()
    {
        return $this->hasMany(Kiwi::getCartClass(), ['sku_id' => 'sku_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItem()
    {
        return $this->hasOne(Kiwi::getItemClass(), ['item_id' => 'item_id']);
    }

    public static function getSkus($itemId)
    {
        $skus = self::find(false)->where(['item_id' => $itemId])->indexBy('properties')->all();
        return $skus ? $skus : [];
    }
}
