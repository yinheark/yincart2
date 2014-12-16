<?php
/**
 * @author Lujie.Zhou(lujie.zhou@jago-ag.cn)
 * @Date 10/24/2014
 * @Time 4:31 PM
 */

namespace kiwi\models;


use kiwi\db\ActiveRecord;
use yii\helpers\ArrayHelper;

/**
 * Class FormModel
 * @deprecated
 * @package kiwi\models
 * @author Lujie.Zhou(lujie.zhou@jago-ag.cn)
 */
class FormARModel extends ActiveRecord
{
    /** @var ActiveRecord[] */
    protected $_models = [];

    protected $_relations = [];

    protected $_rules = [];

    protected $_attributeLabels = [];

    public function hasModel($name)
    {
        return isset($this->_models[$name]) || array_key_exists($name, $this->_models);
    }

    public function __get($name)
    {
        if ($this->hasModel($name)) {
            return $this->_models[$name];
        }
        foreach ($this->_models as $model) {
            if ($model->hasAttribute($name)) {
                return $model->$name;
            }
        }
        return parent::__get($name);
    }

    public function __set($name, $value)
    {
        if ($this->hasModel($name)) {
            $this->_models[$name] = $value;
            return;
        }
        foreach ($this->_models as $model) {
            if ($model->hasAttribute($name)) {
                $model->$name = $value;
                return;
            }
        }
        parent::__set($name, $value);
    }

    public function __unset($name)
    {
        if ($this->hasModel($name)) {
            unset($this->_models[$name]);
            return;
        }
        foreach ($this->_models as $model) {
            if ($model->hasAttribute($name)) {
                unset($model->$name);
                return;
            }
        }
        parent::__unset($name);
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
            foreach ($this->_models as $model) {
                $this->_attributeLabels = ArrayHelper::merge($this->_attributeLabels, $model->attributeLabels());
            }
        }
        return $this->_attributeLabels;
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        if (!$this->_rules) {
            foreach ($this->_models as $model) {
                $this->_rules = ArrayHelper::merge($this->_rules, $model->rules());
            }
        }
        return $this->_rules;
    }

    public function setAttributes($values, $safeOnly = true)
    {
        foreach ($this->_models as $model) {
            $model->setAttributes($values);
        }
    }

    /**
     * @inheritdoc
     */
    public function getIsNewRecord()
    {
        foreach ($this->_models as $model) {
            return $model->getIsNewRecord();
        }
    }

    public static function primaryKey()
    {
        /** @var FormModel $instance */
        $instance = new static;
        foreach ($instance->_models as $model) {
            return $model::primaryKey();
        }
    }

    public static function getTableSchema()
    {
        /** @var FormModel $instance */
        $instance = new static;
        $tableSchema = null;
        $columns = [];
        foreach ($instance->_models as $model) {
            $schema = $model::getTableSchema();
            $tableSchema = $tableSchema ?: $schema;
            $columns = ArrayHelper::merge($columns, $schema->columns);
        }
        $tableSchema->columns = $columns;
        return $tableSchema;
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        /** @var FormModel $instance */
        $instance = new static;
        foreach ($instance->_models as $model) {
            return $model::tableName();
        }
    }

    /**
     * @param \kiwi\models\FormModel $record
     * @param array $row
     */
    public static function populateRecord($record, $row)
    {
        foreach ($record->_models as $key => $model) {
            parent::populateRecord($model, $row);
        }
        parent::populateRecord($record, $row);
    }

    public function validate($attributeNames = null, $clearErrors = true)
    {
        if ($clearErrors) {
            $this->clearErrors();
        }

        if (!$this->beforeValidate()) {
            return false;
        }

        foreach ($this->_models as $model) {
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

        foreach ($this->_models as $model) {
            if (!$model->save()) {
                foreach ($model->getErrors() as $attribute => $errors) {
                    foreach ($errors as $error) {
                        $this->addError($attribute, $error);
                    }
                }
            }
        }

        $this->afterSave($insert, $this->attributes());
        return !$this->hasErrors();
    }

    /**
     * @inheritdoc
     */
    public static function find()
    {
        $instance = new static;
        $query = parent::find()->select("{$instance::tableName()}.*");

        foreach ($instance->_relations as $key => $relation) {
            $joinType = isset($relation['joinType']) ? $relation['joinType'] : 'leftJoin';

            if (isset($relation['table'])) {
                $relationTable = $instance->{$relation['table']}->tableName();
            } else {
                $relationTable = $instance::tableName();
            }

            $table = $instance->$key->tableName();

            if (is_array($relation['on'])) {
                $on = [];
                foreach ($relation['on'] as $k => $fk) {
                    $on[] = "$table.$k = $relationTable.$fk";
                }
                $on = implode(' AND ', $on);
            } else {
                $on = $relation['on'];
            }

            $params = isset($relation['params']) ? $relation['params'] : [];

            $query->{$joinType}($table, $on, $params)->addSelect("{$table}.*");
        }

        return $query;
    }

    /**
     * @param \yii\bootstrap\ActiveForm $form
     * @param array $options
     * @return string
     */
    public function formFields($form, $options = [])
    {
        return '';
    }
} 