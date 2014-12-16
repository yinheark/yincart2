<?php

namespace core\tree\models;

use gilek\gtreetable\models\TreeModel;
use Yii;

/**
 * This is the model class for table "{{%tree}}".
 *
 * @property integer $id
 * @property string $name
 * @property integer $root
 * @property integer $lft
 * @property integer $rgt
 * @property integer $level
 * @property string $type
 */
class Tree extends TreeModel
{
    public function findNestedSet() {
        return parent::findNestedSet()->where(['type' => static::TYPE_DEFAULT]);
    }

    /**
     * @inheritdoc
     */
    public static function find()
    {
        return parent::find()->where(['type' => static::TYPE_DEFAULT]);
    }

    /**
     * @inheritdoc
     */
    public function beforeSave($insert) {
        parent::beforeSave($insert);

        if ($this->isNewRecord) {
            $this->{$this->typeAttribute} = static::TYPE_DEFAULT;
        }
        return true;
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%tree}}';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'root' => Yii::t('app', 'Root'),
            'lft' => Yii::t('app', 'Lft'),
            'rgt' => Yii::t('app', 'Rgt'),
            'level' => Yii::t('app', 'Level'),
            'type' => Yii::t('app', 'Type'),
        ];
    }

    public static function getTreeItems()
    {
        /** @var Tree[] $treeNodes */
        $treeNodes = static::find()->addOrderBy(['root' => SORT_ASC, 'lft' => SORT_ASC])->indexBy('id')->all();
        $treeNodes = array_map(function ($treeNode) {
            $level = $treeNode->level;
            $name = $treeNode->name;
            while (--$level) {
                $name = '|---' . $name;
            }
            return $name;
        }, $treeNodes);
        return $treeNodes;
    }
}
