<?php

namespace yincart\catalog\models;

use Yii;
use yii\helpers\ArrayHelper;
use yincart\base\db\ActiveRecord;
use yincart\Yincart;

/**
 * This is the model class for table "category".
 *
 * @property integer $category_id
 * @property integer $parent_id
 * @property string $name
 * @property string $url_key
 * @property string $image
 * @property string $meta_keywords
 * @property string $meta_description
 * @property integer $sort
 * @property integer $is_navigation_menu
 * @property integer $is_inherit
 * @property integer $status
 *
 * @property Category $parent
 * @property Category[] $children
 * @property Item[] $items
 * @property ItemProp[] $itemProps
 *
 * @method static Category getCategory(int $id)
 */
class Category extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%category}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['image', 'meta_keywords', 'meta_description'], 'default', 'value' => ''],
            [['parent_id', 'sort'], 'default', 'value' => '0'],
            [['is_navigation_menu', 'is_inherit', 'status'], 'default', 'value' => '1'],
//            [['url_key'], 'unique'],
//            [['parent_id'], 'exist', 'targetAttribute' => 'category_id'],
            [['parent_id', 'sort', 'is_navigation_menu', 'is_inherit', 'status'], 'integer'],
            [['name', 'url_key'], 'required'],
            [['name', 'url_key'], 'string', 'max' => 45],
            [['image', 'meta_keywords', 'meta_description'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'category_id' => Yii::t('yincart', 'Category ID'),
            'parent_id' => Yii::t('yincart', 'Parent ID'),
            'name' => Yii::t('yincart', 'Name'),
            'url_key' => Yii::t('yincart', 'Url Key'),
            'image' => Yii::t('yincart', 'Image'),
            'meta_keywords' => Yii::t('yincart', 'Meta Keywords'),
            'meta_description' => Yii::t('yincart', 'Meta Description'),
            'sort' => Yii::t('yincart', 'Sort'),
            'is_navigation_menu' => Yii::t('yincart', 'Is Navigation Menu'),
            'is_inherit' => Yii::t('yincart', 'Is Inherit'),
            'status' => Yii::t('yincart', 'Is Enable'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParent()
    {
        return $this->hasOne(Yincart::$container->categoryClass, ['category_id' => 'parent_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getChildren()
    {
        return $this->hasMany(Yincart::$container->categoryClass, ['parent_id' => 'category_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItems()
    {
        return $this->hasMany(Yincart::$container->itemClass, ['category_id' => 'category_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItemProps()
    {
        return $this->hasMany(Yincart::$container->itemPropClass, ['category_id' => 'category_id']);
    }

    /**
     * @param bool $isAll
     * @return Category[]
     */
    public static function getCategories($isAll = false)
    {
        return $isAll ? self::find()->all() : self::find(true)->indexBy(null)->all();
    }

    /**
     * @return Category[]
     */
    public function getAllParent()
    {
        $categories = [];
        $category = $this->parent;
        while ($category) {
            $categories[] = $category;
            $category = $category->parent;
        }
        return $categories;
    }

    /**
     * @param array $condition
     * @param int $deep
     * @return Category[]
     */
    public function getAllChildren($condition = [], $deep = 0)
    {
        $deep = $deep ? $deep : 999;
        $childCategories = [];
        $condition['parent_id'] = [$this->category_id];
        $categories = $this->find(true)
            ->andWhere($condition)
            ->all();
        while ($categories) {
            $childCategories = ArrayHelper::merge($childCategories, $categories);
            if (!--$deep) break;
            $condition['parent_id'] = array_keys($categories);
            $categories = $this->find(true)
                ->andWhere(['parent_id' => array_keys($categories)])
                ->all();
        }
        return $childCategories;
    }

    /**
     * @return ItemProp[]
     */
    public function getItemPropsInfo()
    {
        $itemPropClass = Yincart::$container->itemPropClass;
        $itemProps = $itemPropClass::getItemProps($this->category_id);
        return $itemProps ? $itemProps : [];
    }

    public function move($parentId, $preId)
    {
        $parent = self::getCategory($parentId);
        if ($parent) {
            $categories = $parent->children;
            $this->parent_id = $parentId;
            if (!$preId) {
                $this->sort = 1;
                $this->save();
                $sort = 1;
                foreach ($categories as $cat) {
                    $cat->sort = ++$sort;
                    $cat->save();
                }
            } else {
                $sort = 0;
                foreach ($categories as $cat) {
                    $cat->sort = ++$sort;
                    $cat->save();
                    if ($cat->category_id == $preId) {
                        $this->sort = ++$sort;
                        $this->save();
                    }
                }
            }
            return true;
        }
        return false;
    }

    /**
     * @param int $deep
     * @return array
     */
    public function getCategoryMenu($deep = 2)
    {
        $categories = $this->getAllChildren(['is_navigation_menu' => 1], $deep);
        $categories[$this->category_id] = $this;

        foreach ($categories as $key => $value) {
            $categories[$key] = $value->toArray();
            $categories[$key]['children'] = [];
        }

        foreach ($categories as $category) {
            while (isset($categories[$category['parent_id']])) {
                $categories[$category['parent_id']]['children'][$category['category_id']] = $category;
                $category = $categories[$category['parent_id']];
            }
        }

        return $categories[$this->category_id]['children'];
    }
}