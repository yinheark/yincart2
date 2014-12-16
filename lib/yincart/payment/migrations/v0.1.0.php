<?php
/**
 * @author Lujie.Zhou(gao_lujie@live.cn)
 * @Date 10/14/2014
 * @Time 15:27 AM
 */
namespace yincart\payment\migrations;

use kiwi\db\Migration;
use kiwi\Kiwi;
use yii\db\Schema;

class v0_1_0 extends Migration
{
    public function safeUp()
    {
        $this->createTable('{{%payment}}', [
            'payment_id' => Schema::TYPE_PK,
            'order_id' => Schema::TYPE_INTEGER . ' NOT NULL',
            'payment_method' => Schema::TYPE_INTEGER . ' NOT NULL',
            'payment_fee' => Schema::TYPE_DECIMAL . '(10, 2) NOT NULL',
            'transcation_no' => Schema::TYPE_STRING . ' NOT NULL',
            'create_at' => Schema::TYPE_INTEGER . ' NOT NULL',
            'status' => Schema::TYPE_INTEGER . ' NOT NULL',
        ]);
    }

    public function safeDown()
    {
        $this->dropTable('{{%pay_log}}');
    }
}
