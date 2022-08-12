<?php

namespace app\models;

use yii\db\ActiveRecord;

/**
 * Class Article
 * @package app\models
 *
 * @property int $id
 * @property int $user_id
 * @property string $header
 * @property string $content
 * @property dateTime $created_at
 */
class Article extends ActiveRecord
{
    public function rules()
    {
        return [
            [ ['header'], 'string', 'max' => 20],
            [ ['content'], 'string', 'max' => 1000],
        ];
    }

    public static function primaryKey()
    {
        return 'id';
    }

    public static function getTableName() {
        return "{{article}}";
    }

    /**
     * Denotes dependencies
     * Finds User
     * @return User
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }
}