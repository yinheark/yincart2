<?php
/**
 * @author Lujie.Zhou(gao_lujie@live.cn)
 * @Date 10/14/2014
 * @Time 15:27 AM
 */
namespace core\cron\migrations;

use kiwi\db\Migration;
use kiwi\Kiwi;
use yii\db\Schema;

class v0_1_0 extends Migration
{
    public function safeUp()
    {
        $this->createTable('{{%cron}}', [
            'cron_id' => Schema::TYPE_PK,
            'name' => Schema::TYPE_STRING . ' NOT NULL',
            'expression' => Schema::TYPE_STRING . '(32) NOT NULL',
            'func' => Schema::TYPE_STRING . ' NOT NULL',
            'once' => Schema::TYPE_INTEGER . ' NOT NULL',
            'status' => Schema::TYPE_INTEGER . ' NOT NULL',
        ]);
    }

    public function safeDown()
    {
        $this->dropTable('{{%cron}}');
    }
}
