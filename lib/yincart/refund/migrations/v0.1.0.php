<?php
/**
 * @author Lujie.Zhou(gao_lujie@live.cn)
 * @Date 10/14/2014
 * @Time 15:27 AM
 */
namespace yincart\refund\migrations;

use kiwi\db\Migration;
use kiwi\Kiwi;
use yii\db\Schema;

class v0_1_0 extends Migration
{
    public function safeUp()
    {
        $this->createTable('{{%refund}}', [
            'refund_id' => Schema::TYPE_PK,
            'order_id' => Schema::TYPE_INTEGER . ' NOT NULL',
            'refund_fee' => Schema::TYPE_DECIMAL . '(10, 2) NOT NULL',
            'reason' => Schema::TYPE_STRING . ' NOT NULL',
            'memo' => Schema::TYPE_STRING . ' NOT NULL',
            'create_at' => Schema::TYPE_INTEGER . ' NOT NULL',
            'update_at' => Schema::TYPE_INTEGER . ' NOT NULL',
            'status' => Schema::TYPE_INTEGER . ' NOT NULL',
        ]);
    }

    public function safeDown()
    {
        $this->dropTable('{{%refund_log}}');
    }
}
