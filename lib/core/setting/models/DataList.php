<?php

namespace core\setting\models;

use Yii;

/**
 * This is the model class for table "{{%data_list}}".
 *
 * @property integer $data_list_id
 * @property string $type
 * @property string $key
 * @property string $value
 *
 * @property array typeDataList
 *
 */
class DataList extends \kiwi\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%data_list}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['type', 'key'], 'required'],
            [['type', 'key', 'value'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'data_list_id' => Yii::t('app', 'Data List ID'),
            'type' => Yii::t('app', 'Type'),
            'key' => Yii::t('app', 'Key'),
            'value' => Yii::t('app', 'Value'),
        ];
    }

    public static function getDataList($type = '')
    {
        /** @var \core\setting\Module $module */
        $module = Yii::$app->getModule('core_setting');
        if ($type == 'type') {
            $dataList = $module->getDataList();
            $dataList = array_filter($dataList, function($data) { return isset($dataList['isDB']) && $dataList['isDB']; });
            foreach ($dataList as $key => $value) {
                $dataList[$key] = $value['label'];
            }
            return $dataList;
        }
        $dataList = $module->getDataList($type);
        $dataList = isset($dataList['value']) ? $dataList['value'] : $dataList;
        if (isset($dataList['isDB']) && $dataList['isDB']) {
            /** @var DataList[] $dbDataList */
            $dbDataList = static::find()->where(['type' => $type])->all();
            foreach ($dbDataList as $data) {
                $dataList[$data->key] = $data->value;
            }
            return $dataList;
        }
        return $dataList;
    }

    public function __get($name)
    {
        return $this->getDataList($name);
    }

    public function __call($name, $arguments)
    {
        if (strlen($name) > 3 && substr($name, 0, 3) == 'get') {
            $key = lcfirst(substr($name, 3));
            return $this->getDataList($key);
        }
        return parent::__get($name);
    }
}
