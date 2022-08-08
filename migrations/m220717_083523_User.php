<?php

use yii\db\Migration;

/**
 * Class m220717_083523_User
 */
class m220717_083523_User extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('User', [
            'id' => $this->primaryKey(),
            'username' => $this->string()->notNull(),
            'password' => $this->string()->notNull(),
            'email' => $this->string()->notNull(),
            'confirm_token' => $this->string(),
            'status' => $this->integer(),
            'access_token' => $this->string()->notNull(),
            'auth_key' => $this->string()->notNull()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "Table User deleted.\n";

        $this->dropTable('User');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220716_185016_Users cannot be reverted.\n";

        return false;
    }
    */
}
