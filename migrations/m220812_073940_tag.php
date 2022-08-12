<?php

use yii\db\Migration;

/**
 * Class m220812_073940_tag
 */
class m220812_073940_tag extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('Tag', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "Table Tag deleted.\n";

        $this->dropTable('Tag');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220812_073940_tag cannot be reverted.\n";

        return false;
    }
    */
}
