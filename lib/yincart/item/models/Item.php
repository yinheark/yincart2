<?php

namespace yincart\item\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "{{%item}}".
 *
 * @property integer $item_id
 * @property string $sku
 * @property string $name
 * @property string $description
 * @property string $short_description
 * @property string $meta_keywords
 * @property string $meta_description
 * @property string $original_price
 * @property string $price
 * @property integer $stock_qty
 * @property integer $min_sale_qty
 * @property integer $max_sale_qty
 * @property string $weight
 * @property string $shipping_fee
 * @property integer $is_free_shipping
 * @property string $pictures
 * @property integer $sort
 * @property integer $status
 */
class Item extends \kiwi\db\ActiveRecord
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
            [['sku', 'name', 'description', 'short_description', 'meta_keywords', 'meta_description', 'original_price', 'price', 'stock_qty', 'min_sale_qty', 'max_sale_qty', 'weight', 'shipping_fee', 'is_free_shipping', 'pictures', 'sort', 'status'], 'required'],
            [['description', 'short_description'], 'string'],
            [['original_price', 'price', 'weight', 'shipping_fee'], 'number'],
            [['stock_qty', 'min_sale_qty', 'max_sale_qty', 'is_free_shipping', 'sort', 'status'], 'integer'],
            [['sku', 'name', 'meta_keywords', 'meta_description'], 'string', 'max' => 255],
            [['pictures'], 'string', 'max' => 1023]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'item_id' => Yii::t('app', 'Item ID'),
            'sku' => Yii::t('app', 'Sku'),
            'name' => Yii::t('app', 'Name'),
            'description' => Yii::t('app', 'Description'),
            'short_description' => Yii::t('app', 'Short Description'),
            'meta_keywords' => Yii::t('app', 'Meta Keywords'),
            'meta_description' => Yii::t('app', 'Meta Description'),
            'original_price' => Yii::t('app', 'Original Price'),
            'price' => Yii::t('app', 'Price'),
            'stock_qty' => Yii::t('app', 'Stock Qty'),
            'min_sale_qty' => Yii::t('app', 'Min Sale Qty'),
            'max_sale_qty' => Yii::t('app', 'Max Sale Qty'),
            'weight' => Yii::t('app', 'Weight'),
            'shipping_fee' => Yii::t('app', 'Shipping Fee'),
            'is_free_shipping' => Yii::t('app', 'Is Free Shipping'),
            'pictures' => Yii::t('app', 'Pictures'),
            'sort' => Yii::t('app', 'Sort'),
            'status' => Yii::t('app', 'Status'),
        ];
    }

//    /**
//     * @inheritdoc
//     */
//    public function setAttributes($values, $safeOnly = true)
//    {
//        foreach(['itemCategories', 'itemTags'] as $key) {
//            if (isset($values[$key])) {
//                if (is_array($values[$key])) {
//                    $values = array_map(function($value) {
//                        return ['tree_id' => $value];
//                    }, $values[$key]);
//                    $this->setRelation($key, $values, 'tree_id');
//                }
//                unset($values[$key]);
//            }
//        }
//
//        parent::setAttributes($values, $safeOnly);
//    }

    public function getCategoryIds()
    {
        return ArrayHelper::getColumn($this->categories, 'id');
    }

    public function getTagIds()
    {
        return ArrayHelper::getColumn($this->tags, 'id');
    }

    public function tryToSetRelation($name, $value)
    {
        if ($name == 'categoryIds') {
            return $this->setCategoryIds($value);
        }

        if ($name == 'tagIds') {
            return $this->setTagIds($value);
        }

        return parent::tryToSetRelation($name, $value);
    }

    public function setCategoryIds($ids)
    {
        $itemCategories = $ids && is_array($ids) ? array_map(function ($id) {
            return ['tree_id' => $id];
        }, $ids) : [];
        $this->setRelation('itemCategories', $itemCategories, 'tree_id');
        return true;
    }

    public function setTagIds($ids)
    {
        $itemTags = $ids && is_array($ids) ? array_map(function ($id) {
            return ['tree_id' => $id];
        }, $ids) : [];
        $this->setRelation('itemTags', $itemTags, 'tree_id');
        return true;
    }
}
