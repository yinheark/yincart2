<?php
/**
 * @author Lujie.Zhou(gao_lujie@live.cn)
 * @Date 10/14/2014
 * @Time 15:27 AM
 */
namespace yincart\item\migrations;

use kiwi\db\Migration;
use yii\db\Schema;

class v0_1_0 extends Migration
{
    public function safeUp()
    {
        $this->createTable('{{%item}}', [
            'item_id' => Schema::TYPE_PK,
            'sku' => Schema::TYPE_STRING . ' NOT NULL',
            'name' => Schema::TYPE_STRING . ' NOT NULL',
            'description' => Schema::TYPE_TEXT . ' NOT NULL',
            'short_description' => Schema::TYPE_TEXT . ' NOT NULL',
            'meta_keywords' => Schema::TYPE_STRING . ' NOT NULL',
            'meta_description' => Schema::TYPE_STRING . ' NOT NULL',
            'original_price' => Schema::TYPE_DECIMAL . '(10, 2) NOT NULL',
            'price' => Schema::TYPE_DECIMAL . '(10, 2) NOT NULL',
            'stock_qty' => Schema::TYPE_INTEGER . ' NOT NULL',
            'min_sale_qty' => Schema::TYPE_INTEGER . ' NOT NULL',
            'max_sale_qty' => Schema::TYPE_INTEGER . ' NOT NULL',
            'weight' => Schema::TYPE_DECIMAL . '(10, 2) NOT NULL',
            'shipping_fee' => Schema::TYPE_DECIMAL . '(10, 2) NOT NULL',
            'is_free_shipping' => Schema::TYPE_INTEGER . ' NOT NULL',
            'pictures' => Schema::TYPE_STRING . '(1023) NOT NULL',
            'sort' => Schema::TYPE_INTEGER . ' NOT NULL',
            'status' => Schema::TYPE_INTEGER . ' NOT NULL',
        ]);
    }

    public function safeDown()
    {
        $this->dropTable('{{%item}}');
    }
}
