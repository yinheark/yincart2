<?php
/**
 * @author Cangzhou Wu<wucang.zhou@jago-ag.cn>
 * @Date: 14-11-27
 * @Time: 下午1:58
 */

namespace extensions\sales\migrations;

use kiwi\db\Migration;
use kiwi\Kiwi;
use yii\db\Schema;
use creocoder\behaviors\NestedSet;
use yincart\itemprop\models\ItemProp;

class v0_1_0_v0_2_0 extends Migration
{
    public function safeUp()
    {

        $newTag = Kiwi::getTag();
        $newTag->name = '首页标签';
        /** @var  $tagModel \creocoder\behaviors\NestedSet */
        $tagModel = Kiwi::getTag()->find()->where(['root'=>1])->one();
        $tagModel->append($newTag);

        $this->createTable('{{%customer_seller}}', [
            'customer_id' => Schema::TYPE_INTEGER . ' PRIMARY KEY ',
            'money' => Schema::TYPE_DECIMAL . '(10, 2) NOT NULL',
            'pin_password' => Schema::TYPE_STRING . ' NOT NULL',
            'referrer' => Schema::TYPE_STRING . ' NOT NULL',
            'status' => Schema::TYPE_INTEGER,
            'integral' => Schema::TYPE_DECIMAL . '(10, 2)',
            'reference_no' => Schema::TYPE_INTEGER,
            'level' => Schema::TYPE_INTEGER . ' NOT NULL'
        ]);

        $this->createTable('{{%seller_money_log}}', [
            'seller_money_log_id' => Schema::TYPE_INTEGER,
            'money' => Schema::TYPE_DECIMAL . '(10, 2) NOT NULL',
            'type' => Schema::TYPE_STRING . ' NOT NULL',
            'info' => Schema::TYPE_STRING . ' NOT NULL',
            'created_at' => Schema::TYPE_STRING . ' NOT NULL',
        ]);

    }

    public function safeDown()
    {
        $this->dropTable('{{%customer_seller}}');
        $this->dropTable('{{%seller_money_log}}');
    }
}