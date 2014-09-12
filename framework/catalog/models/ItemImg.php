<?php

namespace yincart\catalog\models;

use Yii;
use yincart\base\db\ActiveRecord;
use yincart\Yincart;

/**
 * This is the model class for table "item_img".
 *
 * @property integer $item_img_id
 * @property integer $item_id
 * @property string $url
 * @property string $name
 * @property integer $sort
 *
 * @property Item $item
 *
 * @method static ItemImg getItemImg(int $id)
 */
class ItemImg extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%item_img}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'default', 'value' => ''],
            [['sort'], 'default', 'value' => 0],
            [['item_id', 'sort'], 'integer'],
            [['item_id', 'url'], 'required'],
            [['url'], 'string', 'max' => 255],
            [['name'], 'string', 'max' => 45]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'item_img_id' => Yii::t('yincart', 'Item Img ID'),
            'item_id' => Yii::t('yincart', 'Item ID'),
            'url' => Yii::t('yincart', 'Url'),
            'name' => Yii::t('yincart', 'Name'),
            'sort' => Yii::t('yincart', 'Sort'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItem()
    {
        return $this->hasOne(Yincart::$container->itemClass, ['item_id' => 'item_id']);
    }
}