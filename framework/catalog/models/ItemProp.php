<?php

namespace yincart\catalog\models;

use Yii;
use yii\helpers\ArrayHelper;
use yincart\base\behaviors\EnumAttribute;
use yincart\base\db\ActiveRecord;
use yincart\Yincart;

/**
 * This is the model class for table "item_prop".
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
 * @property Category $category
 * @property ItemPropValue[] $itemPropValues
 * @property PropValue[] $propValues
 *
 * @method static ItemProp getItemProp(int $id)
 */
class ItemProp extends ActiveRecord
{
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
            [['category_id', 'is_key', 'is_sale', 'is_color', 'is_search', 'is_must', 'sort'], 'default', 'value' => 0],
            [['type', 'status'], 'default', 'value' => 1],
            [['category_id', 'type', 'is_key', 'is_sale', 'is_color', 'is_search', 'is_must', 'sort', 'status'], 'integer'],
            [['category_id', 'name'], 'required'],
            [['name'], 'string', 'max' => 45]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'item_prop_id' => Yii::t('yincart', 'Item Prop ID'),
            'category_id' => Yii::t('yincart', 'Category ID'),
            'name' => Yii::t('yincart', 'Name'),
            'type' => Yii::t('yincart', 'Type'),
            'is_key' => Yii::t('yincart', 'Is Key'),
            'is_sale' => Yii::t('yincart', 'Is Sale'),
            'is_color' => Yii::t('yincart', 'Is Color'),
            'is_search' => Yii::t('yincart', 'Is Search'),
            'is_must' => Yii::t('yincart', 'Is Must'),
            'sort' => Yii::t('yincart', 'Sort'),
            'status' => Yii::t('yincart', 'Status'),
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
    public function getItemPropValues()
    {
        return $this->hasMany(Yincart::$container->itemPropValueClass, ['item_prop_id' => 'item_prop_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPropValues()
    {
        return $this->hasMany(Yincart::$container->propValueClass, ['item_prop_id' => 'item_prop_id']);
    }

    public $changeOriginal = true;

    public function behaviors()
    {
        return ArrayHelper::merge(parent::behaviors(), [
            'enum' => [
                'class' => EnumAttribute::className(),
                'attributes' => [
                    'type' => [1 => Yii::t('yincart', 'Text'), 2 => Yii::t('yincart', 'Select'), 3 => Yii::t('yincart', 'Checkbox')],
                    'is_key' => [0 => Yii::t('yincart', 'No'), 1 => Yii::t('yincart', 'Yes')],
                    'is_sale' => [0 => Yii::t('yincart', 'No'), 1 => Yii::t('yincart', 'Yes')],
                    'is_color' => [0 => Yii::t('yincart', 'No'), 1 => Yii::t('yincart', 'Yes')],
                    'is_search' => [0 => Yii::t('yincart', 'No'), 1 => Yii::t('yincart', 'Yes')],
                    'is_must' => [0 => Yii::t('yincart', 'No'), 1 => Yii::t('yincart', 'Yes')],
                    'status' => [0 => Yii::t('yincart', 'Disable'), 1 => Yii::t('yincart', 'Enable')],
                ],
                'changeOriginal' => $this->changeOriginal,
            ],
        ]);
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