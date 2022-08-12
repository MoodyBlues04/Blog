<?php

namespace app\models;

use yii\db\ActiveRecord;

/**
 * Class Tag
 * @package app\models
 *
 * @property int $id
 * @property string $name
 */
class Tag extends ActiveRecord
{

    public static function primaryKey()
    {
        return 'id';
    }

    public static function getTableName() {
        return "{{tag}}";
    }

    /**
     * Denotes dependencies
     * Finds Articles
     * 
     * @return app\models\Article
     */
    public function getArticles() {
        return $this->hasMany(Article::class, ['id' => 'article_id'])
            ->viaTable('article_to_tag', ['tag_id' => 'id']);
    }
}