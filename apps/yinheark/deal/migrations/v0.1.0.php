<?php
/**
 * @author Cangzhou Wu<wucang.zhou@jago-ag.cn>
 * @Date: 14-11-27
 * @Time: 下午1:58
 */

namespace extensions\deal\migrations;

use kiwi\db\Migration;
use yii\db\Schema;

class v0_1_0 extends Migration
{
    public function safeUp()
    {
        $this->createTable('{{%deal_log}}', [
            'deal_log_id' => Schema::TYPE_PK,
            'user_id' => Schema::TYPE_INTEGER,
            'order_id' => Schema::TYPE_INTEGER,
            'item_id' => Schema::TYPE_INTEGER,
            'sale_price' => Schema::TYPE_INTEGER,
            'percent' => Schema::TYPE_INTEGER,
            'memo' => Schema::TYPE_STRING,
            'key' => Schema::TYPE_STRING,
            'deal_time' => Schema::TYPE_INTEGER,
            'created_at' => Schema::TYPE_INTEGER,
        ]);
    }

    public function safeDown()
    {
        $this->dropTable('{{%deal_log}}');
    }
}