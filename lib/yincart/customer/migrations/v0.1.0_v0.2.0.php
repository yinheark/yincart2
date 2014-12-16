<?php
/**
 * @author Lujie.Zhou(gao_lujie@live.cn)
 * @Date 10/14/2014
 * @Time 15:27 AM
 */
namespace yincart\customer\migrations;

use kiwi\db\Migration;
use kiwi\Kiwi;
use yii\db\Schema;

class v0_1_0_v0_2_0 extends Migration
{
    public function safeUp()
    {
        $this->createTable('{{%customer_address}}', [
            'customer_address_id' => Schema::TYPE_PK,
            'user_id' => Schema::TYPE_INTEGER,
            'province' => Schema::TYPE_STRING,
            'city' => Schema::TYPE_STRING,
            'district' => Schema::TYPE_STRING,
            'address' => Schema::TYPE_STRING,
            'zip_code' => Schema::TYPE_STRING,
            'phone' => Schema::TYPE_STRING,
            'name' => Schema::TYPE_STRING,
            'is_default' => Schema::TYPE_INTEGER,
        ]);
    }

    public function safeDown()
    {
        $this->dropTable('{{%customer_address}}');
    }
}
