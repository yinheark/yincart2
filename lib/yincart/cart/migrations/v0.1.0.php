<?php
/**
 * @author Lujie.Zhou(gao_lujie@live.cn)
 * @Date 10/14/2014
 * @Time 15:27 AM
 */
namespace yincart\cart\migrations;

use kiwi\db\Migration;
use kiwi\Kiwi;
use yii\db\Schema;

class v0_1_0 extends Migration
{
    public function safeUp()
    {
        $this->createTable('{{%cart}}', [
            'cart_id' => Schema::TYPE_PK,
            'user_id' => Schema::TYPE_INTEGER . ' NOT NULL',
            'item_id' => Schema::TYPE_INTEGER . ' NOT NULL',
            'qty' => Schema::TYPE_INTEGER . ' NOT NULL',
            'data' => Schema::TYPE_STRING,
        ]);
    }

    public function safeDown()
    {
        $this->dropTable('{{%cart}}');
    }
}
