<?php
/**
 * @author Lujie.Zhou(gao_lujie@live.cn)
 * @Date 10/22/2014
 * @Time 1:38 PM
 */

namespace core\auth\models;


use kiwi\db\ActiveRecord;
use kiwi\Kiwi;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\rbac\Role;

class RoleModel extends ActiveRecord
{
    /** @var \yii\rbac\Role */
    public $role;

    protected $_attributeLabels = [];

    protected $_attributeData = [];

    public function init()
    {
        parent::init();
        $this->initModel();
    }

    public $keySeparator = '_';

    protected $_permissions = [];

    protected $_permissionsFromFile = [];

    public function initModel()
    {
        /** @var \core\auth\Module $authModule */
        $authModule = \Yii::$app->getModule('core_auth');
        $this->_permissionsFromFile = $authModule->getPermissionsFromFile();

        foreach ($this->_permissionsFromFile as $moduleKey => $module) {
            $this->_permissions[$moduleKey] = [];
            foreach ($module['groups'] as $controllerKey => $group) {
                $attribute = $moduleKey . $this->keySeparator . $controllerKey;
                $attributeData = [];
                foreach ($group['permissions'] as $actionKey => $permission) {
                    $attributeData[$attribute . $this->keySeparator . $actionKey] = $permission['label'];
                }
                $this->_attributeData[$attribute] = $attributeData;
                $this->_permissions[$moduleKey][$attribute] = ['data' => $attributeData, 'value' => []];
            }
        }

        if ($this->role) {
            $authManager = \Yii::$app->getAuthManager();
            $this->setAttribute('description', $this->role->description);
            $rolePermissions = $authManager->getPermissionsByRole($this->role->name);
            foreach ($rolePermissions as $permission) {
                $keys = explode($authModule->keySeparator, $permission->name);
                array_pop($keys);
                $attribute = implode($this->keySeparator, $keys);
                if ($value = $this->getAttribute($attribute)) {
                    $value[] = $permission->name;
                    $this->setAttribute($attribute, $value);
                } else {
                    $this->setAttribute($attribute, [$permission->name]);
                }
            }
        }
    }

    public function getAttributeData($name)
    {
        return isset($this->_attributeData[$name]) ? $this->_attributeData[$name] : [];
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
            $this->_attributeLabels = ['description' => '角色名称'];
            foreach ($this->_permissionsFromFile as $moduleKey => $module) {
                foreach ($module['groups'] as $controllerKey => $group) {
                    $attribute = $moduleKey . $this->keySeparator . $controllerKey;
                    $this->_attributeLabels[$attribute] = $group['label'];
                }
            }
        }
        return $this->_attributeLabels;
    }

    public function rules()
    {
        $rules = [
            [['description'], 'required'],
            [['description'], 'string', 'max' => 255],
        ];
        $permissionRules = [
            [$this->attributes(), 'safe']
        ];
        return ArrayHelper::merge($rules, $permissionRules);
    }

    public function getIsNewRecord()
    {
        return !$this->role;
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
        $authManager = \Yii::$app->getAuthManager();
        if (!$this->role) {
            $this->role = new Role(['name' => $this->getAttribute('description'), 'description' => $this->getAttribute('description')]);
            $authManager->add($this->role);
        } else {
            $name = $this->role->name;
            $this->role->name = $this->role->description = $this->getAttribute('description');
            $authManager->update($name, $this->role);
        }

        $permissionKeys = [];
        $attributes = $this->getAttributes();
        unset($attributes['description']);
        foreach ($attributes as $name => $keys) {
            if ($keys) {
                $permissionKeys = ArrayHelper::merge($permissionKeys, $keys);
            }
        }
        $permissionKeys = array_combine($permissionKeys, $permissionKeys);

        $permissions = $authManager->getPermissionsByRole($this->role->name);
        foreach ($permissions as $permission) {
            if (in_array($permission->name, $permissionKeys)) {
                unset($permissionKeys[$permission->name]);
            } else {
                $authManager->removeChild($this->role, $permission);
            }
        }

        foreach ($permissionKeys as $permissionKey) {
            $permission = $authManager->getPermission($permissionKey);
            $authManager->addChild($this->role, $permission);
        }

        $this->afterSave(false, $this->attributes());
        return !$this->hasErrors();
    }

    /**
     * get the config
     * @param \yii\bootstrap\ActiveForm $form
     * @param array $options
     * @return array
     */
    public function formFields($form, $options = [])
    {
        if (!$options) {
            $template = "{label}\n<div class=\"col-sm-11\">{input}\n{hint}\n{error}</div>";
            $labelOptions = ['class' => 'control-label col-sm-1'];
            $options = ['template' => $template, 'labelOptions' => $labelOptions];
        }

        $groups = [];
        foreach ($this->_permissions as $moduleKey => $attributes) {
            $label = $this->_permissionsFromFile[$moduleKey]['label'];
            $content = '';
            foreach ($attributes as $attribute => $dataValue) {
                $content .= $form->field($this, $attribute, $options)->inline()->checkboxList($this->getAttributeData($attribute));
            }
            $groups[$moduleKey] = ['label' => $label, 'content' => $content];
        }
        return $groups;
    }
} 