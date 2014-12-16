<?php
/**
 * @author Lujie.Zhou(gao_lujie@live.cn)
 * @Date 10/14/2014
 * @Time 15:27 AM
 */
namespace core\theme\migrations;

use kiwi\db\Migration;
use yii\db\Schema;

class v0_1_0 extends Migration
{
    public function safeUp()
    {
        $this->createTable('{{%theme}}', [
            'theme_id' => Schema::TYPE_PK,
            'key' => Schema::TYPE_STRING . ' NOT NULL',
            'name' => Schema::TYPE_STRING . ' NOT NULL',
            'thumb' => Schema::TYPE_STRING . '(1023)',
            'sort' => Schema::TYPE_INTEGER . ' NOT NULL',
            'scope' => Schema::TYPE_STRING . ' NOT NULL',
            'is_active' => Schema::TYPE_INTEGER . ' NOT NULL',
        ]);
    }

    public function safeDown()
    {
        $this->dropTable('{{%theme}}');
    }
}
