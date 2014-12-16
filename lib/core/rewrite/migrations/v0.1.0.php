<?php
/**
 * @author Lujie.Zhou(gao_lujie@live.cn)
 * @Date 10/14/2014
 * @Time 15:27 AM
 */
namespace core\rewrite\migrations;

use kiwi\db\Migration;
use yii\db\Schema;

class v0_1_0 extends Migration
{
    public function safeUp()
    {
        $this->createTable('{{%url_rewrite}}', [
            'url_rewrite_id' => Schema::TYPE_PK,
            'request_path' => Schema::TYPE_STRING . ' NOT NULL',
            'route' => Schema::TYPE_STRING . ' NOT NULL',
            'params' => Schema::TYPE_STRING,
        ]);
    }

    public function safeDown()
    {
        $this->dropTable('{{%url_rewrite}}');
    }
}
