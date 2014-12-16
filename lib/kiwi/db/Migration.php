<?php
/**
 * @author Lujie.Zhou(gao_lujie@live.cn)
 * @Date 10/15/2014
 * @Time 11:27 AM
 */

namespace kiwi\db;


use yii\db\Query;

class Migration extends \yii\db\Migration
{
    public $table = '{{%module_version}}';

    public $module;

    /**
     * @inheritdoc
     */
    public function up()
    {
        $transaction = $this->db->beginTransaction();
        try {
            ob_start();
            ob_implicit_flush(false);
            if ($this->safeUp() === false || $this->markUpVersion() === false) {
                $transaction->rollBack();
                return false;
            }
            $transaction->commit();
            \Yii::info(ob_get_clean());
        } catch (\Exception $e) {
            $transaction->rollBack();
            \Yii::Warning("Exception: " . $e->getMessage() . ' (' . $e->getFile() . ':' . $e->getLine() . ")\n");
            \Yii::Warning($e->getTraceAsString() . "\n");
            return false;
        }
        return null;
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $transaction = $this->db->beginTransaction();
        try {
            ob_start();
            ob_implicit_flush(false);
            if ($this->safeDown() === false || $this->markDownVersion() === false) {
                $transaction->rollBack();
                return false;
            }
            $transaction->commit();
            \Yii::info(ob_get_clean());
        } catch (\Exception $e) {
            \Yii::info("Exception: " . $e->getMessage() . ' (' . $e->getFile() . ':' . $e->getLine() . ")\n");
            \Yii::info($e->getTraceAsString() . "\n");
            $transaction->rollBack();
            return false;
        }
        return null;
    }

    protected function getUpVersion()
    {
        $names = explode('\\', get_called_class());
        $version = array_pop($names);
        if (strpos($version, '_v') === false) {
            return str_replace('_', '.', $version);
        }
        $version = explode('_v', $version);
        return str_replace('_', '.', 'v' . $version[1]);
    }

    protected function getDownVersion()
    {
        $names = explode('\\', get_called_class());
        $version = array_pop($names);
        if (strpos($version, '_v') === false) {
            return false;
        }
        $version = explode('_v', $version);
        return str_replace('_', '.', $version[0]);
    }

    protected function markUpVersion()
    {
        $this->updateVersion($this->getUpVersion());
    }

    protected function markDownVersion()
    {
        if ($version = $this->getDownVersion()) {
            $this->updateVersion($version);
        } else {
            $this->removeVersion();
        }
    }

    /**
     * Creates the version table.
     */
    protected function createVersionTable()
    {
        $tableName = $this->db->schema->getRawTableName($this->table);
        \Yii::info("Creating version table \"$tableName\"...");
        $this->db->createCommand()->createTable($this->table, [
            'module' => 'varchar(45) NOT NULL PRIMARY KEY',
            'version' => 'varchar(45) NOT NULL',
        ])->execute();
        \Yii::info("done.\n");
    }

    /**
     * get module version
     * @return bool|null|string
     */
    public function getVersion()
    {
        if ($this->db->schema->getTableSchema($this->table, true) === null) {
            $this->createVersionTable();
        }

        return (new Query())->select(['version'])
            ->from($this->table)
            ->where(['module' => $this->module])
            ->createCommand($this->db)
            ->queryScalar();
    }

    protected function updateVersion($version)
    {
        if($this->getVersion()) {
            $this->update($this->table, ['version' => $version], ['module' => $this->module]);
        } else {
            $this->insert($this->table, ['version' => $version, 'module' => $this->module]);
        }
    }

    protected function removeVersion()
    {
        $this->delete($this->table, ['module' => $this->module]);
    }

    public function createTable($table, $columns, $options = null)
    {
        if ($options == null) {
            if ($this->db->driverName === 'mysql') {
                // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
                $options = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
            }
        }
        parent::createTable($table, $columns, $options);
    }
} 