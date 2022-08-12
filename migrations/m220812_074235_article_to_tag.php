<?php

use yii\db\Migration;

/**
 * Class m220812_074235_article_to_tag
 */
class m220812_074235_article_to_tag extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('article_to_tag', [
            'id' => $this->primaryKey(),
            'article_id' => $this->integer()->notNull(),
            'tag_id' => $this->integer()->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "Table article_to_tag deleted.\n";

        $this->dropTable('article_to_tag');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220812_074235_article_to_tag cannot be reverted.\n";

        return false;
    }
    */
}
