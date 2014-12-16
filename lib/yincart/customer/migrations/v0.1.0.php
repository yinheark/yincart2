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

class v0_1_0 extends Migration
{
    public function safeUp()
    {
        $this->createTable('{{%customer_info}}', [
            'user_id' => 'int(11) NOT NULL PRIMARY KEY',
            'nick_name' => Schema::TYPE_STRING,
            'real_name' => Schema::TYPE_STRING,
            'avatars' => Schema::TYPE_STRING,
            'phone' => Schema::TYPE_STRING,
            'qq' => Schema::TYPE_STRING,
            'address' => Schema::TYPE_STRING,
            'sex' => Schema::TYPE_INTEGER,
            'age' => Schema::TYPE_INTEGER,
            'payment_password' => Schema::TYPE_STRING,
            'id_card_no' => Schema::TYPE_STRING,
            'id_card_front_pic' => Schema::TYPE_STRING,
            'id_card_back_pic' => Schema::TYPE_STRING,
        ]);
    }

    public function safeDown()
    {
        $this->dropTable('{{%customer_info}}');
    }
}
