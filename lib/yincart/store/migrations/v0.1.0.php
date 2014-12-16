<?php
/**
 * @author Lujie.Zhou(gao_lujie@live.cn)
 * @Date 10/14/2014
 * @Time 15:27 AM
 */
namespace yincart\store\migrations;

use kiwi\db\Migration;
use yii\db\Schema;

class v0_1_0 extends Migration
{
    public function safeUp()
    {
        $this->addColumn('{{%category}}', 'store_id', Schema::TYPE_INTEGER);
        $this->addColumn('{{%item}}', 'store_id', Schema::TYPE_INTEGER);
    }

    public function safeDown()
    {
    }
}
