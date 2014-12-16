<?php
/**
 * @author Lujie.Zhou(gao_lujie@live.cn)
 * @Date 10/14/2014
 * @Time 15:27 AM
 */
namespace yincart\order\migrations;

use kiwi\db\Migration;
use kiwi\Kiwi;
use yii\db\Schema;

class v0_1_0 extends Migration
{
    public function safeUp()
    {
        $this->createTable('{{%order}}', [
            'order_id' => Schema::TYPE_PK,
            'user_id' => Schema::TYPE_INTEGER . ' NOT NULL',
            'order_no' => Schema::TYPE_STRING . ' NOT NULL',
            'total_price' => Schema::TYPE_DECIMAL . '(10, 2) NOT NULL',
            'shipping_fee' => Schema::TYPE_DECIMAL . '(10, 2) NOT NULL',
            'payment_fee' => Schema::TYPE_DECIMAL . '(10, 2) NOT NULL',
            'address' => Schema::TYPE_STRING . ' NOT NULL',
            'memo' => Schema::TYPE_STRING . ' NOT NULL',
            'create_at' => Schema::TYPE_INTEGER . ' NOT NULL',
            'update_at' => Schema::TYPE_INTEGER . ' NOT NULL',
            'status' => Schema::TYPE_INTEGER . ' NOT NULL',
        ]);

        $this->createTable('{{%order_item}}', [
            'order_item_id' => Schema::TYPE_PK,
            'order_id' => Schema::TYPE_INTEGER . ' NOT NULL',
            'item_id' => Schema::TYPE_INTEGER . ' NOT NULL',
            'price' => Schema::TYPE_DECIMAL . '(10, 2) NOT NULL',
            'qty' => Schema::TYPE_INTEGER . ' NOT NULL',
            'name' => Schema::TYPE_STRING . ' NOT NULL',
            'picture' => Schema::TYPE_STRING . ' NOT NULL',
        ]);
    }

    public function safeDown()
    {
        $this->dropTable('{{%order_item}}');
        $this->dropTable('{{%order}}');
    }
}
