<?php
/**
 * @author Lujie.Zhou(gao_lujie@live.cn)
 * @Date 10/14/2014
 * @Time 15:27 AM
 */
namespace yincart\category\migrations;

use kiwi\db\Migration;
use kiwi\Kiwi;
use yii\db\Schema;

class v0_1_0_v0_2_0 extends Migration
{
    public function safeUp()
    {
        $this->createTable('{{%item_tree}}', [
            'item_tree_id' => Schema::TYPE_PK,
            'item_id' => Schema::TYPE_INTEGER . ' NOT NULL',
            'tree_id' => Schema::TYPE_INTEGER . ' NOT NULL',
        ]);

        $this->insert('{{%tree}}', [
            'name' => 'default',
            'root' => 1,
            'lft' => 1,
            'rgt' => 2,
            'level' => 1,
            'type' => 'yincart-tag',
        ]);
    }

    public function safeDown()
    {
        $this->dropTable('{{%item_tree}}');
    }
}
