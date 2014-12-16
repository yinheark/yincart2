<?php
/**
 * @author Lujie.Zhou(gao_lujie@live.cn)
 * @Date 10/20/2014
 * @Time 4:14 PM
 */

namespace core\setting\models;


use kiwi\db\ActiveRecord;
use kiwi\Kiwi;
use yii\bootstrap\Collapse;
use yii\bootstrap\Tabs;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;

class SettingKVModel extends ActiveRecord
{
    public $keySeparator = '_';

    protected static $_configFromFile = [];

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        $this->initConfig();
    }

    public function initConfig()
    {
        /** @var \core\setting\Module $settingModule */
        $settingModule = \Yii::$app->getModule('core_setting');
        $config = $settingModule->getConfigFromFile();
        foreach ($config as $tabKey => $tab) {
            foreach ($tab['groups'] as $groupKey => $group) {
                foreach ($group['fields'] as $fieldKey => $field) {
                    $configKey = implode($this->keySeparator, [$tabKey, $groupKey, $fieldKey]);
                    static::$_configFromFile[$configKey] = $field;
                }
            }
        }

        /** @var \core\setting\models\Setting $settingClass */
        $settingClass = Kiwi::getSettingClass();
        $config = $settingClass::getConfigFromDB();
        $config = ArrayHelper::merge(static::$_configFromFile, $config);

        foreach ($config as $name => $field) {
            $value = isset($field['value']) ? $field['value'] : null;
            if ($field['type'] == 'checkbox' && is_string($value)) {
                $value = Json::decode($value);
            }
//            $config[$name]['value'] = $value;
            $this->setAttribute($name, $value);
        }
    }

    /**
     * @inheritdoc
     */
    public function attributes()
    {
        return array_keys(static::$_configFromFile);
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        $attributeLabels = [];
        foreach (static::$_configFromFile as $key => $field) {
            $attributeLabels[$key] = $field['label'];
        }
        return $attributeLabels;
    }

    /**
     * @inheritdoc
     */
    public function setAttributes($values, $safeOnly = false)
    {
        parent::setAttributes($values, $safeOnly);
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
        if (!$this->beforeSave(false)) {
            return false;
        }

        /** @var \core\setting\models\Setting $settingClass */
        $settingClass = Kiwi::getSettingClass();

        foreach ($this->getAttributes() as $key => $value) {
            if (static::$_configFromFile[$key]['type'] == 'checkbox' && is_array($value)) {
                $value = Json::encode($value);
            }

            if (isset(static::$_configFromFile[$key]['value']) && static::$_configFromFile[$key]['value'] == $value) {
                $settingClass::deleteAll(['path' => $key]);
            } else {
                /** @var \core\setting\models\Setting $setting */
                $setting = $settingClass::findOne(['path' => $key]);
                $setting = $setting ?: Kiwi::getSetting(['path' => $key]);
                $setting->value = $value;
                if (!$setting->save()) {
                    $this->addError($key, Json::encode($setting->getErrors()));
                }
            }
        }

        $this->afterSave(false, $this->attributes());

        return !$this->hasErrors();
    }

    /**
     * get the config
     * @param \yii\bootstrap\ActiveForm $form
     * @param array $options
     * @return string
     */
    public function formFields($form, $options = [])
    {
        if (!$options) {
            $template = "{label}\n<div class=\"col-sm-11\">{input}\n{hint}\n{error}</div>";
            $labelOptions = ['class' => 'control-label col-sm-1'];
            $options = ['template' => $template, 'labelOptions' => $labelOptions];
        }

        /** @var \core\setting\Module $settingModule */
        $settingModule = \Yii::$app->getModule('core_setting');
        $config = $settingModule->getConfigFromFile();
        $tabItems = [];
        foreach ($config as $tabKey => $tab) {
            $groupItems = [];
            foreach ($tab['groups'] as $groupKey => $group) {
                $groupContent = '';
                foreach ($group['fields'] as $fieldKey => $field) {
                    $key = implode($this->keySeparator, [$tabKey, $groupKey, $fieldKey]);
                    /** @var \yii\bootstrap\ActiveField $activeField */
                    $activeField = $form->field($this, $key, $options);
                    $data = [];
                    if (isset($field['data'])) {
                        if (is_array($field['data'])) {
                            $data = $field['data'];
                        } else {
                            list($class, $func) = explode('/', $field['data']);
                            $getClass = 'get' . ucfirst($class);
                            $data = Kiwi::$getClass()->$func();
                        }
                    }
                    switch ($field['type']) {
                        case 'select':
                            $activeField->dropDownList($data);
                            break;
                        case 'checkbox':
                            $activeField->inline()->checkboxList($data);
                            break;
                        case 'radio':
                            $activeField->inline()->radioList($data);
                            break;
                        case 'textarea':
                            $activeField->textarea();
                            break;
                    }
                    if (isset($field['hint'])) {
                        $activeField->hint($field['hint']);
                    }
                    $groupContent .= $activeField->render();
                }

                $groupItems[$group['label']] = [
                    'label' => $group['label'],
                    'content' => $groupContent,
                ];
            }
            $tabContent = Collapse::widget(['items' => $groupItems]);
            $tabItems[] = [
                'label' => $tab['label'],
                'content' => $tabContent,
            ];
        }

        return Tabs::widget(['items' => $tabItems]);
    }
} 