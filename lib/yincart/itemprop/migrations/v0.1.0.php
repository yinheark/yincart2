<?php
/**
 * @author Lujie.Zhou(gao_lujie@live.cn)
 * @Date 10/14/2014
 * @Time 15:27 AM
 */
namespace yincart\itemprop\migrations;

use kiwi\db\Migration;
use yii\db\Schema;

class v0_1_0 extends Migration
{
    public function safeUp()
    {
        $this->createTable('{{%item_prop}}', [
            'item_prop_id' => Schema::TYPE_PK,
            'category_id' => Schema::TYPE_INTEGER . ' NOT NULL',
            'name' => Schema::TYPE_STRING . ' NOT NULL',
            'type' => Schema::TYPE_INTEGER . ' NOT NULL',
            'is_key' => Schema::TYPE_INTEGER . ' NOT NULL',
            'is_sale' => Schema::TYPE_INTEGER . ' NOT NULL',
            'is_color' => Schema::TYPE_INTEGER . ' NOT NULL',
            'is_search' => Schema::TYPE_INTEGER . ' NOT NULL',
            'is_must' => Schema::TYPE_INTEGER . ' NOT NULL',
            'sort' => Schema::TYPE_INTEGER . ' NOT NULL',
            'status' => Schema::TYPE_INTEGER . ' NOT NULL',
        ]);

        $this->createTable('{{%prop_value}}', [
            'prop_value_id' => Schema::TYPE_PK,
            'item_prop_id' => Schema::TYPE_INTEGER . ' NOT NULL',
            'name' => Schema::TYPE_STRING . ' NOT NULL',
            'sort' => Schema::TYPE_INTEGER . ' NOT NULL',
            'status' => Schema::TYPE_INTEGER . ' NOT NULL',
        ]);

        $this->createTable('{{%item_prop_value}}', [
            'item_prop_value_id' => Schema::TYPE_PK,
            'item_id' => Schema::TYPE_INTEGER . ' NOT NULL',
            'item_prop_id' => Schema::TYPE_INTEGER . ' NOT NULL',
            'prop_value_id' => Schema::TYPE_INTEGER . ' NOT NULL',
            'custom_prop_value' => Schema::TYPE_STRING . '(1023) NOT NULL',
        ]);

        $this->createTable('{{%sku}}', [
            'sku_id' => Schema::TYPE_PK,
            'item_id' => Schema::TYPE_INTEGER . ' NOT NULL',
            'sku' => Schema::TYPE_STRING . ' NOT NULL',
            'properties' => Schema::TYPE_STRING . ' NOT NULL',
            'property_names' => Schema::TYPE_STRING . ' NOT NULL',
            'stock_qty' => Schema::TYPE_INTEGER . ' NOT NULL',
            'price' => Schema::TYPE_INTEGER . ' NOT NULL',
        ]);
    }

    public function safeDown()
    {
        $this->dropTable('{{%item_prop}}');
        $this->dropTable('{{%prop_value}}');
        $this->dropTable('{{%item_prop_value}}');
    }
}
