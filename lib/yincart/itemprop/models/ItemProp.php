<?php

namespace yincart\itemprop\models;

use kiwi\Kiwi;
use Yii;

/**
 * This is the model class for table "{{%item_prop}}".
 *
 * @property integer $item_prop_id
 * @property integer $category_id
 * @property string $name
 * @property integer $type
 * @property integer $is_key
 * @property integer $is_sale
 * @property integer $is_color
 * @property integer $is_search
 * @property integer $is_must
 * @property integer $sort
 * @property integer $status
 *
 * @property \yincart\category\models\Category $category
 * @property ItemPropValue[] $itemPropValues
 * @property PropValue[] $propValues
 */
class ItemProp extends \kiwi\db\ActiveRecord
{
    const ITEM_PROP_TYPE_TEXT = 1;
    const ITEM_PROP_TYPE_SELECT = 2;
    const ITEM_PROP_TYPE_CHECKBOX = 3;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%item_prop}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['category_id', 'name', 'type', 'is_key', 'is_sale', 'is_color', 'is_search', 'is_must', 'sort', 'status'], 'required'],
            [['category_id', 'type', 'is_key', 'is_sale', 'is_color', 'is_search', 'is_must', 'sort', 'status'], 'integer'],
            [['name'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'item_prop_id' => Yii::t('app', 'Item Prop ID'),
            'category_id' => Yii::t('app', 'Category ID'),
            'name' => Yii::t('app', 'Name'),
            'type' => Yii::t('app', 'Type'),
            'is_key' => Yii::t('app', 'Is Key'),
            'is_sale' => Yii::t('app', 'Is Sale'),
            'is_color' => Yii::t('app', 'Is Color'),
            'is_search' => Yii::t('app', 'Is Search'),
            'is_must' => Yii::t('app', 'Is Must'),
            'sort' => Yii::t('app', 'Sort'),
            'status' => Yii::t('app', 'Status'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Kiwi::getCategoryClass(), ['id' => 'category_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItemPropValues()
    {
        return $this->hasMany(Kiwi::getItemPropValueClass(), ['item_prop_id' => 'item_prop_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPropValues()
    {
        return $this->hasMany(Kiwi::getPropValueClass(), ['item_prop_id' => 'item_prop_id']);
    }

    /**
     * @param int $categoryId
     * @return ItemProp[]
     */
    public static function getItemProps($categoryId)
    {
        $itemProps = self::find()
            ->where(['category_id' => $categoryId])
            ->with('propValues')
            ->orderBy(['is_key' => SORT_DESC, 'is_sale' => SORT_ASC, 'sort' => SORT_ASC])
            ->indexBy('item_prop_id')
            ->all();
        return $itemProps ? $itemProps : [];
    }
}
