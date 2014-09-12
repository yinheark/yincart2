<?php
/**
 * @link http://www.yincart.com/
 * @copyright Copyright (c) 2014 Yincart
 * @license http://www.yincart.com/license/
 */

namespace yincart\models;

use yii\base\Model;
use yincart\base\db\ActiveRecord;
use yii\helpers\Json;

class ModelForm extends Model
{
    /**
     * @var \yincart\base\db\ActiveRecord
     */
    public $model;

    public $relations = [];

    public function save($returnJson = true)
    {
        $primaryKeys = $this->model->primaryKey();
        $primaryKey = $primaryKeys[0];

        $modelData = \Yii::$app->getRequest()->post($this->model->shortClassName());
        if (!empty($modelData[$primaryKey])) {
            $id = $modelData[$primaryKey];
            $this->model = $this->model->findOne($id);
            if (!$this->model) {
                return $returnJson ? $this->renderJson() : false;
            }
        }

        $this->model->setAttributes($modelData);

        foreach ($this->relations as $name => $value) {
            if (is_string($value)) {
                $value = \Yii::$app->getRequest()->post($value);
            } else if ($value instanceof \Closure) {
                $value = call_user_func($value);
            }

            $indexKey = null;
            if (isset($value['indexKey'])) {
                $indexKey = $value['indexKey'];
                unset($value['indexKey']);
            }

            $this->model->setRelation($name, $value, $indexKey);
        }
        $result = $this->model->save();
        return $returnJson ? $this->renderJson() : $result;
    }

    public function renderJson()
    {
        if (!$this->model) {
            return Json::encode(['success' => 0, 'message' => \Yii::t('yincart', 'Error ID!'), 'errors' => []]);
        } else if ($this->model->hasErrors()) {
            return Json::encode(['success' => 0, 'message' => \Yii::t('yincart', 'Save Error!'), 'errors' => $this->model->getErrors()]);
        } else {
            return Json::encode(['success' => 1, 'message' => \Yii::t('yincart', 'Save Success!'), 'id' => $this->model->getPrimaryKey()]);
        }
    }
}