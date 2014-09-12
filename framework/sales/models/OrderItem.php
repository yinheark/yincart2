<?php

namespace yincart\sales\models;

use Yii;
use yincart\base\db\ActiveRecord;
use yincart\Yincart;

/**
 * This is the model class for table "order_item".
 *
 * @property integer $order_item_id
 * @property integer $order_id
 * @property integer $item_id
 * @property integer $sku_id
 * @property string $name
 * @property string $image_url
 * @property string $propertyNames
 * @property double $original_price
 * @property string $promotions
 * @property double $price
 * @property integer $qty
 * @property double $total_price
 *
 * @property Order $order
 * @property \yincart\catalog\models\Item $item
 * @property \yincart\catalog\models\Sku $sku
 *
 * @method static OrderItem getOrderItem(int $id)
 */
class OrderItem extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%order_item}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['image_url', 'propertyNames', 'promotions'], 'default', 'value' => ''],
            [['sku_id', 'original_price', 'price', 'total_price'], 'default', 'value' => 0],
            [['qty'], 'default', 'value' => 1],
            [['order_id', 'item_id', 'sku_id', 'qty'], 'integer'],
            [['order_id', 'item_id', 'name'], 'required'],
            [['original_price', 'price', 'total_price'], 'number'],
            [['name', 'promotions'], 'string', 'max' => 45],
            [['image_url', 'propertyNames'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'order_item_id' => Yii::t('yincart', 'Order Item ID'),
            'order_id' => Yii::t('yincart', 'Order ID'),
            'item_id' => Yii::t('yincart', 'Item ID'),
            'sku_id' => Yii::t('yincart', 'Sku ID'),
            'name' => Yii::t('yincart', 'Name'),
            'image_url' => Yii::t('yincart', 'Image Url'),
            'propertyNames' => Yii::t('yincart', 'Property Names'),
            'original_price' => Yii::t('yincart', 'Original Price'),
            'promotions' => Yii::t('yincart', 'Promotions'),
            'price' => Yii::t('yincart', 'Price'),
            'qty' => Yii::t('yincart', 'Qty'),
            'total_price' => Yii::t('yincart', 'Total Price'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrder()
    {
        return $this->hasOne(Yincart::$container->orderClass, ['order_id' => 'order_id']);
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
    public function getSku()
    {
        return $this->hasOne(Yincart::$container->skuClass, ['sku_id' => 'sku_id']);
    }
}
