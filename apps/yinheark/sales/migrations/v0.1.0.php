<?php
/**
 * @author Cangzhou Wu<wucang.zhou@jago-ag.cn>
 * @Date: 14-11-27
 * @Time: 下午1:58
 */

namespace extensions\sales\migrations;

use kiwi\db\Migration;
use yii\db\Schema;

class v0_1_0 extends Migration
{
    public function safeUp()
    {
        $this->createTable('{{%customer_sales}}', [
            'customer_sales_id' => Schema::TYPE_PK,
            'user_id' => Schema::TYPE_INTEGER . ' NOT NULL',
            'item_id' => Schema::TYPE_INTEGER . ' NOT NULL',
            'status' => Schema::TYPE_INTEGER,
            'price' => Schema::TYPE_DECIMAL . '(10, 2) NOT NULL',
            'sale_price' => Schema::TYPE_DECIMAL . '(10, 2) NOT NULL',
            'memo' => Schema::TYPE_STRING,
            'key' => Schema::TYPE_STRING,
        ]);
    }

    public function safeDown()
    {
        $this->dropTable('{{%customer_sales}}');
    }
}