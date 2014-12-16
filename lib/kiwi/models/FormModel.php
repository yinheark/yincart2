<?php
/**
 * @author Lujie.Zhou(lujie.zhou@jago-ag.cn)
 * @Date 10/30/2014
 * @Time 8:57 AM
 */

namespace kiwi\models;


use yii\base\Model;
use yii\db\Query;

class FormModel extends Model
{
    /** @var \kiwi\db\ActiveRecord[] */
    public $models = [];

    public function __get($name)
    {
        if (isset($this->models[$name])) {
            return $this->models[$name];
        }

        foreach ($this->models as $model) {
            if ($model->hasAttribute($name)) {
                return $model->getAttribute($name);
            }
        }

        return parent::__get($name);
    }

    public function __set($name, $value)
    {
        if (isset($this->models[$name])) {
            $this->models[$name] = $value;
            return;
        }

        foreach ($this->models as $model) {
            if ($model->hasAttribute($name)) {
                $model->setAttribute($name, $value);
                return;
            }
        }

        parent::__set($name, $value);
    }

    public function getAttributeLabel($attribute)
    {
        foreach ($this->models as $model) {
            if ($model->hasAttribute($attribute)) {
                return $model->getAttributeLabel($attribute);
            }
        }
        return parent::getAttributeLabel($attribute);
    }

    public function load($data, $formName = null)
    {
        $isLoad = true;
        foreach ($this->models as $key => $model) {
            $isLoad = $model->load($data, $formName) && $isLoad;
        }
        return parent::load($data, $formName) && $isLoad;
    }

    public function validate($attributeNames = null, $clearErrors = true)
    {
        $isValid = true;
        foreach ($this->models as $model) {
            $isValid = $model->validate($attributeNames, $clearErrors) && $isValid;
        }
        return parent::validate($attributeNames, $clearErrors) && $isValid;
    }

    public function saveInternal($attributeNames)
    {
        $isSave = true;
        foreach ($this->models as $model) {
            $isSave = $model->save(false, $attributeNames) && $isSave;
        }
        return $isSave;
    }

    public function save($runValidation = true, $attributeNames = null)
    {
        if ($runValidation && !$this->validate($attributeNames)) {
            \Yii::info('Model not inserted due to validation error.', __METHOD__);
            return false;
        }
        $db = \Yii::$app->getDb();
        $transaction = $db->beginTransaction();
        try {
            $result = $this->saveInternal($attributeNames);
            if ($result === false) {
                $transaction->rollBack();
            } else {
                $transaction->commit();
            }
        } catch (\Exception $e) {
            $transaction->rollBack();
            throw $e;
        }

        return $result;
    }

    public function getIsNewRecord()
    {
        foreach ($this->models as $model) {
            return $model->getIsNewRecord();
        }
    }

    public static function findOne($id)
    {
        $instance = new static;
        $mainModel = null;
        $mainKey = null;
        foreach ($instance->models as $key => $model) {
            $mainKey = $key;
            $mainModel = $model->findOne($id);
            break;
        }

        if (!$mainModel) {
            return null;
        }

        foreach ($instance->models as $key => $model) {
            if ($mainKey == $key) {
                $instance->$key = $mainModel;
            } else {
                $instance->$key = $mainModel->$key ? $mainModel->$key : $instance->$key;
            }
        }
        return $instance;
    }
}