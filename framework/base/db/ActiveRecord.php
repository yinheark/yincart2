<?php
/**
 * @link http://www.yincart.com/
 * @copyright Copyright (c) 2014 Yincart
 * @license http://www.yincart.com/license/
 */

namespace yincart\base\db;

use Yii;
use yii\base\UnknownMethodException;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\Exception;
use yincart\trigger\behaviors\ActiveRecordTrigger;
use yincart\trigger\events\CustomEvent;

/**
 * Class ActiveRecord add save relation model and aop proxy call
 * @package backend\modules\qc\basemodels
 * @author jeremy.zhou(gao_lujie@live.cn)
 */
Class ActiveRecord extends \yii\db\ActiveRecord
{
    #region save relation models

    /**
     * @var array save the relate data
     */
    private $_relations = [];

    /**
     * @var array to delete relation record ids
     */
    private $_toDeleteRelations = [];

    /**
     * @inheritdoc
     */
    public function __set($name, $value)
    {
        if ($this->tryToSetRelation($name, $value)) return;
        parent::__set($name, $value);
    }

    /**
     * @inheritdoc
     */
    public function setAttribute($name, $value)
    {
        if ($this->tryToSetRelation($name, $value)) return;
        parent::setAttribute($name, $value);
    }

    /**
     * rewrite set attributes, set relation data to relations, auto save at after save
     * @inheritdoc
     */
    public function setAttributes($values, $safeOnly = true)
    {
        $this->_relations = [];
        $this->_toDeleteRelations = [];

        if (is_array($values)) {
            foreach ($values as $name => $value) {
                $this->tryToSetRelation($name, $value);
            }
        }
        parent::setAttributes($values, $safeOnly);
    }

    public function tryToSetRelation($name, $value)
    {
        $relation = $this->getRelation($name, false);
        if ($relation) {
            $this->setRelation($name, $value);
            return true;
        }
        return false;
    }

    /**
     * convert relation array to model
     * @param $name
     * @param $values
     * @param null $indexKey
     */
    public function setRelation($name, $values, $indexKey = null)
    {
        $relation = $this->getRelation($name);

        if ($relation->multiple) {
            /** @var \yincart\base\db\ActiveRecord $model */
            $model = Yii::createObject($relation->modelClass);
            if (!$indexKey) {
                $primaryKeys = $model->primaryKey();
                $indexKey = $primaryKeys[0];
            }

            /** @var \yincart\base\db\ActiveRecord[] $oldRelations */
            $oldRelations = $relation->findFor($name, $this);
            $savedModelList = [];
            foreach ($oldRelations as $value) {
                $savedModelList[$value->$indexKey] = $value;
            }

            foreach ($values as $key => $value) {
                if (!empty($value[$indexKey]) && !empty($savedModelList[$value[$indexKey]])) {
                    $model = clone($savedModelList[$value[$indexKey]]);
                    unset($savedModelList[$value[$indexKey]]);
                } else if ($value instanceof ActiveRecord) {
                    $model = $value;
                } else {
                    $model = Yii::createObject($relation->modelClass);
                }

                if ($value instanceof ActiveRecord) {
                    $value = $value->getAttributes();
                }
                $model->setAttributes($value);
                //just to access the validate
                foreach ($relation->link as $fk => $pk) {
                    $model->$fk = 0;
                }
                $values[$key] = $model;
            }
            $this->_relations[$name] = $values;
            $this->_toDeleteRelations[$name] = ['key' => $indexKey, 'value' => array_keys($savedModelList)];
        } else {
            /** @var \yincart\base\db\ActiveRecord $model */
            $model = $this->$name;
            if (empty($model)) {
                $model = Yii::createObject($relation->modelClass);
            }
            $model->setAttributes($values);
            $this->_relations[$name] = $model;
        }
    }

    /**
     * save relation data after save model
     * @inheritdoc
     */
    public function afterSave($insert, $changedAttributes)
    {
        foreach ($this->_relations as $name => $models) {
            $relation = $this->getRelation($name);
            if (is_array($models)) {
                foreach ($models as $model) {
                    /** @var \yii\db\ActiveRecord $model */
                    foreach ($relation->link as $fk => $pk) {
                        $model->$fk = $this->$pk;
                    }
                    if (!$model->save(false)) {
                        $this->addError($name, $model->getErrors());
                    }
                }
                if (!empty($this->_toDeleteRelations[$name]) && !empty($this->_toDeleteRelations[$name]['value'])) {
                    $condition = [];
                    foreach ($relation->link as $fk => $pk) {
                        $condition[$fk] = $this->$pk;
                    }
                    $condition[$this->_toDeleteRelations[$name]['key']] = $this->_toDeleteRelations[$name]['value'];
                    /** @var \yii\db\ActiveRecord $modelClass */
                    $modelClass = $relation->modelClass;
                    $modelClass::deleteAll($condition);
                }
            } else {
                /** @var \yii\db\ActiveRecord $models */
                if (!$models->save(false)) {
                    $this->addError($name, $models->getErrors());
                }
            }
        }
        if ($this->hasErrors()) {
            throw new Exception('Save relation models fail!', $this->getErrors());
        }

        foreach ($this->_relations as $name => $models) {
            $relation = $this->getRelation($name);
            // update lazily loaded related objects
            if ($relation->multiple && $relation->indexBy !== null) {
                $indexBy = $relation->indexBy;
                $relationModels = [];
                foreach ($models as $model) {
                    $relationModels[$model->$indexBy] = $model;
                }
                $models = $relationModels;
            }
            $this->populateRelation($name, $models);
        }
        $this->_relations = [];
        $this->_toDeleteRelations = [];

        parent::afterSave($insert, $changedAttributes);
    }

    /**
     * need to validate the relation models
     * @inheritdoc
     */
    public function validate($attributes = null, $clearErrors = true)
    {
        $isValid = true;

        if (!parent::validate($attributes, $clearErrors)) {
            $isValid = false;
        }

        foreach ($this->_relations as $name => $models) {
            if (is_array($models)) {
                foreach ($models as $model) {
                    /** @var \yii\db\ActiveRecord $model */
                    if (!$model->validate(null, $clearErrors)) {
                        $isValid = false;
                        $this->addError($name, $model->getErrors());
                    }
                }
            } else {
                /** @var \yii\db\ActiveRecord $models */
                if (!$models->validate(null, $clearErrors)) {
                    $isValid = false;
                    $this->addError($name, $models->getErrors());
                }
            }
        }

        return $isValid;
    }

    #endregion

    #region for the aop

    /**
     * call the user defined func with aop
     * @inheritdoc
     */
    public function __call($name, $arguments)
    {
        $result = self::staticCall($name, $arguments);
        if ($result !== false) {
            return $result;
        }

        if ($func = $this->getAopFunc($name)) {
            if ($this->beforeCall($name, $arguments)) {
                $result = call_user_func_array([$this, $func], $arguments);
                $this->afterCall($name, $arguments);
                return $result;
            }
            return false;
        }

        return parent::__call($name, $arguments);
    }

    /**
     * call some common func
     * @param $name
     * @param $arguments
     * @return static
     * @throws UnknownMethodException
     */
    public static function __callStatic($name, $arguments)
    {
        $result = self::staticCall($name, $arguments);
        if ($result !== false) {
            return $result;
        }

        throw new UnknownMethodException('Calling unknown static method: ' . self::className() . "::$name()");
    }

    /**
     * @param $name
     * @param $arguments
     * @return bool|static
     */
    protected static function staticCall($name, $arguments)
    {
        if ($name == 'get' . self::shortClassName() && count($arguments[0]) == 1) {
            return self::findOne($arguments[0]);
        }

        return false;
    }

    /**
     * @param string $name
     * @return bool|string
     */
    protected function getAopFunc($name)
    {
        $func = 'aop' . ucfirst($name);
        return method_exists($this, $func);
    }

    public function beforeCall($name, $arguments)
    {
        $event = new CustomEvent();
        $event->customData = $arguments;
        $this->trigger('before' . ucfirst($name), $event);
        return $event->isValid;
    }

    public function afterCall($name, $arguments)
    {
        $event = new CustomEvent();
        $event->customData = $arguments;
        $this->trigger('after' . ucfirst($name), $event);
    }

    #endregion

    /**
     * @param array $relations
     * @return array
     */
    public function getRelations(array $relations)
    {
        $data = $this->toArray();
        foreach ($relations as $key => $relation) {
            if (is_int($key) && is_string($relation)) {
                $relationData = $this->$relation;
                if (is_array($relationData)) {
                    /** @var \yii\db\ActiveRecord[] $relationData */
                    $data[$relation] = [];
                    foreach ($relationData as $m) {
                        $data[$relation][] = $m->toArray();
                    }
                } else {
                    /** @var \yii\db\ActiveRecord $relationData */
                    $data[$relation] = $relationData ? $relationData->toArray() : [];
                }
            } else if (is_string($key)) {
                $relationData = $this->$key;
                if (is_array($relationData)) {
                    /** @var \yii\db\ActiveRecord[] $relationData */
                    $data[$key] = [];
                    foreach ($relationData as $model) {
                        /** @var \yincart\base\db\ActiveRecord $model */
                        $data[$key][] = $model->getRelations($relation);
                    }
                } else {
                    /** @var \yincart\base\db\ActiveRecord $relationData */
                    $data[$key] = $relationData->getRelations($relation);
                }
            }
        }
        return $data;
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
//            'timestamp' => [
//                'class' => TimestampBehavior::className()
//            ],
//            'blameable' => [
//                'class' => BlameableBehavior::className()
//            ],
//            'trigger' => [
//                'class' => ActiveRecordTrigger::className()
//            ]
        ];
    }

    /**
     * Returns the short qualified name of this class.
     * @return string the short qualified name of this class.
     */
    public static function shortClassName()
    {
        $className = self::className();
        $names = explode('\\', $className);
        return $names[count($names) - 1];
    }

    /**
     * add default conditions
     * @param bool $isDefault
     * @inheritdoc
     */
    public static function find($isDefault = false)
    {
        $query = parent::find();
        if (!$isDefault) {
            return $query;
        }

        $primaryKeys = static::primaryKey();
        if (count($primaryKeys) == 1) {
            $query->indexBy($primaryKeys[0]);
        }
        /** @var ActiveRecord $model */
        $model = new static;
        if ($model->hasAttribute('status')) {
            $query->where(['status' => 1]);
        }
        if ($model->hasAttribute('sort')) {
            $query->orderBy(['sort' => SORT_ASC]);
        }
        return $query;
    }
}