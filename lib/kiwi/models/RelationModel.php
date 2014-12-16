<?php
/**
 * @author Lujie.Zhou(lujie.zhou@jago-ag.cn)
 * @Date 10/29/2014
 * @Time 2:09 PM
 */

namespace kiwi\models;


use kiwi\db\ActiveRecord;
use yii\helpers\ArrayHelper;

/**
 * Class RelationModel
 * @deprecated
 * @package kiwi\models
 * @author Lujie.Zhou(lujie.zhou@jago-ag.cn)
 */
class RelationModel extends ActiveRecord
{
    /** @var ActiveRecord */
    public $model;

    /** @var ActiveRecord[] */
    public $relations = [];

    protected $_rules = [];

    protected $_attributeLabels = [];

    public function __get($name)
    {
        if ($this->model->hasAttribute($name)) {
            return $this->model->getAttribute($name);
        }
        if (isset($this->relations[$name])) {
            return $this->relations[$name];
        }
        foreach ($this->relations as $model) {
            if ($model->hasAttribute($name)) {
                return $model->getAttribute($name);
            }
        }
        return parent::__get($name);
    }

    public function __set($name, $value)
    {
        if ($this->model->hasAttribute($name)) {
            $this->model->setAttribute($name, $value);
        } elseif (isset($this->relations[$name])) {
            if (is_array($value)) {
                $this->relations[$name]->setAttributes($value);
            } elseif ($value instanceof ActiveRecord) {
                $this->relations[$name] = $value;
            }
        } else {
            foreach ($this->relations as $model) {
                if ($model->hasAttribute($name)) {
                    $model->setAttribute($name, $value);
                }
            }
            parent::__set($name, $value);
        }
    }

    /**
     * @inheritdoc
     */
    public function attributes()
    {
        return array_keys($this->attributeLabels());
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        if (!$this->_attributeLabels) {
            foreach ($this->relations as $model) {
                $this->_attributeLabels = ArrayHelper::merge($this->_attributeLabels, $model->attributeLabels());
            }
            $this->_attributeLabels = ArrayHelper::merge($this->_attributeLabels, $this->model->attributeLabels());
        }
        return $this->_attributeLabels;
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        if (!$this->_rules) {
            foreach ($this->relations as $model) {
                $this->_rules = ArrayHelper::merge($this->_rules, $model->rules());
            }
            $this->_rules = ArrayHelper::merge($this->_rules, $this->model->rules());
        }
        return $this->_rules;
    }

    public function setAttributes($values, $safeOnly = true)
    {
        $this->model->setAttributes($values, $safeOnly);
        foreach ($this->relations as $model) {
            $model->setAttributes($values, $safeOnly);
        }
        parent::setAttributes($values, $safeOnly);
    }

    /**
     * @inheritdoc
     */
    public function getIsNewRecord()
    {
        return $this->model->getIsNewRecord();
    }

    public static function primaryKey()
    {
        /** @var RelationModel $instance */
        $instance = new static;
        return $instance->model->primaryKey();
    }

    public static function getTableSchema()
    {
        /** @var RelationModel $instance */
        $instance = new static;
        $tableSchema = $instance->model->getTableSchema();;
        $columns = [];
        foreach ($instance->relations as $model) {
            $schema = $model->getTableSchema();
            $columns = ArrayHelper::merge($columns, $schema->columns);
        }
        $tableSchema->columns = ArrayHelper::merge($columns, $tableSchema->columns);
        return $tableSchema;
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        /** @var RelationModel $instance */
        $instance = new static;
        return $instance->model->tableName();
    }

    public function validate($attributeNames = null, $clearErrors = true)
    {
        if ($clearErrors) {
            $this->clearErrors();
        }

        if (!$this->beforeValidate()) {
            return false;
        }

        if (!$this->model->validate($attributeNames, $clearErrors)) {
            foreach ($this->model->getErrors() as $attribute => $errors) {
                foreach ($errors as $error) {
                    $this->addError($attribute, $error);
                }
            }
        }

        foreach ($this->relations as $model) {
            if (!$model->validate($attributeNames, $clearErrors)) {
                foreach ($model->getErrors() as $attribute => $errors) {
                    foreach ($errors as $error) {
                        $this->addError($attribute, $error);
                    }
                }
            }
        }

        $this->afterValidate();

        return !$this->hasErrors();
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

    public function saveInternal()
    {
        $insert = $this->getIsNewRecord();
        if (!$this->beforeSave($insert)) {
            return false;
        }

        if ($this->model->save(false)) {
            foreach ($this->relations as $model) {
                if (!$model->save(false)) {
                    foreach ($model->getErrors() as $attribute => $errors) {
                        foreach ($errors as $error) {
                            $this->addError($attribute, $error);
                        }
                    }
                }
            }
        } else {
            foreach ($this->model->getErrors() as $attribute => $errors) {
                foreach ($errors as $error) {
                    $this->addError($attribute, $error);
                }
            }
        }

        $this->afterSave($insert, $this->attributes());
        return !$this->hasErrors();
    }

    /**
     * @param \kiwi\models\RelationModel $record
     * @param array $row
     */
    public static function populateRecord($record, $row)
    {
        parent::populateRecord($record->model, $row);
        parent::populateRecord($record, $row);
    }

    /**
     * @inheritdoc
     */
    public static function find()
    {
        /** @var RelationModel $instance */
        $instance = new static;
        $query = parent::find();
        return $query;
    }

    /**
     * @param \yii\bootstrap\ActiveForm $form
     * @param array $attributes
     * @param array $options
     * @return string
     */
    public function formFields($form, $attributes = [], $options = [])
    {
        return '';
    }
} 