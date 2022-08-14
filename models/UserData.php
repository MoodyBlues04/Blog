<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * Class UserData
 * @package app\models
 *
 * @property int $id
 * @property int $user_id
 * @property string $name
 * @property string $surname
 * @property string $gender
 * @property string $introduction
 * @property string $image
 */
class UserData extends ActiveRecord
{
    const GENDER_MALE = 0;
    const GENDER_FEMALE = 1;
    const GENDER_ATTACK_HELICOPTER = 2;

    public function rules()
    {
        return [
            [['user_id'], 'required'],
            ['gender', 'in', 'range' => [self::GENDER_MALE, self::GENDER_FEMALE, self::GENDER_ATTACK_HELICOPTER]],
            [['name', 'surname', 'gender', 'introduction'], 'safe'],
            [['introduction'], 'string', 'max' => 800],
        ];
    }

    public static function primaryKey()
    {
        return 'id';
    }

    public static function getTableName() {
        return "{{user_data}}";
    }

    /**
     * Denotes dependencies
     * Finds User by UserData
     * 
     * @return User
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }

    /**
     * Returns link to user's icon
     * 
     * @return string
     */
    public static function getImgPath()
    {
        $defaultPath = "https://i.ibb.co/rZ3DXMk/default-png.png";
        if (Yii::$app->user->isGuest) {
            return $defaultPath;
        }

        if (empty(Yii::$app->user->identity->userData->image)) {
            return $defaultPath;
        }

        return Yii::$app->user->identity->userData->image;
    }
}