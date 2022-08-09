<?php

use yii\db\Migration;

/**
 * Class m220809_193802_logger_with_datetime
 */
class m220809_193802_logger_with_datetime extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropColumn('logger', 'created_at');
        $this->addColumn('logger', 'created_at', $this->dateTime()->after('stack_trace'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "Column created_at from table logger deleted now string.\n";

        $this->dropColumn('logger', 'created_at');
        $this->addColumn('logger', 'created_at', $this->string()->after('stack_trace'));
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220809_193802_logger_with_datetime cannot be reverted.\n";

        return false;
    }
    */
}
