<?php
/**
 * @author Lujie.Zhou(gao_lujie@live.cn)
 * @Date 10/14/2014
 * @Time 15:27 AM
 */
namespace core\setting\migrations;

use kiwi\db\Migration;
use yii\db\Schema;

class v0_1_0_v0_2_0 extends Migration
{
    public function safeUp()
    {
        $this->createTable('{{%data_list}}', [
            'data_list_id' => Schema::TYPE_PK,
            'type' => Schema::TYPE_STRING . ' NOT NULL',
            'key' => Schema::TYPE_STRING . ' NOT NULL',
            'value' => Schema::TYPE_STRING,
        ]);
    }

    public function safeDown()
    {
        $this->dropTable('{{%data_list}}');
    }
}
