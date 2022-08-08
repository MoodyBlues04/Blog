<?php

use yii\db\Migration;

/**
 * Class m220729_153437_logger
 */
class m220729_153437_logger extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('Logger', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer(),
            'message' => $this->string(),
            'data' => $this->string(),
            'created_at' => $this->string()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "Table Logger deleted.\n";

        $this->dropTable('Logger');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220729_153437_logger cannot be reverted.\n";

        return false;
    }
    */
}
