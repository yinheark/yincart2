<?php

namespace yincart\customer\models;

use Yii;
use yincart\base\db\ActiveRecord;
use yincart\Yincart;

/**
 * This is the model class for table "customer_group".
 *
 * @property integer $customer_group_id
 * @property string $name
 * @property integer $status
 *
 * @property Customer[] $customers
 *
 * @method static CustomerGroup getCustomerGroup(int $id)
 */
class CustomerGroup extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%customer_group}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['status'], 'default', 'value' => 0],
            [['name'], 'required'],
            [['status'], 'integer'],
            [['name'], 'string', 'max' => 45]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'customer_group_id' => Yii::t('yincart', 'Customer Group ID'),
            'name' => Yii::t('yincart', 'Name'),
            'status' => Yii::t('yincart', 'Status'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomers()
    {
        return $this->hasMany(Yincart::$container->customerClass, ['customer_group_id' => 'customer_group_id']);
    }
}
