<?php
/**
 * @link http://www.yincart.com/
 * @copyright Copyright (c) 2014 Yincart
 * @license http://www.yincart.com/license/
 */

namespace yincart\itemprop\models;

use kiwi\db\ActiveRecord;
use kiwi\Kiwi;
use yii\base\InvalidConfigException;
use yii\helpers\Json;

/**
 * This is the model class for Item Prop Value
 *
 * @method static PropValue getPropValueModel(int $id)
 *
 * Class PropValueModel
 * @package yincart\itemprop\models
 * @author jeremy.zhou(gao_lujie@live.cn)
 */
class PropValueModel extends ActiveRecord
{
    public $categoryId;

    public $itemId;

    /**
     * @var \yincart\itemprop\models\ItemProp[]
     */
    protected $itemProps = [];

    /**
     * @var \yincart\itemprop\models\ItemPropValue[]
     */
    protected $itemPropValues = [];

    /**
     * @inheritdoc
     */
    public function init()
    {
        $itemPropClass =  Kiwi::getItemPropClass();
        if ($this->categoryId) {
            $this->itemProps = $itemPropClass::getItemProps($this->categoryId);
        }

        if ($this->itemId) {
            $itemPropValueClass = Kiwi::getItemPropValueClass();
            $this->itemPropValues = $itemPropValueClass::getItemPropValues($this->itemId);

            if (!$this->categoryId) {
                $itemClass = Kiwi::getItemClass();
                $this->categoryId = $itemClass::getItem($this->itemId)->category_id;
                $this->itemProps = $itemPropClass::getItemProps($this->categoryId);
            }

            foreach ($this->itemProps as $key => $itemProp) {
                if (isset($this->itemPropValues[$key])) {
                    $itemPropValue = $this->itemPropValues[$key];
                    switch($itemProp->type) {
                        case $itemPropClass::ITEM_PROP_TYPE_TEXT:
                            $this->setAttribute($key, $itemPropValue->custom_prop_value);
                            break;
                        case $itemPropClass::ITEM_PROP_TYPE_SELECT:
                            $this->setAttribute($key, $itemPropValue->prop_value_id);
                            break;
                        case $itemPropClass::ITEM_PROP_TYPE_CHECKBOX:
                            $this->setAttribute($key, array_keys((array)$itemPropValue));
                            break;
                        default:
                            break;
                    }
                }
            }
        }
    }

    /**
     * @inheritdoc
     */
    public function attributes()
    {
        return array_keys($this->itemProps);
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        $attributeLabels = [];
        foreach ($this->itemProps as $key => $propValue) {
            $attributeLabels[$key] = $propValue->name;
        }
        return $attributeLabels;
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        $required = ['fields' => [], 'type' => 'required'];
        $string = ['fields' => [], 'type' => 'string', 'values' => ['max' => 45]];
        $stringDefault = ['fields' => [], 'type' => 'default', 'values' => ['value' => '']];
        $int = ['fields' => [], 'type' => 'integer'];
        $intDefault = ['fields' => [], 'type' => 'default', 'values' => ['value' => 0]];

        foreach ($this->itemProps as $key => $propValue) {
            if ($propValue->is_must) {
                $required['fields'][] = $key;
            }

            $itemPropClass =  Kiwi::getItemPropClass();
            if ($propValue->type == $itemPropClass::ITEM_PROP_TYPE_TEXT) {
                $string['fields'][] = $key;
                $stringDefault['fields'][] = $key;
            } else {
//                $int['fields'][] = $propValue->name;
//                $intDefault['fields'][] = $propValue->name;
            }
        }

        $rules = [];
        foreach ([$required, $string, $stringDefault, $int, $intDefault] as $rule) {
            if ($rule['fields']) {
                $rules[] = isset($rule['values']) ? array_merge([$rule['fields'], $rule['type']], $rule['values']) : [$rule['fields'], $rule['type']];
            }
        }
        return $rules;
    }

    /**
     * @inheritdoc
     */
    public static function primaryKey()
    {
        return ['item_id'];
    }

    /**
     * @inheritdoc
     */
    public function getPrimaryKey($asArray = false)
    {
        return $this->itemId;
    }

    /**
     * @inheritdoc
     */
    public static function findOne($condition)
    {
        if (!is_numeric($condition)) {
            throw new InvalidConfigException(get_called_class() . ' only find by a primary key.');
        }
        /** @var PropValueModel $model */
        $model = new static(['itemId' => $condition]);
        return $model;
    }

    /**
     * @inheritdoc
     */
    public function save($runValidation = true, $attributeNames = null)
    {
        if ($runValidation && !$this->validate($attributeNames)) {
            \Yii::info('Model not save due to validation error.', __METHOD__);
            return false;
        }
        $db = static::getDb();
        if ($this->isTransactional(self::OP_ALL)) {
            $transaction = $db->beginTransaction();
            try {
                $result = $this->saveInternal();
                if ($result === false) {
                    $transaction->rollBack();
                } else {
                    $transaction->commit();
                }
            } catch (\Exception $e) {
                $transaction->rollBack();
                throw $e;
            }
        } else {
            $result = $this->saveInternal();
        }

        return $result;
    }

