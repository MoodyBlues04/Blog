<?php

use yii\db\Migration;

/**
 * Class m220726_102151_addImageColumn
 */
class m220726_102151_addImageColumn extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('user_data', 'image', $this->string()->after('introduction'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "Column image from table user_data deleted.\n";

        $this->dropColumn('user_data', 'image');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220726_102151_addImageColumn cannot be reverted.\n";

        return false;
    }
    */
}
