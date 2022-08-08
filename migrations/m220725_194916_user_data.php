<?php

use yii\db\Migration;

/**
 * Class m220725_194916_user_data
 */
class m220725_194916_user_data extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('user_data', [
            'id' => $this->primaryKey(),
            'auth_key' => $this->string()->notNull(),
            'name' => $this->string(),
            'surname' => $this->string(),
            'gender' => $this->integer(),
            'introduction' => $this->text()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "Table user_data deleted.\n";

        $this->dropTable('UserData');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220725_194916_user_data cannot be reverted.\n";

        return false;
    }
    */
}
