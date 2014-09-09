<?php

namespace yincart\customer\models;

use Yii;
use yincart\base\db\ActiveRecord;
use yincart\Yincart;

/**
 * This is the model class for table "address_area".
 *
 * @property integer $address_area_id
 * @property integer $parent_id
 * @property string $path
 * @property integer $grade
 * @property string $name
 * @property string $language
 *
 * @property AddressArea $parent
 * @property AddressArea[] $addressAreas
 *
 * @method static AddressArea getAddressArea(int $id)
 */
class AddressArea extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%address_area}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['parent_id', 'grade'], 'integer'],
            [['path', 'name', 'language'], 'required'],
            [['path', 'name'], 'string', 'max' => 45],
            [['language'], 'string', 'max' => 5]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'address_area_id' => Yii::t('yincart', 'Address Area ID'),
            'parent_id' => Yii::t('yincart', 'Parent ID'),
            'path' => Yii::t('yincart', 'Path'),
            'grade' => Yii::t('yincart', 'Grade'),
            'name' => Yii::t('yincart', 'Name'),
            'language' => Yii::t('yincart', 'Language'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParent()
    {
        return $this->hasOne(Yincart::$container->addressAreaClass, ['address_area_id' => 'parent_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getChildren()
    {
        return $this->hasMany(Yincart::$container->addressAreaClass, ['parent_id' => 'address_area_id']);
    }
}
