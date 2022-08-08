<?php

use yii\db\Migration;

/**
 * Class m220806_203516_logger_update
 */
class m220806_203516_logger_update extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('logger', 'stack_trace', $this->string()->after('data'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "Column stack_trace from table logger deleted.\n";

        $this->dropColumn('logger', 'stack_trace');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220806_203516_logger_update cannot be reverted.\n";

        return false;
    }
    */
}
