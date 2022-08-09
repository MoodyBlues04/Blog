<?php

use yii\db\Migration;

/**
 * Class m220809_192700_article
 */
class m220809_192700_article extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('Article', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'header' => $this->string()->notNull(),
            'content' => $this->text()->notNull(),
            'tags' => $this->string(),
            'created_at' => $this->dateTime()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "Table Article deleted.\n";

        $this->dropTable('Article');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220809_192700_article cannot be reverted.\n";

        return false;
    }
    */
}
