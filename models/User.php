<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use \yii\web\IdentityInterface;

/**
 * Class User
 * @package app\models
 *
 * @property int $id
 * @property string $username
 * @property string $password
 * @property string $email
 * @property string $confirm_token
 * @property int $status
 * @property string $auth_key
 * @property string $access_token
 */
class User extends ActiveRecord implements IdentityInterface
{
    const STATUS_WAIT = 0;
    const STATUS_ACTIVE = 1;
    const STATUS_DELETED = 2;
    

    public function rules()
    {
        return [
            [['username', 'password', 'email', 'auth_key', 'access_token'], 'required'],
            [ ['password'], 'string', 'min' => 8],
            // [['username', 'email'], 'unique'],
            ['status', 'in', 'range' => [self::STATUS_DELETED, self::STATUS_WAIT, self::STATUS_ACTIVE]],
            [['email'], 'email'],
        ];
    }

    public static function primaryKey()
    {
        return 'id';
    }

    public static function getTableName() {
        return "{{user}}";
    }

    /**
     * Finds UserData
     * 
     * @return UserData
     */
    public function getUserData()
    {
        return $this->hasOne(UserData::class, ['auth_key' => 'auth_key']);
    }

    /**
     * Finds UserData by session data.
     * 
     * @return UserData
     */
    public static function getData() {
        if (Yii::$app->user->isGuest) {
            return null;
        }
        $username = Yii::$app->user->identity->username;
        $user = self::findByUsername($username);
        return $user->userData;
    }

    /**
     * Finds user by id
     * 
     * @param int $id
     * 
     * @return User 
     */
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id]);
    }

    /**
     * Finds user by access token
     * 
     * @param string $token
     * 
     * @return User 
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['access_token' => $token]);
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * 
     * @return User
     */
    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username]);
    }

    /**
     * Finds user by email
     *
     * @param string $email
     * 
     * @return User
     */
    public static function findByEmail($email)
    {
        return static::findOne(['email' => $email]);
    }

    /**
     * @return int $id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * {@inheritdoc}
     */
    public function validateAuthKey($authKey)
    {
        return $this->auth_key === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return $this->password === $password;
    }
}
