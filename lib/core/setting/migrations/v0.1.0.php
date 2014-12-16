<?php
/**
 * @author Lujie.Zhou(gao_lujie@live.cn)
 * @Date 10/14/2014
 * @Time 15:27 AM
 */
namespace core\setting\migrations;

use kiwi\db\Migration;
use yii\db\Schema;

class v0_1_0 extends Migration
{
    public function safeUp()
    {
        $this->createTable('{{%setting}}', [
            'setting_id' => Schema::TYPE_PK,
            'path' => Schema::TYPE_STRING . ' NOT NULL',
            'value' => Schema::TYPE_TEXT,
        ]);
    }

    public function safeDown()
    {
        $this->dropTable('{{%setting}}');
    }
}