    protected function saveInternal()
    {
        $itemPropClass =  Kiwi::getItemPropClass();
        $itemPropValueClass = Kiwi::getItemPropValueClass();
        foreach ($this->itemProps as $key => $itemProp) {
            if ($value = $this->$key) {
                switch ($itemProp->type) {
                    case $itemPropClass::ITEM_PROP_TYPE_TEXT:
                        if (isset($this->itemPropValues[$key])) {
                            $itemPropValue = $this->itemPropValues[$key];
                        } else {
                            $itemPropValue = Kiwi::getItemPropValue();
                            $itemPropValue->item_id = $this->itemId;
                            $itemPropValue->item_prop_id = $itemProp->item_prop_id;
                        }
                        $itemPropValue->custom_prop_value = $value;
                        if (!$itemPropValue->save()) {
                            $this->addError($key, Json::encode($itemPropValue->getErrors()));
                        }
                        break;
                    case $itemPropClass::ITEM_PROP_TYPE_SELECT:
                        if (isset($this->itemPropValues[$key])) {
                            $itemPropValue = $this->itemPropValues[$key];
                        } else {
                            $itemPropValue = Kiwi::getItemPropValue();
                            $itemPropValue->item_id = $this->itemId;
                            $itemPropValue->item_prop_id = $itemProp->item_prop_id;
                        }
                        $itemPropValue->prop_value_id = $value;
                        if (!$itemPropValue->save()) {
                            $this->addError($key, Json::encode($itemPropValue->getErrors()));
                        }
                        break;
                    case $itemPropClass::ITEM_PROP_TYPE_CHECKBOX:
                        if (isset($this->itemPropValues[$key])) {
                            $itemPropValue = $this->itemPropValues[$key];
                        } else {
                            $itemPropValue = [];
                        }
                        $propValueIds = array_keys($itemPropValue);
                        $toAdd = array_diff($value, $propValueIds);
                        foreach($toAdd as $propValueId) {
                            $itemPropValue = Kiwi::getItemPropValue();;
                            $itemPropValue->item_id = $this->itemId;
                            $itemPropValue->item_prop_id = $itemProp->item_prop_id;
                            $itemPropValue->prop_value_id = $propValueId;
                            if (!$itemPropValue->save()) {
                                $this->addError($key, Json::encode($itemPropValue->getErrors()));
                            }
                        }
                        $toDel = array_diff($propValueIds, $value);
                        $itemPropValueClass::deleteAll(['item_id' => $this->itemId, 'item_prop_id' => $itemProp->item_prop_id, 'prop_value_id' => $toDel]);
                        break;
                    default:
                        break;
                }
            } else {
                $itemPropValueClass::deleteAll(['item_id' => $this->itemId, 'item_prop_id' => $itemProp->item_prop_id]);
            }
        }

        return !$this->hasErrors();
    }

    public function getSaleProps()
    {
        $saleProps = [];
        foreach ($this->itemProps as $key => $itemProp) {
            if ($itemProp->is_sale == '1') {
                $propValueIds = $this->getAttribute($key);
                $propValueClass = Kiwi::getPropValueClass();
                $propValues = $propValueClass::find()->where(['prop_value_id' => $propValueIds])->indexBy('prop_value_id')->all();
                $saleProps[$key] = ['itemProp' => $itemProp, 'propValues' => $propValues];
            }
        }
        return $saleProps;
    }

    /**
     * @param \yii\bootstrap\ActiveForm $form
     * @return string
     */
    public function formFields($form)
    {
        $itemPropClass = Kiwi::getItemPropClass();
        $html = '';
        foreach ($this->itemProps as $key => $itemProp) {
            $options = $itemProp->toArray();
            foreach ($options as $field => $value) {
                $options['data-' . str_replace('_', '-', $field)] = $value;
                unset($options[$field]);
            }
            /** @var \yii\bootstrap\ActiveField $field */
            $field = $form->field($this, $key, ['options' => $options, 'inputOptions' => $options]);
            if (in_array($itemProp->type, [$itemPropClass::ITEM_PROP_TYPE_SELECT, $itemPropClass::ITEM_PROP_TYPE_CHECKBOX])) {
                $items = [];
                foreach ($itemProp->propValues as $propValue) {
                    $items[$propValue->prop_value_id] = $propValue->name;
                }
                $itemOptions = array_merge($options, [
                    'container' => false,
                    'labelOptions' => ['class' => 'radio-inline'],
                ]);
                $field = $itemProp->type == $itemPropClass::ITEM_PROP_TYPE_SELECT ? $field->inline()->radioList($items, ['itemOptions' => $itemOptions]) : $field->inline()->checkboxList($items, ['itemOptions' => $itemOptions]);
            }
            $html .= $field->render();
        }
        return $html;
    }
}