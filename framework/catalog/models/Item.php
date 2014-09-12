<?php

namespace yincart\catalog\models;

use Yii;
use yii\helpers\ArrayHelper;
use yincart\base\behaviors\DateAttribute;
use yincart\base\behaviors\EnumAttribute;
use yincart\base\db\ActiveRecord;
use yincart\Yincart;

/**
 * This is the model class for table "item".
 *
 * @property integer $item_id
 * @property integer $category_id
 * @property string $sku
 * @property string $name
 * @property string $description
 * @property string $short_description
 * @property string $meta_keywords
 * @property string $meta_description
 * @property string $url_key
 * @property integer $news_from_date
 * @property integer $news_to_date
 * @property double $original_price
 * @property double $price
 * @property double $weight
 * @property double $shipping_fee
 * @property integer $is_free_shipping
 * @property integer $stock_qty
 * @property integer $notify_stock_qty
 * @property integer $min_sale_qty
 * @property integer $max_sale_qty
 * @property integer $qty_increments
 * @property integer $clicks
 * @property integer $wishes
 * @property integer $sales
 * @property integer $sort
 * @property integer $status
 *
 * @property Category $category
 * @property ItemImg[] $itemImgs
 * @property ItemPropValue[] $itemPropValues
 * @property \yincart\sales\models\OrderItem[] $orderItems
 * @property \yincart\sales\models\ShippingCart[] $shippingCarts
 * @property Sku[] $skus
 * @property \yincart\customer\models\Wish[] $wishList
 *
 * @property PropValueModel propValueModel
 *
 * @method static Item getItem(int $id)
 */
class Item extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%item}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['description', 'short_description', 'meta_keywords', 'meta_description'], 'default', 'value' => ''],
            [['stock_qty', 'notify_stock_qty', 'max_sale_qty', 'clicks', 'wishes', 'sales', 'sort', 'original_price', 'price', 'weight', 'shipping_fee'], 'default', 'value' => '0'],
            [['is_free_shipping', 'min_sale_qty', 'qty_increments', 'status'], 'default', 'value' => '1'],
//            [['sku', 'url_key'], 'unique'],
//            [['category_id'], 'exist', 'targetClass' => Yincart::$container->categoryClass, 'targetAttribute' => 'category_id'],
            [['category_id', 'news_from_date', 'news_to_date', 'is_free_shipping', 'stock_qty', 'notify_stock_qty', 'min_sale_qty', 'max_sale_qty', 'qty_increments', 'clicks', 'wishes', 'sales', 'sort', 'status'], 'integer'],
            [['category_id', 'sku', 'name', 'url_key'], 'required'],
            [['description', 'short_description'], 'string'],
            [['original_price', 'price', 'weight', 'shipping_fee'], 'number'],
            [['sku', 'name', 'url_key'], 'string', 'max' => 45],
            [['meta_keywords', 'meta_description'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'item_id' => Yii::t('yincart', 'Item ID'),
            'category_id' => Yii::t('yincart', 'Category ID'),
            'sku' => Yii::t('yincart', 'Sku'),
            'name' => Yii::t('yincart', 'Name'),
            'description' => Yii::t('yincart', 'Description'),
            'short_description' => Yii::t('yincart', 'Short Description'),
            'meta_keywords' => Yii::t('yincart', 'Meta Keywords'),
            'meta_description' => Yii::t('yincart', 'Meta Description'),
            'url_key' => Yii::t('yincart', 'Url Key'),
            'news_from_date' => Yii::t('yincart', 'News From Date'),
            'news_to_date' => Yii::t('yincart', 'News To Date'),
            'original_price' => Yii::t('yincart', 'Original Price'),
            'price' => Yii::t('yincart', 'Price'),
            'weight' => Yii::t('yincart', 'Weight'),
            'shipping_fee' => Yii::t('yincart', 'Shipping Fee'),
            'is_free_shipping' => Yii::t('yincart', 'Is Free Shipping'),
            'stock_qty' => Yii::t('yincart', 'Stock Qty'),
            'notify_stock_qty' => Yii::t('yincart', 'Notify Stock Qty'),
            'min_sale_qty' => Yii::t('yincart', 'Min Sale Qty'),
            'max_sale_qty' => Yii::t('yincart', 'Max Sale Qty'),
            'qty_increments' => Yii::t('yincart', 'Qty Increments'),
            'clicks' => Yii::t('yincart', 'Clicks'),
            'wishes' => Yii::t('yincart', 'Wishes'),
            'sales' => Yii::t('yincart', 'Sales'),
            'sort' => Yii::t('yincart', 'Sort'),
            'status' => Yii::t('yincart', 'Is Enable'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Yincart::$container->categoryClass, ['category_id' => 'category_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItemImgs()
    {
        return $this->hasMany(Yincart::$container->itemImgClass, ['item_id' => 'item_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItemPropValues()
    {
        return $this->hasMany(Yincart::$container->itemPropValueClass, ['item_id' => 'item_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderItems()
    {
        return $this->hasMany(Yincart::$container->orderItemClass, ['item_id' => 'item_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShippingCarts()
    {
        return $this->hasMany(Yincart::$container->shippingCartClass, ['item_id' => 'item_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSkus()
    {
        return $this->hasMany(Yincart::$container->skuClass, ['item_id' => 'item_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWishList()
    {
        return $this->hasMany(Yincart::$container->wishClass, ['item_id' => 'item_id']);
    }

    public function getPropValueModel()
    {
        return Yincart::$container->getPropValueModel(['itemId' => $this->item_id]);
    }

    public $changeOriginal = false;

    public function behaviors()
    {
        return ArrayHelper::merge(parent::behaviors(), [
            'enum' => [
                'class' => EnumAttribute::className(),
                'attributes' => [
                    'status' => [0 => Yii::t('yincart', 'No'), 1 => Yii::t('yincart', 'Yes')],
                ],
                'changeOriginal' => $this->changeOriginal,
            ],
            'date' => [
                'class' => DateAttribute::className(),
                'attributes' => ['news_from_date', 'news_to_date'],
            ]
        ]);
    }

    public function beforeSave($insert)
    {
        if (!$insert && $this->category_id != $this->getOldAttribute('category_id')) {
            $itemPropValueClass = Yincart::$container->itemPropValueClass;
            $itemPropValueClass::deleteAll(['item_id' => $this->item_id]);
            $skuClass = Yincart::$container->skuClass;
            $skuClass::deleteAll(['item_id' => $this->item_id]);
        }
        return parent::beforeSave($insert);
    }

    /**
     * @return Item[]
     */
    public static function getItems()
    {
        return self::find(true)->all();
    }
} 