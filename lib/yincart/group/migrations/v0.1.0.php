<?php
/**
 * @author Lujie.Zhou(gao_lujie@live.cn)
 * @Date 10/14/2014
 * @Time 15:27 AM
 */
namespace yincart\group\migrations;

use kiwi\db\Migration;
use kiwi\Kiwi;
use yii\db\Schema;

class v0_1_0 extends Migration
{
    public function safeUp()
    {
        $this->createTable('{{%customer_tree}}', [
            'user_id' => Schema::TYPE_INTEGER . ' NOT NULL',
            'tree_id' => Schema::TYPE_INTEGER . ' NOT NULL',
        ]);

        $this->insert('{{%tree}}', [
            'name' => 'default',
            'root' => 1,
            'lft' => 1,
            'rgt' => 2,
            'level' => 1,
            'type' => 'customer-group',
        ]);
    }

    public function safeDown()
    {
        $this->dropTable('{{%customer_tree}}');
    }
}
