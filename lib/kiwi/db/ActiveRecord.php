<?php
/**
 * @author Lujie.Zhou(gao_lujie@live.cn)
 * @Date 10/17/2014
 * @Time 1:30 PM
 */

namespace kiwi\db;

use Yii;
use yii\db\ActiveQueryInterface;
use yii\db\Exception;

/**
 * Class ActiveRecord
 * @package kiwi\db
 * @author Lujie.Zhou(lujie.zhou@jago-ag.cn)
 */
class ActiveRecord extends \yii\db\ActiveRecord
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

    public function load($data, $formName = null)
    {
        foreach ($data as $name => $value) {
            $this->tryToSetRelation($name, $value);
        }
        return parent::load($data, $formName);
    }

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
        if (is_array($values)) {
            foreach ($values as $name => $value) {
                $this->tryToSetRelation($name, $value);
            }
        }
        parent::setAttributes($values, $safeOnly);
    }

    public function tryToSetRelation($name, $value)
    {
        $name = lcfirst($name);
        if ((is_array($value) || $value instanceof ActiveRecord) && $relation = $this->getRelation($name, false)) {
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
            /** @var \kiwi\db\ActiveRecord $model */
            $model = Yii::createObject($relation->modelClass);
            if (!$indexKey) {
                $primaryKeys = $model->primaryKey();
                $indexKey = $primaryKeys[0];
            }

            /** @var \kiwi\db\ActiveRecord[] $oldRelations */
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

                if (!($value instanceof ActiveRecord)) {
                    $model->setAttributes($value);
                }
                //just to access the validate
                foreach ($relation->link as $fk => $pk) {
                    $model->$fk = 0;
                }
                $values[$key] = $model;
            }
            $this->_relations[$name] = $values;
            $this->_toDeleteRelations[$name] = ['key' => $indexKey, 'value' => array_keys($savedModelList)];
        } else {
            /** @var \kiwi\db\ActiveRecord $model */
            $model = $this->$name;
            if (empty($model)) {
                $model = Yii::createObject($relation->modelClass);
                foreach ($relation->link as $pk => $fk) {
                    $model->$pk = 0;
                }
            }
            if ($values instanceof ActiveRecord) {
                $model = $values;
            } else {
                $model->setAttributes($values);
            }
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
                foreach ($relation->link as $pk => $fk) {
                    $models->$pk = $this->$fk;
                }
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
        $isValid = parent::validate($attributes, $clearErrors);

        $relatedAttributes = [];
        if ($attributes) {
            foreach ($attributes as $attribute) {
                if (($pos = strpos($attribute, '.')) !== false) {
                    $relatedName = substr($attributes, 0, $pos + 1);
                    $relatedAttribute = substr($attributes, $pos + 2);
                    if (!isset($relatedAttributes[$relatedName])) {
                        $relatedAttributes[$relatedName] = [];
                    }
                    $relatedAttributes[$relatedName][] = $relatedAttribute;
                }
            }
        }

        foreach ($this->_relations as $name => $models) {
            $modelAttributes = isset($relatedAttributes[$name]) ? $relatedAttributes[$name] : null;
            if (is_array($models)) {
                foreach ($models as $model) {
                    /** @var \yii\db\ActiveRecord $model */
                    if (!$model->validate($modelAttributes, $clearErrors)) {
                        $isValid = false;
                        $this->addError($name, $model->getErrors());
                    }
                }
            } else {
                /** @var \yii\db\ActiveRecord $models */
                if (!$models->validate($modelAttributes, $clearErrors)) {
                    $isValid = false;
                    $this->addError($name, $models->getErrors());
                }
            }
        }

        return $isValid;
    }

    #endregion
} 