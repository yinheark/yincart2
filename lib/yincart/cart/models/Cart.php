<?php

namespace yincart\cart\models;

use kiwi\behaviors\JsonAttribute;
use kiwi\Kiwi;
use Yii;
use yii\web\YiiAsset;

/**
 * This is the model class for table "{{%cart}}".
 *
 * @property integer $cart_id
 * @property integer $user_id
 * @property integer $item_id
 * @property integer $qty
 * @property string $data
 *
 * @property \yincart\item\models\Item $item;
 */
class Cart extends \kiwi\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%cart}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['item_id', 'qty'], 'required'],
            [['item_id', 'qty'], 'integer'],
            [['data'], 'string']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'cart_id' => 'Cart ID',
            'user_id' => 'User ID',
            'item_id' => 'Item ID',
            'qty' => 'Qty',
            'data' => 'Data',
        ];
    }


    public function getItem()
    {
        return $this->hasOne(Kiwi::getItemClass(), ['item_id' => 'item_id']);
    }

    public function beforeSave($insert)
    {
        if (Yii::$app->user->isGuest) {
            return false;
        }
        $this->user_id = Yii::$app->user->id;
        return parent::beforeSave($insert);
    }

    public function behaviors()
    {
        return [
            'json' => [
                'class' => JsonAttribute::className(),
                'attributes' => ['data'],
            ]
        ];
    }
}
