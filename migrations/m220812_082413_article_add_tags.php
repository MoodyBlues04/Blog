<?php

use yii\db\Migration;

/**
 * Class m220812_082413_article_add_tags
 */
class m220812_082413_article_add_tags extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('article', 'tags', $this->string()->after('content'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "Column tags from table article deleted.\n";

        $this->dropColumn('article', 'tags');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220812_082413_article_add_tags cannot be reverted.\n";

        return false;
    }
    */
}
